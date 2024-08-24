<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\AgentListingScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListingScheduleStoreRequest;
use App\Http\Requests\Admin\ListingScheduleUpdateRequest;
use App\Models\Listing;
use App\Models\ListingSchedule;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AgentListingScheduleController extends Controller
{
    public function index(AgentListingScheduleDataTable $dataTable, string $listingId): View | JsonResponse
    {
        $listing = Listing::select('id', 'title', 'user_id')->where('id', $listingId)->first();
        if ($listing->user_id !== Auth::user()->id) {
            abort(403);
        }
        $listingTitle = $listing;

        $dataTable->with('listingId', $listingId);
        return $dataTable->render('frontend.dashboard.listing.listing-schedule.index', compact('listingId', 'listingTitle'));
    }

    public function create(Request $request, string $listingId): View
    {
        $listing = Listing::select('id', 'user_id')->where('id', $listingId)->first();
        if ($listing->user_id !== Auth::user()->id) {
            abort(403);
        }
        return view('frontend.dashboard.listing.listing-schedule.create', compact('listingId'));
    }

    public function store(ListingScheduleStoreRequest $request, string $lisitng_id): RedirectResponse
    {
        $listing = Listing::select('id', 'user_id')->where('id', $lisitng_id)->first();
        if ($listing->user_id !== Auth::user()->id) {
            abort(403);
        }
        $schedule = new ListingSchedule();
        $schedule->listing_id = $lisitng_id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        toastr()->success('Created successfully!');

        return to_route('user.listing-schedule.index',  $lisitng_id);
    }

    public function edit(string $id): View
    {
        $schedule = ListingSchedule::findOrFail($id);
        $listing = Listing::select('id', 'user_id')->where('id', $schedule->listing_id)->first();
        if ($listing->user_id !== Auth::user()->id) {
            abort(403);
        }
        return view('frontend.dashboard.listing.listing-schedule.edit', compact('schedule'));
    }

    public function update(ListingScheduleUpdateRequest $request, string $id): RedirectResponse
    {
        $schedule = ListingSchedule::findOrFail($id);
        $listing = Listing::select('id', 'user_id')->where('id', $schedule->listing_id)->first();
        if ($listing->user_id !== Auth::user()->id) {
            abort(403);
        }
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        toastr()->success('Updated successfully!');

        return to_route('user.listing-schedule.index',  $schedule->listing_id);
    }

    public function destroy(string $id): Response
    {

        $schedule = ListingSchedule::findOrFail($id);
        $listing = Listing::select('id', 'user_id')->where('id', $schedule->listing_id)->first();
        if ($listing->user_id !== Auth::user()->id) {
            abort(403);
        }

        try {
            $schedule->delete();

            return response([
                'status' => "success",
                'message' => "Schedule deleted successfully"
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
