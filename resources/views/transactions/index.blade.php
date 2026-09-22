@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <h1 class="text-lg font-semibold mb-4">Riwayat Transaksi</h1>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-slate-100 text-left">
                <th class="border px-3 py-2">ID</th>
                <th class="border px-3 py-2">Tanggal</th>
                <th class="border px-3 py-2">Total</th>
            </tr>
        </thead>
    </table>
@endsection