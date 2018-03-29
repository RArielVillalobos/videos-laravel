<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request){
        $this->validate($request,[
            'comentario'=>'required',
        ]);

        $comentario=new Comment();
        $user=\Auth::user();

        $comentario->user_id=$user->id;
        $comentario->video_id=$request->input('video_id');

        $comentario->body=$request->input('comentario');

        $comentario->save();

        return redirect()->route('video.details',['video_id'=>$comentario->video_id])->with(['message'=>'Comentario insertado']);






    }

    public function delete($id){
        //guardamos el user identificado
        $user=\Auth::user();
        $comment=Comment::findOrFail($id);


        //si el id del usuario identificado es igual al usuario del que comento|o si el dueño del videoe sta intentando borrar el comentario
        if($user && ($comment->user_id==$user->id || $comment->video->user_id && $user->id )){
            $comment->delete();
        }
        return redirect()->route('video.details',['video_id'=>$comment->video_id])->with(['message'=>'comentario borrado']);

    }
}
