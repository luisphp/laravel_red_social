<div class="col-md-12">
    @if(Auth::user()->image)
        <img src="{{route('user.image',['filename' => Auth::user()->image])}}" alt="" class="col-md-12 rounded-circle" >
    @else
        @php
            echo "+"
        @endphp
    @endif
</div>