<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AmenityStoreRequest;
use App\Http\Requests\Admin\AmenityUpdateRequest;
use App\Models\Amenity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Str;

class AmenityController extends Controller
{
    function __construct(){
        $this->middleware(['permission:listing index'])->only(['index']);
        $this->middleware(['permission:listing update'])->only(['update','edit']);
        $this->middleware(['permission:listing create'])->only(['create','store']);
        $this->middleware(['permission:listing delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(AmenityDataTable $datatable): View  | JsonResponse
    {
        return $datatable->render('admin.amenity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.amenity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AmenityStoreRequest $request): RedirectResponse
    {
        $amenity = new Amenity();
        $amenity->icon = $request->icon;
        $amenity->name = $request->name;
        $amenity->slug = Str::slug($request->name);
        $amenity->status = $request->status;
        $amenity->save();

        toastr()->success('Created successfully!');

        return to_route('admin.amenity.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $amenity = Amenity::find($id);
        return view('admin.amenity.update', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AmenityUpdateRequest $request, string $id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->icon = $request->filled('icon') ? $request->icon : $amenity->icon;
        $amenity->name = $request->name;
        $amenity->slug = Str::slug($request->name);
        $amenity->status = $request->status;
        $amenity->save();

        toastr()->success('Updated successfully!');

        return to_route('admin.amenity.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Amenity::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Amenity deleted successfully"
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
