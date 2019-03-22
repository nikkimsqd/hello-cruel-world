@extends('layouts.boutique')
@extends('admin.sections')


@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Tags</h3>
      </div>

      <div class="box-body">
        <div class="col-md-5">
          @foreach($tags as $tag)
          <h2 data-tag-id="{{$tag['id']}}" class="tags label label-default">{{$tag['name']}}</h2>
          @endforeach
        </div>

        <div class="col-md-5">
          <form action="addTag" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <label>Enter a tag name:</label>
            <input type="text" name="tag" class="input form-control">
          </div>

        </div>

      </div>
      <div class="box-footer" style="text-align: right;">
       <input type="submit" name="btn_submit" value="Add Tag" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">

  $(document).ready(function(){
    $('.tags').on('click', function(){
      alert($(this).attr('data-tag-id'));
    });
  });

</script>

@endsection



