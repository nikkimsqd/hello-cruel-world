@extends('layouts.hinimo')


@section('titletext')
	Hinimo
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
                    <h3 class="mb-2">Thank you. Now you can proceed on shopping. Enjoy!</h3>
                    <a href="/hinimo/public/shop" class="btn essence-btn">Proceed to Shop</a>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection