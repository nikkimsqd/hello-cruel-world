@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div id="content-wrapper" style="background-color: white;">

<section id="home" style="height: 170px;  background-size:cover; ">
</section>
<hr>

      <div class="row">
        <div class="col-md-3 col-md-offset-1 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Orders</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Customers</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>



      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <br><br><br>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>ORDERS</b></h3>

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
                  <th>Order ID</th>
                  <th>Customer Name</th>
                  <th>Order Placed at:</th>
                  <th>Status</th>
                  <!-- <th></th> -->
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <a href="/hinimo/public/made-to-orders">View Made-to-Orders here</a>
          <!-- /.box -->
        </div>
      </div>
      
      <!-- --------------------RENT---------------- -->
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <br><br><br>
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
                  <!-- <th></th> -->
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <!-- <td><input type="submit" class="btn btn-primary" value="View Order"></td> -->
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <a href="/hinimo/public/made-to-orders">View Rents here</a><br><br>
          <!-- /.box -->
        </div>
      </div>


</div> <!-- sa page -->


@endsection

