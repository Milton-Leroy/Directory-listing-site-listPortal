<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuBuilderContoller extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:menu builder index']);
    }
    public function index()
    {
        return view('admin.menu-builder.index');
    }
}
