@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Add Fabrics</h3>
        </div>

        <div class="box-body">
          <div class="row">
            <form action="{{url('addFabric')}}" method="post">
              {{csrf_field()}}
            <div class="col-md-6">
              Fabric Name:
                <input type="text" name="fabricName" class="input form-control" required autofocus><br>
            </div>

            <div class="col-md-6">
              Fabric Color:
                <input type="text" name="fabricColor" class="input form-control" required><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              
            </div>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
          <input type="submit" name="btn_submit" value="Add Fabric" class="btn btn-primary">
        </form>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Your available fabrics</h3>
        </div>

        <div class="box-body">
          <table id="fabrics-table" class="table table-hover">
            <col width="440"><col width="440"><col width="103">
            <thead>
            <tr>
              <th>Fabric Name</th>
              <th>Fabric Color</th>
              <th class="noname"></th>
            </tr>
            </thead>
            @foreach($fabrics as $fabric)
            <tr>
              <td>{{$fabric['name']}}</td>
              <td>{{$fabric['color']}}</td>
              <td><a href="{{url('deleteFabric/'.$fabric['id'])}}"><i class="fa fa-remove"></i></a></td>
            </tr>
            @endforeach
          </table>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">

$('.etc').addClass('active');
$('.fabrics').addClass('active');
$('.noname').removeClass('sorting');

$(function () {
  $('#fabrics-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

</script>


@endsection
