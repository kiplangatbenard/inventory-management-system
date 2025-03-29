<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Department;
use App\Models\Gadget;
use App\Models\GadgetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;




class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all();
        $assignedGadgets = Gadget::whereNotNull('assigned_to')->get();
        return view('user.index', compact('users', 'assignedGadgets'));
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
   
    public function dashboard()
    {
        $user = auth()->user(); // Get the logged-in user
        $assignedGadgets = $user->gadgets; // Assuming a relationship exists
        $totalGadgets = Gadget::count();
        $assignedGadgetsCount = Gadget::where('assigned_to', auth()->id())->count();

        return view('user.dashboard', compact('totalGadgets', 'assignedGadgetsCount'));
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
    
    // Report Issue
    public function reportIssue(Request $request)
    {
        
        $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'description' => 'required|string',
        ]);

        GadgetRequest::create([
            'user_id' => auth()->id(),
            'gadget_id' => $request->gadget_id,
            'type' => 'issue_report',
            'status' => 'pending',
            'description' => $request->description,
            'manager_id' => auth()->id(),

            
        ]);
        return redirect()->route('user.dashboard')->with('success', 'Issue reported successfully.');

    }
    /*public function requestGadget(Request $request)
{
    // Validate input
    $request->validate([
        'gadget_type' => 'required|string',
        'reason' => 'required|string|max:255',
    ]);

    // Create a gadget request
    GadgetRequest::create([
        'user_id' => auth()->id(),
        'gadget_type' => $request->gadget_type,
        'reason' => $request->reason,
        'status' => 'pending', // Default status
        'manager_id' => auth()->user()->manager_id ?? 1, // Set a default value if null
    ]);

    return back()->with('success', 'Your request has been submitted.');
}
public function showRequestForm()
{
    return view('user.request-gadget');
}
public function showGadgets()
{
    $gadgets = Gadget::all();
    return view('user.gadgets', compact('gadgets'));
    
}
public function showGadget(Gadget $gadget)
{
    return view('user.show-gadget', compact('gadget'));
}*/
public function showDetails($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Return the view with user details
    return view('user.details', compact('user'));
}
public function assignedGadgets()
{
    $userId = auth()->id(); // Get the authenticated user ID

    $assignedGadgets = DB::table('gadget_assignments')
        ->join('gadgets', 'gadget_assignments.gadget_id', '=', 'gadgets.id')
        ->where('gadget_assignments.user_id', $userId)
        ->where('gadget_assignments.status', 'approved') // Fetch only approved gadgets
        ->select('gadgets.*', 'gadget_assignments.status')
        ->get();

    return view('user.assigned_gadgets', compact('assignedGadgets'));
}
public function returnGadget($gadgetId)
{
    // Update gadget status
    DB::table('gadget_assignments')
        ->where('gadget_id', $gadgetId)
        ->where('status', 'approved')
        ->update([
            'status' => 'available',
            'returned_at' => now(),
            'updated_at' => now(),
        ]);

    return redirect()->back()->with('success', 'Gadget returned successfully.');
}


}