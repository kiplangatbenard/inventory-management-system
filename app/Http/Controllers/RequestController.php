<?php
namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    // Fetch all requests (with optional filters)
    public function index(HttpRequest $httpRequest)
    {
        // Start with the Request model's query builder
        $requests = Request::query();

        // Apply filters based on query parameters
        if ($httpRequest->has('status')) {
            $requests->where('status', $httpRequest->input('status'));
        }

        if ($httpRequest->has('priority')) {
            $requests->where('priority', $httpRequest->input('priority'));
        }

        // Fetch the filtered requests
        $filteredRequests = $requests->get();

        return response()->json($filteredRequests);
    }

    // Create a new request
    public function store(HttpRequest $httpRequest)
    {
        $validatedData = $httpRequest->validate([
            'request_type' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'gadget_id' => 'nullable|exists:gadgets,id',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
            'attachment' => 'nullable|string',

        ]);

        $request = Request::create($validatedData);

        return response()->json($request, 201);
    }

    // Fetch a single request
    public function show($id)
    {
        $request = Request::findOrFail($id);
        return response()->json($request);
    }

    // Update a request
    public function update(HttpRequest $httpRequest, $id)
    {
        $request = Request::findOrFail($id);

        $validatedData = $httpRequest->validate([
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        $request->update($validatedData);

        return response()->json($request);
    }

    // Delete a request
    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();

        return response()->json(null, 204);
    }
    
}