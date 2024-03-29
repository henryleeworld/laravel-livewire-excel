<div>
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <input type="file" wire:model.live="importFile" class="@error('import_file') is-invalid @enderror">
        <button class="btn btn-outline-secondary">{{ __('Import') }}</button>
        @error('import_file')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </form>

    @if($importing && !$importFinished)
        <div wire:poll="updateImportProgress">{{ __('Importing...please wait.') }}</div>
    @endif

    @if($importFinished)
        {{ __('Finished importing.') }}
    @endif
</div>