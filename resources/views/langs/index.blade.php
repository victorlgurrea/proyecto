
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

        </div>


        <div class="modal fade" id="createTranslateModal" tabindex="-1" role="dialog" aria-labelledby="createTranslateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('lang.add_translation')}}</h5>
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
                                        <label for="name">Key: </label>
                                        <input type="text" class="form-control" id="key" name="key" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="es">Español: </label>
                                        <input type="text" class="form-control" id="es" name="es" value="" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="en">Inglés: </label>
                                        <input type="text" class="form-control" id="en" name="en" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fr">Frances: </label>
                                        <input type="text" class="form-control" id="fr" name="fr" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="de">Alemán </label>
                                        <input type="text" class="form-control" id="de" name="de" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="it">Italiano: </label>
                                        <input type="text" class="form-control" id="it" name="it" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ru">Ruso: </label>
                                        <input type="text" class="form-control" id="ru" name="ru" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pt">Portuges: </label>
                                        <input type="text" class="form-control" id="pt" name="pt" value="">
                                    </div>
                                </div>
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

        <!-- small modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar registro</h5>
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

</script>
@endsection
