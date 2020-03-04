@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
             @endif            

            
                <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <div class="row">
                            @if($image->user->image)
                            <div class="col-md-2">
                                <img src="{{route('user.image',['filename' => $image->user->image ])}}" alt="" class="col-md-12 mx-auto" style="max-width:60px;">
                            </div>
                            @endif
                            <div class="col-md-10">
                                {{$image->user->name.' '.$image->user->surname}}
                                <span style="color: #cca;">
                                    {{'@'.$image->user->nick}}
                                </span>
                            </div>
                        </div>
                        </div>    
                    </div>
                    {{-- Detalles de la imagen --}}
                    <div class="main_image">
                        <div class="card-body">
                            <img src="{{route('image.get',['filename' => $image->image_path])}}" alt="" class="col-md-12">
                            <br>
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-11"><span style="color:#A0ADC2;">{{'@'.$image->user->nick}} | {{$image->created_at}}</span>
                                    <br>
                                </div>
                                {{-- Lógica de Likes --}}
                                <div class="col-md-1 float-right">
                                    @php
                                    $is_liked = false;
                                    @endphp
                                    @foreach ($image->likes as $like)
                                        @if($like->fk_id_user == Auth::user()->id_user)
                                            @php
                                                $is_liked = true
                                            @endphp
                                        @else
                                            @php
                                                $is_liked = false; 
                                            @endphp
                                        @endif
                                    @endforeach
                                    
                                    @if($is_liked == true)
                                        <img   class="like" src="{{asset('images/like.png')}}" data-id="{{$image->id_image}}" alt="" style="max-width: 20px">
                                    @else
                                        <img class="dislike" src="{{asset('images/unlike.png')}}" data-id="{{$image->id_image}}" alt="" style="max-width: 20px">
                                    @endif
                                        <span  id="contador" data-value="({{count($image->likes)}})" style="color:#A0ADC2;" > ({{count($image->likes)}}) </span>
                                </div>
                                {{-- Fin lógica de likes --}}
                                </div>
                                
                                <p>{{$image->description}}</p>
                                <div class="col-md-12">
                                    <p style="color:#949393; font-size: 14px;" class="float-right"></p>
                                </div>
                                {{-- Botones para editar o borrar la imagen depende de si el usuario es el dueño de la imagen --}}
                                    @if(Auth::user() && Auth::user()->id_user == $image->user->id_user)
                                    <div class="col-md-12">
                                        <div class="row"> 
                                            {{-- Boton par editar la imagen --}}
                                        <a href="{{action('ImageController@edit',['id' => $image->id_image])}}" class="btn btn-sm btn-primary float-right">Editar</a>
                                        {{-- <a href="{{action('ImageController@destroy',['id'=>$image->id_image])}}" class="btn btn-sm btn-secondary float-right">Borrar</a> --}}
                                        
                                    {{-- Modal para preguntar si realmente queremos borrar la imagen --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                        Borrar
                                    </button>

                                        </div>
                                    </div>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- Título del modal --}}
                                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas borrarla?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            {{-- Cuerpo del modal --}}
                                            <div class="modal-body">
                                                {{-- Mensaje del modal --}}
                                                Si eliminas esta imagen nunca podras recuperarla
                                            </div>
                                            <div class="modal-footer">
                                                {{-- Boton de cancelar la eliminación --}}
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                            {{-- Boton para borrar definitivamente la imagen --}}
                                            <a href="{{action('ImageController@destroy',['id'=>$image->id_image])}}" class="btn btn-danger float-right">Borrar definitivamente</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    {{-- Fina del modal --}}
                                    @endif
                                    <br>
                                    <br>
                                {{-- Enviar nuevo comentario --}}
                                <div class="send_comment col-md-12">
                                    <form method="POST" action="{{action('CommentController@store')}}" enctype="multipart/form-data" >
                                        @csrf
                                            
                                        <input name="id_user" id="id_user" type="hidden" value="{{Auth::user()->id_user}}">
                                        <input name="id_image" id="id_image" type="hidden" value="{{$image->id_image}}">                                              
                                            <div class="form-group row ">
                                                <div class="col-md-12 align-content-center">
                                                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Escribe tu comentario..." ></textarea>
                                                     @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                    
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" class="btn btn-success">
                                                        Comentar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                        <br>
                                {{-- Fin del formulario para enviar un nuevo comentario --}}
                                {{-- Listar todos los comentarios --}}
                                <div class="col-md-12">
                                    @foreach ($image->comments as $comment)

                                    <div class="cold-md-12 card" style="padding: 20px;">
                                        <p>By: {{$comment->user->name.'  '}}<span style="color:#A0ADC2;" class="float-right">{{  '@'.$comment->user->nick}}</span></p>
                                        
                                        <div class="col-md-12">
                                            <p> {{$comment->content}}</p><span class="float-right" style="font-size=14px; color:#A0ADC2; ">{{  $comment->created_at}}</span></p>
                                        </div>
                                        {{-- Mostramos el boton de borrar comentario en caso de que el usuario sea dueño del post o sino es dueño del post que sea dueño del comentario --}}
                                        
                                        @if($comment->fk_id_user == Auth::user()->id_user || $image->fk_id_user == Auth::user()->id_user)                                           
                                            <div class="col-md-2">
                                                <a class="btn btn-sm btn-danger" href="{{action('CommentController@destroy', ['id'=> $comment->id_comment])}}">Borrar</a>
                                            </div>
                                        @endif
                                            {{-- Final de la condicion   --}}
                                    </div>
                                    <br>
                                    @endforeach
                                </div>
                                {{-- Listar todos los comentarios --}}
                                <br>
                                <br>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
