@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Sub-Categories</h3>
        </div>

        <div class="box-body">

          <div class="col-md-12">
            <div class="col-md-6"> 
              <label>Women</label>
              @foreach($womens as $women)
                <li>{{$women['categoryName']}}</li>
              @endforeach
            </div>

            <div class="col-md-6">
              <label>Men</label>
              @foreach($mens as $men)
                <li>{{$men['categoryName']}}</li>
              @endforeach
            </div>

          </div>

        </div>
      </div>
      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title">Add Categories</h3>
        </div>

        <div class="box-body">
          <!-- <div class="col-md-6">
            <div class="col-md-6"> 
            
              <label>Women</label>
              @foreach($womens as $women)
                <li>{{$women['categoryName']}}</li>
              @endforeach

            </div>

            <div class="col-md-6">
                <label>Men</label>
                @foreach($mens as $men)
                    <li>{{$men['categoryName']}}</li>
                @endforeach
            </div>
          </div> -->

          <div class="col-md-12">
            <form action="{{ url('/saveCategory') }}" method="post">
              {{ csrf_field() }}
                
                Gender:
                  <select class="form-control select2" name="gender" autofocus>
                    <option selected="selected"> </option>
                    <option value="Womens">Women</option>
                    <option value="Mens">Men</option>
                  </select>
                  <br>
                  
                Category Name:
                <input type="text" name="categoryName" class="input form-control"><br>

          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
         <input type="submit" name="btn_submit" value="Add Category" class="btn btn-primary">
        </form>
        </div>
        <!-- </form> -->
      </div>


      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title">Add Sub-Categories</h3>
        </div>

        <form action="{{ url('/saveSubCategory') }}" method="post">
          <div class="box-body">

            <div class="col-md-12">
                {{ csrf_field() }}
                  
                  Gender:
                    <select class="form-control select2" name="gender" id="gender-select" autofocus>
                      <option selected="selected"> </option>
                      <option value="Womens">Women</option>
                      <option value="Mens">Men</option>
                    </select>
                    <br>
                    
                  Category Name:
                    <select class="form-control select2" name="category" id="category-select">
                      <option selected="selected"> </option>
                    </select>
                    <br>
                    
                  Sub-category Name:
                  <input type="text" name="subcatName" class="input form-control"><br>

            </div>

          </div>
          <div class="box-footer" style="text-align: right;">
           <input type="submit" name="btn_submit" value="Add Sub-Category" class="btn btn-primary">
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
$('.categories').addClass("active");  



  $('#gender-select').on('change', function(){
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