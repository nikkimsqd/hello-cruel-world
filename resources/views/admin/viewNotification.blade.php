@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Categories 
            @if($notif['status'] == "Approved")
              <label class="label label-info">Request Approved</label>
            @elseif($notif['status'] == "Declined")
              <label class="label label-danger">Request Declined</label>
            @endif
          </h3>
        </div>

        <form action="{{url('/saveCategory')}}" method="post">
        <div class="box-body">
          <div class="row">
          <div class="col-md-6">
            {{csrf_field()}}

            <label>Category Gender</label>
            <h4>{{ $notif['gender'] }}</h4>
            <input type="text" name="gender" value="{{ $notif['gender'] }}" hidden>

            <label>Category Name</label>
            <h4>{{ $notif['categoryName'] }}</h4>
            <input type="text" name="categoryName" value="{{ $notif['categoryName'] }}" hidden>

            <label>Boutique Name</label>
            <h4>{{ $boutique['boutiqueName']}}</h4>

            <input type="text" name="categoryRequest" value="{{ $notif['id'] }}" hidden>
            <input type="text" name="notificationID" value="{{ $notification['id'] }}" hidden>
           
            </div>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
         <!-- <a class="btn btn-warning" href="{{url('admin-notifications')}}">Go to notifications</a> -->
         @if($notif['status'] == "Pending")
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal">Decline request</button>
          <input type="submit" name="btn_submit" value="Approve request" class="btn btn-primary">
         @elseif($notif['status'] == "Approved")
          <input type="submit" name="btn_submit" value="Request Approved" class="btn btn-primary" disabled>
         @elseif($notif['status'] == "Declined")
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal" disabled>Request Declined</button>
         @endif
       </form>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="modal modal-danger fade" id="declineModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Provide a reason</h4>
      </div>
      <div class="modal-body">
        <form action="{{url('declineCategory')}}" method="post">
          {{csrf_field()}}
          <textarea name="reason" class="modal-body" rows="3" cols="65" placeholder="Provide a reason here..." required></textarea>
          <input type="text" name="catreqID" value="{{ $notif['id'] }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-outline" value="Save changes">
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



@endsection