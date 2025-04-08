<?php
// app/Http/Controllers/GadgetReturnController.php
namespace App\Http\Controllers;

use App\Models\Gadget;
use App\Models\GadgetReturn;
use Illuminate\Http\Request;
use App\Models\GadgetReturnRequest;


class GadgetReturnController extends Controller
{
    // Show return request form to the user (with assigned gadgets)
// app/Http/Controllers/GadgetReturnController.php

/*public function create()
{
    // Fetch gadgets assigned to the authenticated user
    $gadgets = Gadget::where('user_id', auth()->id())->get();

    return view('user.returns.create', compact('gadgets'));
}*/
public function create()
{
    // Get gadgets assigned to the user that have no approved return
    $gadgets = Gadget::where('user_id', auth()->id())
        ->whereDoesntHave('returnRequest', function ($query) {
            $query->where('status', 'approved');
        })
        ->get();

    return view('user.returns.create', compact('gadgets'));
}



    // Store the return request
    public function store(Request $request)
    {
        $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'reason' => 'required|string|max:255',
        ]);

        GadgetReturn::create([
            'user_id' => auth()->id(),
            'gadget_id' => $request->gadget_id,
            'reason' => $request->reason,
        ]);

        return redirect()->route('user.returns.index')->with('success', 'Return request submitted successfully!');
    }

    // Admin: View all return requests
    public function adminIndex()
    {
        $returns = GadgetReturn::all();
        return view('admin.returns.index', compact('returns'));
    }

    // Admin: Approve or Reject the return request
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $return = GadgetReturn::findOrFail($id);
        $return->status = $request->status;
        $return->save();

        return redirect()->route('admin.returns.index')->with('success', 'Return request status updated!');
    }
    public function index()
{
    // Get the return requests for the authenticated user
    $returns = GadgetReturn::where('user_id', auth()->id())->get();

    return view('user.returns.index', compact('returns'));
}
// app/Http/Controllers/GadgetReturnController.php

public function approve($id)
{
    $return = GadgetReturn::findOrFail($id);
    $return->update(['status' => 'Approved']);

    return redirect()->back()->with('success', 'Return request approved successfully.');
}

public function reject($id)
{
    $return = GadgetReturn::findOrFail($id);
    $return->update(['status' => 'Rejected']);

    return redirect()->back()->with('success', 'Return request rejected.');
}
public function approveReturn($id)
{
    $returnRequest = GadgetReturnRequest::findOrFail($id);

    // Update the return request status to "approved"
    $returnRequest->status = 'approved';
    $returnRequest->save();

    // Update the gadget assignment (if applicable)
    if ($returnRequest->gadget) {
        $returnRequest->gadget->assigned_to = null;
        $returnRequest->gadget->save();
    }

    return redirect()->back()->with('success', 'Gadget return approved successfully.');
}

public function rejectReturn($id)
{
    $returnRequest = GadgetReturnRequest::findOrFail($id);
    $returnRequest->status = 'rejected';
    $returnRequest->save();

    return redirect()->back()->with('success', 'Gadget return rejected.');
}


}
