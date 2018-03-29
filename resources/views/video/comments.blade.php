<h4>Comentarios</h4>
@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>

@endif
<hr>


@if(isset($video->comments))
    <div class="comments-list">

        @foreach($video->comments as $comment)
            <div class="comment-item col-md-12 pull-left">
                <div class="panel panel-default comment-data">
                    <div class="panel-heading">
                        <div class="panel-title">
                            {{-- como la tabla esta relacionada y en el modelo tenemos el metodo user podemos acceder a el y obtener el nombre de usuario--}}
                            {{$comment->user->name}}
                        </div>
                    </div>
                    <div class="panel-body">
                        {{$comment->body}}
                        @if(Auth::check() && (Auth::user()->id==$comment->user_id || Auth::user()->id==$video->user_id))
                            <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                <div class="pull-right">
                                    <a href="#victorModal{{$comment->id}}" role="button" class="btn btn-sm btn-primary" data-toggle="modal">Eliminar</a>

                                    <!-- Modal / Ventana / Overlay en HTML -->
                                    <div id="victorModal{{$comment->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Seguro que quieres borrar este comentario?</p>
                                                    <p class="text-warning"><small>{{$comment->body}}.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <a href="{{url('/delete',$comment->id)}}" class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>


                </div>

            </div>

        @endforeach

    </div>
@endif
@if(Auth::check())
    <form class="col-md-4" method="post" action="{{url('/comment')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="video_id" value="{{$video->id}}" required>
        <p>
            <textarea class="form-control" name="comentario" required></textarea>
        </p>
        <input type="submit" value="comentar" class="btn btn-success">

    </form>
@endif