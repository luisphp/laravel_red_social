@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @foreach ($images as $image)
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
                    <div class="main_image">
                        <div class="card-body">
                            <a href="{{action('ImageController@show',['id' => $image->id_image])}}"><img src="{{route('image.get',['filename' => $image->image_path])}}" alt="" class="col-md-12"></a>
                            <br>
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-11"><span style="color:#A0ADC2;">{{'@'.$image->user->nick}}</span><br></div>
                                    <div class="col-md-1 float-right">
                                        <a href="#"><img src="{{asset('images/unlike.png')}}" alt="" style="max-width: 20px"></a>
                                    </div>
                                </div>
                            
                                <p>{{$image->description}}</p>
                                <div class="col-md-12">
                                <p style="color:#949393; font-size: 14px;" class="float-right">{{$image->created_at}}</p>
                                </div>
                                <br><br>
                                <div class="col-md-12">
                                    <a href="#" class="btn btn-primary col-md-3 float-center">Comentarios ({{count($image->comments)}})</a>
                                </div>
                                <br>
                            </div>
                            
                            
                        </div>
                    </div>

                    
                    {{-- <img src="{{url('user.image',['filename' => Auth::user()->image])}}" alt="" class="col-md-12" > --}}
                        
                </div>
                <br>
            @endforeach

            <br>
            <br>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection
