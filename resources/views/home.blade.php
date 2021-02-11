
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p>{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
        @endif
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                       
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user())
                        <p>{{ __('welcome',['Name' => auth()->user()->name . " " . auth()->user()->surname] )}}</p>
                        <div>{{__('roles')}} : {{ $roles }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


