@extends('layouts.boutique')
@extends('admin.sections')

@section('content')

<section class="content">

  <div class="row">
    <div class="col-md-3">
      <!-- <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a> -->

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Messages</h3>

          <div class="box-tools">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> --> <!-- para ma collpase -->
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            @foreach($boutiques as $boutique)
              <li>
                <a href="{{url('chat-w-boutique/'.$boutique['id'])}}/">
                  <i class="fa fa-inbox"></i> {{$boutique['boutiqueName']}}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

</section>

<style type="text/css">
  .right .direct-chat-text{margin-left: 500px; margin-right: 2px}
  .sender-time{margin-left: 300px;}
  .direct-chat-text{margin: 5px 500px 0 2px;}
  .direct-chat-messages{height: 350px !important;}
</style>


@endsection



@section('scripts')
<script type="text/javascript">

$('.chat-w-boutique').addClass("active");


</script>
@endsection