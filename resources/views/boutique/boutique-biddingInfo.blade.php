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
                @foreach($bidding->bids as $bid)
                  <?php array_push($bids, $bid['bidAmount']) ?>
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

          </div>

          <div class="col-md-5 col-12 col-lg-4">
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
          <a href="{{url('boutique-biddings')}}" class="btn btn-default">Back</a>
          <a href="{{url('orders/'.$bidding->order['id'])}}" class="btn btn-primary">View Order Details</a>
        </div>
      </div>
    </div>
  </div>
</section>



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

</script>


@endsection

