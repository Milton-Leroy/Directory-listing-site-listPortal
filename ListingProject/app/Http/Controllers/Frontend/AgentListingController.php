<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\AgentListingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AgentListingStoreRequest;
use App\Http\Requests\Frontend\AgentListingUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingAmenity;
use App\Models\Location;
use App\Models\subscription;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;
use Str;
use Auth;
use Illuminate\Validation\ValidationException;

class AgentListingController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(AgentListingDataTable $datatable): View | JsonResponse
    {
        return  $datatable->render('frontend.dashboard.listing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $subscription = subscription::with('package')->where('user_id', auth()->user()->id)->first();
        if(!$subscription){
            throw ValidationException::withMessages(['message' => 'You need to subscribe to a package to create a listing']);
        }
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();

        return view('frontend.dashboard.listing.create', compact('categories', 'locations', 'amenities','subscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentListingStoreRequest $request) : RedirectResponse
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
        $listing->is_verified = 0;
        $listing->expire_date = date('Y-m-d');

        $listing->save();

        foreach ($request->amenity_id as $amenity) {
            $listingAmenity = new ListingAmenity();

            $listingAmenity->listing_id = $listing->id;
            $listingAmenity->amenity_id = $amenity;

            $listingAmenity->save();
        }

        toastr()->success('Created successfully!');

        return to_route('user.listing.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $listing = Listing::findOrFail($id);
        if(Auth::user()->id !== $listing->user_id){
            return abort(403);
        }
        $listingAmenities = ListingAmenity::where('listing_id', $listing->id)->pluck('amenity_id')->toArray();
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        $subscription = subscription::with('package')->where('user_id', auth()->user()->id)->first();
        return view("frontend.dashboard.listing.edit", compact('listing', 'categories', 'locations', 'amenities', 'listingAmenities', 'subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentListingUpdateRequest $request, string $id) : RedirectResponse
    {
        $listing = Listing::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image', $request->old_image);
        $thumbnailPath = $this->uploadImage($request, 'thumbnail_image',$request->old_thumbnail);
        $attachmentPath = $this->uploadImage($request, 'attachment', $request->old_attachment);
        $package_id = 1;

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
        $listing->is_verified = 0;
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

        return to_route('user.listing.index');
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
