<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ClaimDataTable;
use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ClaimController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:listing claims']);
    }
    public function index(ClaimDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.claim.index');
    }

    public function destroy(string $id): Response
    {
        try {
            Claim::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Claim deleted successfully"
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
