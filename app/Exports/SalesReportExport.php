<?php
namespace App\Exports;
use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        private $from,
        private $to
    ) {}

    public function collection(): Collection
    {
        return Transaction::with('user')
            ->whereBetween('created_at', [$this->from, $this->to])
            ->orderByDesc('created_at')
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Tanggal', 'Kasir', 'Total'];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->created_at?->format('Y-m-d H:i:s'),
            $transaction->user->name ?? '-',
            $transaction->total,
        ];
    }
}
