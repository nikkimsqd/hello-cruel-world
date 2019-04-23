@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Locations supported by Hinimo</h3>
      </div>

      <div class="box-body">
        <div class="col-md-6">
         

        </div>

        <div class="col-md-5">
          <form action="{{ url('/saveCategory') }}" method="post">
            {{ csrf_field() }}
              
              Gender:
                <select class="form-control select2" name="gender" id="gender-select">
                  <option selected="selected"> </option>
                  <option value="Womens">Womens</option>
                  <option value="Mens">Mens</option>
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
  </div>
</div>
@endsection



