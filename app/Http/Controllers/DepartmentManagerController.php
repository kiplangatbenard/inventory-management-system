<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gadget;
use App\Models\GadgetRequest;
use App\Models\Issue;
use App\Models\GadgetAllocation;
use App\Models\Activity; // Import the Activity model

class DepartmentManagerController extends Controller
{
    public function dashboard()
    {
        $departmentId = Auth::user()->department_id;

        $totalGadgets = Gadget::where('department_id', $departmentId)->count();
        $pendingRequests = GadgetRequest::where('department_id', $departmentId)->where('status', 'Pending')->count();
        $reportedIssues = Issue::whereHas('gadget', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId);
        })->count();
        $returnedGadgets = GadgetAllocation::onlyTrashed()->where('department_id', $departmentId)->count();
        
        $recentActivities = Activity::where('department_id', $departmentId)->latest()->take(5)->get();
        $gadgets = Gadget::where('department_id', $departmentId)->with('user')->get();

        return view('manager.dashboard', compact('totalGadgets', 'pendingRequests', 'reportedIssues', 'returnedGadgets', 'recentActivities', 'gadgets'));
    }
    public function viewGadgets()
    {
        $departmentId = Auth::user()->department_id;
        $gadgets = Gadget::where('department_id', $departmentId)->get();

        return view('manager.gadgets', compact('gadgets'));
    }
    public function viewAllocations()
    {
        $departmentId = Auth::user()->department_id;
        $allocations = GadgetAllocation::whereHas('gadget', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId);
        })->with('gadget', 'user')->get();
    
        return view('manager.allocations', compact('allocations'));
    }
    public function managerRequests()
{
    $gadgets = GadgetRequest::all();
    dd($gadgets); // Check what gadgets data is being retrieved
    return view('admin.manager_requests.manager_requests', compact('gadgets'));
}


}