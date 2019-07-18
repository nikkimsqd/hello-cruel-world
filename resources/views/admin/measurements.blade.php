@extends('layouts.boutique')
@extends('admin.sections')


@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title">Measurements</h3>
        </div>

        <div class="box-body">
          <form action="admin-addMeasurement" method="post">
          {{csrf_field()}}
            <div class="col-md-4"> 
              <div class="form-group">
                <label>Category of item</label><br>
                  <select name="gender" id="gender-select" class="input form-control" autofocus>
                    <option value=""></option>
                    <!-- <option value="mens">Mens</option> -->
                    <option value="womens">Womens</option>
                  </select><br>                
              </div>
            </div>

            <div class="col-md-4"><br>
              <div class="form-group categories">
                <select name="category" id="category-select" disabled class="input form-control">
                  <option></option>
                  @foreach($categories as $category)
                  <option value="{{$category['id']}}">{{$category['categoryName']}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Enter a measurement name:</label>
                <input type="text" name="mName" class="input form-control">
              </div>
            </div>

        </div>
        <div class="box-footer" style="text-align: right;">
          <input type="submit" name="btn_submit" value="Add Measurement Name" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">

        

        <div class="box-body">
          <div class="col-md-6">
            <div class="box-header with-border">
              <h3 class="box-title">Womens</h3>
            </div>
            @foreach ($categoryArray as $categoriesName => $cats)
              @if ($categoriesName == "Womens")
                @foreach ($cats as $cat => $measures)
                    <label>{{$cat}}</label>
                    <ul>
                      @foreach($measures as $measure)
                      <li>{{$measure}}</li>
                      @endforeach
                    </ul>
                @endforeach
              @endif
            @endforeach
          </div>

          <div class="col-md-6">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Mens</h3>
            </div>
            @foreach ($categoryArray as $categoriesName => $cats)
              @if ($categoriesName == "Mens")
                @foreach ($cats as $cat => $measures)
                    <label>{{$cat}}</label>
                    <ul>
                      @foreach($measures as $measure)
                      <li>{{$measure}}</li>
                      @endforeach
                    </ul>
                @endforeach
              @endif
            @endforeach -->
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
           <!-- <input type="submit" name="btn_submit" value="Add Measurement Name" class="btn btn-primary"> -->
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">
  .categories{margin-top: 6px;}
</style>

@endsection


@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");
$('.measurements').addClass("active"); 


$('#gender-select').on('change', function(){

  $('#category-select').empty();
  $('#category-select').next().find('.list').empty();
  $('#category-select').next().find('.current').val("-----------------");

  var gender = $(this).val();

  $('#category-select').prop('disabled',false);
  $('.nice-select').removeClass('disabled');

  $.ajax({
    url: "/hinimo/public/getCategory/"+gender, //naa ni sa customer controller nga function
    success:function(data){ 
      data.categories.forEach(function(category){
        $('#category-select').append('<option value="'+category.id+'">'+category.categoryName+'</option>');
        $('#category-select').next().find('.list').append('<li data-value="'+category.id+'" class="option">'+category.categoryName+'</li>');
      });
    }
  });
}); 

</script>
@endsection



