<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductTypeModel;



class HomeController extends BaseController
{
    public function index()
    {   
        $session = \Config\Services::session();
        $productModel = new ProductModel();
        $productTypeModel = new ProductTypeModel();
        $data = [
            'title'=> 'Acceuil',
            'product' => $productModel->findAll(8),
            'product_type' => $productTypeModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('home', $data);
    }
}
