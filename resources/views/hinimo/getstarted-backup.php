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
                    <p class="mb-2">Choose the tops you like to wear</p>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Sleeveless" class="custom-control-input" id="sleeveless">
                                <label class="custom-control-label" for="sleeveless">Sleeveless</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Shirts" class="custom-control-input" id="shirts">
                                <label class="custom-control-label" for="shirts">Shirts</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Tees" class="custom-control-input" id="tees">
                                <label class="custom-control-label" for="tees">Tees</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Off the shoulder" class="custom-control-input" id="offtheshoulder">
                                <label class="custom-control-label" for="offtheshoulder">Off the shoulder</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Ruffles" class="custom-control-input" id="ruffles">
                                <label class="custom-control-label" for="ruffles">Ruffles</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Sweatshirts" class="custom-control-input" id="Sweatshirts">
                                <label class="custom-control-label" for="Sweatshirts">Sweatshirts</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Graphics" class="custom-control-input" id="Graphics">
                                <label class="custom-control-label" for="Graphics">Graphics</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="tops[]" value="Boho" class="custom-control-input" id="Boho">
                                <label class="custom-control-label" for="Boho">Boho</label>
                            </div>
                        </div>
                    </div>

                    <!-- JACKETS -->
                    <p class="mb-2">Choose the jackets you like to wear</p>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Blazers" class="custom-control-input" id="Blazers">
                                <label class="custom-control-label" for="Blazers">Blazers</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Bombers" class="custom-control-input" id="Bombers">
                                <label class="custom-control-label" for="Bombers">Bombers</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Car coats" class="custom-control-input" id="Car coats">
                                <label class="custom-control-label" for="Car coats">Car coats</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Denim" class="custom-control-input" id="Denim">
                                <label class="custom-control-label" for="Denim">Denim</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Vests" class="custom-control-input" id="Vests">
                                <label class="custom-control-label" for="Vests">Vests</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Capes" class="custom-control-input" id="Capes">
                                <label class="custom-control-label" for="Capes">Capes</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Drape Front" class="custom-control-input" id="Drape Front">
                                <label class="custom-control-label" for="Drape Front">Drape Front</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Moto" class="custom-control-input" id="Moto">
                                <label class="custom-control-label" for="Moto">Moto</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="jackets[]" value="Utility" class="custom-control-input" id="Utility">
                                <label class="custom-control-label" for="Utility">Utility</label>
                            </div>
                        </div>
                    </div>

                    <!-- PANTS -->
                    <p class="mb-2">Choose the pants you like to wear</p>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Cropped" class="custom-control-input" id="Cropped">
                                <label class="custom-control-label" for="Cropped">Cropped</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Denim" class="custom-control-input" id="denim">
                                <label class="custom-control-label" for="denim">Denim</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Jumpsuit" class="custom-control-input" id="Jumpsuit">
                                <label class="custom-control-label" for="Jumpsuit">Jumpsuit</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Leggings" class="custom-control-input" id="Leggings">
                                <label class="custom-control-label" for="Leggings">Leggings</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Trousers" class="custom-control-input" id="Trousers">
                                <label class="custom-control-label" for="Trousers">Trousers</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Skirts" class="custom-control-input" id="Skirts">
                                <label class="custom-control-label" for="Skirts">Skirts</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Active" class="custom-control-input" id="Active">
                                <label class="custom-control-label" for="Active">Active</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="pants[]" value="Printed" class="custom-control-input" id="Printed">
                                <label class="custom-control-label" for="Printed">Printed</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2"" value="">
                                <input type="checkbox" name="pants[]" value="Shorts" class="custom-control-input" id="Shorts">
                                <label class="custom-control-label" for="Shorts">Shorts</label>
                            </div>
                        </div>
                    </div>

                    <!-- DRESSES -->
                    <p class="mb-2">Choose the dresses you like to wear</p>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Bodycon" class="custom-control-input" id="Bodycon">
                                <label class="custom-control-label" for="Bodycon">Bodycon</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Fit & Flare" class="custom-control-input" id="Fit & Flare">
                                <label class="custom-control-label" for="Fit & Flare">Fit & Flare</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Shifts" class="custom-control-input" id="Shifts">
                                <label class="custom-control-label" for="Shifts">Shifts</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Sheath Dresses" class="custom-control-input" id="Sheath Dresses">
                                <label class="custom-control-label" for="Sheath Dresses">Sheath Dresses</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Shirt Dresses" class="custom-control-input" id="Shirt Dresses">
                                <label class="custom-control-label" for="Shirt Dresses">Shirt Dresses</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Wrap Dresses" class="custom-control-input" id="Wrap Dresses">
                                <label class="custom-control-label" for="Wrap Dresses">Wrap Dresses</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Min" class="custom-control-input" id="Min">
                                <label class="custom-control-label" for="Min">Min</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Midi" class="custom-control-input" id="Midi">
                                <label class="custom-control-label" for="Midi">Midi</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="dresses[]" value="Maxi" class="custom-control-input" id="Maxi">
                                <label class="custom-control-label" for="Maxi">Maxi</label>
                            </div>
                        </div>
                    </div>

                    <!-- GOWNS -->
                    <p class="mb-2">Choose the gowns you like to wear</p>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="sweaters[]" value="Ball Gowns" class="custom-control-input" id="Ball Gowns">
                                <label class="custom-control-label" for="Ball Gowns">Ball Gowns</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="sweaters[]" value="Mermaid Gowns" class="custom-control-input" id="Mermaid Gowns">
                                <label class="custom-control-label" for="Mermaid Gowns">Mermaid Gowns</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2" value="">
                                <input type="checkbox" name="sweaters[]" value="Empire Waist Gowns" class="custom-control-input" id="DustEmpire Waist Gownsers">
                                <label class="custom-control-label" for="Empire Waist Gowns">Empire Waist Gowns</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="sweaters[]" value="A-Line Gowns" class="custom-control-input" id="A-Line Gowns">
                                <label class="custom-control-label" for="A-Line Gowns">A-Line Gowns</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="sweaters[]" value="Modified A-Line Gowns" class="custom-control-input" id="Modified A-Line Gowns">
                                <label class="custom-control-label" for="Modified A-Line Gowns">Modified A-Line Gowns</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="sweaters[]" value="Trumpet Gowns" class="custom-control-input" id="Trumpet Gowns">
                                <label class="custom-control-label" for="Trumpet Gowns">Trumpet Gowns</label>
                            </div>
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" name="sweaters[]" value="Sheath Gowns" class="custom-control-input" id="Sheath Gowns">
                                <label class="custom-control-label" for="Sheath Gowns">Sheath Gowns</label>
                            </div>
                        </div>
                    </div>

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