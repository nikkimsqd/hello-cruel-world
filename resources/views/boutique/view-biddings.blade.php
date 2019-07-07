@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')

<section class="content">
  <div class="row">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-9">
        
          <div class="total-products">
              <p><span>{{$biddingsCount}}</span> biddings found</p>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class=" col-md-4" style="padding-right: 20px; padding-left: 20px;"> -->
    <div class="col-md-12">
      <div class="box " style="padding: 10px;">
        <div class="box-body">

  @if(empty($biddings))
    <label>There are no biddings as of the moment</label>
  @else
  @foreach($biddings as $bidding)
      <!-- <div class="row"> -->
        <div class="col-md-4 bid-item">
    
          <?php $counter = 1; ?>

          @foreach( $bidding->productFile as $image)

          @if($counter == 1)  
            <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 350px; object-fit: cover;">
          @else
          @endif
          <?php $counter++; ?>
          @endforeach

          <!-- <div class="row"> -->
            <!-- <a href="{{ url('viewproduct/'.$bidding['id']) }}"> -->
              <span>Bidding closes in: {{date('M d, Y',strtotime($bidding['endDate']))}}</span>
              <h4>Price Limt: <b>₱{{$bidding['maxPriceLimit']}}</b></h4>
              @if(count($bidding->bids))
                <?php $bids = array(); ?>
                <span>Lowest bid:
                  @foreach($bidding->bids as $bid)
                    <?php array_push($bids, $bid['bidAmount']) ?>
                  @endforeach
                    ₱{{min($bids)}}
                </span>
              @else
                <span>No bids</span>
              @endif
            <!-- </a> -->
            <h2></h2>

            <div class="hover-content">
              <a href="{{ url('boutique-view-bidding/'.$bidding['id']) }}" class="btn btn-block btn-lg btn-success btn-flat view-bidding" hidden>View Bidding</a>
            </div>
          <!-- </div> -->
        </div>
      <!-- </div> -->
  @endforeach
  @endif
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">

/*.bid-item{margin: 0 auto;}*/
.view-bidding{text-transform: uppercase; font-weight: 600;}
.view-bidding:hover{background-color: #d9f9ea; border-color: #d9f9ea; color: #398439;}
.bid-item{position: relative;}
.hover-content{position: absolute; width: calc(100% - 40px); bottom: 115px; left: 20px; right: 20px; opacity: 0; visibility: hidden; -webkit-transition-duration: 500ms; transition-duration: 500ms;};
.bid-item .hover-content{visibility: hidden;}
.bid-item:hover .hover-content{visibility: visible; opacity: 1;}
h4{margin: 0 0;}

</style>

@endsection


@section('scripts')
<script type="text/javascript">

$('.biddings').addClass("active");

</script>


@endsection
