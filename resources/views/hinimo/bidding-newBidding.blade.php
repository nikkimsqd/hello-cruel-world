@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('titletext')
	Hinimo | {{ $page_title }}
@endsection


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{ $page_title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->
<!-- ##### Blog Wrapper Area Start ##### -->
<div class="blog-wrapper" style="padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="regular-page-content-wrapper">
                    <div class="regular-page-text">
                        <form method="post" action="{{url('/savebidding')}}">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="productType" class="col-md-4 col-form-label text-md-right">Product Category</label>

                                <div class="col-md-6">
                                    <select id="productType" class="{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="productType" required autofocus>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['categoryName'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('productType'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('productType') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="startingprice" class="col-md-4 col-form-label text-md-right">Starting Bidding Price</label>

                                <div class="col-md-6">
                                    <input id="startingprice" type="number" min="1" class="form-control{{ $errors->has('startingprice') ? ' is-invalid' : '' }}" name="startingprice" value="{{ old('startingprice') }}" required autofocus>

                                    @if ($errors->has('startingprice'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('startingprice') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="notes" class="col-md-4 col-form-label text-md-right">Notes </label>

                                <div class="col-md-6">
                                    <!-- <input id="notes" type="text" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes" value="{{ old('notes') }}" required autofocus> -->
                                    <textarea class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes"></textarea>

                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bidImg" class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <input id="bidImg" type="file" class="form-control{{ $errors->has('bidImg') ? ' is-invalid' : '' }}" name="bidImg" value="{{ old('bidImg') }}" required autofocus>

                                    @if ($errors->has('bidImg'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bidImg') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="endDate" class="col-md-4 col-form-label text-md-right">Bidding End Date</label>

                                <div class="col-md-6">
                                    <input id="endDate" type="date" class="form-control{{ $errors->has('endDate') ? ' is-invalid' : '' }}" name="endDate" value="{{ old('endDate') }}" required autofocus>

                                    @if ($errors->has('endDate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('endDate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Deadline for the product</label>

                                <div class="col-md-6">
                                    <input id="dateOfUse" type="date" class="form-control{{ $errors->has('dateOfUse') ? ' is-invalid' : '' }}" name="dateOfUse" value="{{ old('dateOfUse') }}" required>



                                        <span class="invalid-feedback" role="alert">
                                            <strong>errrrrrrrrrr</strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">Tags</label>

                                <div class="col-md-6 tags">
                                    @foreach($tags as $tag)
                                    <input type="checkbox" name="tags[]" id="{{$tag['name']}}" value="{{$tag['id']}}">
                                    <label for="{{$tag['name']}}">{{$tag['name']}}</label>
                                    @endforeach

                                    <!-- <input id="tags" data-role="tagsinput" type="text" class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" name="tags" required> -->

                                    @if ($errors->has('tags'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tags') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Start Bidding
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
.tags label {
  display: inline-block;
  width: auto;
  padding: 10px;
  border: solid 1px #ccc;
  transition: all 0.3s;
  background-color: #e3e2e2;
  border-radius: 5px;
}

.tags input[type="checkbox"] {
  display: none;
}

.tags input[type="checkbox"]:checked + label {
  border: solid 1px #e7e7e7;
  background-color: #ef1717;
  color: #fff;
}
</style>

@endsection

@section('scripts')

@endsection