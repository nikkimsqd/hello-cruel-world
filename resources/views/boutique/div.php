@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
      </div>

      <div class="box-body">
        <div class="col-md-5"> 
        </div>

        <div class="col-md-5">
        </div>

      </div>
      <div class="box-footer" style="text-align: right;">
       <a class="btn btn-warning" href="/hinimo/public/dashboard/"><i class="fa fa-arrow-left"> Back to dasboard</i></a>
       <a class="btn btn-primary" href="/hinimo/public/addCategories/"><i class="fa fa-plus"> Add a Category</i></a>
      </div>
    </div>
  </div>
</div>


<!-- collapsible box -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Title</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    Start creating your amazing application!
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    Footer
  </div>
  <!-- /.box-footer-->
</div>



<!-- MODAL -->
<a href="" class="btn essence-btn" data-toggle="modal" data-target="#madeToOrderModal">[name here]</a>

<div class="modal fade" id="requestToRentModal{{$product['productID']}}" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title"><b>Rent Details</b></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">

          </div>

          <div class="modal-footer">
            <input type="submit" class="btn essence-btn" value="Place Request">
            <!-- <input type="" class="btn btn-danger" data-dismiss="modal" value="Cancel"> -->
          </div>
      </div> 
    </div>
</div>
@endsection