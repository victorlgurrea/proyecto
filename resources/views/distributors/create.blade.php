
@extends('layouts.dashboard')

@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>{{ __('new_type_partner')}}</strong>  
                  <a class="btn btn-success ml-5 float-right" href="{{ route('distributors.index') }}">{{__('return')}}</a>
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
               
            <form action="{{ route('distributors.store') }}" method="POST">
                @csrf
              
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="name">{{__('name')}}: </label>
                            <input type="text" class="form-control" id="name" name="name" value="">
                        </div>
                    </div>
            
                    <div class="col-6 offset-3 text-center">
                        <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                    </div>
                </div>
            </form>
        </div>
@endsection

