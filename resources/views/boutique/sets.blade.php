@extends('layouts.boutique')
@extends('boutique.sections')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">{{$page_title}}</li>
</ol>
@endsection


@section('content')

<section class="content">
  <div class="row">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-9">
        
          <div class="total-products">
              <p><span>{{$setCount}}</span> products found</p>
          </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
             <a class="btn btn-block btn-info" href="{{url('addset')}}">Add Sets here</a>
            </div>
        </div>
      </div>
    </div>

  @if(empty($sets))
    <label>You have no sets in your store</label>
  @else
  @foreach($sets as $set)

    <div class=" col-12 col-sm-6 col-lg-4" style="padding-right: 20px; padding-left: 20px;"> <!-- change to col-lg-3 if dako ra -->
      <div class="box " style="padding: 10px;">
        <div class="box-body">
          <div class="row">
          <?php $counter = 1; ?>

            @foreach( $set->items as $item)
            <div class="col-md-6">
              @foreach($item->product->productFile as $image)

                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 350px; object-fit: cover;">
                <?php break; ?>
              @endforeach
            </div>
            @endforeach
          </div>

          <div class="row">
            <a href="{{ url('viewproduct/'.$set['id']) }}">
              <h4>{{ $set['setName'] }}</h4>
            </a>
            <h2></h2>

            <a href="{{ url('viewset/'.$set['id']) }}" class="btn btn-block btn-primary">View Set</a>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  @endif
  </div>
</section>

@endsection


@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");
$('.allsets').addClass("active");

</script>


@endsection
