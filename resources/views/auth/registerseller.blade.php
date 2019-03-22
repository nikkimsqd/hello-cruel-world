@extends('layouts.hinimo')

@section('titletext')
Hinimo | Register Boutique
@endsection

@section('auth')
<div class="classynav" style="padding-right: 50px;">
    <ul>
        <li><a href="register-boutique">Sell on Hinimo</a></li>  
        <li><a href="login">Login</a></li>  
        <li><a href="register">Signup</a></li>
    </ul>
    
</div>

@endsection

@section('body')

<div class="single-blog-wrapper">
    <!-- Single Blog Post Thumb -->
    <div class="single-blog-post-thumb">
    <img src="{{asset('essence/img/bg-img/bg-8.jpg')}}" alt="" value="">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">
                        <div class="cart-page-heading mb-30" style="text-align: center;"><h4>Register Your Boutique</h4></div>
                        <form method="POST" action="register-boutique" aria-label="{{ __('Register Seller') }}">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="boutiqueName" class="col-md-4 col-form-label text-md-right">{{ __('Boutique Name') }}</label>

                                <div class="col-md-6">
                                    <input id="boutiqueName" type="text" class="form-control{{ $errors->has('boutiqueName') ? ' is-invalid' : '' }}" name="boutiqueName" value="{{ old('boutiqueName') }}" required autofocus>

                                    @if ($errors->has('boutiqueName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('boutiqueName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="boutiqueAddress" class="col-md-4 col-form-label text-md-right">{{ __('Boutique Address') }}</label>

                                <div class="col-md-6">
                                    <input id="boutiqueAddress" type="text" class="form-control{{ $errors->has('boutiqueAddress') ? ' is-invalid' : '' }}" name="boutiqueAddress" value="{{ old('boutiqueAddress') }}" required autofocus>

                                    @if ($errors->has('boutiqueAddress'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('boutiqueAddress') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
    </div>
</div>
@endsection

@section('footer_menu')
<!-- Footer Menu -->
<div class="footer_menu">
    <ul>
        <li><a href="{{url('/shop')}}">Shop</a></li>
        <li><a href="{{url('/biddings')}}">Biddings</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</div>
@endsection