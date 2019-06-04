@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
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
        <span class="info-box-icon bg-green"><i class="ion ion-bag"></i></span>

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
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">New Customers</span>
          <span class="info-box-number">90<small>%</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Sales</span>
          <span class="info-box-number">90<small>%</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>



  <div class="row">
    <div class="col-md-12">
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
    <div class="col-md-12">
      <div class="box ">
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
              <th>Request Placed at:</th>
              <th>Status</th>
              <th></th>
            </tr>
            @foreach($rents as $rent)
            <tr>
              <td>{{$rent['rentID']}}</td>
              <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
              <td>{{$rent['created_at']->format('M d, Y')}}</td>
              <td><span class="label label-warning">Pending</span></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div> <!-- table row -->
</section>

@endsection

