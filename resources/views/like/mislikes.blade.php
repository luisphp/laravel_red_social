@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Mis Likes</h1>

            @foreach ($likes as $like)

                @include('includes.image',['image' => $like->image])
                
            @endforeach
            <br>
            <br>
            {{ $likes->links() }}
        </div>    
    </div>    
</div>
@endsection