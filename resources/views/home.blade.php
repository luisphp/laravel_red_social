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

            @foreach ($images as $image)
                @include('includes.image')
            @endforeach

            <br>
            <br>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection
