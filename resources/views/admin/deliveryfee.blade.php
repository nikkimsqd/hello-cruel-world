@extends('layouts.boutique')
@extends('admin.sections')

@section('content')

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <!-- <h3 class="box-title"><b>DELIVERY FEE</b></h3> -->
        </div>


        <!-- <form action="{{url('admin-savedeliveryfee')}}" method="post" class="form-horizontal"> -->
        <form action="{{url('admin-updatedeliveryfee')}}" method="post" class="form-horizontal">
          {{csrf_field()}}
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">

                <div class="form-group">
                  <label for="baseFee" class="col-sm-4 control-label">Base fee</label>

                  <div class="col-sm-6">
                    <input type="text" name="baseFee" class="form-control" id="baseFee" value="{{$deliveryfee['baseFee']}}" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="additionalFee" class="col-sm-4 control-label">Additional fee per kilometer</label>

                  <div class="col-sm-6">
                    <input type="text" name="additionalFee" class="form-control" id="additionalFee" value="{{$deliveryfee['additionalFee']}}" required>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="box-footer center" >
            <!-- <input type="submit" name="btn_submit" value="Submit" class="btn btn-primary"> -->
            <input type="submit" name="btn_submit" value="Update" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>

</section>

<style type="text/css">
  .dropdown-menu{left: 237px;}
  .center{text-align: center;}
  .heading{font-weight: bold;}
</style>


@endsection



@section('scripts')
<script type="text/javascript">

$('.complaints').addClass("active");


</script>
@endsection