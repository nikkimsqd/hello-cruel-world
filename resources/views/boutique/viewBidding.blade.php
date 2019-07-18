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
          <div class="col-md-6">
            <?php 
              $measurementData = json_decode($bidding->measurement['data']);
            ?>

            <h4>Customer's Measurements:</h4>
            @foreach($measurementData as $measurementName => $value)
              <h4>{{$measurementName}}: <b>{{$value}} inches</b></h4>
            @endforeach
            <h4>Customer's Height: <b>{{$bidding['height']}} cm</b></h4>
            <hr>
            <h4>Customer's notes/instructions:</h4>
            <h4><b>{{ $bidding['notes'] }}</b></h4>
            <h4>Bidding Ends in: <b>{{ date('M d, Y',strtotime($bidding['endDate'])) }}</b></h4>
            <h4>Deadline of Product: <b>{{ date('M d, Y',strtotime($bidding['deadlineOfProduct'])) }}</b></h4>
            <h4>Maximum Price Limit: <b>₱{{ $bidding['maxPriceLimit'] }}</b></h4>
            @if(count($bidding->bids))
              <?php $bids = array(); ?>
              <h4>Lowest bid:
                @foreach($bidding->bids as $bidAmount)
                  <?php array_push($bids, $bidAmount['bidAmount']) ?>
                @endforeach
                  <b>₱{{min($bids)}}</b>
              </h4>
            @else
              <h4>No bids</h4>
            @endif
            <hr>
            @if($bid != null)
            <h4>Your plans: <b>{{$bid['plans']}}</b></h4>
            <h4>Your current bid: <b>₱{{$bid['bidAmount']}}</b></h4>
            <hr>
            @endif

            <!-- <br> -->
            @if($bid == null)
            <a href="" class="btn btn-success btn-lg" data-toggle="modal" data-target="#submitABidModal{{$bidding['id']}}">Submit a Bid</a>
            @else
            <a href="" class="btn btn-success btn-lg" data-toggle="modal" data-target="#editBidModal{{$bidding['id']}}">Update your Bid</a>
            @endif
          </div>

          <div class="col-md-5">
            <?php $counter = 1; ?>
            @foreach( $bidding->productFile as $image)
             @if($counter == 1)
              <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
            @else
            @endif
            <?php $counter++; ?>
            @endforeach
          </div>
        </div>

        <div class="box-footer" style="text-align: right;">
          <a href="{{url('boutique-view-biddings')}}" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to biddings</i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAAAAAAAAAAAAAAAL-------------------------------->
<div class="modal fade" id="submitABidModal{{$bidding['id']}}" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Submit your bid</b></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-12 bid-content">
            <form action="{{url('submitBid')}}" method="post">
              {{csrf_field()}}
            <label>Enter Amount</label>
            <input type="number" name="bidAmount" min="1" max="{{$bidding['maxPriceLimit']}}" class="form-control" required><br>
            <label>Your plan</label>
            <textarea name="plans"  class="form-control" colspan="5" required></textarea>
            <input type="text" name="biddingID" value="{{$bidding['id']}}" hidden>
          </div>
        </div>
      </div> <!-- modal body -->

      <div class="modal-footer">
        <a href="" class="btn btn-default">Cancel</a>
        <input type="submit" class="btn btn-primary" value="Submit Bid" id="">
        <!-- <input type="" class="btn essence-btn" data-dismiss="modal" value="Cancel"> -->
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editBidModal{{$bidding['id']}}" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Update your bid</b></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-12 bid-content">
            <form action="{{url('updateBid')}}" method="post">
              {{csrf_field()}}
            <label>Enter Amount</label>
            <input type="number" name="bidAmount" min="1" max="{{$bid['maxPriceLimit']}}" class="form-control" value="{{$bid['bidAmount']}}" required><br>
            <label>Your plan</label>
            <textarea name="plans" class="form-control" colspan="5" required>{{$bid['plans']}}</textarea>
            <input type="text" name="biddingID" value="{{$bidding['id']}}" hidden>
          </div>
        </div>
      </div> <!-- modal body -->

      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Update Bid" id="">
        <!-- <input type="" class="btn essence-btn" data-dismiss="modal" value="Cancel"> -->
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bidSubmitted" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <h4>Your bid has been submitted!</h4>
          </div>
        </div>
      </div> <!-- modal body -->

      <div class="modal-footer">
        <input type="submit" class="btn btn-default" value="Close" data-dismiss="modal">
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

$('.biddings').addClass("active");

// $(window).on('load',function(){
//   $('#bidSubmitted').modal('show');
// });

</script>


@endsection

