
@extends('layouts.app')
@section('title', 'Riwayat Transaksi')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <h1 class="text-lg font-semibold">Riwayat Transaksi</h1>

    <button
        type="button"
        id="downloadExcel"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md"
    >
        Download Excel
    </button>
</div>

@foreach ($transactions as $transaction)
    <div class="border rounded-md p-3 mb-3">
        <p class="font-medium">
            Transaksi #{{ $transaction->id }}
            &middot;
            {{ $transaction->created_at->format('d M Y H:i') }}
            &middot;
            Rp {{ number_format($transaction->total) }}
            &middot; {{ $transaction->details->sum('qty') }} item
        </p>

        <ul class="text-sm text-slate-500 mt-1">
            @foreach ($transaction->details as $detail)
                <li>
                    {{ $detail->product->name }}
                    &times;
                    {{ $detail->qty }}
                    =
                    Rp {{ number_format($detail->subtotal) }}
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

<div class="mt-4">
    {{ $transactions->links() }}
</div>

<script>
document.getElementById('downloadExcel').addEventListener('click', async function () {
    const button = this;
    button.disabled = true;
    button.textContent = 'Mengunduh...';

    try {
        const url = new URL(
            @json(route('reports.export.xlsx')),
            window.location.origin
        );

        // Ikutkan filter tanggal jika tersedia di URL.
        const params = new URLSearchParams(window.location.search);
        params.forEach((value, key) => url.searchParams.set(key, value));

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Unduhan gagal');
        }

        const blob = await response.blob();
        const downloadUrl = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = downloadUrl;
        link.download = 'laporan-penjualan.xlsx';
        document.body.appendChild(link);
        link.click();
        link.remove();

        setTimeout(() => URL.revokeObjectURL(downloadUrl), 1000);

        alert('Berhasil! Laporan Excel berhasil diunduh.');
    } catch (error) {
        alert('Gagal mengunduh laporan Excel. Silakan coba lagi.');
        console.error(error);
    } finally {
        button.disabled = false;
        button.textContent = 'Download Excel';
    }
});
</script>
@endsection
