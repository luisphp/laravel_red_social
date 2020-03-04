@extends('layouts.app')

@section('content')
{{-- <h3>Configuración de usuario</h3> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h1>Perfil de usuario</h1>
                <br>
                <div class="data-user">
                    <div class="card sombraprofile" style="padding:20px; border:none; -webkit-box-shadow: 4px 3px 16px -4px #000000; box-shadow: 4px 3px 9px -4px #000000;">
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
                        </div>
                    </div>
                </div>
                <br>
                <br>


                @foreach ($user->images as $image)

                    @include('includes.image',['images'=> $image])
    
                @endforeach

                <br>
                <br>
                {{-- {{ $images->links() }} --}}

            </div>
        </div>
    </div>        

</div>


@endsection