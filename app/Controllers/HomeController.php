<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductTypeModel;



class HomeController extends BaseController
{
    public function index()
    {
        // $productModel = new ProductModel();
        // $productTypeModel = new ProductTypeModel();
        $data = [
            'title'=> 'Acceuil',
            // 'product' => $productModel->findAll(8),
            // 'product_type' => $productTypeModel->findAll(),
        ];

        return view('home', $data);
    }
    public function toto()
    {
        // $productModel = new ProductModel();
        // $productTypeModel = new ProductTypeModel();
        $data = [
            'title'=> 'toto',
            // 'product' => $productModel->findAll(8),
            // 'product_type' => $productTypeModel->findAll(),
        ];

        return view('home', $data);
    }
}
