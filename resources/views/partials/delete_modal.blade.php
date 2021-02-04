<form action="{{ route($rute, $id) }}" method="POST">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Esta seguro de eliminar el registro  {{$name}}?</h5>
        <p  class="text-center">{{ $message }}</p>
    </div>
    <div class="modal-footer">
        <input type="text" name="id" id="id" value="{{ $id }}" class="invisible">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger {{ $visible }}">Eliminar</button>
    </div>
</form>