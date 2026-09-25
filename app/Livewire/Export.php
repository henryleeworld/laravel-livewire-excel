<?php

namespace App\Livewire;

use App\Jobs\ExportJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Export extends Component
{
    public ?string $batchId = null;
    public bool $exporting = false;
    public bool $exportFinished = false;

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;

        $batch = Bus::batch([
            new ExportJob(),
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getExportBatchProperty(): ?Batch
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function downloadExport()
    {
        return Storage::download('public/transactions.csv');
    }

    public function updateExportProgress(): void
    {
        $batch = $this->exportBatch;

        if (! $batch) {
            return;
        }

        $this->exportFinished = $batch->finished();

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function render()
    {
        return view('livewire.export');
    }
}
