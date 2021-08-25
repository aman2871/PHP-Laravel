@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>

<head>
    <title>Payment Gateway</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @yield('style')
</head>


<body>
    @if($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Error!</strong> {{ $message }}
    </div>
    @endif
    {!! Session::forget('error') !!}
    @if($message = Session::get('success'))
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> {{ $message }}
    </div>
    @endif
    {!! Session::forget('success') !!}

    <div class="container overflow-hidden">
        <!-- FIRST PAYMENT CARD -->
        <div class="container mb-5 mt-5">
            <div class="pricing card-deck flex-column flex-md-row mb-3">
                <div class="card card-pricing border-5 text-center px-3 mb-4 "> <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-secondary text-white shadow-sm">One Month</span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <h1 class="h1 font-weight-normal text-secondary text-center mb-0" data-pricing-value="15">$<span class="price">3</span><span class="h6 text-muted ml-2">/1 month</span></h1>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li>Add your posts</li>
                            <li>Comment on all Post</li>

                        </ul>
                        <form action="{!!route('payment')!!}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_owSKbuOvpvfTkd" data-amount="48000" data-currency="INR" data-buttontext="Buy Now" data-name="BlogPost 1 Month Plan" data-theme.color="#F37254"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                        </form>

                    </div>
                </div>
                <div class="card card-pricing border-5 text-center px-3 mb-4"> <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-secondary text-white shadow-sm">Three Months</span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <h1 class="h1 font-weight-normal text-secondary text-center mb-0" data-pricing-value="30">$<span class="price">6</span><span class="h6 text-muted ml-2">/ 3 months</span></h1>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li>Add your posts</li>
                            <li>Comment on all Post</li>
                        </ul>
                        <form action="{!!route('payment')!!}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_owSKbuOvpvfTkd" data-amount="48000" data-currency="INR" data-buttontext="Buy Now" data-name="BlogPost 3 Month Plan" data-theme.color="#F37254"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                        </form>
                    </div>
                </div>
                <div class="card card-pricing border-5 text-center px-3 mb-4"> <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-secondary text-white shadow-sm">Six Months</span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <h1 class="h1 font-weight-normal text-secondary text-center mb-0" data-pricing-value="45">$<span class="price">9</span><span class="h6 text-muted ml-2">/ 6 month</span></h1>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li>Add your posts</li>
                            <li>Comment on all Post</li>
                        </ul>
                        <form action="{!!route('payment')!!}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_owSKbuOvpvfTkd" data-amount="72000" data-currency="INR" data-buttontext="Buy Now" data-name="BlogPost 6 Month Plan" data-theme.color="#F37254"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                        </form>
                    </div>
                </div>
                <div class="card card-pricing border-5 text-center px-3 mb-4"> <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-secondary text-white shadow-sm">Twelve Months</span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <h1 class="h1 font-weight-normal text-secondary text-center mb-0" data-pricing-value="60">$<span class="price">12</span><span class="h6 text-muted ml-2">/ 12 month</span></h1>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li>Add your posts</li>
                            <li>Comment on all Post</li>
                        </ul>
                        <form action="{!!route('payment')!!}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_owSKbuOvpvfTkd" data-amount="96000" data-currency="INR" data-buttontext="Buy Now" data-name="BlogPost 12 Month Plan" data-theme.color="#F37254"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                        </form>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>
@endsection