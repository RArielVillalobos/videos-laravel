<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//permite subir archivos y guardarlo en una carpeta
use Illuminate\Support\Facades\Storage;

//respuesta
use Symfony\Component\HttpFoundation\Response;

//usando modelos
use App\Video;
use App\Comment;




class VideoController extends Controller
{
    //

    public function createVideo(){
        return view('video.form-createVideo');
    }

    public function saveVideo(Request $request){
        //validate formulario
        $this->validate($request,[
           'titulo'=>'required|min:8',
            'descripcion'=>'required',

        ]);

        $video=new Video();
        //usuario autenticado
        $user=Auth::user()->id;

        $video->user_id=$user;
        $video->title=$request->input('titulo');
        $video->description=$request->input('descripcion');
        //subida miniatura
        $image=$request->file('imagen');
        if($image){
            //capturamos el path de la imagen
            $image_path=$image->getClientOriginalName();

            //storage , para almacenar el fichero en el storage
            \Storage::disk('images')->put($image_path,\File::get($image));
            $video->image=$image_path;


        }

        //subida video
        $video_file=$request->file('video');

        if($video_file){
            $video_path=$video_file->getClientOriginalName();



            //storage para almacenar el video
            \Storage::disk('videos')->put($video_path,\File::get($video_file));
            $video->video_path=$video_path;
        }


        $video->save();

        return redirect()->action('HomeController@index')->with(['mensaje'=>'Video Subido correctamente']);

    }
    //busco la imagen en el disco
    public function getImagen($filename){
        //busco la imagen en el storage
        $file=Storage::disk('images')->get($filename);
        return  response($file,200);

    }

    public function getVideoPage($id){
        $video=Video::findOrFail($id);

        return view('video.video',['video'=>$video]);

    }

    public function getVideo($filename){
        $file=Storage::disk('videos')->get($filename);

        return responde($file,200);
    }






}

