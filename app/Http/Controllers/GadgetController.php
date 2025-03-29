<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use App\Models\GadgetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Issue; 
use Illuminate\Support\Facades\DB;


class GadgetController extends Controller
{
    // Display a listing of gadgets
    public function index()
    {
        $gadgets = GadgetRequest::all();
        return view('gadgets.index', compact('gadgets'));
    }

    // Show the form for creating a new gadget
    public function create()
    {
        return view('gadgets.create');
    }

    // Store a newly created gadget in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:phone,laptop',
            'serial_number' => 'required|string|unique:gadgets',
            'condition' => 'required|in:new,used,damaged',
        ]);

        Gadget::create($request->all());

        return redirect()->route('gadgets.index')->with('success', 'Gadget created successfully.');
    }

    // Display the specified gadget
    public function show($id)
    {
        $gadget = Gadget::findOrFail($id);
        return view('gadgets.show', compact('gadget'));
    }
    
    // Show the form for editing the specified gadget
    public function edit($id)
    {
        $gadget = Gadget::findOrFail($id);

        return view('gadgets.edit', compact('gadget'));
    }

    // Update the specified gadget in the database
    public function update(Request $request, $id)
    {
        $gadget = Gadget::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:phone,laptop',
            'serial_number' => 'required|string|unique:gadgets,serial_number,' . $gadget->id,
            'condition' => 'required|in:new,used,damaged',
        ]);

        $gadget->update($request->all());

        return redirect()->route('gadgets.index')->with('success', 'Gadget updated successfully.');
    }

    // Remove the specified gadget from the database
    public function destroy(Gadget $gadget)
    {
        $gadget->delete();
        return redirect()->route('gadgets.index')->with('success', 'Gadget deleted successfully.');
    }
    public function viewAssignedGadgets()
{
    $assignedGadgets = auth()->user()->gadgets; // Ensure the relationship exists
    return view('user.gadget.view', compact('assignedGadgets'));
}
/*public function assignedGadgets()
    {
        // Get the currently logged-in user's assigned gadgets
        $assignedGadgets = Gadget::where('user_id', Auth::id())->get();

        // Return the user gadgets view
        return view('user.gadget.assigned', compact('assignedGadgets'));
    }*/
    public function assignedGadgets()
{
    // Fetch only approved gadgets assigned to the logged-in user
    $assignedGadgets = DB::table('gadget_requests')
        ->join('gadgets', 'gadget_requests.gadget_id', '=', 'gadgets.id')
        ->where('gadget_requests.status', 'approved') // Only fetch approved gadgets
        ->where('gadget_requests.user_id', auth()->id()) // Ensure it's assigned to the logged-in user
        ->select('gadgets.*', 'gadget_requests.status')
        ->get();

    return view('user.gadget.assigned', compact('assignedGadgets'));
}
public function allocateGadget($gadgetId, $userId)
{
    // Check if the gadget is already assigned and not returned
    $existingAssignment = DB::table('gadget_requests')
        ->where('gadget_id', $gadgetId)
        ->where('status', 'approved')
        ->exists();

    if ($existingAssignment) {
        return redirect()->back()->with('error', 'This gadget is already assigned to another user.');
    }

    // Assign gadget
    DB::table('gadget_requests')->insert([
        'user_id' => $userId,
        'gadget_id' => $gadgetId,
        'status' => 'approved',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->back()->with('success', 'Gadget assigned successfully.');
}

    // Show the form for reporting an issue
    public function reportIssue()
    {
        $assignedGadgets = Gadget::where('user_id', auth()->id())->get();
        return view('user.gadget.report', compact('assignedGadgets'));
    }

    // Handle the issue report submission
    public function submitIssueReport(Request $request)
    {
        $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'issue_description' => 'required|string|max:500',
        ]);

        Issue::create([
            'user_id' => auth()->id(),
            'gadget_id' => $request->gadget_id,
            'description' => $request->issue_description,
            'status' => 'pending',
        ]);

        return redirect()->route('user.issues.report')->with('success', 'Issue reported successfully!');
    }
    public function showReturnForm()
{
    $assignedGadgets = Gadget::where('user_id', auth()->id())->get();
    return view('user.gadget.return', compact('assignedGadgets'));
}
/*public function returnGadget(Request $request, $id)
{
    // Find the gadget request
    $gadgetRequest = GadgetRequest::findOrFail($id);

    // Update status to 'returned' or any appropriate value
    $gadgetRequest->status = 'returned';
    $gadgetRequest->save();

    return redirect()->back()->with('success', 'Gadget returned successfully.');
}*/
public function returnGadgetForm()
{
    // Get only approved or assigned gadgets
    $assignedGadgets = Gadget::whereIn('status', ['approved', 'assigned'])->get();

    return view('user.gadget.return', compact('assignedGadgets'));
}
public function return(Request $request)
{
    $gadgetId = $request->input('gadget_id');
    $returnReason = $request->input('return_reason');

    // Process the gadget return logic here...

    return redirect()->back()->with('success', 'Gadget return request submitted successfully.');
}


public function gadgetDetails($id)
{
    // Find the gadget by ID
    $gadget = Gadget::findOrFail($id);

    // Return the view with gadget details
    return view('user.gadget_requests.details', compact('gadget'));
}
public function returnGadget(Request $request, $id)
{
    // Find the gadget by ID
    $gadget = Gadget::findOrFail($id);

    // Process the return request (e.g., updating status)
    $gadget->update(['status' => 'returned']);

    return redirect()->route('gadget.index')->with('success', 'Gadget returned successfully.');
}
public function allocatedGadgets()
{
    $allocatedGadgets = DB::table('gadget_assignments')
        ->join('gadgets', 'gadget_assignments.gadget_id', '=', 'gadgets.id')
        ->join('users', 'gadget_assignments.user_id', '=', 'users.id')
        ->where('gadget_assignments.status', 'approved') 
        ->select('gadgets.*', 'users.name as assigned_to', 'gadget_assignments.status')
        ->get();

    return view('admin.allocated_gadgets', compact('allocatedGadgets'));
}
public function assignGadget(Request $request)
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



}