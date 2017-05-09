<div class="row">
    @include('partials.alert-notification')
    <div class="col-sm-12">
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i> Conversación con <strong>{{ $recipient->name }} {{ $recipient->first_surname }}</strong>
            </div>
            <div class="panel-body" id="window-chat">
                <ul class="chat">
                    @forelse($messages as $message)
                        @if($message->sender_id === currentAuth()->id)
                            <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img style="width: 50px" src="{{ asset(getPP(currentAuth())) }}" alt="User Avatar" class="img-circle" />
                                    </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->diffForHumans() }}
                                        </small>
                                        <strong class="pull-right primary-font">Tú</strong>
                                    </div>
                                    <p>
                                        {{ $message->content }}
                                    </p>
                                </div>
                            </li>
                        @else
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img style="width: 50px" src="{{ asset(getPP($recipient)) }}" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{ $recipient->name }}</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p>
                                        {{ $message->content }}
                                    </p>
                                </div>
                            </li>
                        @endif

                    @empty
                        <li><h2>No hay mensajes en la conversación</h2></li>
                    @endforelse
                </ul>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <form action="{{ $route }}" method="post">
                    <div class="input-group">
                        {{ csrf_field() }}
                        <input name="content" id="btn-input" type="text" class="form-control input-sm" placeholder="Escribe tú mensaje aquí." />
                        <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Enviar
                                </button>
                            </span>
                    </div>
                </form>
            </div>
            <!-- /.panel-footer -->
        </div>
    </div>
</div>