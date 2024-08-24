<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(UserOrderDataTable $datatable) : View | JsonResponse
    {
        return $datatable->render('frontend.dashboard.order.index');
    }

    public function show(string $id) : View
    {
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }
}
