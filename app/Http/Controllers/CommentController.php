<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Comment;
use \Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request){
            $content = $request->input('description');
            $id_image = $request->input('id_image');
            $id_user = $request->input('id_user');

            $validatedData = $request->validate([
                'description' => ['required', 'string','max:255'],
            ]);

            $comment = new Comment();
            $comment->fk_id_user = $id_user;
            $comment->fk_id_image = $id_image;
            $comment->content = $content;
            $comment->save();

            return back()->with('message', 'Comentario guardado correctamente');

        }else{
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Conseguir usuario
        $user = \Auth::user();

        //Conseguir comentario a Eliminar
        $comment = Comment::find($id);

        if($user  && ($comment->fk_id_user == $user->id_user ||  $comment->image->fk_id_user == $user->id_user)){

            $comment->delete();

            return back()->with('message', 'Comentario eliminado correctamente');
        }else{
            return redirect('home');
        }




    }
}
