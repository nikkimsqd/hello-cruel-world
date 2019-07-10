@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title">You are required to submit the following</h3>
        </div>

        <div class="box-body">
          <div class="col-md-12">
            <form action="{{url('reqToVerify')}}" method="post">
              {{csrf_field()}}

            <div class="form-group row">
                <label for="closingHours" class="col-md-4 col-form-label text-md-right">Boutique Store Days</label>

                <div class="col-md-6">
                    <input id="closingHours" type="checkbox" class="custom-control-input" name="closingHours">
                    <label class="custom-control-label" for="closingHours">Monday</label><br>

                    <input id="closingHours" type="checkbox" class="custom-control-input" name="closingHours">
                    <label class="custom-control-label" for="closingHours">Tuesday</label><br>

                    <input id="closingHours" type="checkbox" class="custom-control-input" name="closingHours">
                    <label class="custom-control-label" for="closingHours">Wednesday</label><br>

                    <input id="closingHours" type="checkbox" class="custom-control-input" name="closingHours">
                    <label class="custom-control-label" for="closingHours">Thursday</label><br>

                    <input id="closingHours" type="checkbox" class="custom-control-input" name="closingHours">
                    <label class="custom-control-label" for="closingHours">Friday</label><br>

                    <input id="closingHours" type="checkbox" class="custom-control-input" name="closingHours">
                    <label class="custom-control-label" for="closingHours">Saturday</label><br>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="openingHours" class="col-md-4 col-form-label text-md-right">Store Opening Hours</label>

                <div class="col-md-6">
                    <input id="openingHours" type="time" class="form-control" name="openingHours" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="closingHours" class="col-md-4 col-form-label text-md-right">Boutique Closing Hours</label>

                <div class="col-md-6">
                    <input id="closingHours" type="time" class="form-control" name="closingHours" required autofocus>
                </div>
            </div>
            
            <!-- <div class="form-group row">
                <label for="boutiqueAddress" class="col-md-4 col-form-label text-md-right">{{ __('Boutiques Location') }}</label>

                <div class="col-md-6">
                    <input id="boutiqueAddress" type="file" class="form-control" name="boutiqueAddress" required autofocus>
                </div>
            </div> -->

          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
         <!-- <a class="btn btn-primary" href="/hinimo/public/addCategories/"> Submit</a> -->
         <input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden>
         <input type="submit" name="btn_submit" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection