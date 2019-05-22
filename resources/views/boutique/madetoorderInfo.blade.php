@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">MTO ID: {{$mto['id']}}</h3>
      </div>
      <!-- /.box-header -->

      <div class="box-body">
        <div class="row">
        <div class="col-md-6">
        <!-- if($mto['status'] == "Pending")
        <form action="/hinimo/public/approveMto" method="post">
        elseif($mto['status'] == "In-Transaction")
        <form action="/hinimo/public/updateRentInfo" method="post"> -->
  
        <!-- endif -->
          {{csrf_field()}}
          <?php 
            $measurements = json_decode($mto->measurement['data'])
          ?>

          <label>Customer Name:</label>
          <h4>{{$mto->customer['fname'].' '.$mto->customer['lname']}}</h4>

          <label>Date request placed:</label>
          <h4>{{$mto['created_at']->format('M d, Y')}}</h4>

          <label>Date of item's use:</label>
          <h4>{{date('M d, Y',strtotime($mto['dateOfUse']))}}</h4>

          <label>Customer's Notes/Instructions:</label>
          <h4>{{$mto['notes']}}</h4>

          <label>Customer's Height:</label>
          <h4>{{$mto['height']}}</h4><br>
        </div>

          <div class="col-md-6">
            <label>Customer's Measurements:</label>
            @foreach($measurementNames as $measurementName)
            <h4>{{$measurementName['mName']}}</h4>
            @endforeach
            
            @foreach($measurements as $meas)
            <h5>{{$meas}}</h5>
            @endforeach
          </div>
        </div> <!-- row -->

          <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('/pics_for_upload/short/x.jpg')}}" style="width:95%; height: auto; object-fit: cover;margin: 10px;">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <form action="{{url('/addOfferPrice')}}" method="post">
                {{csrf_field()}}
                <label>Submit an offer:</label>
                <input type="number" name="offerPrice" class="input form-control"><br>
                <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>

                <input type="submit" name="btn_submit" value="Place Offer" class="btn btn-primary">
              </form>
            </div>
          </div>

      </div>

      <div class="box-footer" style="text-align: right;">
          <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
          <a href="" data-toggle="modal" data-target="#declineModal" class="btn btn-danger">Decline Request</a>
        @if($mto['status'] == "Pending")
          <a href="{{url('halfapproveMto/'.$mto['id'])}}" class="btn btn-primary">Contact customer for negotiations</a>
          @elseif($mto['status'] == "In-Transaction")
          <a href="" class="btn btn-success">Accept Request</a>
          @endif
        <!-- </form> -->
      </div>

    </div>
  </div>
</div>

<!-- DECLINE RENT -->
<div class="modal fade" id="declineModal" role="dialog">
  <div class="modal-dialog modal-lg">
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
</style>




@endsection


@section('scripts')

<script type="text/javascript">
  //scripts here
</script>

@endsection

