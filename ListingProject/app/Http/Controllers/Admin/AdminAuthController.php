<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function login(): view
    {
        return view('admin.auth.login');
    }

    public function PasswordRequest(): view
    {
        return view('admin.auth.forgot-password');
    }
}
