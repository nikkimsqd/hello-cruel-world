@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
      </div>

      <form action="{{url('/saveCategory')}}" method="post">
      <div class="box-body">
        <div class="row">
        <div class="col-md-6">
          {{csrf_field()}}

          <label>Category Gender</label>
          <h4>{{ $notification->data['gender'] }}</h4>
          <input type="text" name="gender" value="{{ $notification->data['gender'] }}" hidden>

          <label>Category Name</label>
          <h4>{{ $notification->data['categoryName'] }}</h4>
          <input type="text" name="categoryName" value="{{ $notification->data['categoryName'] }}" hidden>

          <label>Boutique Name</label>
          <h4>{{ $boutique['boutiqueName']}}</h4>

         
          </div>
        </div>

      </div>
      <div class="box-footer" style="text-align: right;">
       <a class="btn btn-warning" href="{{url('admin-notifications')}}">Go to notifications</a>
       <a class="btn btn-danger" href="{{url('')}}">Decline request</a>
       <input type="submit" name="btn_submit" value="Approve request" class="btn btn-primary">
     </form>
      </div>
    </div>
  </div>
</div>




@endsection