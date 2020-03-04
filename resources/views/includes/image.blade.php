<div class="card">
    <div class="card-header">
        <div class="col-md-12">
            <div class="row">
                @if($image->user->image)
                <div class="col-md-2">
                <img src="{{route('user.image',['filename' => $image->user->image ])}}" alt="" class="col-md-12 mx-auto rounded-circle" style="max-width:60px;">
                </div>
                @endif
                <div class="col-md-10">
                <a href="{{action('UserController@profile',['id' => $image->fk_id_user])}}"> {{$image->user->name.' '.$image->user->surname}} </a>
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
                        <div class="col-md-10"><span style="color:#A0ADC2;">{{'@'.$image->user->nick}}</span><br></div>
                        <div class="col-md-2 float-right">
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