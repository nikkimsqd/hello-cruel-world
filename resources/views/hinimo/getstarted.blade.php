@extends('layouts.hinimo')


@section('titletext')
	{{$page_title}}
@endsection


@section('body')

 <div class="single-blog-wrapper">

        <!-- Single Blog Post Thumb -->
<!-- <div class="single-blog-post-thumb">
    <img src="{{asset('essence/img/bg-img/bg-8.jpg')}}" alt="" value="">
</div> -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="regular-page-content-wrapper section-padding-80">
                <div class="regular-page-text">
                    <!-- <p class="mb-2">Before you proceed, we would like to know which clothes you would like to wear so we will know what to recommend to you.</p> -->
                    <div class="align-center">
                        <!-- <h5>What are you looking to for?</h5> -->
                        <h4 class="mb-0">What are you looking to for?</h4>
                        <p class="below_heading">We'll use this information to recommend items you might be interested in.</p>
                    </div>
                    <form action="user-profiling" method="post">
                        {{csrf_field()}}

                        @foreach($categories as $category)
                        @if($category->categoryTag)
                        <p class="mb-2">Choose the {{$category['categoryName']}} you like to wear</p>
                        <div class="row">
                            <div class="col-md-5">
                                @foreach($categoryTags as $categoryTag)
                                @if($categoryTag['categoryID'] == $category['id'])
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" name="tag[{{$category['id']}}][]" value="{{$categoryTag['id']}}" class="custom-control-input" id="{{$categoryTag['id']}}">
                                    <label class="custom-control-label" for="{{$categoryTag['id']}}">{{ucfirst($categoryTag['tagName'])}}</label>
                                </div>
                                @endif
                                @endforeach
                            </div>

                           <!--  <div class="col-md-5">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" name="tops[]" value="Sweatshirts" class="custom-control-input" id="Sweatshirts">
                                    <label class="custom-control-label" for="Sweatshirts">Sweatshirts</label>
                                </div>
                            </div> -->
                        </div>
                        @endif
                        @endforeach


                        <br>
                        <input type="submit" name="btn_submit" value="Get Started" class="btn essence-btn">
                    </form>


                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style type="text/css">
    .align-center p {font-size: 16px !important; line-height: 1;}
    .align-center{text-align: center;}
    .mb-0{margin-bottom: 0;}
</style>


@endsection