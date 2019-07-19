@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box">

        <div class="box-body">

          <div class="col-md-5">
            <form action="{{url('admin-saveAccount')}}" method="post">
              {{csrf_field()}}
              <label>Email</label>
              <input type="text" name="email" class="form-control"><br>
              
              <label>Username</label>
              <input type="text" name="username" class="form-control"><br>

              <label>Set Password</label>
              <input type="password" name="password" class="form-control"><br>
              
              <label>Set Role</label>
              <input type="text" name="role" class="form-control"><br>

              <input type="submit" name="btn_submit" value="Submit" class="btn btn-primary">
            </form>
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