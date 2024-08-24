<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LocationCreateRequest;
use App\Http\Requests\Admin\LocationUpdateRequest;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Str;

class LocationController extends Controller
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
    public function index(LocationDataTable $dataTable): View | JsonResponse
    {
        return $dataTable->render('admin.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationCreateRequest $request): RedirectResponse
    {
        $location = new Location();
        $location->name = $request->name;
        $location->slug = Str::slug($request->name);
        $location->show_at_home = $request->show_at_home;
        $location->status = $request->status;
        $location->save();

        toastr()->success('Location created successsfully!');

        return to_route('admin.location.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $location = Location::find($id);
        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, string $id): RedirectResponse
    {
        $location = Location::find($id);
        $location->name = $request->name;
        $location->slug = Str::slug($request->name);
        $location->show_at_home = $request->show_at_home;
        $location->status = $request->status;
        $location->save();

        toastr()->success('Location updated successsfully!');

        return to_route('admin.location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Location::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Location deleted successfully"
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
