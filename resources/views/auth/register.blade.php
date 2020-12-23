{{-- @extends('layouts.app') --}}
@extends('frontend.master.master')
@section('body')

<!-- Subcategory Title -->
    <div class="jumbotron jumbotron-fluid subtitle">
        <div class="container">
            <h1 class="text-center text-white"> Create Account </h1>
        </div>
    </div>
    
    <!-- Content -->
    <div class="container my-5">

        <div class="row justify-content-center">
            <div class="col-8">
        <!--  register fail  -->
{{--         <?php 
          if(isset($_SESSION['reg_fail'])){
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h2>  🚨 Oops! </h2>
            <hr>
            <p> <?= $_SESSION['reg_fail']; ?> </p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <?php } unset($_SESSION['reg_fail']); ?> --}}

        <!-- register fail -->


                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="inputName"> Name</label>
                              <input class="form-control py-4 @error('name') is-invalid @enderror" id="inputName" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}" required autofocus />
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="phone">Phone Number</label>
                              <input class="form-control py-4" id="phone" type="text" placeholder="Enter Phone Number" name="phone" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                        <input class="form-control py-4 @error('email') is-invalid @enderror" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email"  value="{{ old('email') }}" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="inputPassword">Password</label>
                              <input class="form-control py-4 @error('password') is-invalid @enderror" id="inputPassword" type="password" placeholder="Enter password" name="password" required />
                              <font id="error" color="red"></font>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                              <input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" name="password_confirmation" required />
                              <font id="cerror" color="red"></font>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small mb-1" for="address"> Address </label>
                        <input type="textarea" class="form-control" name="address">
                    </div>
                    
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                        
                        <button class="btn btn-secondary mainfullbtncolor btn-block"> Create Account </button><!--  type="submit" -->
                    </div>
                </form>

                <div class=" mt-3 text-center ">
                    <a href="{{route('login')}}" class="loginLink text-decoration-none">Have an account? Go to login</a>
                </div>
            </div>
        </div>
    </div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
