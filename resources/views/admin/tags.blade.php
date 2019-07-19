@extends('layouts.boutique')
@extends('admin.sections')


@section('content')

<section class="content">
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
            <br><br>
            <span><i>Click on a tag to delete.</i></span>
          </div>

          <div class="col-md-5">
            <form action="addTag" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label>Enter a tag name:</label>
              <input type="text" name="tag" class="input form-control" autofocus>
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
</section>

@endsection


@section('scripts')

<script type="text/javascript">

$('.products').addClass("active");
$('.tags').addClass("active"); 

    $('.tags').on('click', function(){
      var tagID = $(this).attr('data-tag-id');
      // alert(tagID);


      $.ajax({
          url: "/hinimo/public/deleteTag/"+tagID,
          success:function(data){
            location.reload();
          }
      });

    });

</script>

@endsection



