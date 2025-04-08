<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Override the redirectTo method to send users to different dashboards
     * based on their role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $role = Auth::user()->role; // Assuming you have a 'role' column in users table

        switch ($role) {
            case 'admin':
                return '/admin/dashboard';
            case 'manager':
                return '/manager/dashboard';
            case 'user':
                return '/user/dashboard';
            default:
                return '/home'; // fallback
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
