<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SocialLinkDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SocialLinkCreateRequest;
use App\Http\Requests\admin\SocialLinkUpdateRequest;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SociaLinkController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:social link index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SocialLinkDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.social-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialLinkCreateRequest $request): RedirectResponse
    {
        $socialLink = new SocialLink();
        $socialLink->icon = $request->icon;
        $socialLink->url = $request->url;
        $socialLink->status = $request->status;
        $socialLink->save();

        toastr()->success('Created successfully!');

        return redirect()->route('admin.social-link.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $social = SocialLink::findOrFail($id);
        return view('admin.social-link.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialLinkUpdateRequest $request, string $id): RedirectResponse
    {
        $socialLink = SocialLink::findOrFail($id);
        if ($request->filled('icon')) {
            $socialLink->icon = $request->icon;
        }
        $socialLink->url = $request->url;
        $socialLink->status = $request->status;
        $socialLink->save();

        toastr()->success('Updated successfully!');

        return redirect()->route('admin.social-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            SocialLink::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Review deleted successfully"
            ]);
        } catch (\Exception $e) {
            logger($e);
            return response([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
    }
}
