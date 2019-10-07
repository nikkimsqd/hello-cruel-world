@extends('layouts.boutique')
@extends('admin.sections')

@section('content')

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h4 class="box-title">Complain ID: <b>{{$complain['id']}}</b></h4>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <h4>Order ID: <b>{{$complain->order['id']}}</b></h4>
              <h4>Complainant Name: <b>{{$complain->order->customer['fname'].' '.$complain->order->customer['lname']}}</b></h4>
              <h4>Complain: <b>{{$complain['complain']}}</b></h4>
              <h4>Attachments:</h4>

              <div class="row"> 
                @foreach($complain->complainFiles as $complainFile)
                <div class="col-md-2 image-container">
                  <img src="{{ asset('/uploads').$complainFile['filename'] }}" style="width: calc(100% + 40px); height: 250px; object-fit: cover; ">
                </div>
                @endforeach
              </div>

            </div>
          </div>
          <br>
        </div>

        <div class="box-footer" style="text-align: right;">
          <a href="{{url('complaints')}}" class="btn btn-default">Back to complaints</a>
          <!-- <input type="submit" class="btn btn-primary" id="contactSeller" value="Contact Seller here"> -->
          <!-- <a href="{{url('complaints')}}" class="btn btn-success">Solved</a> -->
        </div>

        <input id="complainID" value="{{$complain['id']}}" hidden>
        <input id="boutiqueID" value="{{$complain->order->boutique['id']}}" hidden>

      </div>
    </div>
  </div>


  <div class="row" id="compose" hidden>
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Compose New Message</h3>
        </div>

        <form action="{{url('sendCompose')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <input class="form-control" placeholder="To:" name="recipient" id="recipient">
              <input name="recipientID" id="recipientID" hidden>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Subject:" name="subject">
            </div>
            <div class="form-group">
              <textarea id="compose-textarea" class="form-control" style="height: 300px" name="message"> </textarea>
            </div>
            <input type="text" name="complaintID" value="{{$complain['id']}}">
          </div>

          <div class="box-footer">
            <div class="pull-right">
              <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
            </div>
            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>

<style type="text/css">
  .dropdown-menu{left: 237px;}
  .center{text-align: center;}
  .image-container{overflow: hidden;}
  .right{text-align: right;}
</style>


@endsection



@section('scripts')
<script type="text/javascript">

  $('.complaints').addClass("active");

  $('#contactSeller').on('click', function(){
    var complainID = $('#complainID').val();

    $('#compose').attr('hidden', !this.click);

    $.ajax({
      url: "{{url('getComplaint')}}"+'/'+complainID,
      success:function(data){
        window.location.href = "{{url('viewComplaint')}}"+'/'+complainID+'#compose';
        // console.log(data.boutique.owner['email']);
        $('#recipient').val(data.boutique.owner['email']);
        $('#recipientID').val(data.boutique.owner['id']);

      }
    });


  });



</script>
@endsection