
@section('titletext')
  {{$admin['fname'].' | '.$admin['lname']}}
@endsection

@section('page_title')
{{$page_title}}
@endsection

@section('logo')
<!-- LOGO -->
  <a href="admin-dashboard" class="logo">
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

          @foreach($adminNotifications as $notification)
          @if($notification->read_at != null)
          <li>
            <a href="{{ url('categories-notifications/'.$notification->id) }}">
                <i class="fa fa-tags text-aqua"></i> {{$notification->data['text']}}
            </a> 
          </li>
          @else
          <li style="background-color: #e6f2ff;">
            <a href="{{ url('categories-notifications/'.$notification->id) }}">
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



@section('useraccount')
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <!-- <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"> -->
    <span class="hidden-xs">{{$admin['lname']}}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <!-- <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> -->
      <br><br>
      <p>
        {{$admin['lname']}}
        <small>by {{$admin['fname']}}</small>
      </p>
    </li>
    <!-- Menu Body -->
   <!--  <li class="user-body">
      <div class="row">
        <div class="col-xs-4 text-center">
          <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Orders</a>
        </div>
      </div>
    </li> -->
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
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
<!--   <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{$admin['lname']}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div> -->

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
   
    <li class="dashboard">
      <a href="{{url('admin-dashboard')}}">
        <i class="fa fa-th"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>
   
    <li class="sales">
      <a href="{{url('admin-sales')}}">
        <i class="fa fa-line-chart"></i> <span>Sales</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>

    <li class="treeview orders">
      <a href="#">
        <i class="fa fa-edit"></i>
        <span>Orders</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="on-going"><a href="{{url('admin-orders')}}"><i class="fa fa-circle-o"></i> On-going</a></li>
        <li class="archives"><a href="{{url('admin-archives')}}"><i class="fa fa-circle-o"></i> Archives</a></li>
      </ul>
    </li>

    <li class="treeview products">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Products</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="categories"><a href="{{url('admin-categories')}}"><i class="fa fa-circle-o"></i> Categories</a></li>
        <li class="tags"><a href="{{url('admin-tags')}}"><i class="fa fa-circle-o"></i> Tags</a></li>
        <li class="measurements"><a href="{{url('admin-measurements')}}"><i class="fa fa-circle-o"></i> Measurements</a></li>
      </ul>
    </li>

    <li class="treeview tools">
      <a href="#">
        <i class="fa fa-gear"></i>
        <span>Tools</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="locations"><a href="{{url('admin-locations')}}"><i class="fa fa-circle-o"></i> Locations</a></li>
        <li class="accounts"><a href="{{url('admin-addAccount')}}"><i class="fa fa-circle-o"></i> Add Account</a></li>
      </ul>
    </li>

  </ul>
</section>

<style type="text/css">
  .user-panel{min-height: 45px;}
</style>
<!-- /.sidebar -->

@endsection
