@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                <br>
            @endif
                <h1>Gente</h1>
                <br>
            <form action="{{action('UserController@index')}}" method="GET" id="buscador">
                <div class="col-md-12">
                    <div class="row">
                        <input type="text" id="search" placeholder="¿A quién buscas?" class="form-control col-md-8 float-left" style="margin-right: 15px;">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-success col-md-2 float-right">
                    </div>
                </div>
                
            </form>
                <br>
            @foreach ($users as $user)
            <div class="data-user">
                <div class="col-md-12" >
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{route('user.image',['filename' => $user->image ])}}" alt="" class="col-md-6 float-center rounded-circle">
                        </div>
                        <div class="col-md-8">
                            <h3> {{$user->name}}
                            {{$user->surname}}</h3>
                            <h4 style="color:#A0ADC2;">{{'@'.$user->nick}}</h4>

                            <h6 style="color:#ccc;" class="float-right">Se unió el: {{$user->created_at}}</h6>
                        </div>
                        <a class="mx-auto btn btn-sm btn-success" href="{{action('UserController@profile',['id' => $user->id_user])}}">Ver perfil</a>
                    </div>
                </div>
                <hr>
                <br>
            </div>
            <br>
            
            @endforeach
            
            <br>
            <br>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
