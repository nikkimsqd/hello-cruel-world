@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{$page_title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->

<div class="single-blog-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>MTO ID</span> <span>{{$mto['id']}}</span></li>
                                <li><span>Date of use of the product</span> <span>{{$mto['dateOfUse']}}</span></li>
                                <li><span>Height</span> <span>{{$mto['height']}} cm</span></li>
                                <li><span>Category of item</span> <span>{{$mto->category['categoryName']}}</span></li>
                                <li><span>Measurements</span> <span>{{$mto->measurement->data}}</span></li>
                                <li><span>Instructions/Notes</span> <span>{{$mto['notes']}}</span></li>
                            </ul>
                        </div> <!-- card closing -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- </div> -->



@endsection