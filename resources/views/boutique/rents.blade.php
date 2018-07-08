@extends('layouts.boutique')

@section('titletext')
  Boutique de Filipina
@endsection

@section('content')

<div class="content-wrapper" style="background-color: white;">
    <!-- Content Header (Page header) -->

<section id="home" style="height: 170px;  background-size:cover; ">
</section>



    <div class="row">
        <div class="col-md-8 col-md-offset-1">
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
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Rent ID</th>
                  <th>Customer Name</th>
                  <th>Order Placed at:</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td><input type="submit" class="btn btn-primary" value="View Order" data-toggle="modal" data-target="#myModal"></td>
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td><input type="submit" class="btn btn-primary" value="View Order" data-toggle="modal" data-target="#appModal"></td>
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td><input type="submit" class="btn btn-primary" value="View Order"></td>
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <td><input type="submit" class="btn btn-primary" value="View Order"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    <!-- Pending modal -->
    <div class="modal fade" id="myModal" role="dialog">
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
              <td><b>Rent ID:</b></td>
              <td>183</td>
            </tr>
            <tr>
              <td><b>Customer Name:</b></td>
              <td>John Doe</td>
            </tr>
            <tr>
              <td><b>Order Placed at</b></td>
              <td>11-7-2017</td>
            </tr>
            <tr>
              <td>Order Status:</td>
              <td>Pending</td>
            </tr>
            <tr>
              <td>Item ID</td>
              <td>G001</td>
            </tr>
            <tr>
              <td>Item:</td>
              <td><img src="long/m.jpg"></td>
            </tr>
          </table>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Accept Order</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Approved modal -->
  <div class="modal fade" id="appModal" role="dialog">
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
              <td><b>Rent ID:</b></td>
              <td>219</td>
            </tr>
            <tr>
              <td><b>Customer Name:</b></td>
              <td>Alexander Pierce</td>
            </tr>
            <tr>
              <td><b>Order Placed at</b></td>
              <td>11-7-2017</td>
            </tr>
            <tr>
              <td>Item ID</td>
              <td>G009</td>
            </tr>
            <tr>
              <td>Item:</td>
              <td><img src="long/p.jpg"></td>
            </tr>
            <tr>
              <td>Order Status:</td>
              <td>On going (slide2)</td>
            </tr>
          </table>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Order Finished</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


 </div>

@endsection