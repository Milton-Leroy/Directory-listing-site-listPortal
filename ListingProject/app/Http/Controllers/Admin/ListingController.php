<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ListingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListingStoreRequest;
use App\Http\Requests\Admin\ListingUpdateRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingAmenity;
use App\Models\Location;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Str;

class ListingController extends Controller
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
    public function index(ListingDataTable $datatable): View | JsonResponse
    {
        return $datatable->render('admin.listing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        return view('admin.listing.create', compact('categories', 'locations', 'amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingStoreRequest $request): RedirectResponse
    {
        $listing = new Listing();

        $imagePath = $this->uploadImage($request, 'image');
        $thumbnailPath = $this->uploadImage($request, 'thumbnail_image');
        $attachmentPath = $this->uploadImage($request, 'attachment');
        $user_id = Auth::user();
        $package_id = 1;

        $listing->user_id = $user_id->id;
        $listing->package_id = $package_id;
        $listing->image = $imagePath;
        $listing->thumbnail_image = $thumbnailPath;
        $listing->title = $request->title;
        $listing->slug =  Str::slug($request->title);
        $listing->category_id = $request->category_id;
        $listing->location_id = $request->location_id;
        $listing->address = $request->address;
        $listing->phone = $request->phone;
        $listing->email = $request->email;
        $listing->website = $request->website;
        $listing->facebook_link = $request->facebook_link;
        $listing->x_link = $request->x_link;
        $listing->linkedin_link = $request->linkedin_link;
        $listing->whatsapp_link = $request->whatsapp_link;
        $listing->instagram_link = $request->instagram_link;
        $listing->file = $attachmentPath;
        $listing->description = $request->description;
        $listing->google_map_embed_code = $request->google_map_embed_code;
        $listing->seo_title = $request->seo_title;
        $listing->seo_description = $request->seo_description;
        $listing->status = $request->status;
        $listing->is_featured = $request->is_featured;
        $listing->is_verified = $request->is_verified;
        $listing->is_approved = 1;
        $listing->expire_date = date('Y-m-d');

        $listing->save();

        foreach ($request->amenity_id as $amenity) {
            $listingAmenity = new ListingAmenity();

            $listingAmenity->listing_id = $listing->id;
            $listingAmenity->amenity_id = $amenity;

            $listingAmenity->save();
        }

        toastr()->success('Created successfully!');

        return to_route('admin.listing.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $listing = Listing::findOrFail($id);
        $listingAmenities = ListingAmenity::where('listing_id', $listing->id)->pluck('amenity_id')->toArray();
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        return view('admin.listing.edit', compact('listing', 'categories', 'locations', 'amenities', 'listingAmenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListingUpdateRequest $request, string $id): RedirectResponse
    {
        $listing = Listing::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image', $request->old_image);
        $thumbnailPath = $this->uploadImage($request, 'thumbnail_image',$request->old_thumbnail);
        $attachmentPath = $this->uploadImage($request, 'attachment', $request->old_attachment);
        $user_id = Auth::user();
        $package_id = 1;

        $listing->user_id = $user_id->id;
        $listing->package_id = $package_id;
        $listing->image = !empty($imagePath) ? $imagePath : $request->old_image ;
        $listing->thumbnail_image = !empty($thumbnailPath) ? $thumbnailPath : $request->old_thumbnail;
        $listing->title = $request->title;
        $listing->slug =  Str::slug($request->title);
        $listing->category_id = $request->category_id;
        $listing->location_id = $request->location_id;
        $listing->address = $request->address;
        $listing->phone = $request->phone;
        $listing->email = $request->email;
        $listing->website = $request->website;
        $listing->facebook_link = $request->facebook_link;
        $listing->x_link = $request->x_link;
        $listing->linkedin_link = $request->linkedin_link;
        $listing->whatsapp_link = $request->whatsapp_link;
        $listing->instagram_link = $request->instagram_link;
        $listing->file = !empty($attachmentPath) ? $attachmentPath : $request->old_attachment;
        $listing->description = $request->description;
        $listing->google_map_embed_code = $request->google_map_embed_code;
        $listing->seo_title = $request->seo_title;
        $listing->seo_description = $request->seo_description;
        $listing->status = $request->status;
        $listing->is_featured = $request->is_featured;
        $listing->is_verified = $request->is_verified;
        $listing->expire_date = date('Y-m-d');

        $listing->save();

        ListingAmenity::where('listing_id', $listing->id)->delete();

        foreach ($request->amenity_id as $amenity) {
            $listingAmenity = new ListingAmenity();

            $listingAmenity->listing_id = $listing->id;
            $listingAmenity->amenity_id = $amenity;

            $listingAmenity->save();
        }

        toastr()->success('Updated successfully!');

        return to_route('admin.listing.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Listing::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Lisitng deleted successfully"
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
