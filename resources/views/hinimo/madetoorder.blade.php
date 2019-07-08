@extends('layouts.hinimo')
@extends('hinimo.sections')

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
                        <form method="post" action="{{url('/saveMadeToOrder')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <h2 class="form-group row">Submit your made-to-order details here</h2>
                            <p>After you send your made-to-order details, the boutique will set a price for your made-to-order and you'll get to decide if you will continue your request for made-to-order with the said price or not.</p>

                            <div class="col-md-8 mb-3">
                                <label>Image</label>
                                <input name="file" type="file" class="form-control" multiple>
                            </div>

                            <div class="col-md-8 mb-3 dateOfUse">
                                <label>Date of use of the product</label>
                                <input name="dateOfUse" type="text" class="form-control" id="dateOfUse" placeholder="mm / dd / yyyy">
                                <!-- <input name="date" type="date" class="form-control" id="date"> -->
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Height (cm)</label>
                                <input name="height" type="number" class="form-control"  placeholder="Ex: 165 cm">
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Type of item  <span>*</span></label>
                                <select class="mb-3" name="gender" id="gender-select">
                                    <option disabled selected>Choose gender</option>
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
                            <div class="col-md-8 mb-3">
                                <label>Measurements (inches)</label>
                                <div class="mb-3" id="measurement-input">
                                </div>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Choose Fabric</label><br>
                                    <input id="suggest" class="fabric-radio" type="radio" name="fabric" value="suggest">
                                    <label for="suggest"> Ask boutique for fabric suggestions</label> <br>

                                    <input id="choose" class="fabric-radio" type="radio" name="fabric" value="choose">
                                    <label for="choose"> Choose available fabric from boutique</label> <br>
                            </div>

                            <div class="col-md-8 mb-3" id="fabric-select" hidden="">
                                <!-- <label>Choose Fabric</label> -->
                               <!--  <select id="fabric-type" class="mb-3">
                                    @foreach($fabrics as $fabric)
                                    @if($fabric == $fabric)
                                    <option value="{{$fabric['name']}}">{{$fabric['name']}}</option>
                                    @endif
                                    @endforeach
                                </select><br><br><br> -->
                                <select id="fabric-type" class="mb-3">
                                    <option disabled selected>Choose fabric type</option>
                                    @foreach($fabs as $fab => $name)
                                    <option value="{{$fab}}">{{$fab}}</option>
                                    @endforeach
                                </select><br><br><br>
                                <select id="fabric-color" class="mb-3" name="fabricID">
                                    <option disabled selected="selected">Choose fabric color</option>
                                </select><br><br>

                                <!-- di lang sa maka buot si customer sa fabric -->
                                <!-- <label>Cannot find the right fabric and color? Type it below!</label>
                                <input type="text" name="fabricChoice[fabricType]" class="form-control mb-3" placeholder="Fabric Type">
                                <input type="text" name="fabricChoice[fabricColor]" class="form-control" placeholder="Fabric Color"> -->
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Instructions/Notes</label>
                                    <textarea class="form-control" name="notes" rows="5" placeholder="Place here your instructions for the item. Ex: what is your preferred type of cloth for your item etc."></textarea>
                            </div>  

                            <div class="col-md-8 mb-3">
                                <input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden>
                                <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">

.datepicker-dropdown{top: 634px !important; left: 281.5px; z-index: 11; display: block;}

label{
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
}

</style>
@endsection



@section('scripts')
<script type="text/javascript">

var dateToday = new Date();
var dateNextMonth = new Date();
dateNextMonth.setDate(dateToday.getDate()+30);

$('#dateOfUse').datepicker({
    startDate: dateNextMonth
});

// $('#date').on('change', function(){
//     var dateSelected = $(this).val();
//     date = new Date(dateSelected);
//     console.log(date);
//     $('.dateOfUse').append('<input name="dateOfUse" type="date" class="form-control" id="dateOfUse" value="'+ date +'">');
// });


$('.fabric-radio').on('change', function() {
    if($(this).val() == "choose"){
        $('#fabric-select').removeAttr('hidden');
    }else{
        $('#fabric-select').attr('hidden', "hidden");
    }
});

$('#fabric-type').on('change', function(){
    $('#fabric-color').empty();
    $('#fabric-color').next().find('.list').empty();
    $('#fabric-color').next().find('.current').empty();

    var type = $(this).val();
    $.ajax({
        url: "/hinimo/public/getFabricColor/"+type,
        success:function(data){ 
            console.log('aasa');
            data.colors.forEach(function(color){
                $('#fabric-color').append('<option value="'+color.id+'">'+color.color+'</option>');
                $('#fabric-color').next().find('.list').append('<li data-value="'+color.id+'" class="option">'+color.color+'</li>');
            });
        }
    });
});


$('#gender-select').on('change', function(){
    $('#measurement-input').empty()
    $('#category-select').empty();
    $('#category-select').next().find('.list').empty();
    $('#category-select').next().find('.current').empty();

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