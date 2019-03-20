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
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
      </div>

      <div class="box-body">
        <div class="col-md-6">
          <div class="col-md-6"> 
          
        <label>Womens</label>
        @foreach($womens as $women)
          <li>{{$women['categoryName']}}</li>
        @endforeach

      </div>

      <div class="col-md-6">
          <label>Mens</label>
          @foreach($mens as $men)
              <li>{{$men['categoryName']}}</li>
          @endforeach
      </div>
        </div>

        <div class="col-md-5">
          <form action="{{ url('/saveCategory') }}" method="post">
            {{ csrf_field() }}
              
              Gender:
                <select class="form-control select2" name="gender" id="gender-select">
                  <option selected="selected"> </option>
                  <option value="Womens">Womens</option>
                  <option value="Mens">Mens</option>
                </select>
                <br>
                
              Category Name:
              <input type="text" name="categoryName" class="input form-control"><br>

        </div>

      </div>
      <div class="box-footer" style="text-align: right;">
       <input type="submit" name="btn_submit" value="Add Category" class="btn btn-primary">
      </form>
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>


@endsection



