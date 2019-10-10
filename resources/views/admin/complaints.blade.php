@extends('layouts.boutique')
@extends('admin.sections')

@section('content')

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title"><b>PAYPAL ACCOUNT</b></h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">


              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#pendings" data-toggle="tab">Pendings</a></li>
                  <li><a href="#payouts" data-toggle="tab">Archives</a></li>
                  <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="pendings">
                    <table class="table table-hover">
                      <col width="245"><col width="420"><col width="145"><col width="170">
                      <thead>
                        <th>Complainant</th>
                        <th>Complain</th>
                        <th class="center">Order ID</th>
                        <th></th>
                      </thead>
                      @foreach($complains as $complain)
                      @if($complain['status'] == "Active")
                      <tr>
                        <td>{{$complain->order->customer['fname']}}</td>
                        <td>{{$complain['complain']}}</td>
                        <td class="center">{{$complain->order['id']}}</td>
                        <td><a href="{{url('admin-orders/'.$complain->order['id'].'#complaint')}}" class="btn btn-default">View Complain</a></td>
                      </tr>
                      @endif
                      @endforeach
                    </table>
                    
                  </div>
                  
                  <div class="tab-pane" id="payouts">
                    <table class="table">
                      <thead>
                        <th>Complainant</th>
                        <th>Complain</th>
                        <th>Order ID</th>
                        <th></th>
                      </thead>
                      @foreach($complains as $complain)
                      @if($complain['status'] == "Closed")
                      <tr>
                        <td>{{$complain->order->customer['fname']}}</td>
                        <td>{{$complain['complain']}}</td>
                        <td>{{$complain->order['id']}}</td>
                        <td><a href="{{url('admin-orders/'.$complain->order['id'].'#complaint')}}" class="btn btn-default">View Complain</a></td>
                      </tr>
                      @endif
                      @endforeach
                    </table>
                      
                  </div>
                  
                </div>
              </div>


            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</section>

<style type="text/css">
  .dropdown-menu{left: 237px;}
  .center{text-align: center;}
</style>


@endsection



@section('scripts')
<script type="text/javascript">

$('.complaints').addClass("active");


</script>
@endsection