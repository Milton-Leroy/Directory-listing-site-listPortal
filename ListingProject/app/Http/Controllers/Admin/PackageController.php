<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PackageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageCreateRquest;
use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    function __construct(){
        $this->middleware(['permission:package index'])->only(['index']);
        $this->middleware(['permission:package update'])->only(['update','edit']);
        $this->middleware(['permission:package create'])->only(['create','store']);
        $this->middleware(['permission:package delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PackageDataTable $datatable): View | JsonResponse
    {
        return $datatable->render('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageCreateRquest $request): RedirectResponse
    {
        $package = new Package();
        $package->type = $request->type;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->number_of_days = $request->number_of_days;
        $package->number_of_listing = $request->number_of_listing;
        $package->number_of_photos = $request->number_of_photos;
        $package->number_of_video = $request->number_of_video;
        $package->number_of_amenities = $request->number_of_amenities;
        $package->number_of_featured_listing = $request->number_of_featured_listing;
        $package->show_at_home = $request->show_at_home;
        $package->status = $request->status;
        $package->save();

        toastr()->success('Created successfully!');

        return to_route('admin.package.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $package = Package::findOrFail($id);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageCreateRquest $request, string $id): RedirectResponse
    {
        $package = Package::findOrFail($id);
        $package->type = $request->type;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->number_of_days = $request->number_of_days;
        $package->number_of_listing = $request->number_of_listing;
        $package->number_of_photos = $request->number_of_photos;
        $package->number_of_video = $request->number_of_video;
        $package->number_of_amenities = $request->number_of_amenities;
        $package->number_of_featured_listing = $request->number_of_featured_listing;
        $package->show_at_home = $request->show_at_home;
        $package->status = $request->status;
        $package->save();

        toastr()->success('Updated successfully!');

        return to_route('admin.package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Package::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Package deleted successfully"
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
