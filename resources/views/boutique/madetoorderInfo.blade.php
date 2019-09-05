@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          @if($mto['status'] == "Active")
          <h3 class="box-title">MTO ID: {{$mto['id']}}</h3>
          @elseif($mto['status'] == "Cancelled")
          <h3 class="box-title">MTO ID: {{$mto['id']}} | <label class="label label-danger">Cancelled</label></h3>
          @else
          <h3 class="box-title">MTO ID: {{$mto['id']}} | <label class="label label-danger">Declined</label></h3>
          @endif
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            <?php 
              $measurements = json_decode($mto->measurement['data']);
            ?>

              <h4>Customer Name: <b>{{$mto->customer['fname'].' '.$mto->customer['lname']}}</b></h4>
              <h4>Date request placed: <b>{{$mto['created_at']->format('M d, Y')}}</b></h4>

              <hr>
              <h4><b>MTO Details</b></h4>
              <h4>Date of item's use: <b>{{date('M d, Y',strtotime($mto['deadlineOfProduct']))}}</b></h4>
              <h4>Fabric:
                @if($mto['fabChoice'] == "provide")
                  <i><b>Customer will provide fabric<b></i>
                  
                @elseif($mto['fabChoice'] == "askboutique")
                  <i>User wants you to recommend which type of fabric to use.</i>
                @endif
              </h4>

              <h4>Customer's Notes/Instructions: <b>{{$mto['notes']}}</b></h4>
              @if($mto['price'] != null && $mto['orderID'] != null)
                <h4>Price: <b>₱{{$mto['price']}}</b></h4>
              @endif

              @if($mto['orderID'] != null)
              <hr>
              @if($measurements != null)
                <a href="" data-toggle="modal" data-target="#measurementsModal">View measurements here</a>
              @else
                <a href="" data-toggle="modal" data-target="#requestMeasurementsModal">Ask client for measurements here</a>
              @endif
              @endif
            

              @if($mto['orderID'] == null && $mto['status'] == "Active" && $mto['fabChoice'] == "askboutique")
              <hr>
              <a href="" data-toggle="modal" data-target="#recommendFabricModal">Recommend fabric to use with price here.</a><br><br>
                @if($mto['fabSuggestion'] != null)
                <h4>Your fabric suggestion: <b>{{$mto['fabSuggestion']}}</b></h4>
                <h4>Your offer price: <b>₱{{$mto['price']}}</b></h4>
                @endif

              @endif

              @if($mto['fabChoice'] == "provide" && $mto['orderID'] == null)
              <hr>
                <h4>Your price: <b>₱{{$mto['price']}}</b></h4>

              <form action="{{url('/addPrice')}}" method="post">
                {{csrf_field()}}
                <h4>Submit price of item:</h4>
                <input type="number" name="price" class="input form-control"><br>
                <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>

                <input type="submit" name="btn_submit" value="Place Offer" class="btn btn-primary">
              </form>
              @endif

              @if($mto['status'] != "Active" && $mto['status'] != "Cancelled")
              <hr>
              <h4><i>Your reason for declining: {{$mto->declineDetails['reason']}}</i></h4>
              @endif

            </div>
            <div class="col-md-6 col-12 col-lg-5"> <!-- col-md-6 ra ang orig-->

              <img src="{{ asset('/uploads/').$mto->productFile['filename'] }}" style="width:80%; height: auto; object-fit: cover;margin: 10px; text-align: right;">
            </div>
          </div>
        </div>
                  <input type="text" id="boutiqueID" name="boutiqueID" value="{{$mto->boutique['id']}}" hidden>

        <div class="box-footer" style="text-align: right;">
          @if($mto['orderID'] == null && $mto['status'] == "Active")
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
            <a href="" data-toggle="modal" data-target="#declineModal" class="btn btn-danger">Decline Request</a>
          @elseif($mto['orderID'] != null && $mto['status'] == "Active")
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
            <a href="{{url('orders/'.$mto->order['id'])}}" class="btn btn-primary">View Order Details</a>
          @else
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
          @endif
        </div>

      </div>
    </div>
  </div>
</section>


<div class="modal fade" id="requestMeasurementsModal" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Request for Measurements</b></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="{{url('requestMeasurement')}}" method="post">
          {{csrf_field()}}
        <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>

        <div class="form-group" id="select-div">
          <select name="category[]" id="category-select" class="form-control">
            <option selected></option>
            @foreach($categories as $category)
            <option value="{{$category['id']}}">{{$category['categoryName']}}</option>
            @endforeach
          </select><br>

          <div class="col-md-12" id="measurement-input" style="column-count: 2">
          </div>
        </div>

        <div class="form-group">
          <a id="addnew"><i class="fa fa-plus"></i> Request another</a>
        </div>

      </div>

      <div class="modal-footer">
        <input type="submit" class="btn essence-btn" value="Place Request">
      </form>
      </div>
    </div> 
  </div>
</div>

<!-- VIEW MEASUREMENT -->
<div class="modal fade" id="measurementsModal" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Measurements Submitted</b></h4>
      </div>

      <div class="modal-body">
            <!-- <p><b>Measurements Submitted:</b></p> -->
            @if($mto['measurementID'] != null)
            @foreach($measurements as $measurement)
                @foreach($measurement as $person)
                @if(is_array($person)) <!-- filter if naay array si person -->
                    @foreach($person as $personData)
                    @if(is_object($personData)) <!-- filter if naay object si personData -->
                        <?php $personDataArray = (array) $personData; ?> <!-- convert object to array para ma access -->
                        @foreach($personDataArray as $measurementName => $dataObject) <!-- get name and data -->
                            <?php $dataArray = (array) $dataObject; ?> <!-- convert to array gihapon kay object pa ang variable -->
                            <h4><b>{{strtoupper($measurementName)}}</b></h4>
                            @foreach($dataArray as $dataName => $data)
                                <h4>{{$dataName}}: &nbsp; {{$data}}"</h4>
                            @endforeach
                        @endforeach
                    @endif
                    @endforeach
                    <hr>
                @else
                    <h4><b>Name:</b> {{strtoupper($person)}}</h4>
                @endif
                @endforeach
            @endforeach
            @endif
      </div>

      <div class="modal-footer">
        <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
        <input type="submit" class="btn essence-btn" value="Cancel">
      </div>
    </div> 
  </div>
