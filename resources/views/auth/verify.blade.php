@extends('frontend.master.master')

@section('body')

<!-- Subcategory Title -->
<div class="jumbotron jumbotron-fluid subtitle">
    <div class="container">
        <h1 class="text-center text-white"> Verify Your Email Address </h1>
    </div>
</div>

<div class="container">
    <!-- Shopping Cart Div -->
    <div class="row my-5 shoppingcart_div">
        <div class="col-12">
            <a href="{{route('home')}}" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
                <i class="icofont-shopping-cart"></i>
                Back Home 
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-10">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
