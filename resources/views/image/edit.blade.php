@extends('layouts.app')

@section('content')
{{-- <h3>Configuración de usuario</h3> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar imagen</div>

                <div class="card-body">

                    <div class="col-md-5 text-center mx-auto">
                        <img src="{{route('image.get',['filename' => $image->image_path])}}" alt="" class="col-md-12">
                    </div>
                    <br>    

                <form method="POST" action="{{action('ImageController@update')}}" enctype="multipart/form-data">
                    @csrf

                <input name="id_imagen" id="id_imagen" type="hidden" value="{{$image->id_image}}">

                        <div class="form-group row">
                            
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            
                            <div class="col-md-7">
                                <input id="image_path" name="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror">
                                
                                {{-- @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>

                                @enderror --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            
                            <div class="col-md-7">
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{$image->description}}</textarea>
                                 @error('description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>

                                @enderror 
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar cambios!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection