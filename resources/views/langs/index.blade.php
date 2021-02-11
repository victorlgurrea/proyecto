
@extends('layouts.dashboard')

@section('stylesheets')

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('content')
<div class="card mt-5">
            <div class="card-header">
                <div class="col-md-12">
                    <h4 class="card-title"><strong>{{__('translates')}}</strong>
                    <a data-toggle="modal" class="btn btn-success float-right" id="createButton" data-target="#createTranslateModal">{{__('add_translation')}}</a>
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

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>{{ $message }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table id="table" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Key</th>
                            <th class="text-center">{{__('spanish')}}</th>
                            <th class="text-center">{{__('french')}}</th>
                            <th class="text-center">{{__('german')}}</th>
                            <th class="text-center">{{__('italian')}}</th>
                            <th class="text-center">{{__('english')}}</th>
                            <th class="text-center">{{__('russian')}}</th>
                            <th class="text-center">{{__('portuguese')}}</th>
                            <th class="text-center">{{__('valencian')}}</th>
                            <th width="10%" class="text-center">{{__('actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($translates as $translate)
                        <tr>
                            <td>{{ $translate->key }}</td>
                            <td>{{ $translate->es }}</td>
                            <td>{{ $translate->fr }}</td>
                            <td>{{ $translate->de }}</td>
                            <td>{{ $translate->it }}</td>
                            <td>{{ $translate->en }}</td>
                            <td>{{ $translate->ru }}</td>
                            <td>{{ $translate->pt }}</td>
                            <td>{{ $translate->ca }}</td>
                            <td class="text-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__('actions')}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a data-toggle="modal" class="dropdown-item btn btn-default" id="editButton" data-target="#updateTranslateModal" data-action="langs/edit" data-key="{{ $translate->key}}" title="{{__('edit')}}">
                                                        {{__('edit')}}
                                                    </a>
                                                    <a data-toggle="modal" class="dropdown-item btn btn-default" id="deleteButton" data-target="#deleteModal" data-action="langs/delete/{{ $translate->key }}" title="{{__('remove')}}">
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
</div>

        <div class="modal fade" id="createTranslateModal" tabindex="-1" role="dialog" aria-labelledby="createTranslateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('add_translation')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('saveTranslate') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="form-group">
                                        <label for="name">Key:</label>   <a href="" data-toggle="popover" class="float-right" title="{{__('key_information')}}" data-content="{{__('key_info_popover')}}"><i class="fas fa-question"></i></a>
                                        <input type="text" class="form-control" id="key" name="key" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach (Config::get('app.languages') as $lang => $language)
                                    <div class="col-6">
                                        <div class="form-group">
                                        @switch($language)
                                            @case('en')
                                            <label for="{{$language}}"> {{__('english')}}</label>
                                            @break
                                            @case('es')
                                            <label for="{{$language}}"> {{__('spanish')}}</label>
                                            @break
                                            @case('de')
                                            <label for="{{$language}}"> {{__('german')}}</label>
                                            @break
                                            @case('it')
                                            <label for="{{$language}}"> {{__('italian')}}</label>
                                            @break
                                            @case('fr')
                                            <label for="{{$language}}"> {{__('french')}}</label>
                                            @break
                                            @case('pt')
                                            <label for="{{$language}}"> {{__('portuguese')}}</label>
                                            @break
                                            @case('ru')
                                            <label for="{{$language}}"> {{__('russian')}}</label>
                                            @break
                                            @case('ca')
                                            <label for="{{$language}}"> {{__('valencian')}}</label>
                                            @break                         
                                        @endswitch
                                        <input type="text" class="form-control" id="{{$language}}" name="{{$language}}" value="" {{ $language == 'es' ? 'required': '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-6 offset-3 text-center">
                                    <button class="btn btn-warning" id="translate">{{__('translate_from_spanish')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}" />
                            <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateTranslateModal" tabindex="-1" role="dialog" aria-labelledby="updateTranslateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('edit_translation')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('updateTranslate') }}">
                    @method('PATCH')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="form-group">
                                        <label for="name">Key:</label> <a href="" data-toggle="popover" class="float-right" title="{{__('key_information')}}" data-content="{{__('key_info_popover')}}"><i class="fas fa-question"></i></a>
                                        <input type="text" class="form-control key" id="key" name="key" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach (Config::get('app.languages') as $lang => $language)
                                    <div class="col-6">
                                        <div class="form-group">
                                        @switch($language)
                                            @case('en')
                                            <label for="{{$language}}"> {{__('english')}}</label>
                                            @break
                                            @case('es')
                                            <label for="{{$language}}"> {{__('spanish')}}</label>
                                            @break
                                            @case('de')
                                            <label for="{{$language}}"> {{__('german')}}</label>
                                            @break
                                            @case('it')
                                            <label for="{{$language}}"> {{__('italian')}}</label>
                                            @break
                                            @case('fr')
                                            <label for="{{$language}}"> {{__('french')}}</label>
                                            @break
                                            @case('pt')
                                            <label for="{{$language}}"> {{__('portuguese')}}</label>
                                            @break
                                            @case('ru')
                                            <label for="{{$language}}"> {{__('russian')}}</label>
                                            @break
                                            @case('ca')
                                            <label for="{{$language}}"> {{__('valencian')}}</label>
                                            @break                         
                                        @endswitch
                                        <input type="text" class="form-control {{$language}}" id="edit_{{$language}}" name="{{$language}}" value="" {{ $language == 'es' ? 'required': '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-6 offset-3 text-center">
                                    <button class="btn btn-warning" id="edit_translate">{{__('translate_from_spanish')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}" />
                            <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
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

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    $('[data-toggle="popover"]').popover();  

    $("#table").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.22/i18n/" + $('html').attr('language')+ ".json"
            },
            pageLength:15,
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '#translate', function(event) {
            event.preventDefault();
            let url = "{{ route('translate')}}";
            let word = $("#es").val();

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    word:word,
                },
                
                beforeSend: function() {
                   
                },
                // return the result
                success: function(data) {
                    //console.log(data);
                    let languages = data.languages;
                    $.each(data,function(key,value){
                       $("#"+key).val(value);
                    })
                
                }
            })
        });

        $(document).on('click', '#edit_translate', function(event) {
            event.preventDefault();
            let url = "{{ route('translate')}}";
            let word = $(".es").val();

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    word:word,
                },
                
                beforeSend: function() {
                   
                },
                // return the result
                success: function(data) {
                    //console.log(data);
                    let languages = data.languages;
                    $.each(data,function(key,value){
                       $("."+key).val(value);
                    })
                
                }
            })
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

        $(document).on('click', '#editButton', function(event) {
            event.preventDefault();
            let url = $(this).attr('data-action');
            let key = $(this).attr('data-key');

            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {
                    key:key,
                },
                
                beforeSend: function() {
                   
                },
                // return the result
                success: function(data) {
                    console.log(data.key);
                    $(".key").val(data.key);
                    let languages = data.languages;
                    $.each(data,function(key,value){
                       $("."+key).val(value);
                    })
                               
                }
            })
        });


});
</script>
@endsection
