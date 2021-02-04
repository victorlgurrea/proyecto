
@extends('layouts.dashboard')

@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>Editar Rol</strong>  
                  <a class="btn btn-success ml-5 float-right" href="{{ route('roles.index') }}">Volver</a>
                </h4>
            </div>
         </div>
         <div class="card-body">
           @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> Se ha producido un error.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
               
            <form action="{{ route('roles.update',$rol->id) }}" method="POST">
            @method('PATCH')
                @csrf
              
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="name">Nombre: </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $rol->name }}">
                        </div>
                    </div>
            
                    <div class="col-6 offset-3 text-center">
                        <input type="text" id="id" name="id" value="{{$rol->id}}" class="invisible">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </form>
        </div>
@endsection

