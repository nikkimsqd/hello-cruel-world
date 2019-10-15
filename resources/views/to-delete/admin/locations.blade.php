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
                    </select>
            </div>
          </div> <!-- row -->

          <!-- <div class="row">
            <div class="col-md-12">
              <label id="barangay-id" hidden>Select Barangays:</label>
              <div name="barangays" id="brgy-select" style="column-count: 3">
              </div>

              <label id="city-id" hidden>Select Cities:</label>
              <div name="cities-div" id="city-select" style="column-count: 3">

              </div><br>
            </div>
          </div>
 -->
        </div>
        <div class="box-footer" style="text-align: right;">
         <input type="submit" name="btn_submit" value="Add Location" class="btn btn-primary">
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
            <col width="350">
            <col width="250">
            <col width="300">
            <col width="70">
            <thead>
            <tr>
              <th>Region</th>
              <th>Province</th>
              <th>City</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cities as $city)
            <tr>

                  @foreach($provinces as $province)
                  @if($city->provCode == $province->provCode)

                    @foreach($regions as $region)
                    @if($province->regCode == $region->regCode)
                      
                        <td>{{$region->regDesc}}</td>
                        <td>{{$province->provDesc}}</td>
                        <td>{{$city->citymunDesc}}</td>
                    @endif
                    @endforeach
                  @endif
                  @endforeach
                <td><a href="{{url('deleteLocation/'.$city['id'])}}" class="btn btn-danger">Delete</a></td>
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

$('.tools').addClass("active");
$('.locations').addClass("active");  

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
      console.log(data);
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



// $('#province-select').on('change', function(){
//   $('#city-select').empty();
//   // $('#brgy-select').empty();
//   var provCode = $(this).val();
  
//   // $('#city-select').prop('disabled',false);;

//   $.ajax({
//     url: "/hinimo/public/admin-getCity/"+provCode,
//     success:function(data){

//       $('#city-id').prop('hidden',false);

//         data.cities.forEach(function(city){
//         console.log(city);
//          $('#city-select').append(
//         '<input type="checkbox" name="cities[]" value="'+city.citymunCode+'" id="'+city.citymunDesc+'"> '+city.citymunDesc+'<br>'
//         );
//       });
//     }
//   }); //ajaxclosing
// });


// $('#city-select').on('change', function(){
//   console.log("adadad");

//   $('#brgy-select').empty();

//   var citymunCode = $(this).val();

//   $.ajax({
//        url: "/hinimo/public/admin-getBrgy/"+citymunCode,
//       success:function(data){

//           $('#barangay-id').prop('hidden',false);

//           data.brgys.forEach(function(brgy){

//               $('#brgy-select').append(
//               '<input type="checkbox" name="barangays[]" value="'+brgy.brgyCode+'" id="'+brgy.brgyDesc+'"> '+brgy.brgyDesc+'<br>'
//               );
//           });
//       }
//   });
// });


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


