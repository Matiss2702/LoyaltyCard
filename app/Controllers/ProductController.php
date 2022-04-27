<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductTypeModel;



class ProductController extends BaseController
{
    public function index()
    {   
        $session = \Config\Services::session();
        $productModel = new ProductModel();
        $productTypeModel = new ProductTypeModel();
        $data = [
            'title'=> 'Produit',
            'product' => $productModel->findAll(),
            'product_type' => $productTypeModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('product', $data);
    }
    public function product($id=null)
    {
        $session = \Config\Services::session();
        $productModel = new ProductModel();
        $productTypeModel = new ProductTypeModel();
        $data = [
            'title'=> 'Produit',
            'product' => $productModel->find($id),
            'product_type' => $productTypeModel->find($productModel->find($id)['product_types_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('show_product', $data);
    }
}