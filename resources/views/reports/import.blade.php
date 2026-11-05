@extends('layouts.app')

@section('title', 'Import Produk')

@section('content')
<h1 class="text-lg font-semibold mb-4">Import Produk dari CSV</h1>

@if (session('success'))
    <div class="bg-green-50 text-green-700 p-3 rounded-md mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Import Manual --}}
<div class="mb-8">
    <h2 class="text-base font-semibold mb-3">Import Manual</h2>

    <form method="POST" action="{{ route('import.store') }}" enctype="multipart/form-data" class="max-w-md">
        @csrf

        <label class="block mb-3">
            <span class="text-sm font-medium">File CSV</span>
            <input type="file" name="csv" accept=".csv" class="mt-1 block w-full text-sm">
            @error('csv')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </label>

        <p class="text-xs text-slate-500 mb-3">
            Column yang dibutuhkan: <code>name</code>, <code>category_id</code>, <code>price</code>.
        </p>

        <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-md text-sm">
            Import Manual
        </button>
    </form>
</div>

{{-- Import Laravel Excel --}}
<div class="mb-8 border-t pt-6">
    <h2 class="text-base font-semibold mb-3">Import dengan Laravel Excel</h2>

    <form method="POST" action="{{ route('import.excel') }}" enctype="multipart/form-data" class="max-w-md">
        @csrf

        <label class="block mb-3">
            <span class="text-sm font-medium">File CSV</span>
            <input type="file" name="excel_file" accept=".csv" class="mt-1 block w-full text-sm">
            @error('excel_file')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </label>

        <p class="text-xs text-slate-500 mb-3">
            Column yang dibutuhkan: <code>name</code>, <code>category_id</code>, <code>price</code>.
        </p>

        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
            Import dengan Laravel Excel
        </button>
    </form>
</div>

<div class="mt-8 border-t pt-6">
    <h2 class="text-base font-semibold mb-3">Catatan Baris Import Cacat / Gagal</h2>

    @if ($importErrors->isEmpty())
        <div class="bg-slate-50 text-slate-600 p-3 rounded-md text-sm">
            Belum ada catatan baris cacat.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="py-2 px-3">No</th>
                        <th class="py-2 px-3">Baris CSV</th>
                        <th class="py-2 px-3">Data Baris</th>
                        <th class="py-2 px-3">Pesan Error</th>
                        <th class="py-2 px-3">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($importErrors as $index => $err)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-2 px-3">{{ $index + 1 }}</td>
                        <td class="py-2 px-3 font-mono font-semibold text-red-600">Baris {{ $err->row_number }}</td>
                        <td class="py-2 px-3 font-mono text-xs max-w-xs truncate" title="{{ $err->raw_data }}">{{ $err->raw_data ?? '-' }}</td>
                        <td class="py-2 px-3 text-red-700">{{ $err->error_message }}</td>
                        <td class="py-2 px-3 text-slate-500 text-xs">{{ $err->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection