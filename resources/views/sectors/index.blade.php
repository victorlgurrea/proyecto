
@extends('layouts.dashboard')

@section('content')
<div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title"><strong>Sectores</strong>
                  <a class="btn btn-success float-right" href="{{ route('sectors.create') }}" id="createNewSector">Crear Nuevo Sector</a>
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
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">Nombre</th>
                    <th width="10%" class="text-center">Acciones</th>
                </tr>
                @foreach ($sectors as $sector)
                <tr>
                    <td>{{ $sector->name }}</td>
                    <td class="text-center">
                      <!--  <form action="{{ route('sectors.destroy',$sector->id) }}" method="POST">-->
                            <div class="row">
                                <div class="col-4">
                                    <a class="btn btn-info btn-sm" href="{{ route('sectors.show',$sector->id) }}" title="ver"><i class="fas fa-search"></i></a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-primary btn-sm" href="{{ route('sectors.edit',$sector->id) }}" title="editar"><i class="fas fa-pen"></i></a>
                                </div>
                                <div class="col-4">
                                    <a data-toggle="modal" class="btn btn-danger btn-sm" id="smallButton" data-target="#smallModal" data-action="delete" data-id="{{ $sector->id }}" title="eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                        <!--
                            @csrf
                            @method('DELETE')
                                <div class="col-4">
                                    <button type="submit" class="btn btn-danger btn-sm" title="eliminar"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </form>

                        -->
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="d-flex">
                <div class="mx-auto">
                {{ $sectors->links() }}
                </div>
            </div>
        </div>

        <!-- small modal -->
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="smallBody">
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('javascript_page')
<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let url = "sectors/" + $(this).attr('data-action') + "/" + $(this).attr('data-id');
        $.ajax({
            url: url
            , beforeSend: function() {
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result);
            }
            , complete: function() {
              
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
            }
            , timeout: 8000
        })
    });

</script>
@endsection
