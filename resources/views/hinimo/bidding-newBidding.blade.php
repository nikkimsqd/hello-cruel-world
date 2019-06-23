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
            <div class="col-md-12">
                <div class="regular-page-content-wrapper checkout_details_area">
                    <div class="regular-page-text">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <form method="post" action="{{url('/savebidding')}}">
                                    {{csrf_field()}}

                                    <div class="col-md-12 mb-3">
                                        <label>Product Category</label>
                                        <select class="form-control" name="gender" id="gender-select" required autofocus>
                                            <option selected="selected"> </option>
                                            <option value="Womens">Womens</option>
                                            <option value="Mens">Mens</option>
                                        </select>

                                        <select class="form-control" id="category-select" name="categoryName" required disabled>
                                            <option value=""></option>
                                        </select>
                                    </div><br><br><br><br>

                                    <div class="col-md-12 mb-3">
                                        <label>Starting Bidding Price</label>
                                        <input name="startingprice" type="number" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Image</label>
                                        <input name="file" type="file" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Date of use of the product</label>
                                        <input name="dateOfUse" type="date" class="form-control" >
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Height (cm)</label>
                                        <input name="height" type="number" class="form-control"  placeholder="Ex: 165 cm">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Category of item  <span>*</span></label>
                                        <select class="mb-3" name="gender" id="gender-select">
                                            <option value=""></option>
                                            <option value="mens">Mens</option>
                                            <option value="womens">Womens</option>
                                        </select><br><br><br>

                                        <select class="mb-3" name="category" id="category-select" disabled>
                                            <option></option>
                                            <!-- @foreach($categories as $category)
                                            <option value="{{$category['id']}}">{{$category['categoryName']}}</option>
                                            @endforeach -->
                                        </select>
                                    </div><br><br>

                                    <!-- <hr> -->
                                    <div class="col-md-12 mb-3">
                                        <label>Measurements (inches)</label>
                                        <div class="mb-3" id="measurement-input">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Choose Fabric</label><br>
                                            <input id="suggest" class="fabric-radio" type="radio" name="fabric" value="suggest">
                                            <label for="suggest"> Ask boutique for fabric suggestions</label> <br>

                                            <input id="choose" class="fabric-radio" type="radio" name="fabric" value="choose">
                                            <label for="choose"> Choose available fabric from boutique</label> <br>
                                    </div>

                                    <div class="col-md-12 mb-3" id="fabric-select" hidden="">
                                        <input type="text" name="fabricChoice[Fabric Type]" class="form-control mb-3" placeholder="Fabric Type">
                                        <input type="text" name="fabricChoice[Fabric Color]" class="form-control" placeholder="Fabric Color">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Instructions/Notes</label>
                                            <textarea class="form-control" name="notes" rows="5" placeholder="Place here your instructions for the item. Ex: what is your preferred type of cloth for your item etc."></textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Bidding End Date</label>
                                        <input type="date" name="endDate" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Deadline for the product</label>
                                        <input type="date" name="dateOfUse" class="form-control">
                                    </div>

                                    <label>Tags</label><br>
                                    <div class="col-md-12 mb-3 tags">
                                        @foreach($tags as $tag)
                                            <input type="checkbox" name="tags[]" id="{{$tag['name']}}" value="{{$tag['id']}}">
                                            <label for="{{$tag['name']}}">{{$tag['name']}}</label>
                                        @endforeach
                                    </div>


                                    <button type="submit" class="btn btn-primary">
                                        Start Bidding
                                    </button>
                                    <a href="{{url('biddings')}}" class="btn btn-primary">Submit dummy</a>
                                        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
.tags label {
  display: inline-block;
  width: auto;
  padding: 10px;
  border: solid 1px #ccc;
  transition: all 0.3s;
  background-color: #e3e2e2;
  border-radius: 5px;
}

.tags input[type="checkbox"] {
  display: none;
}

.tags input[type="checkbox"]:checked + label {
  border: solid 1px #e7e7e7;
  background-color: #ef1717;
  color: #fff;
}

</style>
@endsection



@section('scripts')
<script type="text/javascript">

$('#gender-select').on('change', function(){

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

</script>

@endsection