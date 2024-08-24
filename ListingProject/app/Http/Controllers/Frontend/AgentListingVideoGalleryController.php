<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingVideoGallery;
use App\Models\subscription;
use App\Rules\MaxVideos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AgentListingVideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $videos = ListingVideoGallery::where('listing_id', $request->id)->get();
        $listingTitle = Listing::select('title')->where('id', $request->id)->first();
        $subscription = subscription::with('package')->where('user_id', auth()->user()->id)->first();

        return view('frontend.dashboard.listing.listing-video-gallery.index', compact('videos', 'listingTitle','subscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'video_url' => ['required', 'url'],
            'listing_id' => ['required', new MaxVideos],
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
    public function destroy(string $id) : Response
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
