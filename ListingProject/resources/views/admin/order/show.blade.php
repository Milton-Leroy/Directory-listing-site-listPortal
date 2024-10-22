@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Invoice</div>
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print" id="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $order->order_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{ $order->user->name }}<br>
                                        {{ $order->user->email }}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        {{ $order->payment_method }}<br>
                                        Transaction_id: {{ $order->transaction_id }}<br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ date('F d, y', strtotime($order->purchase_date)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Paid In</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $order->package->name }}</td>
                                        <td class="text-center">{{ $order->base_amount }} {{ $order->base_currency }}</td>
                                        <td class="text-center">{{ $order->paid_amount }} {{ $order->paid_currency }}</td>
                                        <td class="text-right">{{ $order->base_amount }} {{ $order->base_currency }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8 d-print-none">
                                    <div class="section-title">Change Payment Status</div>
                                    <div class="col-md-4">
                                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <select name="payment_status" class="form-control">
                                                    <option @selected($order->payment_status === 'pending') value="pending">Pending</option>
                                                    <option @selected($order->payment_status === 'completed') value="completed">Completed
                                                    </option>
                                                    <option @selected($order->payment_status === 'failed') value="failed">Failed</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">{{ $order->base_amount }}
                                            {{ $order->base_currency }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <button class="btn btn-warning btn-icon icon-left" onclick="printPageArea('invoice-print')"><i
                            class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function printPageArea(areaID) {
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endpush
