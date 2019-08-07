@extends('layouts.hinimo')
@extends('hinimo.sections')

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
            <div class="col-md-8">
                <div class="regular-page-content-wrapper">
                    <div class="regular-page-text">
                        <form method="post" action="{{url('/saveMadeToOrder')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <h2 class="form-group row">Submit your request for your made-to-order here</h2>
                            <p>After you send your made-to-order details, the boutique will set a price for your made-to-order and you'll get to decide if you will continue your request for made-to-order with the said price or not.</p>

                            <div class="col-md-8 mb-3">
                                <label>Image</label>
                                <input name="file" type="file" class="form-control" multiple required>
                            </div>

                            <div class="col-md-8 mb-3 dateOfUse">
                                <label>Deadline of product</label>
                                <input name="deadlineOfProduct" type="text" class="form-control" id="deadlineOfProduct" placeholder="mm / dd / yyyy" required>
                                <!-- <input name="date" type="date" class="form-control" id="date"> -->
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Quantity</label><br>
                                <input name="quantity" type="number" class="form-control" required style="width: 100px; display: inline;"> pcs.
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Number of wearers</label><br>
                                <input name="numOfPerson" type="number" class="form-control" required style="width: 100px; display: inline;"> person
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Fabric Choice</label><br>
                                &nbsp;&nbsp;&nbsp;
                                <input id="provide" name="fabChoice" type="checkbox" value="provide">
                                <label for="provide">Provide Fabric to boutique</label><br>
                                &nbsp;&nbsp;&nbsp;
                                <input id="askboutique" name="fabChoice" type="checkbox" value="askboutique">
                                <label for="askboutique">Let boutique provide the fabric</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Instructions/Notes</label>
                                <textarea class="form-control" name="notes" rows="5" placeholder="Place here your instructions for the item. Ex: what is your preferred type of cloth for your item etc." required></textarea>
                            </div>  

                            <div class="col-md-8 mb-3">
                                <input type="text" id="boutiqueID" name="boutiqueID" value="{{$boutique['id']}}" hidden>
                                <a href="{{url('boutique/'.$boutique['id'])}}" class="btn essence-btn">Cancel</a>
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

    .datepicker-dropdown{top: 388px !important; left: 281.5px; z-index: 11; display: block;}

    label{
        font-size: 13px;
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

$('#deadlineOfProduct').datepicker({
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
    var boutiqueID = $("#boutiqueID").val();
    $.ajax({
        url: "/hinimo/public/getFabricColor/"+boutiqueID+'/'+type,
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