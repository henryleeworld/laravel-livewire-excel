<div>
    <a href="#" wire:click.prevent="export" wire:loading.attr="disabled" wire:target="export" class="btn btn-outline-primary">{{ __('Export') }}</a>

    @if($exporting && !$exportFinished)
        <div class="d-inline ms-2" wire:poll.2s="updateExportProgress">{{ __('Exporting...please wait.') }}</div>
    @endif

    @if($exportFinished)
        <span class="ms-2">{{ __('Done. Download file ') }}<a href="#" wire:click.prevent="downloadExport">{{ __('here') }}</a></span>
    @endif
</div>