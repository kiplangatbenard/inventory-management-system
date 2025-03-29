<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\GadgetRequest;
use App\Models\GadgetReturnRequest;
use App\Models\User;
use App\Models\Gadget;
use App\Models\Allocation;
use App\Models\Issue;


//use Illuminate\Http\Request;
//use App\Models\Gadget; // Import Gadget model
//use App\Models\User;   // Import User model
//use App\Models\GadgetRequest; // Import GadgetRequest model
//use App\Models\GadgetReturnRequest; // Import GadgetReturnRequest model
use App\Models\GadgetReturnRequest as GadgetReturnRequestModel; // Alias for GadgetReturnRequest model
use App\Models\Report; // Import Report model
use Illuminate\Support\Facades\DB; // Import DB facade
use App\Models\Request; // Import the database model, NOT Illuminate\Http\Request
//use Illuminate\Http\Request as HttpRequest; // Alias for HTTP Request
use Illuminate\Support\Facades\Log; // Import Logging
//use App\Models\Allocation;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role.admin');
    }

    public function dashboard()
{
    $totalGadgets = Gadget::count();
    $totalUsers = User::count();
    $pendingRequests = GadgetRequest::where('status', 'pending')->with('user')->get();
    $pendingRequestsCount = $pendingRequests->count();
    $allocatedGadgets = Gadget::whereNotNull('assigned_to')->count();
    $returnRequests = GadgetReturnRequest::where('status', 'pending')->with(['user', 'gadget'])->get();
    $pendingRequestsCount = GadgetRequest::where('status', 'pending')->count();
    $allocatedGadgets = GadgetRequest::where('status', 'assigned')->count();
    $gadgetUsage = Gadget::select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->pluck('total', 'type');
    
    $issueTrends = GadgetRequest::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->pluck('total', 'month');

    return view('admin.dashboard', compact(
        'totalGadgets', 'totalUsers', 'pendingRequests', 'pendingRequestsCount',
        'allocatedGadgets','returnRequests', 'gadgetUsage', 'issueTrends'
    ));
}

    
    
    public function getPendingRequests()
    {
        $pendingRequests = GadgetRequest::where('status', 'pending')->with('user')->get();
        return response()->json($pendingRequests);
    }
    
    // Generate Reports
    public function generateReports()
    {
        $allocatedGadgets = Gadget::where('status', 'assigned')->count();
        $availableGadgets = Gadget::where('status', 'available')->count();

        // Save report to the database (optional)
        Report::create([
            'type' => 'allocated_gadgets',
            'generated_by' => auth()->id(),
            'data' => json_encode([
                'allocated_gadgets' => $allocatedGadgets,
                'available_gadgets' => $availableGadgets,
            ]),
        ]);

        return view('admin.reports', compact('allocatedGadgets', 'availableGadgets'));
    }
    public function pendingRequests()
{
    $users = User::whereHas('gadgetRequests', function ($query) {
        $query->where('status', 'pending');
    })->get();

    return view('admin.pendingRequests', compact('users'));
}
public function approveRequest($id)
{
    $request = GadgetRequest::find($id);
    if (!$request) {
        return redirect()->back()->with('error', 'Request not found.');
    }

    $request->status = 'approved';
    $request->save();

    return redirect()->back()->with('success', 'Request approved successfully.');
}
/*public function assignGadget($id)
{
    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $pendingRequests = GadgetRequest::where('user_id', $id)->where('status', 'pending')->get();
    $gadgets = Gadget::where('status', 'available')->get(); 

    return view('admin.assignGadget', compact('user', 'pendingRequests', 'gadgets'));
}
*/public function assignGadget(Request $request)
{
    $gadgetId = $request->input('gadget_id');
    $userId = $request->input('user_id');

    // Check if the gadget is already assigned
    $existingAssignment = DB::table('gadget_assignments')
        ->where('gadget_id', $gadgetId)
        ->where('status', 'approved')
        ->first();

    if ($existingAssignment) {
        return redirect()->back()->with('error', 'Gadget is already assigned and not available.');
    }

    // Assign gadget
    DB::table('gadget_assignments')->insert([
        'gadget_id' => $gadgetId,
        'user_id' => $userId,
        'status' => 'approved',
        'assigned_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Gadget assigned successfully.');
}

public function processAssignment(HttpRequest $request, $requestId)
{
    $gadgetRequest = GadgetRequest::find($requestId);

    if (!$gadgetRequest || $gadgetRequest->status !== 'pending') {
        return redirect()->back()->with('error', 'Gadget request not found or already processed.');
    }

    // Validate
    $request->validate([
        'gadget_id' => 'required|exists:gadgets,id',
    ]);

    // Assign the gadget
    $gadget = Gadget::find($request->gadget_id);
    if (!$gadget || $gadget->status !== 'available') {
        return redirect()->back()->with('error', 'Gadget not available.');
    }

    // Create a new allocation
    Allocation::create([
        'gadget_id' => $gadget->id,
        'user_id' => $gadgetRequest->user_id,
        'status' => 'assigned',
    ]);

    // Update gadget request status
    $gadgetRequest->update(['status' => 'approved']);

    // Update gadget status
    $gadget->update(['status' => 'assigned']);

    return redirect()->route('admin.pendingRequests')->with('success', 'Gadget assigned successfully.');
}
public function viewReturnRequests()
    {
        $returnRequests = GadgetReturnRequest::with('user', 'gadget')->get();
        return view('admin.return_requests', compact('returnRequests'));
    }

    public function approveReturnRequest($id)
    {
        $returnRequest = GadgetReturnRequest::findOrFail($id);
        $returnRequest->status = 'approved';
        $returnRequest->save();

        return redirect()->back()->with('success', 'Return request approved successfully.');
    }

    public function rejectReturnRequest($id)
    {
        $returnRequest = GadgetReturnRequest::findOrFail($id);
        $returnRequest->status = 'rejected';
        $returnRequest->save();

        return redirect()->back()->with('error', 'Return request rejected.');
    }

    public function viewReportedIssues()
    {
        $issues = Issue::with('user', 'gadget')->get();
        return view('admin.reported_issues', compact('issues'));
    }
public function returnGadget($id)
{
    $gadgetRequest = GadgetRequest::where('user_id', $id)
                                  ->where('status', 'approved')
                                  ->latest() // Get the latest request
                                  ->first();

    if (!$gadgetRequest) {
        return redirect()->back()->with('error', 'No approved gadget request found for return.');
    }

    // Change request status
    $gadgetRequest->status = 'returned';
    $gadgetRequest->save();

    // Also update the gadget status
    $gadget = Gadget::find($gadgetRequest->gadget_id);
    if ($gadget) {
        $gadget->status = 'available';
        $gadget->user_id = null;
        $gadget->save();
    }

    return redirect()->back()->with('success', 'Gadget returned successfully.');
}




public function storeAssignedGadget(HttpRequest $request, $id)
{
    Log::info('storeAssignedGadget method called.', ['user_id' => $id, 'gadget_id' => $request->gadget_id]);

    // Validate input
    $request->validate([
        'gadget_id' => 'required|exists:gadgets,id',
    ]);

    // Find the user (instead of employee)
    $user = User::find($id);
    if (!$user) {
        Log::error('User not found.', ['user_id' => $id]);
        return redirect()->back()->with('error', 'User not found.');
    }

    // Find the gadget
    $gadget = Gadget::find($request->gadget_id);
    if (!$gadget) {
        Log::error('Gadget not found.', ['gadget_id' => $request->gadget_id]);
        return redirect()->back()->with('error', 'Gadget not found.');
    }

    // Store allocation
    $allocation = new Allocation();
    $allocation->gadget_id = $gadget->id;
    $allocation->user_id = $user->id;
    $allocation->status = 'pending';
    $allocation->save();

    Log::info('Gadget assigned successfully.', ['allocation_id' => $allocation->id]);

    return redirect()->route('admin.pendingRequests')->with('success', 'Gadget assigned and awaiting approval.');
}




public function requestReturn(Request $request)
{
    $request->validate([
        'gadget_id' => 'required|exists:gadgets,id',
        'return_reason' => 'required|string|max:255',
    ]);

    $gadget = Gadget::find($request->gadget_id);

    if (!$gadget || $gadget->user_id != auth()->id()) {
        return redirect()->back()->with('error', 'Invalid gadget selection.');
    }

    // Create a return request
    GadgetReturnRequest::create([
        'user_id' => auth()->id(),
        'gadget_id' => $gadget->id,
        'return_reason' => $request->return_reason,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Return request submitted for admin approval.');
}

public function approveReturn($id)
{
    $returnRequest = GadgetReturnRequest::findOrFail($id);
    $returnRequest->update(['status' => 'approved']);

    // Mark the gadget as available again
    $gadget = Gadget::find($returnRequest->gadget_id);
    $gadget->update(['status' => 'available', 'user_id' => null]);

    return redirect()->back()->with('success', 'Gadget return approved.');
}
public function rejectReturn($id)
{
    $returnRequest = GadgetReturnRequest::findOrFail($id);
    $returnRequest->update(['status' => 'rejected']);

    return redirect()->back()->with('success', 'Gadget return rejected.');
}




public function rejectRequest($id)
{
    // Find the request
    $request = GadgetRequest::findOrFail($id);

    // Mark the request as "rejected"
    $request->status = 'rejected';
    $request->save();

    return redirect()->back()->with('success', 'Request rejected successfully!');

}
public function viewPendingRequests()
{
    $pendingRequests = GadgetRequest::where('status', 'pending')->with('user')->get();

    return view('admin.viewPendingRequests', compact('pendingRequests'));
}
public function viewGadgets()
{
    $gadgets = Gadget::all();

    return view('admin.viewGadgets', compact('gadgets'));
}
public function viewUsers()
{
    $users = User::all();

    return view('admin.viewUsers', compact('users'));
}
public function viewUserGadgets($id)
{
    $user = User::findOrFail($id);
    $gadgets = $user->gadgets;

    return view('admin.viewUserGadgets', compact('user', 'gadgets'));
}
public function viewUserRequests($id)
{
    $user = User::findOrFail($id);
    $requests = $user->gadgetRequests;

    return view('admin.viewUserRequests', compact('user', 'requests'));
}
public function viewReports()
{
    $reports = Report::all();

    return view('admin.viewReports', compact('reports'));
}
public function deleteReport($id)
{
    // Find the report by ID
    $report = Report::findOrFail($id);

    // Delete the report
    $report->delete();

    return redirect()->back()->with('success', 'Report deleted successfully.');
}
public function approveGadget($id)
{
    $gadgetRequest = GadgetRequest::where('user_id', $id)
                                  ->where('status', 'pending') // Only approve pending requests
                                  ->firstOrFail();

    $gadgetRequest->status = 'approved';
    $gadgetRequest->save();

    return redirect()->back()->with('success', 'Gadget request approved successfully.');
}
public function rejectGadget($id)
{
    $gadgetRequest = GadgetRequest::where('user_id', $id)
                                  ->where('status', 'pending') // Only reject pending requests
                                  ->firstOrFail();

    $gadgetRequest->status = 'rejected';
    $gadgetRequest->save();

    return redirect()->back()->with('success', 'Gadget request rejected successfully.');
}   
public function showPendingRequests()
{
    $pendingRequests = GadgetRequest::where('status', 'pending')->with('user')->get();

    return view('admin.pending-requests', compact('pendingRequests'));
}
public function showApprovedRequests()
{
    $approvedRequests = GadgetRequest::where('status', 'approved')->with('user')->get();

    return view('admin.approved-requests', compact('approvedRequests'));
}
public function showRejectedRequests()
{
    $rejectedRequests = GadgetRequest::where('status', 'rejected')->with('user')->get();

    return view('admin.rejected-requests', compact('rejectedRequests'));
}
public function showReturnedRequests()
{
    $returnedRequests = GadgetRequest::where('status', 'returned')->with('user')->get();

    return view('admin.returned-requests', compact('returnedRequests'));
}
public function showAssignedGadgets()
{
    $assignedGadgets = GadgetRequest::where('status', 'assigned')->with('user')->get();

    return view('admin.assigned-gadgets', compact('assignedGadgets'));
}
public function showAvailableGadgets()
{
    $availableGadgets = Gadget::where('status', 'available')->get();

    return view('admin.available-gadgets', compact('availableGadgets'));
}
public function showAllocatedGadgets()
{
    $allocatedGadgets = Gadget::where('status', 'assigned')->get();

    return view('admin.dashboard', compact('allocatedGadgets'));
}
public function showUsers()
{
    $users = User::all();

    return view('admin.users', compact('users'));
}
public function showUserGadgets($id)
{
    $user = User::findOrFail($id);
    $gadgets = $user->gadgets;

    return view('admin.user-gadgets', compact('user', 'gadgets'));
}
public function showUserRequests($id)
{
    $user = User::findOrFail($id);
    $requests = $user->gadgetRequests;

    return view('admin.user-requests', compact('user', 'requests'));
}


public function managerRequests()
{
    $gadgets = GadgetRequest::whereHas('user', function($query) {
        $query->where('role', 'manager');
    })->get();

    return view('admin.manager_requests.manager_requests', compact('gadgets'));
}



    public function managerAllocations()
    {
        $managerAllocations = Allocation::whereHas('user', function($query) {
            $query->where('role', 'manager');
        })->get();
        return view('admin.manager_requests.manager_allocations', compact('managerAllocations'));
    }

    public function managerIssues()
    {
        $managerIssues = Issue::whereHas('user', function($query) {
            $query->where('role', 'manager');
        })->get();
        return view('admin.manager_requests.manager_issues', compact('managerIssues'));
    }

}