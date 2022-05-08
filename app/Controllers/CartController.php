<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class CartController extends BaseController
{
    use ResponseTrait;
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
        $data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'mail'=> $this->request->getVar('mail'),
            'address' => $this->request->getVar('address'),
            'city' => $this->request->getVar('city'),
            'country' => $this->request->getVar('country'),
            'zipcode' => $this->request->getVar('zipcode'),
        ];
        $invoice_prefix = 'LYCDD';
        $invoice_no = $session->get('id').'NEIL'.time();
        $order->insert([
            'invoice_prefix' => $invoice_prefix,
            'invoice_no' => $invoice_no,
            'user_id' => $session->get('id'),
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'zipcode' => $data['zipcode'],
        ]);
        $order_id = $order->insert_id();
        if($order_id){
            $order_item = [];
            foreach($cart->contents() as $item){
                $order_item = [
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'sub_total' => $item['sub_total'],
                ];
                $order_product = new \App\Models\OrderProductModel();
                $order_product->insert($order_item);
            }
            if(empty($order_item)){
              return $this->fail('votre panier est vide');
            }
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'commande passer avec success'
                ]
            ];
            $cart->destroy();
            $email = \Config\Services::email(); // loading for use
            $email->setTo($data['mail']);
            $email->setSubject('Commande LoyaltyCard');
            // Using a custom template
            $template = view('mail/checkout-mail', $data);
            $email->setMessage($template);
            // Send email
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => 'mail envoyé avec succès',
    
            ];
            if ($email->send()) {
                    return $this->respond($response);
            } else {
                $response = [
                    'status'   => 400,
                    'error'    => null,
                    'messages' => [
                        'le mail n\'a pas été envoyé',
                    ]
                ];
                return $this->fail($response);
            }
            return $this->respond($response);  
        }else{
            return $this->fail('une erreur est survenue');
        }
    }
}
