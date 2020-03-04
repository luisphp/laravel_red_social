<?php

namespace App\Http\Controllers;

use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


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

        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'image_path' => ['required','image' ,'mimes:jpg,jpeg,png,gif'],
            'description' => ['required', 'string','max:255'],
        ]);

            $image_path = $request->image_path;
            $description = $request->description;
            $id_user = $request->id_user;

            $image = new Image();
            $image->image_path = null;
            $image->description = $description;

            $image->fk_id_user = $id_user;

            //Subir imagen
            if($image_path){
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name,File::get($image_path));
                $image->image_path = $image_path_name;
            }

            $image->save();

            return redirect()->route('home')->with('message', 'La foto ha sido subida correctamente');

        

        //return back()->with('success', 'La imagen ha sido guardada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $image = Image::find($id);

        return view('image.detail')->with('image', $image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->fk_id_user == $user->id_user){

            return view ('image.edit')->with('image', $image);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'image_path' => ['image' ,'mimes:jpg,jpeg,png,gif'],
            'description' => ['required', 'string','max:255'],
        ]);

        $id_imagen = $request->input('id_imagen');
        $description = $request->input('description');
        $image_path = null;
        
        //Verificar si ha llegado una imagen
        if($request->image_path != null){

            $image_path = $request->image_path;
        }

        //Conseguir el objeto image de la DB y setear la nueva info
        $image = Image::find($id_imagen);
        $image->description = $description; 

         //Subir imagen
         if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('home')->with('message', 'Imagen actualizada con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user = \Auth::user();
       $image = Image::find($id);
       $comments = Comment::where('fk_id_image', '=', $id)->get();
       $likes = Like::where('fk_id_image', '=', $id)->get();

        if($user && $image &&$image->user->id_user == $user->id_user ){

            //Eliminar comentarios
                if($comments && count($comments) > 0){
                    foreach($comments as $comment){
                        $comment->delete();
                    }
                }
            //Eliminar likes

            if($likes && count($likes) > 0){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar ficher de imagen

            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro de imagen

            $image->delete();

            $message = array('message' => 'La imagen se ha borrado correctamente');

        }else{
            $message = array('message' => 'La imagen NO se ha borrado correctamente');
        }

        return redirect()->route('home')->with($message);

    }

    public function getImage($fileName){
        $file  = Storage::disk('images')->get($fileName);

        return response($file, 200);
    }
}
