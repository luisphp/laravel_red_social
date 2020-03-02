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
                                
                                <div class="col-md-1 float-right">
                                    <a href="#"><img src="{{asset('images/unlike.png')}}" alt="" style="max-width: 20px"></a>
                                </div>
                                </div>
                                
                                <p>{{$image->description}}</p>
                                <div class="col-md-12">
                                    <p style="color:#949393; font-size: 14px;" class="float-right"></p>
                                </div>
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
                                                        Guardar cambios
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
