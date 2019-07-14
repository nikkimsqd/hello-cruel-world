@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box">

        <div class="box-body">
          @if($sp != null)
          <h4>You have <b>{{$sp['sharePercentage']}}%</b> share in every boutique's order.</h4>
          <input type="checkbox" id="edit-link" name="edit-link" value="true" class="minimal-red"> 
          <label for="edit-link">Edit here</label><br><br>
          @else
          <h4>You have not yet set your share in every boutique's order.</h4>
          <input type="checkbox" id="edit-link" name="edit-link" value="true" class="minimal-red"> 
          <label for="edit-link">Add here</label><br><br>
          @endif


          <div class="col-md-5" id="percentageShare" hidden>
            <form action="{{url('editPercentage')}}" method="post">
              {{csrf_field()}}
              <label>Enter your percentage</label>
              <input type="number" name="sharePercentage" class="form-control"><br>
              <input type="submit" name="btn_submit" class="btn btn-success">
            </form>
          </div>


        </div>

      </div>


      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>SALES</b></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-hover" id="orders-table">
            <thead>
            <tr>
              <th class="align-center">Order ID</th>
              <th>Boutique Name</th>
              <th class="align-center">Status</th>
              <th class="align-center">Total</th>
              <th class="align-center">Boutique's revenue</th>
              <th class="align-center">Hinimo's revenue</th>
            </tr>
            </thead>
            <?php $totalRevenue = 0; ?>
            @foreach($orders as $order)
            <tr>
              <td class="align-center">{{$order['id']}}</td>
              <td>{{$order->boutique['boutiqueName']}}</td>
              <td class="align-center">
                @if($order['status'] == "In-Progress")
                <span class="label label-warning">{{$order['status']}}</span>

                @elseif($order['status'] == "For Alterations")
                <span class="label label-info">{{$order['status']}}</span>

                @elseif($order['status'] == "For Pickup")
                <span class="label bg-navy">{{$order['status']}}</span>

                @elseif($order['status'] == "For Delivery")
                <span class="label bg-olive">{{$order['status']}}</span>

                @elseif($order['status'] == "On Delivery")
                <span class="label bg-maroon">{{$order['status']}}</span>

                @elseif($order['status'] == "Delivered")
                <span class="label label-success">{{$order['status']}}</span>

                @elseif($order['status'] == "Completed")
                <span class="label label-success">{{$order['status']}}</span>
                @endif
              </td>
              <td class="align-center">₱{{$order['total']}}</td>
              <td class="align-center">₱{{$order['boutiqueShare']}}</td>
              <td class="align-center">₱{{$order['adminShare']}}</td>
            </tr>
            <?php $totalRevenue += $order['adminShare']; ?>
            @endforeach
            <tr class="total">
              <td colspan="5">&nbsp; Total Revenue for this month</td>
              <td class="align-center"><b>₱{{$totalRevenue}}</b></td>
            </tr>
          </table>
        </div>
        <div class="box-footer" style="text-align: right;">
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>

<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.sales').addClass("active");  


$('#edit-link').on('change', function() {
  $('#percentageShare').attr('hidden',!this.checked)
});


// $(function () {
//   $('#orders-table').DataTable({
//     'paging'      : true,
//     'lengthChange': true,
//     'searching'   : false,
//     'ordering'    : true,
//     'info'        : true,
//     'autoWidth'   : false
//   })
// });

</script>

@endsection