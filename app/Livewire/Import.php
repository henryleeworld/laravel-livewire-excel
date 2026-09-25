<?php

namespace App\Livewire;

use App\Jobs\ImportJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;

    public ?string $batchId = null;
    public $importFile = null;
    public bool $importing = false;
    public ?string $importFilePath = null;
    public bool $importFinished = false;

    public function import(): void
    {
        $this->validate([
            'importFile' => ['required', 'file'],
        ]);

        $this->importing = true;
        $this->importFinished = false;
        $this->importFilePath = $this->importFile->store('imports');

        $batch = Bus::batch([
            new ImportJob($this->importFilePath),
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty(): ?Batch
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress(): void
    {
        $batch = $this->importBatch;

        if (! $batch) {
            return;
        }

        $this->importFinished = $batch->finished();

        if ($this->importFinished) {
            if ($this->importFilePath) {
                Storage::delete($this->importFilePath);
            }
            $this->importing = false;
        }
    }

    public function render()
    {
        return view('livewire.import');
    }
}
