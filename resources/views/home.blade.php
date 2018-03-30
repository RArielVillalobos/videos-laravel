@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="conteiner">
            @if(session('mensaje'))
                <div class="alert alert-success">
                    {{-- mostramos la seccion flash/ recordamos que si refre<camos ya no aparecera --}}
                    {{session('mensaje')}}

                </div>
            @endif
            <div id="video-list">
                @foreach($videos as $video)
                    <div class="video-item col-md-10 pull-left panel panel-default">
                        <div class="panel-body">

                            @if(Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb col-md-4 pull-left">
                                    <div class="col-md-6 col-md-offset-3 ">
                                        <div class="video-image-mask">
                                            <img class="video-image" src="{{url('/miniatura/'.$video->image)}}">
                                        </div>
                                    </div>

                                </div>

                             @endif
                            <div class="data">
                                <h4 class="video-title"><a href="">{{$video->title}}</a></h4>
                                <p>{{$video->user->name}}</p>
                            </div>


                        {{-- BOTONES DE ACCION --}}
                                {{-- si estamos autenticados y el video pertenece al usuario identificado  --}}
                                <a href="{{url("video/$video->id")}}" class="btn btn-success">Ver</a>
                            @if(Auth::check() && Auth::user()->id==$video->user->id )
                                <a href="{{url('edit',$video->id)}}" class="btn btn-warning">Editar video</a>
                                    <a href="{{url('/video/delete',$video->id)}}" class="btn btn-danger">Eliminar</a>
                             @endif
                        </div>
                    </div>
                 @endforeach

            </div>
        </div>

    </div>
    {{$videos->links()}}
</div>
@endsection
