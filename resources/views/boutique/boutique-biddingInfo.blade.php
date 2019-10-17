@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
  <?php 
      $counter = 1;
  ?>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">By: {{ $bidding->owner['fname'].' '.$bidding->owner['lname'] }}</h3>
        </div>

        <div class="box-body">
          <div class="col-md-6 col-12 col-lg-7">
            <?php 
              $measurements = json_decode($bidding->measurement['data']);
            ?>

            <h4>Bidding Ends in: <b>{{ date('M d, Y',strtotime($bidding['endDate'])) }}</b></h4>
            <h4>Deadline of Product: <b>{{ date('M d, Y',strtotime($bidding['deadlineOfProduct'])) }}</b></h4>
            <h4>Customer's notes/instructions:</h4>
            <h4><b>{{ $bidding['notes'] }}</b></h4>
            <h4>Quantity: <b>{{ $bidding['quantity'] }}</b></h4>
            <h4>Maximum Price Limit: <b>₱{{ $bidding['quotationPrice'] }}</b></h4>
            <!-- Customer's Quotation Price -->
            @if(count($bidding->bids))
              <?php $bids = array(); ?>
              <h4>Lowest quotation offered to the client:
                @foreach($bidding->bids as $bid)
                  <?php array_push($bids, $bid['quotationPrice']) ?>
                @endforeach
                  <b>₱{{min($bids)}}</b>
              </h4>
            @else
              <h4>No bids</h4>
            @endif

            <hr>
            @if($bid != null)
              @if($bid['fabricName'] != null)
                <h4>Your Fabric Suggestion: <b>{{$bid['fabricName']}}</b></h4>
              @endif
            <h4>Your current quotation: <b>₱{{$bid['quotationPrice']}}</b></h4>
            @endif

            <hr>
            @if($measurements != null)
              <a href="" data-toggle="modal" data-target="#measurementsModal">View measurements here</a>
            @else
              <a href="" data-toggle="modal" data-target="#requestMeasurementsModal">Ask client for measurements here</a>
            @endif

          </div>

          <div class="col-md-5 col-12 col-lg-4">
            <?php $counter = 1; ?>
            @foreach( $bidding->productFile as $image)
             @if($counter == 1)
              <img src="{{ asset('/uploads').$image['filepath'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
            @else
            @endif
            <?php $counter++; ?>
            @endforeach
          </div>
        </div>

        <div class="box-footer" style="text-align: right;">
          <a href="{{url('boutique-biddings')}}" class="btn btn-default">Back</a>
          <a href="{{url('orders/'.$bidding->order['id'])}}" class="btn btn-primary">View Order Details</a>
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
            <!-- <div class="form-group">
              Enter category count:
              <input type="text" id="category-count" class="form-control">
              <a class="count-submit">Enter</a>
            </div> -->
            <input type="text" name="biddingID" value="{{$bidding['id']}}" hidden>


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
              <!-- <input type="text" id="addnew" >Request another -->
              <!-- <select class="form-control"></select> -->
            </div>

          </div>

          <div class="modal-footer">
            <input type="submit" class="btn essence-btn" value="Place Request">
            <!-- <input type="" class="btn btn-danger" data-dismiss="modal" value="Cancel"> -->
          </form>
          </div>
      </div> 
    </div>
</div>

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
                @if($bidding['measurementID'] != null)
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


<style type="text/css">
  /*h4{font-weight: bold;}*/
</style>


@endsection



@section('scripts')
<script type="text/javascript">

$('.transactions').addClass("active");
$('.boutique-biddings').addClass("active");


// $(window).on('load',function(){
//   $('#bidSubmitted').modal('show');
// });
  // console.log(<?php //echo $categories; ?>);

// $('#category-count').on('keyup', function(){
//   var counter = $(this).val();
//   console.log(counter);
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

