@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
 <div class="single-blog-wrapper">

<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('bg/breadcumb.jpg')}});">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
            <div class="regular-page-content-wrapper section-padding-80">
                <div class="regular-page-text">
                    <!-- <h3 class="mb-2">Thank you. Now you can proceed on shopping. Enjoy!</h3> -->

                    <div class="row">
                    @foreach($pictures as $picture)
                        <div class="col-md-4">
                            <?php $counter = 1; ?>
                            <!-- foreach( $picture->productFile as $image) -->
                                @if($counter == 1)
                                    <label class="product-top product-top{{$picture['id']}}">
                                        <img src="{{ asset('/uploads').$picture->productFile['filename'] }}" style="width:100%; height: 100%; object-fit: cover;">
                                    </label>
                                @endif
                                <?php $counter++; ?>
                            <!-- endforeach -->
                        </div>
                    @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection