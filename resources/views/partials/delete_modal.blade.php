<form action="{{ route($rute, $id) }}" method="POST">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{ __('ask_delete_record', ['Name' => $name ])}}  ?</h5>
        <p  class="text-center">{{ $message }}</p>
    </div>
    <div class="modal-footer">
        <input type="text" name="id" id="id" value="{{ $id }}" class="invisible">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cancel')}}</button>
        <button type="submit" class="btn btn-danger {{ $visible }}">{{ __('remove') }}</button>
    </div>
</form>