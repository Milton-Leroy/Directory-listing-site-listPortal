<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Razorpay</title>
    <style>
        .razorpay-payment-button{
            display: none;
        }
    </style>
</head>

<body>
    <span style="color:red !important;">Do NOT CLOSE THIS PAGE!</span>
    @php
        $packageId = session()->get('selected_package_id');
        $package = App\Models\Package::find($packageId);

        $totalPayableAmount = ($package->price * config('payment.razorpay_currency_rate')) * 100;
    @endphp

    <form action="{{ route('razorpay.payment') }}" method="GET">
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ config('payment.razorpay_key') }}"
                data-currency="{{ config('payment.razorpay_currency') }}"
                data-amount="{{ $totalPayableAmount }}"
                data-buttontext="Pay with Razorpay"
                data-name="Razorpay Payment"
                data-description="Payment for Package"
                data-prefill.name=""
                data-prefill.email=""
                data-theme.color=""
        ></script>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let button = document.querySelector('.razorpay-payment-button');
            button.click();
        });
    </script>
</body>

</html>
