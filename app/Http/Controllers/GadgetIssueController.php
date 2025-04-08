<?php
// app/Http/Controllers/GadgetIssueController.php
namespace App\Http\Controllers;

use App\Models\GadgetIssue;
use Illuminate\Http\Request;
use App\Models\Gadget;
use App\Models\Issue;
class GadgetIssueController extends Controller
{
    // app/Http/Controllers/GadgetIssueController.php

/*public function create()
{
    // Get the list of gadgets assigned to the logged-in user
    $gadgets = Gadget::where('user_id', auth()->id())->get();  

    return view('user.issues.create', compact('gadgets'));
}*/
public function create()
{
    $gadgets = Gadget::where('user_id', auth()->id())
        ->where(function ($query) {
            $query->whereDoesntHave('returnRequest')
                  ->orWhereHas('returnRequest', function ($q) {
                      $q->where('status', '!=', 'approved');
                  });
        })
        ->get();

    return view('user.issues.create', compact('gadgets'));
}

public function store(Request $request)
{
    $request->validate([
        'gadget_id' => 'required|exists:gadgets,id',  // Ensure gadget exists
        'issue_title' => 'required|string|max:255',
        'issue_description' => 'required|string',
    ]);

    GadgetIssue::create([
        'user_id' => auth()->id(),
        'gadget_id' => $request->gadget_id,
        'issue_title' => $request->issue_title,
        'issue_description' => $request->issue_description,
    ]);

    return redirect()->route('user.issues.index')->with('success', 'Issue reported successfully!');
}


    // app/Http/Controllers/GadgetIssueController.php

public function index()
{
    $reportedIssuesCount = Issue::count();
       // Fetch all issues to display
       $issues = Issue::with('gadget')->get();
    $issues = GadgetIssue::where('user_id', auth()->id())->get();
    $gadgets = Gadget::where('user_id', auth()->id())->get();  // Get the gadgets assigned to the user
    return view('user.issues.index', compact('issues', 'gadgets','reportedIssuesCount'));
    
}

 // Admin Dashboard: View all reported issues
 public function adminIndex()
 {
     $issues = GadgetIssue::all(); // Get all issues for the admin
     return view('admin.issues.index', compact('issues'));
 }

 // Admin: Update the status of a reported issue
 public function updateStatus(Request $request, $id)
 {
     $request->validate([
         'status' => 'required|in:Pending,Resolved',
     ]);

     $issue = GadgetIssue::findOrFail($id);
     $issue->status = $request->status;
     $issue->save();

     return redirect()->route('admin.issues.index')->with('success', 'Issue status updated successfully!');
 }
}
