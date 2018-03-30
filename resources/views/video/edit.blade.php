@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Video {{$video->title}}</h3>
            <hr>

            <form action="{{url('update')}}" method="post" enctype="multipart/form-data" class="col lg-7">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="video_id" value="{{$video->id}}">
                <div class="form-group">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif


                    <label>Titulo</label>
                    <input type="text" name="titulo" class="form-control" id="titulo" value="{{$video->title}}">


                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion">{{$video->description}}</textarea>


                </div>
                <div class="form-group">
                    <label>Miniatura</label>
                    <input type="file" class="form-control" name="imagen" id="imagen">

                </div>

                <div class="form-group">
                    <label>Video</label>
                    <input type="file" class="form-control" name="video" id="video">

                </div>

                <button type="submit" class="btn btn-success" >Modificar Video</button>
            </form>

        </div>

    </div>

@endsection
