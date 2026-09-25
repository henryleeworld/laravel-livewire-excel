<div>
    <form wire:submit="import" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center">
            <div data-mdb-input-init class="form-outline me-3" style="width: 14rem">
                <input type="file" wire:model.live="importFile" class="form-control @error('importFile') is-invalid @enderror">
            </div>
            <button type="submit" wire:loading.attr="disabled" wire:target="import" class="btn btn-outline-secondary">{{ __('Import') }}</button>
        </div>
    </form>
    @if($importing && !$importFinished)
        <div wire:poll.2s="updateImportProgress">{{ __('Importing...please wait.') }}</div>
    @endif
    @if($importFinished)
        {{ __('Finished importing.') }}
    @endif
    @error('importFile')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>