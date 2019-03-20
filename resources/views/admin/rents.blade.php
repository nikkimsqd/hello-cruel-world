@extends('layouts.boutique')


@section('titletext')
  {{$admin['fname'].' | '.$admin['lname']}}
@endsection


@section('logo')
<!-- LOGO -->
    <a href="/hinimo/public/admin-dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Hinimo</span>
    </a>
@endsection

@section('inbox')
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success">4</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 4 messages</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <li><!-- start message -->
          <a href="#">
            <div class="pull-left">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <h4>
              Support Team
              <small><i class="fa fa-clock-o"></i> 5 mins</small>
            </h4>
            <p>Why not buy a new awesome theme?</p>
          </a>
        </li>
        <!-- end message -->
      </ul>
    </li>
    <li class="footer"><a href="#">See All Messages</a></li>
  </ul>
</li>
@endsection


@section('notifications')
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-warning">10</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 10 notifications</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">

        <li>
          <a href="#">
            <i class="fa fa-users text-aqua"></i> 5 new members joined today
          </a>
        </li>

      </ul>
    </li>
    <li class="footer"><a href="#">View all</a></li>
  </ul>
</li>
@endsection



@section('tasks')
<li class="dropdown tasks-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-flag-o"></i>
    <span class="label label-danger">9</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 9 tasks</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">

        <li><!-- Task item -->
          <a href="#">
            <h3>
              Design some buttons
              <small class="pull-right">20%</small>
            </h3>
            <div class="progress xs">
              <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                   aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">20% Complete</span>
              </div>
            </div>
          </a>
        </li>
        <!-- end task item -->

      </ul>
    </li>
    <li class="footer">
      <a href="#">View all tasks</a>
    </li>
  </ul>
</li>
@endsection


@section('useraccount')
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
    <span class="hidden-xs">{{$admin['lname']}}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

      <p>
        {{$admin['lname']}}
        <small>by {{$admin['fname']}}</small>
      </p>
    </li>
    <!-- Menu Body -->
    <li class="user-body">
      <div class="row">
        <div class="col-xs-4 text-center">
          <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Friends</a>
        </div>
      </div>
      <!-- /.row -->
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="#" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        <a href="#" class="btn btn-default btn-flat">Sign out</a>
      </div>
    </li>
  </ul>
</li>
@endsection


@section('sidebar')
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{$admin['lname']}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
   
    <li>
      <a href="/hinimo/public/admin-dashboard">
        <i class="fa fa-th"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Products</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/hinimo/public/admin-categories"><i class="fa fa-circle-o"></i> Categories</a></li>
        <li><a href="/hinimo/public/admin-tags"><i class="fa fa-circle-o"></i> Tags</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Transactions</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/hinimo/public/admin-orders"><i class="fa fa-circle-o"></i> Orders</a></li>
        <li><a href="/hinimo/public/admin-made-to-orders"><i class="fa fa-circle-o"></i> Made-to-Orders</a></li>
        <li><a href="/hinimo/public/admin-rents"><i class="fa fa-circle-o"></i> Rents</a></li>
      </ul>
    </li>

  </ul>
</section>
<!-- /.sidebar -->

@endsection




@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title"><b>PENDING RENT REQUESTS</b></h3>

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
          @if($rent['status'] === "Pending")
          <tr>
            <td>{{$rent['rentID']}}</td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
            <td><span class="label label-warning">Pending</span></td>
            <td>
                <input type="submit" class="btn btn-primary btn-sm" value="View Order" data-toggle="modal" data-target="#pendingModal{{$rent['rentID']}}">
            </td>
          </tr>
         
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->



<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><b>IN-PROGRESS RENTS</b></h3>

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
            <th>Request Approved at:</th>
            <th>Status</th>
            <th></th>
          </tr>
          @foreach($rents as $rent)
          @if($rent['status'] == "In-Progress")
          <tr>
            <td>{{$rent['rentID']}}</td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
            <td><span class="label label-info">In-Progress</span></td>
            <td><input type="submit" class="btn btn-primary btn-sm" value="View Order" data-toggle="modal" data-target="#inprogressModal{{$rent['rentID']}}"></td>
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->



<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title"><b>RENT HISTORY</b></h3>

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
            <th>Completed at:</th>
            <th>Status</th>
            <th></th>
          </tr>
          @foreach($rents as $rent)
          @if($rent['status'] == "Completed" || $rent['status'] == "Declined")
          <tr>
            <td>{{$rent['rentID']}}</td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
            <td>
              @if($rent['status'] == "Completed")
              <span class="label label-success">Completed</span>
              @elseif($rent['status'] == "Declined")
              <span class="label label-danger">Declined</span>
              @endif
            </td>
            <td><input type="submit" class="btn btn-sm-primary" value="View Order" data-toggle="modal" data-target="#historyModal{{$rent['rentID']}}"></td>
          </tr>
          @elseif($rent['status'] != "Completed")
          <tr>
            <td colspan="5"><i>You have no rent history...</i></td>
            @break
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->
      

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

