
@extends('layouts.dashboard')

@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>{{ __('edit_role')}}</strong>  
                  <a class="btn btn-success ml-5 float-right" href="{{ route('roles.index') }}">{{__('return')}}</a>
                </h4>
            </div>
         </div>
         <div class="card-body">
           @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{__('error')}}!</strong>{{__('error_ocurred')}}<br><br>
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
                            <label for="name">{{__('name')}}: </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $rol->name }}">
                        </div>
                    </div>
            
                    <div class="col-6 offset-3 text-center">
                        <input type="text" id="id" name="id" value="{{$rol->id}}" class="invisible">
                        <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
                    </div>
                </div>
            </form>
        </div>
@endsection

