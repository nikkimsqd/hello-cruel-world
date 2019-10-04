@section('titletext')
  Hinimo | {{$boutique['boutiqueName']}}
@endsection

@section('page_title')
{{$page_title}}
@endsection


@section('logo')
<!-- LOGO -->
    <a href="/hinimo/public/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Hinimo</span>
    </a>
@endsection

@section('inbox')
<!-- Messages: style can be found in dropdown.less-->
<!-- <li class="dropdown messages-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-danger">4</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 4 messages</li>
    <li>
      <ul class="menu">
        <li>
          <a href="#">
            <div class="pull-left">
              <img src="{{asset('adminlte/dist/img/avatar2.png')}}" class="img-circle" alt="User Image">
            </div>
            <h4>
              Customer Name
              <small><i class="fa fa-clock-o"></i> 5 mins</small>
            </h4>
            <p>I would like to follow up my order</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="footer"><a href="#">See All Messages</a></li>
  </ul>
</li> -->
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
<!-- <li class="dropdown tasks-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-flag-o"></i>
    <span class="label label-danger">9</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 9 tasks</li>
    <li>
      <ul class="menu">

        <li>
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

      </ul>
    </li>
    <li class="footer">
      <a href="#">View all tasks</a>
    </li>
  </ul>
</li> -->
@endsection


@section('useraccount')
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <!-- <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="user-image" alt="User Image"> -->
    <span class="hidden-xs">{{$boutique['boutiqueName']}}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <!-- <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="img-circle" alt="User Image"> -->
      <br><br><br>
      <p>
        {{$boutique['boutiqueName']}}
        <small>Member since {{$boutique['created_at']}}</small>
      </p>
    </li>
    <!-- Menu Body -->
    <!-- <li class="user-body">
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
    </li> -->
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="{{url('boutique-profile')}}" class="btn btn-default btn-flat">Profile</a>
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
  <!-- <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('adminlte/dist/img/avatar2.png') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{$boutique['boutiqueName']}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div> -->

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">{{$boutique['boutiqueName']}}</li>
   
    <li class="dashboard">
      <a href="{{url('dashboard')}}">
        <i class="fa fa-th"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>
   
    <li class="biddings">
      <a href="{{url('boutique-view-biddings')}}">
        <i class="fa fa-edit"></i> <span>Biddings</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="bids"><a href="{{url('boutique-bids')}}"><i class="fa fa-circle-o"></i> Bids</a></li>
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
        <li class="allsets"><a href="{{url('sets')}}"><i class="fa fa-circle-o"></i> All Sets</a></li>
        <li class="allproducts"><a href="{{url('products')}}"><i class="fa fa-circle-o"></i> All Products</a></li>
        <!-- <li><a href="/hinimo/public/products/womens"><i class="fa fa-circle-o"></i> Womens</a></li> -->
        <!-- <li><a href="/hinimo/public/products/mens"><i class="fa fa-circle-o"></i> Mens</a></li> -->
        <!-- <li><a href="/hinimo/public/products/embellishments"><i class="fa fa-circle-o"></i> Embellishments</a></li> -->
        <!-- <li><a href="{{url('products/customizable')}}"><i class="fa fa-circle-o"></i> Customizable Items</a></li> -->
      </ul>
    </li>

    <li class="treeview transactions">
      <a href="#">
        <i class="fa fa-user-plus"></i>
        <span>Transactions</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="orders"><a href="{{url('orders')}}"><i class="fa fa-circle-o"></i> Orders</a></li>
        <li class="rents"><a href="{{url('rents')}}"><i class="fa fa-circle-o"></i> Rents</a></li>
        <li class="mtos"><a href="{{url('made-to-orders')}}"><i class="fa fa-circle-o"></i> Made-to-Orders</a></li>
        <li class="boutique-biddings"><a href="{{url('boutique-biddings')}}"><i class="fa fa-circle-o"></i> Biddings</a></li>
      </ul>
    </li>

    <li class="treeview etc">
      <a href="#">
        <i class="fa fa-gear"></i>
        <span>Tools</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="categories"><a href="{{url('categories')}}"><i class="fa fa-circle-o"></i> Categories</a></li>
        <!-- <li class="tags"><a href="{{url('tags')}}"><i class="fa fa-circle-o"></i> Tags</a></li> -->
        <li class="fabrics"><a href="{{url('fabrics')}}"><i class="fa fa-circle-o"></i> Available Fabrics</a></li>
      </ul>
    </li>

    <li class="treeview archives">
      <a href="#">
        <i class="fa fa-archive"></i>
        <span>Archives</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="archive-orders"><a href="{{url('archive-orders')}}"><i class="fa fa-circle-o"></i> Orders</a></li>
        <li class="archive-rents"><a href="{{url('archive-rents')}}"><i class="fa fa-circle-o"></i> Rents</a></li>
        <li class="archive-mtos"><a href="{{url('archive-made-to-orders')}}"><i class="fa fa-circle-o"></i> Made-to-Orders</a></li>
        <li class="archive-boutique-biddings"><a href="{{url('archive-boutique-biddings')}}"><i class="fa fa-circle-o"></i> Biddings</a></li>
      </ul>
    </li>
   
    <li class="paypal-account">
      <a href="{{url('paypal-account')}}">
        <i class="fa fa-paypal"></i> <span>PayPal Account</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>

  </ul>
</section>

<style type="text/css">
  .user-panel{min-height: 45px;}
  .navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a, .navbar-nav > .messages-menu > .dropdown-menu > li .menu > li > a, .navbar-nav > .tasks-menu > .dropdown-menu > li .menu > li > a{white-space: unset !important;}
</style>
<!-- /.sidebar -->

@endsection