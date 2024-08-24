<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:listing review']);
    }

    public function index(ReviewDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.listing.listing-review.index');
    }

    public function updateStatus(string $id): Response
    {
        $review = Review::findOrFail($id);
        $review->is_approved = !$review->is_approved;
        $review->save();

        return response(['status' => 'success', 'message' => 'Status updated successfully']);
    }

    public function destroy(string $id) : Response
    {
        try {
            Review::findOrFail($id)->delete();

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
