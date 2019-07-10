@extends('layouts.boutique')
@extends('admin.sections')


@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>RENTS</b></h3>

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
          <table class="table table-hover" id="rents-table">
            <thead>
            <tr>
              <th>Rent ID</th>
              <th>Boutique Name</th>
              <!-- <th>Customer Name</th> -->
              <th>Status</th>
              <th>Boutique's profit</th>
              <th>Hinimo's profit</th>
              <th>Total</th>
              <th></th>
            </tr>
            </thead>
            @foreach($rents as $rent)
            <tr>
              <td>{{$rent['rentID']}}</td>
              <td>{{$rent->order->boutique['boutiqueName']}}</td>
              <!-- <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td> -->
              <td><span class="label label-warning">Pending</span></td>
              <td>[halin ni boutique here]</td>
              <td>[halin ni hinimo here]</td>
              <td>{{$rent->order['total']}}</td>
              <td>
                  <input type="submit" class="btn btn-primary btn-sm" value="View Order" data-toggle="modal" data-target="#pendingModal{{$rent['rentID']}}">
              </td>
            </tr>
           
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div> <!-- table row -->


</section>
      

<!-- MODALS HEREE -->
<!-- PENDING MODAL -->
@foreach($rents as $rent)
<div class="modal fade" id="pendingModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Rent Details</b></h3>
      </div>

      <div class="modal-body">
        {{csrf_field()}}
        <table class="table">
          <tr>
            <td><label>Rent ID:</label></td>
            <td>{{$rent['rentID']}}</td>
          </tr>
          <tr>
            <td><label>Customer Name:</label></td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
          </tr>
          <tr>
            <td><label>Order Placed at</label></td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
          </tr>
          <tr>
            <td><label>Order Status:</label></td>
            <td><span class="label label-warning">{{$rent['status']}}</span></td>
          </tr>
          <tr>
            <td><label>Product:</label></td>
            <td>{{$rent->product->productName}}</td>
          </tr>
          <!-- <tr>
            <td><label>Item:</label></td>
            <td>
             <?php 
                  $counter = 1;
              ?>
                            
              @foreach($rent->product->productFile as $image)
              @if($counter == 1)    
              <img src="{{ asset('/uploads').$image['filename'] }}">
              @else
              @endif
              <?php $counter++; ?>
              @endforeach
            </td>
          </tr> -->
        </table>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
@endforeach



<!-- IN-PROGRESS MODAL -->
@foreach($rents as $rent)
<div class="modal fade" id="inprogressModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Rent Details</b></h3>
      </div>

      <div class="modal-body">
        <table class="table">
          <tr>
            <td><label>Rent ID:</label></td>
            <td>{{$rent['rentID']}}</td>
          </tr>
          <tr>
            <td><label>Customer Name:</label></td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
          </tr>
          <tr>
            <td><label>Order Placed at</label></td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
          </tr>
          <tr>
            <td><label>Rent Status:</label></td>
            <td><span class="label label-info">{{$rent['status']}}</span></td>
          </tr>
          <tr>
            <td><label>Request Approved at:</label></td>
            <!-- <td>{{$rent['approved_at']}}</td> -->
            <td>{{date('M d, Y', strtotime($rent['approved_at']))}}</td>
          </tr>
          <tr>
            <td><label>Product:</label></td>
            <td>{{$rent->product->productName}}</td>
          </tr>
         <!--  <tr>
            <td><label>Item:</label></td>
            <td>
             <?php 
                  $counter = 1;
              ?>
                            
              @foreach($rent->product->productFile as $image)
              @if($counter == 1)    
              <img src="{{ asset('/uploads').$image['filename'] }}">
              @else
              @endif
              <?php $counter++; ?>
              @endforeach
            </td>
          </tr> -->
        </table>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
@endforeach


<!-- RENT HISTORY MODAL -->
@foreach($rents as $rent)
<div class="modal fade" id="historyModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Rent Details</b></h3>
      </div>

      <div class="modal-body">
        <table class="table">
          <tr>
            <td><label>Rent ID:</label></td>
            <td>{{$rent['rentID']}}</td>
          </tr>
          <tr>
            <td><label>Customer Name:</label></td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
          </tr>
          <tr>
            <td><label>Order Placed at</label></td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
          </tr>
          <tr>
            <td><label>Rent Status:</label></td>
            <td>
               @if($rent['status'] == "Completed")
              <span class="label label-success">Completed</span>
              @elseif($rent['status'] == "Declined")
              <span class="label label-danger">Declined</span>
              @endif
            </td>
          </tr>
          <tr>
            <td><label>Request Approved at:</label></td>
            <!-- <td>{{$rent['approved_at']}}</td> -->
            <td>{{date('M d, Y', strtotime($rent['approved_at']))}}</td>
          </tr>
          <tr>
            <td><label>Product:</label></td>
            <td>{{$rent->product->productName}}</td>
          </tr>
         <!--  <tr>
            <td><label>Item:</label></td>
            <td>
             <?php 
                  $counter = 1;
              ?>
                            
              @foreach($rent->product->productFile as $image)
              @if($counter == 1)    
              <img src="{{ asset('/uploads').$image['filename'] }}">
              @else
              @endif
              <?php $counter++; ?>
              @endforeach
            </td>
          </tr> -->
        </table>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
@endforeach

@endsection



@section('scripts')
<script type="text/javascript">

$(function () {
    $('#rents-table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });

</script>
@endsection

