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
                <h3>{{$eventName}}</h3>
                <div class="form-group tags">
                  @foreach($events as $event)
                   <input type="checkbox" name="tags[]" id="{{$event->tag['name']}}" value="{{$event->tag['id']}}" checked>
                   <label for="{{$event->tag['name']}}">{{$event->tag['name']}}</label>
                  @endforeach
                </div><br>

            </div>
          </div>
          <div class="box-footer">
            <a href="{{url('admin-events')}}" class="btn btn-default">Back</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}
  h3{font-weight: bold;}

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