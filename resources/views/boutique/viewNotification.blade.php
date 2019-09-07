@extends('layouts.boutique')
@extends('boutique.sections')

@section('titletext')
  Hinimo | {{$boutique['boutiqueName']}} - Notification
@endsection

@section('content')

<section class="content">

  <div class="row">
    <div class="col-md-8">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title"><b>{{$page_title}}</b></h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <h4>{{$data}}</h4>
              
            </div>
          </div>
        </div>

        <div class="box-footer" style="text-align: right;">
            <input type="submit" name="btn_add" value="View" class="btn btn-primary">
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