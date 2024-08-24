<?php

namespace App\Http\Controllers\admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:order index'])->only(['index','show','update']);
        $this->middleware(['permission:order delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        $order->save();

        toastr()->success('Order status updated successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Order::findOrFail($id)->delete();

            return response([
                'status' => "success",
                'message' => "Order deleted successfully"
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
