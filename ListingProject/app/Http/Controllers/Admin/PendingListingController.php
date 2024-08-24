<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PendingListingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PendingListingController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:pending listing']);
    }
    public function index(PendingListingDataTable $datatable): View | JsonResponse
    {
        return $datatable->render('admin.pending-lisitng.index');
    }

    public function update(Request $request): Response
    {
        $request->validate([
            'value' => ['boolean']
        ]);

        try {
            $listing = Listing::findOrFail($request->id);
            $listing->is_approved = $request->value;
            $listing->save();

            return response(['status' => 'success', 'message' => 'status updated sucessfully']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
