<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;


class DepartmentController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard'); // Adjust the view path as needed
    }
    public function index()
    {
        $departments = Department::with(['manager', 'users', 'gadgets'])->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function show($id)
    {
        $department = Department::with(['manager', 'users', 'gadgets'])->findOrFail($id);
        return view('admin.departments.show', compact('department'));
    }
}
