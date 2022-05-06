<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductTypeModel;
use CodeIgniter\API\ResponseTrait;



class HomeController extends BaseController
{
    use ResponseTrait;

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

    public function faq()
    {
        $session = \Config\Services::session();
        $data = [
            'title' => 'FAQ',

            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('faq', $data);
    }

    public function contact()
    {
        $data = [
            'lastname' => $this->request->getPost('lastname'),
            'firstname' => $this->request->getPost('firstname'),
            'mail' => $this->request->getPost('mail'),
            'body' => sha1($this->request->getPost('body')),
        ];

        $rules = [
            'lastname' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[10]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
                ]
            ],
            'firstname' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[10]',
                'errors' =>  [
                    'required' => 'le prenom est requis',
                    'alpha_numeric_space' => 'le prenom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le prenom doit contenir 3 caractere minimun',
                    'max_length' => ' le prenom doit contenir 10 caractere maximun',
                ]
            ],
            'mail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'le mail est requis',
                    'valid_email' => 'le mail doit etre valid',
                ]
            ],
            'body' => [
                'rules' => 'required',
                'errors' =>  [
                    'required' => 'le mot de passe est requis',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $userInfo = [
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'body' => $data['body']
        ];
        $email = \Config\Services::email(); // loading for use
        $email->setTo('matiss.haillouy@gmail.com');
        $email->setFrom($data['mail']);
        $email->setSubject('Formulaire de contact LoyaltyCard');
        // Using a custom template
        $template = view('mail/contact-mail', $userInfo);
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
    }
}
