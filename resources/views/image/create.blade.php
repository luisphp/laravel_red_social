@extends('layouts.app')

@section('content')
{{-- <h3>Configuración de usuario</h3> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir nueva imagen</div>

                <div class="card-body">

                <form method="POST" action="{{action('ImageController@store')}}" enctype="multipart/form-data">
                    @csrf

                <input name="id_user" id="id_user" type="hidden" value="{{Auth::user()->id_user}}">

                        <div class="form-group row">
                            
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            
                            <div class="col-md-7">
                                <input id="image_path" name="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" required>
                                
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
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required></textarea>
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
                                    Guardar cambios
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
