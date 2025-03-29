<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Display the welcome message for 3 seconds, then redirect to login
        return view('welcome')->with('message', 'Welcome to the Inventory Management System')
            ->with('redirect', route('login'))
            ->with('delay', 3); // Delay in seconds
    }
}