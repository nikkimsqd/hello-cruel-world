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
              @if($boutique['id'] == $selectedBoutique['id'])
              <li class="active">
                <a href="{{url('chat-w-boutique/'.$boutique['id'])}}/">
                  <i class="fa fa-inbox"></i> {{$boutique['boutiqueName']}}
                  <!-- <span class="label label-primary pull-right">{{$unreadCount}}</span> -->
                </a>
              </li>
              @else
              <li>
                <a href="{{url('chat-w-boutique/'.$boutique['id'])}}/">
                  <i class="fa fa-inbox"></i> {{$boutique['boutiqueName']}}
                  <!-- <span class="label label-primary pull-right">{{$unreadCount}}</span> -->
                </a>
              </li>
              @endif 
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      
      <div class="box box-success direct-chat direct-chat-success" id="chat">
        <div class="box-header with-border">
          <h3 class="box-title">Chat with {{$selectedBoutique['boutiqueName']}}</h3>
          <div class="box-tools pull-right">
            <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span> -->
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>

        <div class="box-body">

          <div class="direct-chat-messages">
              @foreach($chats as $chat)
                @if($chat['senderID'] != $id)
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-left">{{$chat->sender['fname'].' '.$chat->sender['lname']}}</span>
                      <span class="direct-chat-timestamp pull-left sender-time">{{ date('d M h:i a',strtotime($chat['created_at'])) }}</span>
                    </div>

                    <div class="direct-chat-text">
                      {{$chat['message']}}
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                @else
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <!-- <span class="direct-chat-name pull-right">{{$chat->sender->boutique['boutiqueName']}}</span> -->
                        <span class="direct-chat-timestamp pull-right">{{ date('d M h:i a',strtotime($chat['created_at'])) }}</span>
                      </div>

                      <div class="direct-chat-text">
                        {{$chat['message']}}
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                @endif
              @endforeach

          </div>

        </div> <!-- /.box-body -->

        <div class="box-footer">
          <form action="{{url('chatBoutique')}}" method="post">
            {{ csrf_field() }}
            <div class="input-group">
              <input type="text" name="message" placeholder="Type Message ..." class="form-control" autofocus>
              <input type="text" name="boutiqueID" value="{{$selectedBoutique['id']}}" hidden>
                  <span class="input-group-btn">
                    <input type="submit" name="btn_submit" class="btn btn-primary" value="Send">
                  </span>
            </div>
          </form>
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