</div>

<!-- RECOMMEND FABRIC -->
<div class="modal fade" id="recommendFabricModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Recommend a fabric</b></h3>
      </div>

      <div class="modal-body">
        <form action="{{url('/recommendFabric')}}" method="post">
        {{csrf_field()}}

          <h4>Fabric Type:</h4> 
          <input type="text" name="fabSuggestion" class="form-control mb-3" required>
          <!-- <select id="fabric-type" name="fabSuggestion" class="form-control mb-3" required>
            <option disabled selected>Choose fabric type</option>
            @foreach($fabs as $fab => $name)
            <option value="{{$fab}}">{{$fab}}</option>
            @endforeach
          </select> --><br>
          <h4>Price:</h4> 
          <!-- <input type="number" name="fabricSuggestion[price]" class="form-control" placeholder="Price" required> -->
          <input type="number" name="price" class="form-control" placeholder="Price" required>
          <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
      </div>

      <div class="modal-footer">
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- FOR PICKUP MODAL -->
<div class="modal fade" id="forPickupModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <p>Submit MTO for Pickup?</p>
            <input type="date" name="deliverySchedule">
            <input type="text" name="orerID" value="{{$mto['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <a href="{{url('submitMTO/'.$mto['id'])}}" class="btn btn-primary">Confirm</a>
          </div>
      </div> 
    </div>
</div>


<!-- DECLINE MTO -->
<div class="modal fade" id="declineModal" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Submit a reason</b></h3>
      </div>

      <div class="modal-body">
        <form action="{{url('/declineMto')}}" method="post">
        {{csrf_field()}}
        <textarea name="reason" rows="3" cols="50" class="input form-control" placeholder="Place your reason here"></textarea>
        <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
      </div>

      <div class="modal-footer">
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<style type="text/css">
  h4{ margin-top: 0;}
  .borderless td, .borderless th {border: none;}
  .measurements {padding-left: 0;}
</style>




@endsection


@section('scripts')

<script type="text/javascript">

$('.transactions').addClass("active");
$('.mtos').addClass("active");

// $('#fabric-type').on('change', function(){
//   $('#fabric-color').empty();
//   $('#fabric-color').append('<option disabled selected="selected">Choose fabric color</option>');
//   $('#fabric-color').prop('disabled',false);

//   var type = $(this).val();
//   var boutiqueID = $("#boutiqueID").val();
//   $.ajax({
//     url: "/hinimo/public/getFabricColor/"+boutiqueID+'/'+type,
//     success:function(data){ 
//         data.colors.forEach(function(color){
//             $('#fabric-color').append('<option value="'+color.id+'">'+color.color+'</option>');
//             // $('#fabric-color').next().find('.list').append('<li data-value="'+color.id+'" class="option">'+color.color+'</li>');
//         });
//     }
//   });
// });


var counter = 1;

$('#addnew').on('click', function(){
  counter++;

  var categories = <?php echo $categories; ?>

  $('#select-div').append('<select name="category[]" id="new-category-select'+ counter +'" class="form-control new-category-select"> </select><br>');
  $('#new-category-select'+counter).append('<option selected></option>');

  <?php echo $categories; ?>.forEach(function(category){
    $('#new-category-select'+counter).append('<option value="'+ category.id +'">'+ category.categoryName +'</option>')
  });
});


$('body').on('change', '.new-category-select', function(){
  var categoryID = $(this).val();

  $('#new-category-measurement-input'+counter).empty();

  $.ajax({
    url:"/hinimo/public/getMeasurements/"+categoryID,
    success:function(data){

      $('#select-div').append('<div class="col-md-12" id="new-category-measurement-input'+ counter +'" style="column-count: 2"> </div><br><br>');

      data.measurements.forEach(function(measurement){
        $('#new-category-measurement-input'+counter).append('<input type="checkbox" id="'+ measurement.id +'" name="'+ categoryID +'['+measurement.mName +']" class="mb-3" placeholder="'+measurement.mName+'">&nbsp;');
        $('#new-category-measurement-input'+counter).append('<label for="'+ measurement.id +'">'+ measurement.mName +'</label><br>');
      });
    }
  });
}); 


$('#category-select').on('change', function(){
  var categoryID = $(this).val();

  $('#measurement-input').empty();

  $.ajax({
    url:"/hinimo/public/getMeasurements/"+categoryID,
    success:function(data){
      data.measurements.forEach(function(measurement){
        // $('#measurement-input').append('<input type="text" name="mCategory[]" class="form-control" value="'+measurement.id+'" hidden>');
        $('#measurement-input').append('<input type="checkbox" id="'+ measurement.id +'" name="'+ categoryID +'['+measurement.mName +']" class="mb-3" placeholder="'+measurement.mName+'">&nbsp;');
        $('#measurement-input').append('<label for="'+ measurement.id +'">'+ measurement.mName +'</label><br>');
      });


    }
  });
}); 
</script>

@endsection

