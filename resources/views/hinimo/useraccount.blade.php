@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')

<div class="page">
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{$page_title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->


<!-- ##### Checkout Area Start ##### -->
<div class="checkout_area section-padding-70">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-11">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="row">
                        <div class="col-md-7 cart-page-heading mb-30">
                            <h3>Account Details</h3>
                        </div>

                        <div class="col-md-3">
                            <a href=""><u>Edit Details</u></a>
                        </div>
                    </div>
                    <br>

                    <form action="" method="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Name</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user['fname'].' '.$user['lname']}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Username</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user['username']}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Email</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user['email']}}" disabled>
                            </div>
                        </div>
                        <!-- <input type="submit" name="btn_submit" value=""> -->
                    </form>
                </div>
            </div>
        </div> <!-- first row -->

        <br><br>
        <div class="row" id="addresses">
            <div class="col-12 col-md-11">
                <div class="mt-50 clearfix">
                    <div class="row">
                        <div class="col-md-7 cart-page-heading mb-30">
                            <h3>Addresses</h3>
                        </div>
                        <div class="col-md-3 justify-content-right">
                            <a href="" data-toggle="modal" data-target="#addAddress"><u>+ New Address</u></a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            
                        @foreach($addresses as $address)
                        <hr>
                        <table class="">
                            <tr>
                                <td width="15%">Name</td>
                                <td width="70%"><b>{{$address['contactName']}}</b><br></td>
                                <td width="20%" rowspan="2" width="20%" align="right">
                                    <br>
                                    <a href="" data-toggle="modal" data-target="#editAddress" class="btn btn-app">
                                        <i class="fa fa-edit"> 
                                        </i>
                                    </a>
                                    <a href="" class="btn btn-app">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <br>
                                    @if($address['status'] == null)
                                    <a href="/hinimo/public/setAsDefault/{{$address['id']}}">Set as Default</a>
                                    @endif
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">Phone</td>
                                <td width="70%">{{$address['phoneNumber']}}<br></td>
                            </tr>
                            <tr>
                                <td width="15%">Address</td>
                                <td width="70%">
                                    {{$address['completeAddress']}}<br>
                                    {{$address->brgyName['brgyDesc'].', '.$address->cityName['citymunDesc'].', '.$address->provName['provDesc']}}
                                </td>
                            </tr>
                            
                        </table>
                        <br>
                        @endforeach
                        <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Checkout Area End ##### -->



<div class="modal fade" id="addAddress" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Add Address</b></h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <div class="modal-body">
            <form action="/hinimo/public/addAddress" method="post">
                {{csrf_field()}}
                <label>Name:</label>
                <input type="text" name="contactName" class="form-control"><br>

                <label>Phone Number:</label>
                <input type="text" name="phoneNumber" class="form-control"><br>

                <label>City</label><br>
                <select name="city" class="form-control" id="city-select">
                    <option value=""></option>
                    @foreach($cities as $city)
                    <option value="{{$city['citymunCode']}}">{{$city['citymunDesc']}}</option>
                    @endforeach
                </select><br><br><br>

                <label>Barangay</label><br>
                <select name="barangay" class="form-control" id="brgy-select">
                    <option value=""></option>
                 
                    <option value=""></option>
                 
                </select><br><br><br>
                <!-- </div> -->

                <label>Complete Address</label><br>
                <input type="text" name="completeAddress" class="form-control">       
        </div> <!-- modal-body -->

                <div class="modal-footer">
                  <input type="submit" name="btn_submit" value="Submit" class="btn btn-success">
                </div>
            </form>
    </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal-fade -->




<div class="modal fade" id="editAddress" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Edit Address</b></h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <div class="modal-body">
            <form action="/hinimo/public/addAddress" method="post">
                {{csrf_field()}}
                <label>Name:</label>
                <input type="text" name="contactName" class="form-control"><br>

                <label>Phone Number:</label>
                <input type="text" name="phoneNumber" class="form-control"><br>

                <label>City</label><br>
                <select name="city" class="form-control" id="city-select">
                    <option value=""></option>
                </select><br><br><br>

                <label>Barangay</label><br>
                <select name="barangay" class="form-control" id="brgy-select">
                    <option value=""><u>-----------------</u></option>
                 
                    <option value=""></option>
                 
                </select><br><br><br>
                <!-- </div> -->

                <label>Complete Address</label><br>
                <input type="text" name="completeAddress" class="form-control">       
        </div> <!-- modal-body -->

                <div class="modal-footer">
                  <input type="submit" name="btn_submit" value="Submit" class="btn btn-success">
                </div>
            </form>
    </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal-fade -->
</div> <!-- page -->

<style type="text/css">
    .nice-select .list{width: inherit; max-height: 250px; overflow-y: scroll;}
</style>

@endsection



@section('scripts')
<script type="text/javascript">
    var session = 0;

$('#city-select').on('change', function(){

    $('#brgy-select').empty();
    $('#brgy-select').next().find('.list').empty();
    $('#brgy-select').next().find('.current').val("-----------------");

    var citymunCode = $(this).val();

    $.ajax({
         url: "/hinimo/public/getBrgy/"+citymunCode,
        success:function(data){

            data.brgys.forEach(function(brgy){

                $('#brgy-select').append(
                '<option value="'+brgy.brgyCode+'">'+brgy.brgyDesc+'</option>'
                );

                $('#brgy-select').next().find('.list').append(
                    '<li data-value="'+brgy.brgyCode+'" class="option">'+brgy.brgyDesc+'</li>'
                );
            });
        }
    });

});



</script>

@endsection