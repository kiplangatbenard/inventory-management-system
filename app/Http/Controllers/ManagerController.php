<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use App\Models\GadgetRequest;
use Illuminate\Http\Request;


class ManagerController extends Controller
{
    // Manager Dashboard
    public function dashboard()
    {
        // Get gadgets allocated to the manager's department
        $departmentId = auth()->user()->department_id;
        $gadgets = Gadget::where('assigned_to', $departmentId)->get();

        return view('manager.dashboard', compact('gadgets'));
    }

    // Request Additional Gadget
    public function requestGadget(Request $request)
    {
        $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'description' => 'required|string',
        ]);

        GadgetRequest::create([
            'user_id' => auth()->id(),
            'gadget_id' => $request->gadget_id,
            'type' => 'allocation_request',
            'status' => 'pending',
            'description' => $request->description,
            'manager_id' => auth()->id(),
        ]);

        return redirect()->route('manager.dashboard')->with('success', 'Gadget request submitted successfully.');
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

        return redirect()->route('manager.dashboard')->with('success', 'Issue reported successfully.');
    }

    public function showRequestGadgetForm()
    {
        $availableGadgets = Gadget::where('status', 'available')->get();
        return view('manager.request_gadget', compact('availableGadgets'));
    }
    
    public function viewEmployees()
{
    $department = auth()->user()->department;

    if (!$department) {
        return redirect()->back()->with('error', 'You are not assigned to a department.');
    }

    $employees = $department->employees;

    return view('manager.employees', compact('employees', 'department'));
}


}