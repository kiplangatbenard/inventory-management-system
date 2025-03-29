<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Gadget;
use App\Models\GadgetRequest;
use Illuminate\Support\Facades\Auth;



class UserGadgetController extends Controller
{
    // Display only available gadgets
    public function index()
    {
        $gadgets = Gadget::where('status', 'available')->get();
        return view('user.gadgets', compact('gadgets'));
    }

    // Handle gadget request submission
    public function requestGadget(Request $request)
    {
        $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'reason' => 'required|string|max:255',
        ]);

        GadgetRequest::create([
            'user_id' => Auth::id(),
            'gadget_id' => $request->gadget_id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('user.gadgets')->with('success', 'Your request has been submitted.');
    }
}
