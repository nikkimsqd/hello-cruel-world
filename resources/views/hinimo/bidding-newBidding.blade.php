@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('titletext')
	Hinimo | {{ $page_title }}
@endsection


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('bg/breadcumb.jpg')}});">
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
                <div class="regular-page-content-wrapper">
                    <div class="regular-page-text">
                        <div class="row justify-content-center">
                            <div class="col-md-7">
                                <form method="post" action="{{url('/savebidding')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    <div class="col-md-12 mb-3">
                                        <label>Image</label>
                                        <input name="file" type="file" class="form-control" multiple required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Category of item  <span>*</span></label>
                                        <select class="mb-3" name="gender" id="gender-select">
                                            <option disabled selected>Choose gender</option>
                                            <!-- <option value="mens">Mens</option> -->
                                            <option value="womens">Womens</option>
                                        </select><br><br><br>

                                        <select class="mb-3" name="category" id="category-select" disabled required>
                                            <!-- @foreach($categories as $category)
                                            <option value="{{$category['id']}}">{{$category['categoryName']}}</option>
                                            @endforeach -->
                                        </select>
                                    </div><br><br>

                                    <!-- <hr> -->
                                    <div class="col-md-12 mb-3">
                                        <label>Measurements (inches)</label> 
                                        <span><a style="color: blue;" href="https://youtu.be/gIhfrADZ2ZU" target="blank">See guide on how to measure youself here.</a></span>
                                        <div class="mb-3" id="measurement-input">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Height (cm)</label>
                                        <input name="height" type="number" class="form-control"  placeholder="Ex: 165 cm" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Instructions/Notes</label>
                                            <textarea class="form-control" name="notes" rows="5" placeholder="Place here your instructions for the item. Ex: what is your preferred type of fabric for your item etc." required></textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Bidding End Date</label>
                                        <input type="date" name="endDate" id="endDate" class="form-control" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Deadline for the product</label>
                                        <input type="text" name="deadlineOfProduct" id="deadlineOfProduct" class="form-control" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Your Maximum Price</label>
                                        <input name="maxPriceLimit" type="number" class="form-control" required>
                                    </div><br>


                                    <a href="{{url('biddings')}}" class="btn essence-btn">Cancel</a>
                                    <input type="submit" name="btn_submit" class="btn essence-btn" value="Start Bidding">
                                    <!-- <a href="{{url('biddings')}}" class="btn btn-primary">Submit dummy</a> -->
                                        
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

label{
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 600;
}

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

.datepicker-dropdown{position: absolute; top: 935px; left: 281.5px; z-index: 11; display: block;}

</style>
@endsection



@section('scripts')
<script type="text/javascript">

var dateToday = new Date();
var dateTomorrow = new Date();
var dateNextMonth = new Date();
dateTomorrow.setDate(dateToday.getDate()+1);
dateNextMonth.setDate(dateToday.getDate()+30);

// $('#endDate').datepicker({
//     startDate: dateTomorrow
// });

$('#deadlineOfProduct').datepicker({
    startDate: dateNextMonth
});

$('#gender-select').on('change', function(){
    $('#category-select').empty();
    $('#category-select').next().find('.list').empty();
    $('#category-select').next().find('.current').empty();
    $('#measurement-input').empty();

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
                $('#measurement-input').append('<input type="text" name="measurement['+measurement.mName +']" class="form-control mb-3" placeholder="'+measurement.mName+'">');
            });
        }
    });

});  

</script>

@endsection