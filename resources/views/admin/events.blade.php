@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form action="{{url('admin-saveEvent')}}" method="post">
        <div class="box">
          <div class="box-body">
            <div class="col-md-12">
                {{csrf_field()}}
                <h4>Add Event Name</h4>
                <input type="text" name="event" class="form-control" autofocus><br>
                
                <h4>Add Tags</h4>
                <div class="form-group tags">
                   @foreach($tags as $tag)
                   <input type="checkbox" name="tags[]" id="{{$tag['name']}}" value="{{$tag['id']}}">
                   <label for="{{$tag['name']}}">{{$tag['name']}}</label>
                   @endforeach
                </div><br>

            </div>
          </div>
          <div class="box-footer">
            <input type="submit" name="btn_submit" value="Submit" class="btn btn-success">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">

          <table id="locations-table" class="table table-hover">
            <col width="800">
            <col width="170">
            <thead>
              <tr>
                <th>Events</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($eventNames as $eventName => $value)
              <tr>
                <td>{{$eventName}}</td>
                <td class="align-center">
                  <a href="{{url('admin-viewEvent/'.$eventName)}}">View</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}
  h4{font-weight: bold;}

  .tags label {
    display: inline-block;
    width: auto;
    padding: 10px;
    border: solid 1px #ccc;
    transition: all 0.3s;
    background-color: #e3e2e2;
    border-radius: 5px;
  }

  .tags input[type="checkbox"] {
    display: none;
  }

  .tags input[type="checkbox"]:checked + label {
    border: solid 1px #e7e7e7;
    background-color: #ef1717;
    color: #fff;
  }

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");  
$('.events').addClass("active");  



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