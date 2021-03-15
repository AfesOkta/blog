@extends('frontend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style-registration.css')}}">
@endsection
@section('content')
    @if ($errors->any())
        <div>
            <div>{{ __('Whoops! Something went wrong.') }}</div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- <div class="row">
        <div class="col-md-8" style="padding-left: 500px; padding-right:500px">
            <form method="POST" action="{{ route('register.user.store') }}">
                @csrf
                <div>
                    <label>{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus autocomplete="name" />
                </div>

                <div>
                    <label>{{ __('Email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required />
                </div>

                <div>
                    <label>{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control" required autocomplete="new-password" />
                </div>

                <div>
                    <label>{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" />
                </div>

                <br/>

                <div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div> --}}

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('register.user.store') }}">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                    statements in <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{asset('uploads/images/signup-image.jpg')}}" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
