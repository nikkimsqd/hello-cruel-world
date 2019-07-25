@section('titletext')
  {{$user['fname']}}
@endsection

@section('page_title')
{{$page_title}}
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
          <a href="{{ url('courier-notifications/'.$notification->id) }}">
              <i class="fa fa-tags text-aqua"></i> {{$notification->data['text']}}
          </a> 
        </li>
        @else
        <li style="background-color: #e6f2ff;">
          <a href="{{ url('courier-notifications/'.$notification->id) }}">
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
    <!-- <img src="{{ asset('essence/img/core-img/user.svg') }}" class="user-image" alt="User Image"> -->
        <i class="fa fa-user"></i>
    <span class="hidden-xs">{{$user['lname']}}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <!-- <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="img-circle" alt="User Image"> -->
      <br><br>
      <p>
        {{$user['fname'].' '.$user['lname']}}
        <!-- <small>Member since {{$user['created_at']}}</small> -->
      </p>
    </li>
    
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
 <!--  <div class="user-panel">
    <div class="pull-left info"> -->
      <!-- <p>{{$user['lname']}}</p> -->
  <!--   </div>
  </div> -->

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
   
    <li class="dashboard">
      <a href="{{url('ionic-topickup')}}">
        <span>To Pickup</span>
        <span class="pull-right-container">
        </span>
      </a>
    </li>
   
    <li class="dashboard">
      <a href="{{url('ionic-todeliver')}}">
        <span>To Deliver</span>
        <span class="pull-right-container">
        </span>
      </a>
    </li>
   
    <li class="dashboard">
      <a href="{{url('ionic-delivered')}}">
        <span>Delivered</span>
        <span class="pull-right-container">
        </span>
      </a>
    </li>
   
    <li class="dashboard">
      <a href="{{url('ionic-completed')}}">
        <span>Completed</span>
        <span class="pull-right-container">
        </span>
      </a>
    </li>
   
<!-- 
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
    </li> -->


  </ul>
</section>
<!-- /.sidebar -->

@endsection