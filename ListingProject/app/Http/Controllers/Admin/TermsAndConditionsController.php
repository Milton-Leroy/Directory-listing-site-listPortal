<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TermsAndConditionsController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:terms and conditions index']);
    }
    public function index(): View
    {
        $termsAndCondition = TermsAndCondition::first();
        return view('admin.terms-and-Condition.index', compact('termsAndCondition'));
    }

    public function update(Request $request) : RedirectResponse
    {
        $request->validate([
            'description' => ['required']
        ]);

        TermsAndCondition::updateOrCreate(
            ['id' => 1],
            ['description' => $request->description]
        );

        toastr()->success('Updated successfully!');

        return redirect()->back();
    }
}
