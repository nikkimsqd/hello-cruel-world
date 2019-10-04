@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box">
        <div class="box-body">
          <div class="col-md-12">
            <form action="{{url('admin-saveAccount')}}" method="post" class="form-horizontal">
              {{csrf_field()}}

              <br>

              <div class="form-group">
                <label for="fname" class="col-sm-3 control-label">First Name</label>

                <div class="col-sm-7">
                  <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="lname" class="col-sm-3 control-label">Last Name</label>

                <div class="col-sm-7">
                  <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-7">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>

                <div class="col-sm-7">
                  <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-7">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="gender" class="col-sm-3 control-label">Gender</label>

                <div class="col-sm-7">
                  <select class="form-control" name="gender" required>
                    <option selected disabled></option>
                    <option value="Male">Male</option>
                    <option value="Female">Femlale</option>
                  </select>
                </div>
              </div>
              
              <!-- <div class="form-group">
                <label for="priorityNumber" class="col-sm-3 control-label">Priority Number</label>

                <div class="col-sm-7">
                  <input type="number" name="priorityNumber" class="form-control" id="priorityNumber" placeholder="Priority Number" required>
                </div>
              </div> -->

              <div class="form-group align-center">
                <input type="submit" name="btn_submit" value="Submit" class="btn btn-primary">
              </div>

            </form>
          </div>

        </div>
      </div>


      <div class="box" id="couriers">
        <div class="box-header with-border">
          <h3 class="box-title">Couriers</h3>
        </div>

        <div class="box-body">
          <div class="col-md-12">
            <table class="table table-hover" id="couriers-table">
              <thead>
                <th>Courier ID</th>
                <th>Name</th>
                <th>Status</th>
                <th></th>
              </thead>
              @foreach($couriers as $courier)
              <tr>
                <td>{{$courier['id']}}</td>
                <td>{{$courier->user['fname'].' '.$courier->user['lname']}}</td>
                @if($courier['status'] == 'Active')
                  <td class="green">{{$courier['status']}}</td>
                @else
                  <td class="red">{{$courier['status']}}</td>
                @endif
                <td><a href="{{url('view-courier/'.$courier['id'])}}" class="btn btn-default">View Courier</a></td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}
  .red{color: red;}
  .green{color: green;}

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.tools').addClass("active");  
$('.accounts').addClass("active");  



$(function () {
  $('#couriers-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

</script>

@endsection