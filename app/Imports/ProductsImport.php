<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row): Model|array|null
    {
        $product = Product::firstOrNew([
            'name' => $row['name'],
            'category_id' => $row['category_id'],
        ]);

        $product->price = $row['price'];

        return $product;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}