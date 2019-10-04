@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box">
        <div class="box-body">
          <div class="col-md-12">
            <form class="form-horizontal">

              <div class="form-group">
                <h4 class="col-sm-5 control-label">First Name</h4>

                <div class="col-sm-7">
                  <h4 class="heading">{{$courier->user['fname'].' '.$courier->user['lname']}}</h4>
                </div>
              </div>
              
              <div class="form-group">
                <h4 class="col-sm-5 control-label">Username</h4>

                <div class="col-sm-7">
                  <h4 class="heading">{{$courier->user['username']}}</h4>
                </div>
              </div>
              
              <div class="form-group">
                <h4 class="col-sm-5 control-label">Email</h4>

                <div class="col-sm-7">
                  <h4 class="heading">{{$courier->user['email']}}</h4>
                </div>
              </div>
              
              <div class="form-group">
                <h4 class="col-sm-5 control-label">Gender</h4>

                <div class="col-sm-7">
                  <h4 class="heading">{{$courier->user['gender']}}</h4>
                </div>
              </div>
              
              <div class="form-group">
                <h4 class="col-sm-5 control-label">Status</h4>

                <div class="col-sm-7">
                  @if($courier['status'] == 'Active')
                    <h4 class="heading green">{{$courier['status']}}</h4>
                  @else
                    <h4 class="heading red">{{$courier['status']}}</h4>
                  @endif
                </div>
              </div>

              <!-- <div class="form-group align-right">
                <input type="submit" name="btn_submit" value="Submit" class="btn btn-primary">
              </div> -->

            </form>
          </div>

        </div>

        <div class="box-footer align-right">
          <a href="{{url('admin-addAccount#couriers')}}" class="btn btn-default">Back</a> &nbsp;
          @if($courier['status'] == 'Active')
            <a href="{{url('deactivate-courier/'.$courier['id'])}}" class="btn btn-danger">Deactivate Account</a>
          @else
            <a href="{{url('activate-courier/'.$courier['id'])}}" class="btn btn-success">Activate Account</a>
          @endif
        </div>

      </div>

    </div>
  </div>
</section>

<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}
  .form-horizontal .control-label{padding-top: 0;}
  .form-group{margin-bottom: 0;}
  /*h4{font-weight: bold;}*/
  .heading{font-weight: bold;}
  .red{color: red;}
  .green{color: green;}

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.tools').addClass("active");  
$('.accounts').addClass("active");  



// $(function () {
//   $('#orders-table').DataTable({
//     'paging'      : true,
//     'lengthChange': true,
//     'searching'   : false,
//     'ordering'    : true,
//     'info'        : true,
//     'autoWidth'   : false
//   })
// });

</script>

@endsection