<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\FooterInfoRequest;
use App\Models\FooterInfo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterInfoController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:footer index']);
    }
    public function index(): View
    {
        $footerInfo = FooterInfo::first();
        return view('admin.footer_info.index', compact('footerInfo'));
    }

    public function update(FooterInfoRequest $request){

        FooterInfo::updateOrCreate(
            ['id' => 1],
            [
                'short_description' => $request->short_description,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'copyright' => $request->copyright,
            ]
        );

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }
}
