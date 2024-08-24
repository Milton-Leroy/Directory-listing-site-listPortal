<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:privacy policy index']);
    }
    public function index(): View
    {
        $policy = PrivacyPolicy::first();
        return view('admin.privacy-policy.index', compact('policy'));
    }

    public function update(Request $request) : RedirectResponse
    {
        $request->validate([
            'description' => ['required']
        ]);

        PrivacyPolicy::updateOrCreate(
            ['id' => 1],
            ['description' => $request->description]
        );

        toastr()->success('Updated successfully!');

        return redirect()->back();
    }

}

