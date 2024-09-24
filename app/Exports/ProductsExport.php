<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $products = Product::all(['prod_list', 'qty']);
        $data = [];

        foreach ($products as $index => $product) {
            $data[] = [
                $index + 1,      // Auto-incremented number starting from 1
                $product->prod_list,  // Product Name
                $product->qty,  // Quantity
            ];
        }

        return $data;
    }

    /**
     * Return column headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',          // Auto-incremented number
            'Product Name',
            'Quantity'
        ];
    }
    
}
