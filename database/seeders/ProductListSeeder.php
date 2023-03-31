<?php

namespace Database\Seeders;

use App\Models\ProductList;
use Illuminate\Database\Seeder;

class ProductListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = json_decode(file_get_contents(storage_path('app/product_list.json')), true);
        ProductList::insert($lists);
    }
}
