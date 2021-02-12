
@extends('layouts.dashboard')

@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>{{__('edit_subscription')}}</strong>  
                  <a class="btn btn-success ml-5 float-right" href="{{ route('subscriptions.index') }}">{{__('return')}}</a>
                </h4>
            </div>
         </div>
         <div class="card-body">
           @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{__('error')}}!</strong> {{__('error_ocurred')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
               
            <form action="{{ route('subscriptions.update',$subscription->id) }}" method="POST">
            @method('PATCH')
                @csrf
              
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="name">{{__('name')}}: </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $subscription->name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 offset-3">
                        <div class="form-group">
                            <label for="min_labels">{{__('min_labels')}}: </label>
                            <input type="number" class="form-control" id="min_labels" name="min_labels" value="{{ $subscription->min_labels }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="max_labels">{{__('max_labels')}}: </label>
                            <input type="number" class="form-control" id="max_labels" name="max_labels" value="{{ $subscription->max_labels }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3 text-center">
                        <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
                    </div>
                </div>
            </form>
        </div>
@endsection

