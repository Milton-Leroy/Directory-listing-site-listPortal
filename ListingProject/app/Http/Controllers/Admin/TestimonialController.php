<?php

namespace App\Http\Controllers\admin;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TestimonialCreateRequest;
use App\Http\Requests\admin\TestimonialUpdateRequest;
use App\Models\Testimonial;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use FileUploadTrait;

    function __construct()
    {
        $this->middleware(['permission:testimonial index'])->only(['index']);
        $this->middleware(['permission:testimonial update'])->only(['update', 'edit']);
        $this->middleware(['permission:testimonial create'])->only(['create', 'store']);
        $this->middleware(['permission:testimonial delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TestimonialDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');
        $testimonial = new Testimonial();
        $testimonial->image = $imagePath;
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->status = $request->status;
        $testimonial->save();

        toastr()->success('Created successfully!');

        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialUpdateRequest $request, string $id)
    {
        $imagePath = $this->uploadImage($request, 'image', $request->old_image);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->status = $request->status;
        $testimonial->save();

        toastr()->success('Updated successfully!');

        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            $this->deleteFile($testimonial->image);

            $testimonial->delete();

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
