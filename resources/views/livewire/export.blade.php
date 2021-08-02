<div>
    <a wire:click="export" class="btn btn-outline-primary">{{ __('Export') }}</a>

    @if($exporting && !$exportFinished)
        <div class="d-inline" wire:poll="updateExportProgress">{{ __('Exporting...please wait.') }}</div>
    @endif

    @if($exportFinished)
        {{ __('Done. Download file ') }}<a class="stretched-link" wire:click="downloadExport">{{ __('here') }}</a>
    @endif
</div>