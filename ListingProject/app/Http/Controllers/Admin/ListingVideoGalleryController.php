<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingVideoGallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListingVideoGalleryController extends Controller
{
    function __construct(){
        $this->middleware(['permission:listing index'])->only(['index']);
        $this->middleware(['permission:listing create'])->only(['store']);
        $this->middleware(['permission:listing delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $videos = ListingVideoGallery::where('listing_id', $request->id)->get();
        $listingTitle = Listing::select('title')->where('id', $request->id)->first();
        return view('admin.listing.listing-video-gallery.index',compact('videos','listingTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_url' => ['required','url'],
            'listing_id' => ['required'],
        ]);

        $videoGallery = new ListingVideoGallery();

        $videoGallery->listing_id = $request->listing_id;
        $videoGallery->video_url = $request->video_url;
        $videoGallery->save();

        toastr()->success('Uploaded successfully!');

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $video = ListingVideoGallery::find($id);

            $video->delete();

            return response([
                'status' => "success",
                'message' => "Video deleted successfully"
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
