<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query(): Builder|EloquentBuilder|Relation
    {
        return Transaction::query()->with('user');
    }

    public function headings(): array
    {
        return [
            '#',
            'Description',
            'Amount',
            'User',
            'Created At'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->description,
            $transaction->amount,
            $transaction->user->name,
            $transaction->created_at
        ];
    }

    public function fields(): array
    {
        return [
            'id',
            'description',
            'amount',
            'user',
            'created_at'
        ];
    }
}
