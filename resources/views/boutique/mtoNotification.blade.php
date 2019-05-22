@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">View MTO Notification</h3>
      </div>

      @if($mto != null)
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <label>Customer Name</label>
            <h4>{{$mto->customer['fname'].' '.$mto->customer['lname']}}</h4><br>
          </div>
          <div class="col-md-3">
            <label>Item's date of use</label>
            <h4>{{$mto['dateOfUse']}}</h4><br>
          </div>
          <div class="col-md-5">
            <label>Notes</label>
            <h4>{{$mto['notes']}}</h4><br>

          </div>
        </div>
      </div> <!-- BODY CLOSING -->
      <div class="box-footer" style="text-align: right;">
        <a class="btn btn-warning" href="{{url('boutique-notifications')}}"><i class="fa fa-arrow-left"> Go to notifications</i></a>
        <a class="btn btn-primary" href="{{url('made-to-order/'.$mto['id'])}}"><i class="fa fa-plus"> View MTO info</i></a>
      </div>

      @else
      <div class="box-body">
        Sorry, MTO request doesn't exist anymore.
      </div>
      <div class="box-footer" style="text-align: right;">
        <a class="btn btn-warning" href="{{url('boutique-notifications')}}"><i class="fa fa-arrow-left"> Go to notifications</i></a>
      </div>
      @endif
    </div>
  </div>
</div>




@endsection

