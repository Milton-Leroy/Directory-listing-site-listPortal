<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Str;

class CategoryController extends Controller
{
    use FileUploadTrait;

    function __construct(){
        $this->middleware(['permission:listing index'])->only(['index']);
        $this->middleware(['permission:listing update'])->only(['update','edit']);
        $this->middleware(['permission:listing create'])->only(['create','store']);
        $this->middleware(['permission:listing delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable): View | JsonResponse
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $imageIconPath = $this->uploadImage($request, 'image_icon');
        $backgroundImagePath = $this->uploadImage($request, 'background_image');

        $category = new Category();
        $category->image_icon = $imageIconPath;
        $category->background_image =  $backgroundImagePath;
        $category->name =  $request->name;
        $category->slug = Str::slug($request->name);
        $category->show_at_home =  $request->show_at_home;
        $category->status =  $request->status;
        $category->save();

        toastr()->success('Category Created Suceesfully');

        return  to_route('admin.category.index');
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id): RedirectResponse
    {
        $imageIconPath = $this->uploadImage($request, 'image_icon', $request->old_icon);
        $backgroundImagePath = $this->uploadImage($request, 'background_image', $request->old_background);

        $category =  Category::find($id);
        $category->image_icon = !empty($imageIconPath) ? $imageIconPath : $request->old_icon;
        $category->background_image =  !empty($backgroundImagePath) ? $backgroundImagePath : $request->old_background;
        $category->name =  $request->name;
        $category->slug = Str::slug($request->name);
        $category->show_at_home =  $request->show_at_home;
        $category->status =  $request->status;
        $category->save();

        toastr()->success('Category Updated Suceesfully');

        return  to_route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category =  Category::find($id);
        $this->deleteFile($category->image_icon);
        $this->deleteFile($category->background_image);

        $category->delete();

        return  response([
            'status' => "success",
            'message' => "Category Deleted Suceesfully"
        ]);
    }
}
