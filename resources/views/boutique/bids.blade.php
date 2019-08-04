@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title">Bids</h3>
        </div>

        <div class="box-body">
          <table id="bids-table" class="table table-hover">
            <thead>
              <tr>
                <th>Bid ID</th>
                <th>Offer Price</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
              @foreach($bids as $bid)
              <tr>
                <td>{{$bid['id']}}</td>
                <td>₱{{$bid['quotationPrice']}}</td>
                <td>
                  @if($bid->bidding['bidID'] == $bid['id'])
                    <label class="label label-success">Accepted</label>
                  @else
                    <label class="label label-danger" >Denied</lable>
                  @endif
                </td>
                <td><a href="{{url('/boutique-view-bidding/'.$bid['biddingID'])}}" class="btn btn-sm btn-default">View Details</a></td>
              </tr>
              @endforeach
          </table>

        </div>
        <div class="box-footer" style="text-align: right;">
<!--          <a class="btn btn-warning" href="/hinimo/public/dashboard/"><i class="fa fa-arrow-left"> Back to dasboard</i></a>
         <a class="btn btn-primary" href="/hinimo/public/addCategories/"><i class="fa fa-plus"> Add a Category</i></a> -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">

$(function () {
  $('#bids-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

$('.biddings').addClass("active");
$('.bids').addClass("active");

</script>
@endsection