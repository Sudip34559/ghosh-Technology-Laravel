<?php

namespace App\Imports;

use Validator;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    public function model(array $row)
    {
        // dd($row);
            $name = $row['prod_list'] ?? '';
            $quentity = $row['qty'] ?? '';
            // dd($name, $quentity);
            $validator = \Validator::make(
                compact('name', 'quentity'),
                [
                    'name' =>'required|string',
                    'quentity' =>'required|integer',
                ]
            );
            // dd($validator);
            if ($validator->fails()) {
                // Handle validation errors
                // dd('Validation');
                return null;
            }
            $exestingProduct = Product::where('prod_list', $name)->first();
            // dd($exestingProduct);
            if ($exestingProduct) {
                return null;
            }
            $pdt =  Product::create(
                [
                    'prod_list' => $name,
                    'qty' => $quentity,
                ]
            );

    }
    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }
}
