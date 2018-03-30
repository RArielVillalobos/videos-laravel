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
     public function delete($id){
        //obtener usuario identidicado
         $user=Auth::user();

        $video=Video::findOrFail($id);

        //buscar los comentarios que tiene el video
        $comments=Comment::where('video_id',$id)->get();


        if($user && $video->user_id==$user->id){
            //eliminar comentarios
            if($comments && count($comments)>=1){
                foreach($comments as $comment){

                    $comment->delete();
                }
            }
            //eliminar ficheros

           // Storage::disk('images')->delete($video->image);
            //Storage::disk('video')->delete($video->video_path);

            //eliminar registro(video)
            $video->delete();
            $message=['message'=>'se elimino correctamente el video'];

        }else{
            $message=['message'=>'no se pudo eliminar el video'];
        }



        return redirect()->route('home')->with([$message]);


     }

     public function edit($id){
        $video=Video::findOrFail($id);


        return view('video.edit',['video'=>$video]);

     }

     public function update($id,Request $request){
        $data=$request->all();
         $video=Video::findOrFail($id);
         dd($video->id);
         $this->validate($request,[
            'titulo'=>'required',
             'descripcion'=>'required',
         ]);



        // $video
     }






}

