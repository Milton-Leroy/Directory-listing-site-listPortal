<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ListingScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListingScheduleStoreRequest;
use App\Http\Requests\Admin\ListingScheduleUpdateRequest;
use App\Models\Listing;
use App\Models\ListingSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ListingScheduleController extends Controller
{
    function __construct(){
        $this->middleware(['permission:listing index'])->only(['index']);
        $this->middleware(['permission:listing update'])->only(['update','edit']);
        $this->middleware(['permission:listing create'])->only(['create','store']);
        $this->middleware(['permission:listing delete'])->only(['destroy']);
    }
    public function index(ListingScheduleDataTable $dataTable, string $listingId): View | JsonResponse
    {
        $dataTable->with('listingId', $listingId);
        $listingTitle = Listing::select('title')->where('id', $listingId)->first();
        return $dataTable->render('admin.listing.listing-schedule.index', compact('listingId','listingTitle'));
    }

    public function create(): View
    {
        return view('admin.listing.listing-schedule.create');
    }

    public function store(ListingScheduleStoreRequest $request, string $lisitng_id): RedirectResponse
    {
        $schedule = new ListingSchedule();
        $schedule->listing_id = $lisitng_id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        toastr()->success('Created successfully!');

        return to_route('admin.listing-schedule.index',  $lisitng_id);
    }

    public function edit(string $id) : View
    {
        $schedule = ListingSchedule::findOrFail($id);
        return view('admin.listing.listing-schedule.edit', compact('schedule'));
    }

    public function update(ListingScheduleUpdateRequest $request, string $id): RedirectResponse
    {

        ;
        $schedule = ListingSchedule::findOrFail($id);
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        toastr()->success('Updated successfully!');

        return to_route('admin.listing-schedule.index',  $schedule->listing_id);
    }

    public function destroy(string $id): Response
    {

        try {
            ListingSchedule::findOrFail($id)->delete();

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
