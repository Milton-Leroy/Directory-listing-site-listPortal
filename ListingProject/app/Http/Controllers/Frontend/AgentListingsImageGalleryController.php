<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingImageGallery;
use App\Models\subscription;
use App\Rules\MaxImages;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AgentListingsImageGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $images = ListingImageGallery::where('listing_id', $request->id)->orderBy('id', 'desc')->get();
        $listingTitle = Listing::select('title')->where('id', $request->id)->first();
        $subscription = subscription::with('package')->where('user_id', auth()->user()->id)->first();
        return view('frontend.dashboard.listing.listing-image-gallery.index',compact('images','listingTitle', 'subscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'images' => ['required'],
            'images.*' => ['required' ,'image', 'max:3000'],
            'listing_id' => ['required', new MaxImages],
        ], [
            'images.*.image' => "One or more selected files are not valid images.",
            'images.*.max' => "One or more images exceed the maximun file size (3MB)"
        ]);

        $imagePaths = $this->uploadMultipleImage($request, 'images');

        foreach ($imagePaths as $path) {
            $image = new ListingImageGallery();
            $image->listing_id = $request->listing_id;
            $image->image = $path;
            $image->save();
        }

        toastr()->success('Images inserted successfully!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try {
            $image = ListingImageGallery::find($id);
            $this->deleteFile($image->image);
            $image->delete();

            return response([
                'status' => "success",
                'message' => "Image deleted successfully"
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
