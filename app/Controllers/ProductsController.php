<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\City;

class ProductsController extends Controller
{
    public function index()
    {
        $products = new Product;

        $cities = City::all();
        return $this->view('products', compact('products', 'cities', 'number_pages'));
    }

    static public function import($xml)
    {
        (new Product)->import($xml);
    }
}