@section('titletext')
  {{$user['fname']}}
@endsection




@section('logo')
<!-- LOGO -->
    <a href="{{url('ionic-dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Hinimo</span>
    </a>
@endsection




@section('notifications')
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    @if($notificationsCount != null)
    <span class="label label-danger">{{$notificationsCount}}</span>
    @else
    @endif
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have {{$notificationsCount}} notifications</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">

        @foreach($notifications as $notification)
        @if($notification->read_at != null)
        <li>
          <a href="{{ url('view-notifications/'.$notification->id) }}">
              <i class="fa fa-tags text-aqua"></i> {{$notification->data['text']}}
          </a> 
        </li>
        @else
        <li style="background-color: #e6f2ff;">
          <a href="{{ url('view-notifications/'.$notification->id) }}">
              <i class="fa fa-tags text-aqua"></i> {{$notification->data['text']}}
          </a> 
        </li>
        @endif
        @endforeach

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
    <span class="label label-danger"></span>
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
    <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="user-image" alt="User Image">
    <span class="hidden-xs">{{$user['lname']}}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="img-circle" alt="User Image">

      <p>
        {{$user['fname'].' '.$user['lname']}}
        <!-- <small>Member since {{$user['created_at']}}</small> -->
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
        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
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
      <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{$user['fname']}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
   
    <li class="dashboard">
      <a href="{{url('ionic-dashboard')}}">
        <i class="fa fa-th"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>
   
  <!--   <li class="biddings">
      <a href="{{url('boutique-view-biddings')}}">
        <i class="fa fa-th"></i> <span>Orders</span>
        <span class="pull-right-container">
        </span>
      </a> -->
    </li>

    <li class="treeview deliveries">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Deliveries</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="topickup"><a href="{{url('ionic-topickup')}}"><i class="fa fa-circle-o"></i> To Pickup</a></li>
        <li class="todeliver"><a href="{{url('ionic-todeliver')}}"><i class="fa fa-circle-o"></i> To Deliver</a></li>
        <li class="delivered"><a href="{{url('ionic-delivered')}}"><i class="fa fa-circle-o"></i> Delivered</a></li>
        <li class="completed"><a href="{{url('ionic-completed')}}"><i class="fa fa-circle-o"></i> Completed</a></li>
      </ul>
    </li>


  </ul>
</section>
<!-- /.sidebar -->

@endsection