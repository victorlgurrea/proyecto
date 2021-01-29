
@extends('layouts.dashboard')

@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>Sector</strong>
                  <a class="btn btn-success float-right" href="{{ route('sectors.index') }}">volver</a>
                </h4>
            </div>
         </div>
         <div class="card-body">
           <div class="row">
                <div class="col-6 offset-3">
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" class="form-control" id="name" value="{{ $sector->name}}" disabled>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

