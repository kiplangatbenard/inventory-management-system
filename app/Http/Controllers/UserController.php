<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Department;
use App\Models\Gadget;
use App\Models\GadgetRequest;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\UserActivity;




class UserController extends Controller
{
    public function departmentEmployees()
    {
        $manager = auth()->user(); // Get the logged-in manager
    
        // Fetch users in the same department, with their approved gadgets
        $users = User::where('department_id', $manager->department_id)
            ->with('approvedGadgets')
            ->get();
    
        return view('manager.employees', compact('users'));
    }

    // Display a listing of users
    public function index()
    {
        $recentActivities = UserActivity::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

        $users = User::all();
        $assignedGadgets = Gadget::whereNotNull('assigned_to')->get();
        return view('user.index', compact('users', 'assignedGadgets', 'recentActivities'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $departments = Department::all(); // Fetch all departments
        return view('user.create', compact('departments'));
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => ['required', Rule::in(['admin', 'manager', 'user'])],
            'department_id' => 'nullable|exists:departments,id',
        ]);

        // Create and save the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password for security
            'role' => $request->role,
            'department_id' => $request->department_id, // Nullable field
        ]);

        return redirect()->route('user.index')->with('success', 'User added successfully!');
    }

    // Display the specified user
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $departments = Department::all();
        return view('user.edit', compact('user', 'departments'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,manager,user',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role,
                'department_id' => $request->department_id,
            ]);

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // User Dashboard
   
    /*public function dashboard()
    {
        $user = auth()->user(); // Get the logged-in user
        $assignedGadgets = $user->gadgets; // Assuming a relationship exists
        $totalGadgets = Gadget::count();

        $reportedIssuesCount = Issue::where('user_id', auth()->id())->count(); // Count issues reported by the user
        // Count gadgets assigned to the user
        $assignedGadgetsCount = Gadget::where('assigned_to', auth()->id())->count();
        // Count the number of assigned gadgets
        $assignedGadgetsCount = Gadget::whereNotNull('assigned_to')->count();

        // Count the number of reported issues
        $reportedIssuesCount = Issue::count();
            // Retrieve recent activities (adjust the model and query as needed)
    $recentActivities = UserActivity::latest()->take(10)->get(); // Example query

    // Retrieve reported issues count
    $reportedIssuesCount = Issue::count();

        return view('user.dashboard', compact('totalGadgets', 'assignedGadgets','assignedGadgetsCount','reportedIssuesCount','recentActivities'));
    }*/

    public function dashboard()
{
    $user = auth()->user(); // Get the logged-in user

    // Total available gadgets (not assigned to any user)
    $totalGadgets = Gadget::whereNull('assigned_to')->count();

    // Gadgets assigned to this user
    $assignedGadgetsCount = Gadget::where('assigned_to', $user->id)->count();

    // Reported issues by this user
    $reportedIssuesCount = Issue::where('user_id', $user->id)->count();

    // Recent activity by this user
    $recentActivities = UserActivity::where('user_id', $user->id)
                            ->latest()
                            ->take(10)
                            ->get();

    return view('user.dashboard', compact(
        'totalGadgets',
        'assignedGadgetsCount',
        'reportedIssuesCount',
        'recentActivities'
    ));
}


    // Request Replacement
    public function requestReplacement(Request $request)
    {
        $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'description' => 'required|string',
        ]);

        // Ensure the gadget is assigned to the user
        $gadget = Gadget::where('id', $request->gadget_id)
                        ->where('assigned_to', auth()->id())
                        ->first();

        if (!$gadget) {
            return back()->with('error', 'Gadget not found or not assigned to you.');
        }

        try {
            GadgetRequest::create([
                'user_id' => auth()->id(),
                'gadget_id' => $request->gadget_id,
                'type' => 'replacement_request',
                'status' => 'pending',
                'description' => $request->description,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Replacement request submitted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    

 /*   // Show user details
public function showDetails($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Return the view with user details
    return view('user.details', compact('user'));
}*/
public function showDetails()
{
    $user = auth()->user();
    return view('user.gadget.details', compact('user'));
}

// Show the form for returning a gadget
public function returnGadget(Request $request)
{
    $gadgetId = $request->gadget_id;

    // Update gadget assignment status
    DB::table('gadget_assignments')
        ->where('gadget_id', $gadgetId)
        ->where('user_id', auth()->id()) // Ensure it belongs to the user
        ->update([
            'status' => 'returned',
            'returned_at' => now(),
            'updated_at' => now(),
        ]);

    // Update gadget status in the gadgets table
    Gadget::where('id', $gadgetId)->update(['status' => 'available']);

    return redirect()->back()->with('success', 'Gadget returned successfully.');
}
public function assignedGadgets()
{
    $userId = auth()->id(); // Get the authenticated user ID

    $assignedGadgets = DB::table('gadget_assignments')
        ->join('gadgets', 'gadget_assignments.gadget_id', '=', 'gadgets.id')
        ->where('gadget_assignments.user_id', $userId)
        ->where('gadget_assignments.status', 'approved') // Only fetch approved gadgets
        ->select('gadgets.name', 'gadgets.serial_number', 'gadgets.condition', 'gadgets.status')
        ->get();

    return view('user.assigned_gadgets', compact('assignedGadgets'));
}


}