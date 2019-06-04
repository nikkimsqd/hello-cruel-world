@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">

        <div class="box-header with-border">
          <h3 class="box-title">Add locations</h3>
        </div>

        <div class="box-body">
          <!-- <div class="col-md-6">
            @foreach($regions as $region)
              <label>{{$region->regDesc}}</label> <br>
              @foreach($provinces as $province)
                @if($region->regCode == $province->regCode)
                  <ul>
                    <li>{{$province->provDesc}}</li>

                    @foreach($cities as $city)
                      @if($province->provCode == $city->provCode)
                        <ul>
                          <li>{{$city->citymunDesc}}

                          @foreach($barangays as $barangay)
                            @if($city->citymunCode == $barangay->citymunCode)
                            <ul>
                              <li>{{$barangay->brgyDesc}}
                            </ul>
                            @endif
                          @endforeach
                          </ul>
                      @endif
                    @endforeach
                  </ul>
                @endif
              @endforeach
            @endforeach
          </div> -->
          <div class="row">
            <div class="col-md-5">
              <form action="{{ url('/addLocation') }}" method="post">
                {{ csrf_field() }}
                  
                  <label>Select Region:</label>
                    <select name="region" class="form-control" id="region-select" autofocus>
                      <option selected="selected"> </option>
                      @foreach($refregions as $refregion)
                      <option value="{{$refregion['regCode']}}">{{$refregion['regDesc']}}</option>
                      @endforeach
                    </select>
                    <br>
            </div>
            <div class="col-md-3">
                  <label>Select Province:</label>
                    <select name="province" class="form-control" id="province-select" disabled>
                      <option selected="selected"> </option>
                    </select>
                    <br>
            </div>
            <div class="col-md-4">
                  <label>Select City:</label>
                    <select name="city" class="form-control" id="city-select" disabled>
                      <option selected="selected"></option>
                    </select><br>
            </div>
          </div> <!-- row -->

          <div class="row">
            <div class="col-md-12">
              <label id="barangay-id" hidden>Select Barangays:</label>
              <div name="barangays" id="brgy-select" style="column-count: 3">
                <!-- append js code here -->
                <!-- <label class="custom-control-label" for="id">name</label> -->
              </div>
            </div>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
         <input type="submit" name="btn_submit" value="Add Category" class="btn btn-primary">
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">

        <div class="box-header with-border">
          <h3 class="box-title">Locations supported by Hinimo</h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="box-body">


          <table id="locations-table" class="table table-hover table-bordered">
            <col width="250">
            <col width="150">
            <col width="200">
            <col width="300">
            <col width="70">
            <thead>
            <tr>
              <th>Region</th>
              <th>Province</th>
              <th>City</th>
              <th>Barangay</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($barangays as $barangay)
            <tr>
                @foreach($cities as $city)
                @if($barangay->citymunCode == $city->citymunCode)

                  @foreach($provinces as $province)
                  @if($city->provCode == $province->provCode)

                    @foreach($regions as $region)
                    @if($province->regCode == $region->regCode)
                      
                        <td>{{$region->regDesc}}</td>
                        <td>{{$province->provDesc}}</td>
                        <td>{{$city->citymunDesc}}</td>
                        <td>{{$barangay->brgyDesc}}</td>
                    @endif
                    @endforeach
                  @endif
                  @endforeach
                @endif
                @endforeach
                <td><a href="" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
          </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection



@section('scripts')
<script type="text/javascript">
  var session = 0;


$("#region-select").on('change', function(){
  $('#province-select').empty();
  $('#province-select').val("Select");
  $('#city-select').empty();
  $('#brgy-select').empty();
  var regCode = $(this).val();

  $('#city-select').prop('disabled',true);
  $('#province-select').prop('disabled',false);

  $.ajax({
      url: "/hinimo/public/admin-getProvince/"+regCode,
      success:function(data){
        $('#province-select').append('<option value=""></option>');

          data.provinces.forEach(function(province){
              $('#province-select').append(
                  '<option value="'+province.provCode+'">'+province.provDesc+'</option>'
                  );
          });
      }
  });
});


$('#province-select').on('change', function(){
  $('#city-select').empty();
  $('#brgy-select').empty();
  var provCode = $(this).val();
  
  // $('#city-select').prop('disabled',false);

  $.ajax({
      url: "/hinimo/public/admin-getCity/"+provCode,
      success:function(data){
        $('#city-select').append('<option value=""></option>');
          data.cities.forEach(function(city){

            if(city === null){
            console.log(provCode);
              // $('#city-select').prop('disabled',true);
              // console.log('naka sud');
              // $('.city-label').append(
              // '<p>Location not supported</p>'
              // );
            }else{
            console.log(provCode);
              $('#city-select').prop('disabled',false);
              $('#city-select').append(
              '<option value="'+city.citymunCode+'">'+city.citymunDesc+'</option>'
              );
            }
          });
      }
  }); //ajaxclosing
});


$('#city-select').on('change', function(){
  console.log("adadad");

  $('#brgy-select').empty();

  var citymunCode = $(this).val();

  $.ajax({
       url: "/hinimo/public/admin-getBrgy/"+citymunCode,
      success:function(data){

          $('#barangay-id').prop('hidden',false);

          data.brgys.forEach(function(brgy){

              $('#brgy-select').append(
              '<input type="checkbox" name="barangays[]" value="'+brgy.brgyCode+'" id="'+brgy.brgyDesc+'"> '+brgy.brgyDesc+'<br>'
              );
          });
      }
  });
});


$(function () {
    $('#locations-table').DataTable({
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


