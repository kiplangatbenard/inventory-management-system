<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GadgetRequest;
use App\Models\Gadget;

class GadgetRequestController extends Controller
{
    public function index()
    {
        $requests = GadgetRequest::where('user_id', auth()->id())->with('gadget')->get();
        return view('user.gadget_requests.index', compact('requests'));
    }

    public function edit($id)
    {
        $request = GadgetRequest::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $gadgets = Gadget::all(); // Fetch all available gadgets
        return view('user.gadget_requests.edit', compact('request', 'gadgets'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'gadget_type' => 'required|string',
            'gadget_id' => 'required|exists:gadgets,id',
            'reason' => 'required|string|max:255',
        ]);

        $gadgetRequest = GadgetRequest::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Only allow updating if request is still pending
        if ($gadgetRequest->status !== 'pending') {
            return redirect()->route('user.gadget_requests.index')->with('error', 'Cannot edit approved or rejected requests.');
        }

        $gadgetRequest->update($validated);

        return redirect()->route('user.gadget_requests.index')->with('success', 'Request updated successfully!');
    }

    public function destroy($id)
    {
        $request = GadgetRequest::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Only allow deleting if request is still pending
        if ($request->status !== 'pending') {
            return redirect()->route('user.gadget_requests.index')->with('error', 'Cannot delete approved or rejected requests.');
        }

        $request->delete();
        return redirect()->route('user.gadget_requests.index')->with('success', 'Request deleted successfully!');
    }
    // Show all gadget requests (Admin View)
    public function adminIndex()
    {
        $requests = GadgetRequest::with(['user', 'gadget'])->get(); 
        return view('admin.gadget_requests.index', compact('requests'));
    }

    // Admin updates the request status
    public function adminUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $gadgetRequest = GadgetRequest::findOrFail($id);
        $gadgetRequest->status = $validated['status'];
        $gadgetRequest->save();

        return redirect()->route('admin.gadget_requests.index')->with('success', 'Request updated successfully.');
    }
    public function create()
{
    $gadgets = Gadget::all(); // Fetch available gadgets
    return view('user.gadget_requests.create', compact('gadgets'));
}
public function store(Request $request)
{
    $validated = $request->validate([
        'gadget_type' => 'required|string',
        'gadget_id' => 'required|exists:gadgets,id',
        'reason' => 'required|string|max:255',
    ]);

    GadgetRequest::create([
        'user_id' => auth()->id(),
        'gadget_type' => $validated['gadget_type'],
        'gadget_id' => $validated['gadget_id'],
        'reason' => $validated['reason'],
        'status' => 'pending',
    ]);

    return redirect()->route('user.gadget_requests.index')->with('success', 'Request submitted successfully!');
}
public function return(Request $request)
{
    $gadgetId = $request->input('gadget_id');
    $returnReason = $request->input('return_reason');

    // Process the gadget return logic here...

    return redirect()->back()->with('success', 'Gadget return request submitted successfully.');
}

}