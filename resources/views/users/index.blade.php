
@extends('layouts.dashboard')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>{{__('users')}}</strong>
                 <a class="btn btn-success float-right" href="{{ route('users.create') }}" id="createNewUser">{{__('create_user')}}</a>
                </h4>
            </div>
         </div>
         <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ $message }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <table id="users" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center">{{__('name')}}</th>
                            <th class="text-center">{{__('surname')}}</th>
                            <th class="text-center">{{__('phone')}}</th>
                            <th class="text-center">{{__('email')}}</th>
                            <th class="text-center">{{__('roles')}}</th>
                            <th width="10%" class="text-center">{{__('actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles }}</td>
                            <td class="text-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__('actions')}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item btn btn-default" href="{{ route('users.edit',$user->id) }}" title="{{__('edit')}}">
                                                        {{__('edit')}}
                                                    </a>
                                                    <a data-toggle="modal" class="dropdown-item btn btn-default" id="deleteButton" data-target="#deleteModal" data-action="users/delete/{{ $user->id }}" title="{{__('remove')}}">
                                                        {{__('remove')}}
                                                    </a>
                                                </div>
                                            </div>
                                    </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>

        <!-- small modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('delete_record')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="deleteBody">
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('javascript_page')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    // display a modal (small modal)
    $(document).ready(function() {
        $("#users").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/" + $('html').attr('language')+ ".json"
            },
            pageLength:5,
        });

        $(document).on('click', '#deleteButton', function(event) {
            event.preventDefault();
            let url = $(this).attr('data-action');
            $.ajax({
                url: url
                , beforeSend: function() {
                    $("#deleteModal").show();
                    $("#deleteBody").html('<div class="row"><div class="col-12 text-center"><img src="{{ asset('img/loader.gif') }}" width="50px" height="50px"/></div></div>');
                },
                // return the result
                success: function(result) {
                    $("#deleteBody").html("");
                    $('#deleteBody').html(result);
                }
            })
        });

    });

    
</script>
@endsection
