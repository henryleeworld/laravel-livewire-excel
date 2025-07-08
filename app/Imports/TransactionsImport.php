<?php

namespace App\Imports;

use App\Models\Transaction;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    private $users;

    public function __construct()
    {
        $this->users = User::all(['id', 'name'])->pluck('id', 'name');
    }

    public function model(array $row)
    {
        return new Transaction([
            'description' => $row['description'],
            'amount' => $row['amount'],
            'user_id' => $this->users[$row['user']],
            'created_at' => $row['created_at']
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
