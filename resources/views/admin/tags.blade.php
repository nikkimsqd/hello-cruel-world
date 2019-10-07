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

            @foreach($categoryGenders as $gender => $value)
              <h3>{{$gender}}</h3>
              <ul>


                @foreach($categories as $category)
                  @if($gender == $category['gender'])
                    <li><h4>{{$category['categoryName']}}</h4></li>

                      @foreach($categoryTags as $categoryTag)
                        @if($categoryTag['categoryID'] == $category['id'])
                        <!-- <li><h4>{{$categoryTagGender}}</h4></li> -->
                        

                            <h2 data-tag-id="{{$categoryTag['id']}}" class="tags label label-default">{{$categoryTag['tagName']}}</h2>
                        @endif
                      @endforeach

                  @endif
                @endforeach


            </ul>
            @endforeach


            <br><br>
            <span><i>Click on a tag to delete.</i></span>
          </div>

          <div class="col-md-5">
            <form action="addTag" method="post">
            {{csrf_field()}}

            <div class="form-group">
              <label>Select Gender:</label>
              <select class="input form-control" id="gender-select" required autofocus>
                <option disabled selected></option>
                @foreach($categoryGenders as $gender => $category)
                  <option value="{{$gender}}">{{$gender}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Select Category:</label>
              <select class="input form-control" id="category-select" name="category"  required disabled>
                <option disabled selected></option>
              </select>
            </div>

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
</section>

<style type="text/css">
  h4{font-weight: bold;}
</style>

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


$('#gender-select').on('change', function(){
  $('#measurement-input').empty();
  $('#category-select').empty();

  var gender = $(this).val();

  $('#category-select').prop('disabled',false);

  $.ajax({
    url: "/hinimo/public/getCategory/"+gender,
    success:function(data){ 

      $('#category-select').append('<option selected disabled value=""></option>');
      data.categories.forEach(function(category){
        $('#category-select').append('<option value="'+category.id+'">'+category.categoryName+'</option>');
      });
    }
  });
});

</script>

@endsection



