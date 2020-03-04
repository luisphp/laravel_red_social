<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Validation\Rule;
use App\Rules\nickRepetido;
use App\Rules\emailRepetido;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Component\VarDumper\VarDumper;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null){

        if($search != null){
            $all_users = User::where('nick', 'like', '%'.$search.'%')
                            ->orWhere('name', 'like', '%'.$search.'%')
                            ->orWhere('surname', 'like', '%'.$search.'%')
                            ->orderBy('id_user', 'desc')
                            ->paginate(5);
        }else{

            $all_users = User::orderBy('id_user', 'desc')
                            ->paginate(5);
        }
        

        return view('user.all_users')->with('users', $all_users);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    {   
        //Proteger Vista
            //Entra en acción el middlware que esta arriba

        return view('user.config');
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

    //Actualizar usuario
    public function update(Request $request)
    {   
        //Conseguir el usuario identificado en este caso lo traemos del formulario
        $id_user = $request->input('id_user');

        $user = \Auth::user();

        //Validamos cada campo del formulario, en vista de que estoy usando campos ID customizados pues tambien estoy usando reglas de validacion customizadas como es el caso de nickRepetido e emailRepetido
        $validate = $this->validate($request, [
            
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required','string','max:200', new nickRepetido],
            'email' => ['required', 'string', 'email', 'max:255', new emailRepetido]
        ]);
            
        //Seteamos en variables los datos del formulario    
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //$user = auth()->user();
        
        //Update a la base de datos
         /*DB::table('users')
              ->where('id_user', $id_user)
              ->update(['name' => $name,'surname' => $surname,'nick' => $nick,'email' => $email] );
            */
            $user->name = $name;
            $user->surname = $surname;    
            $user->nick = $nick;
            $user->email = $email;

            //Subir imagen de avatar de usuario
            $image_path = $request->file('image_path');
            if($image_path){
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('users')->put($image_path_name,File::get($image_path));
                $user->image = $image_path_name;
            }

            $user->update();

        //var_dump($user);
        //die();

        return redirect()->route('config')->with('message', 'Usuario actualizado correctamente');        
    }

    public function getImage($fileName){

        $file  = Storage::disk('users')->get($fileName);

        return response($file, 200);
    }

    //Perfil del usuario
    public function profile($id)
    {
        $user = User::find($id);

        return view('user.my_profile')->with('user', $user);
    }

}
