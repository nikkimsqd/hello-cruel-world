@extends('layouts.boutique')
@extends('boutique.sections')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title"><b>Made-to-Orders</b></h3>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>Rent ID</th>
            <th>Customer Name</th>
            <th>Request Placed at:</th>
            <th>Status</th>
            <th></th>
          </tr>
         
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->
<br><br>





@endsection

