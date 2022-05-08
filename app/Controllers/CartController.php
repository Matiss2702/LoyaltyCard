<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CartController extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $cart = \Config\Services::cart();
        $data = [
            'title' => 'Panier',
            'cart' => $cart->contents(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('cart', $data);
    }
    public function remove($id)
    {
        $session = \Config\Services::session();
        $cart = \Config\Services::cart();
        $cart->remove($id);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'produit enlever de votre panier avec success'
            ]
        ];
        return $this->respondDeleted($response);
    }
    public function update($id)
    {
        $session = \Config\Services::session();
        $cart = \Config\Services::cart();
        if(empty($id)&&empty($this->request->getVar('quantity'))){
            return $this->fail('vous n\'avez choisie aucun produit');
        }
        $cart->update($id, $this->request->getVar('quantity'));
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'le produit dans votre panier à été modifié avec success'
            ]
        ];
        return $this->respond($response);
    }
    public function checkout()
    {
        $session = \Config\Services::session();
        $cart = \Config\Services::cart();
        $order = new \App\Models\OrderModel();
        $invoice_prefix = 'LYCDD';
        $invoice_no = $session->get('id').'NEIL'.time();
        $order->insert([
            'user_id' => $session->get('id'),
        ]);

    }
}
