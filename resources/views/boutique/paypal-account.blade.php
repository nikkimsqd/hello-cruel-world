@extends('layouts.boutique')
@extends('boutique.sections')

@section('titletext')
  Hinimo | {{$boutique['boutiqueName']}} - Profile
@endsection

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
              
              @if($paypalAccount != null)
              <form class="form-horizontal">
                <div class="form-group row">
                    <label class="col-sm-2 control-label">PayPal Email:</label>

                  <div class="col-sm-5">
                      <label class="control-label">{{$paypalAccount['paypalEmail']}}</label>

                    <input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden="hidden">

                  </div>
                </div>
              </form><hr>
              @endif

              @if($paypalAccount != null)
              <form action="{{url('updatePaypalAccount')}}" method="post" class="form-horizontal">
              @else
              <form action="{{url('addPaypalAccount')}}" method="post" class="form-horizontal">
                @endif
                {{csrf_field()}}
                
                <div class="form-group row">
                  @if($paypalAccount != null)
                    <label for="closingHours" class="col-sm-2 control-label">Update PayPal Email</label>
                  @else
                    <label for="closingHours" class="col-sm-2 control-label">Add PayPal Email</label>
                  @endif

                  <div class="col-sm-5">
                    @if($paypalAccount != null)
                      <input type="email" class="form-control" name="paypalEmail" required>
                    @else
                      <input type="email" class="form-control" name="paypalEmail" required autofocus>
                    @endif

                    <input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden="hidden">

                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="box-footer" style="text-align: right;">
          @if($paypalAccount != null)
            <input type="submit" name="btn_add" value="Update Account" class="btn btn-primary">
          @else
            <input type="submit" name="btn_add" value="Add Account" class="btn btn-primary">
          @endif
          </form>
        </div>
      </div>
    </div>
  </div>

</section>

<style type="text/css">
  .dropdown-menu{left: 237px;}
</style>


@endsection



@section('scripts')
<script type="text/javascript">

$('.paypal-account').addClass("active");


</script>
@endsection