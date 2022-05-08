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
    public function add_cart($id)
    {
        $cart = \Config\Services::cart();
        $session = \Config\Services::session();
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        $data = [
            'id' => $id,
            'name' =>  $product['name'],
            'price' =>  $product['price'],
            'image' =>  $product['image'],
            'reduction' => $product['reduction'],
            'quantity' => $this->request->getVar('quantity'),
            'description' => $product['description'],
        ];
        $cart->insert($data);
    }
   
}