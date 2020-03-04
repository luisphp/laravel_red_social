<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($id_image){

        $user = \Auth::user();
        //Condicion para ver si ya existe el like y no duplicarlo

        $isset_like = Like::where('fk_id_user', "=" ,$user->id_user)->where('fK_id_image', "=" ,$id_image)->count();

        if($isset_like == 0){
        
            $like = new Like();
            $like->fk_id_user = $user->id_user;
            $like->fk_id_image = (int)$id_image;
            $like->save(); 

            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => 'El like ya existe',
            ]);
        }
        

       
        
    }

    public function dislike($id_image){

        $user = \Auth::user();
        //Condicion para ver si ya existe el like y no duplicarlo

        $like = Like::where('fk_id_user', "=" ,$user->id_user)->where('fK_id_image', "=" ,$id_image)->first();

        if($like){
        
            $like->delete(); 

            return response()->json([
                'like' => $like,
                'message' => 'No te gusta esta publicación',
            ]);
        }else{
            return response()->json([
                'message' => '',
            ]);
        }

    }

    public function mis_likes(){

        $id_user = \Auth::user()->id_user;

        $likes = Like::where('fk_id_user', '=', $id_user)
        ->orderBy('id_like', 'desc')
        ->paginate(5);

        //var_dump($likes );
        //die();

        return view ('like.mislikes',[
            'likes' =>$likes,
        ]);

    }
}
