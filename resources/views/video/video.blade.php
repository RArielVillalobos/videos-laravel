@extends('layouts.app')
@section('content')
<div class="col-md-10 col-md-offset-2">
    <h2>{{$video->title}}</h2>

    <hr>
    <div class="col-md-8">
        {{-- video--}}
        <video controls id="video-pĺayer" src="{{url('videofile',['filename'=>$video->video_path])}}" controls>

        </video>
        {{-- descripcion--}}
        <div class="panel panel-default video-data">
            <div class="panel-heading">
                <div class="panel-title">
                    Subido Por <strong>{{$video->user->name}}</strong>  {{\FormatTime::LongTimeFilter($video->created_at)}}

                </div>
            </div>
            <div class="panel-body">
                {{$video->description}}
            </div>


        </div>

        @include('video.comments')


    </div>

</div>


@endsection