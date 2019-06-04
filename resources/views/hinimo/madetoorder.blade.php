@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('titletext')
	Hinimo | {{ $page_title }}
@endsection


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{ $page_title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->
<!-- ##### Blog Wrapper Area Start ##### -->
<div class="blog-wrapper" style="padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="regular-page-content-wrapper">
                    <div class="regular-page-text">
                        <form method="post" action="{{url('/saveMadeToOrder')}}"  enctype="multipart/form-data">
                            {{csrf_field()}}

                            <h2 class="form-group row">Submit your "churva" here</h2>
                            <p>The boutique still needs to confirm your request before proceeding to the much more details about your item.</p>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <input name="file" type="file" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Date of use of the product</label>

                                <div class="col-md-6">
                                    <input name="dateOfUse" type="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Height (cm)</label>

                                <div class="col-md-6">
                                    <input name="height" type="text" class="form-control" required placeholder="Ex: 165 cm">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Category of item</label>

                                <div class="col-md-6">
                                    <select name="gender" id="gender-select">
                                        <option value=""></option>
                                        <option value="mens">Mens</option>
                                        <option value="womens">Womens</option>
                                    </select><br><br><br>

                                    <select name="category" id="category-select" disabled>
                                        <option></option>
                                        @foreach($categories as $category)
                                        <option value="{{$category['id']}}">{{$category['categoryName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Measurements (inches)</label>

                                <div class="col-md-6" id="measurement-input">
                                    <br><br><br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Instructions/Notes</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="notes" rows="5" placeholder="Place here your instructions for the item. Ex: what is your preferred type of cloth for your item etc."></textarea>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden>
                                    <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit for confirmation">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">


</style>
@endsection



@section('scripts')
<script type="text/javascript">

$('#gender-select').on('change', function(){

    $('#measurement-input').empty()
    $('#category-select').empty();
    $('#category-select').next().find('.list').empty();
    $('#category-select').next().find('.current').val("-----------------");

    var gender = $(this).val();

    $('#category-select').prop('disabled',false);
    $('.nice-select').removeClass('disabled');

    $.ajax({
        url: "/hinimo/public/getCategory/"+gender,
        success:function(data){ 
            data.categories.forEach(function(category){
                $('#category-select').append('<option value="'+category.id+'">'+category.categoryName+'</option>');
                $('#category-select').next().find('.list').append('<li data-value="'+category.id+'" class="option">'+category.categoryName+'</li>');
            });
        }
    });
}); 

$('#category-select').on('change', function(){
    var categoryID = $(this).val();

    $('#measurement-input').empty()

    $.ajax({
        url:"/hinimo/public/getMeasurements/"+categoryID,
        success:function(data){
            data.measurements.forEach(function(measurement){
                $('#measurement-input').append('<input type="text" name="mCategory[]" class="form-control" value="'+measurement.id+'" hidden>');
                $('#measurement-input').append('<input type="text" name="measurement['+measurement.mName +']" class="form-control" placeholder="'+measurement.mName+'"><br>');
            });
        }
    });

}); 

</script>

@endsection