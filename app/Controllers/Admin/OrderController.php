<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;

class OrdersController extends ResourcePresenter
{
    protected $modelName = 'App\Models\OrderModel';
    protected $format    = 'json';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $session = \Config\Services::session();
        $data = [
            'title' => 'commande',
            'order' => $this->model->findAll(),
            'user_id' => $userModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/order', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $session = \Config\Services::session();
        $data = [
            'title'=> 'Produit',
            'group' => $this->model->find($id),
            'user_id' => $userModel->find($this->model->find($id)['user_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_group', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'invoice_prefix' => $this->request->getPost('invoice_prefix'),
            'invoice_no' => $this->request->getPost('invoice_no'),
            'user_id' => $this->request->getPost('user_id'),
            'total' => $this->request->getPost('total'),
            'reduction' => $this->request->getPost('reduction'),
            'payment_country' => $this->request->getPost('payment_country'),
            'payment_firstname' => $this->request->getPost('payment_firstname'),
            'payment_lastname' => $this->request->getPost('payment_lastname'),
            'payment_address' => $this->request->getPost('payment_address'),
            'payment_city' => $this->request->getPost('payment_city'),
            'payment_zipcode' => $this->request->getPost('payment_zipcode'),
            'comment' => $this->request->getPost('comment'),
            'status' => $this->request->getPost('status'),
        ];
        $company_rules =[
            'invoice_prefix' => [
                'rules' => 'required|alpha|min_length[5]|max_length[5]',
                'errors' => [
                    'required' => 'Le préfixe de facture est obligatoire.',
                    'alpha' => 'Le préfixe de facture doit être composé uniquement de lettres.',
                    'min_length' => 'Le préfixe de facture doit contenir 5 caractères.',
                    'max_length' => 'Le préfixe de facture doit contenir 5 caractères.',
                ]
            ],
            'invoice_no' => [ 
                'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[16]',
                'errors' => [
                    'required' => 'Le numéro de facture est obligatoire.',
                    'alpha_numeric_space' => 'Le numéro de facture doit être alphanumérique.',
                    'min_length' => 'Le numéro de facture doit contenir 1 caractère.',
                    'max_length' => 'Le numéro de facture doit contenir 16 caractères.',
                ]
            ],
            'user_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'L\'id de l\'utilisateur est obligatoire.',
                    'numeric' => 'L\'id de l\'utilisateur doit être un nombre.',
                ]
            ],
            'total' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Le total est obligatoire.',
                    'decimal' => 'Le total doit être un nombre.',
                ]
            ],
            'reduction' => [ 
                'rules' => 'required|decimal|min_length[0]|max_length[0.9]',
                'errors' => [
                    'required' => 'La réduction est obligatoire.',
                    'decimal' => 'La réduction doit être un nombre.',
                    'min_length' => 'La réduction doit contenir 0 caractères.',
                    'max_length' => 'La réduction doit contenir 0.9 caractères.',
                ]
            ],
            'payment_country' => [
                'rules' =>  'required|alpha|min_length[1]|max_length[42]',
                'errors' => [
                    'required' => 'Le pays de paiement est obligatoire.',
                    'alpha' => 'Le pays de paiement doit être un nom.',
                    'min_length' => 'Le pays de paiement doit contenir 1 caractère.',
                    'max_length' => 'Le pays de paiement doit contenir 42 caractères.',
                ]
            ],
            'payment_firstname' =>[ 
                'rules' => 'required|alpha|min_length[1]|max_length[20]',
                'errors' => [
                    'required' => 'Le prénom de paiement est obligatoire.',
                    'alpha' => 'Le prénom de paiement doit être un nom.',
                    'min_length' => 'Le prénom de paiement doit contenir 1 caractère.',
                    'max_length' => 'Le prénom de paiement doit contenir 20 caractères.',
                ]
            ],
            'payment_lastname' => [
                'rules' => 'required|alpha||min_length[1]|max_length[20]',
                'errors' => [
                    'required' => 'Le nom de paiement est obligatoire.',
                    'alpha' => 'Le nom de paiement doit être un nom.',
                    'min_length' => 'Le nom de paiement doit contenir 1 caractère.',
                    'max_length' => 'Le nom de paiement doit contenir 20 caractères.',
                ]
            ],
            'payment_address' => [
                'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[50]',
                'errors' => [
                    'required' => 'L\'adresse de paiement est obligatoire.',
                    'alpha_numeric_space' => 'L\'adresse de paiement doit être alphanumérique.',
                    'min_length' => 'L\'adresse de paiement doit contenir 1 caractère.',
                    'max_length' => 'L\'adresse de paiement doit contenir 50 caractères.',
                ]
            ],
            'payment_city' => [
                'rules' => 'required|alpha|min_length[1]|max_length[38]',
                'errors' => [
                    'required' => 'La ville de paiement est obligatoire.',
                    'alpha' => 'La ville de paiement doit être nom.',
                    'min_length' => 'La ville de paiement doit contenir 1 caractère.',
                    'max_length' => 'La ville de paiement doit contenir 38 caractères.',
                ]
            ],
            'payment_zipcode' =>[
                'rules' =>  'required|numeric|min_length[5]|max_length[5]',
                'errors' => [
                    'required' => 'Le code postal de paiement est obligatoire.',
                    'numeric' => 'Le code postal de paiement doit être un nombre.',
                    'min_length' => 'Le code postal de paiement doit contenir 5 caractères.',
                    'max_length' => 'Le code postal de paiement doit contenir 5 caractères.',
                ]
            ],
            'comment' => [
                'rules' => 'alpha|max_length[255]',
                'errors' => [
                    'alpha' => 'Le commentaire doit être un texte.',
                    'max_length' => 'Le commentaire doit contenir 255 caractères.',
                ]
            ],
            'status' => [
                'rules' => 'numeric|required|max_length[1]|min_length[0]',
                'errors' => [
                    'required'=>'le code postale doit etre donnée',
                    'max_length'=>'la taille doit etre inferieur a 1',
                    'min_length'=>'la taille doit etre superieur a 0',
                    'numeric'=>'il doit contenir que des chiffres',
                ]
            ],
        ];
        if(!$this->validate($company_rules)){
            return $this->fail($this->validator->getErrors());
           }
   
           $this->model->insert($data);
           $response = [
               'status'   => 201,
               'error'    => null,
               'messages' => [
                   'success' => 'commande creer avec success'
               ]
           ];
           return $this->respondCreated($response);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = [
            'invoice_prefix' => $this->request->getPost('invoice_prefix'),
            'invoice_no' => $this->request->getPost('invoice_no'),
            'user_id' => $this->request->getPost('user_id'),
            'total' => $this->request->getPost('total'),
            'reduction' => $this->request->getPost('reduction'),
            'payment_country' => $this->request->getPost('payment_country'),
            'payment_firstname' => $this->request->getPost('payment_firstname'),
            'payment_lastname' => $this->request->getPost('payment_lastname'),
            'payment_address' => $this->request->getPost('payment_address'),
            'payment_city' => $this->request->getPost('payment_city'),
            'payment_zipcode' => $this->request->getPost('payment_zipcode'),
            'comment' => $this->request->getPost('comment'),
            'status' => $this->request->getPost('status'),
        ];
        $company_rules =[
            'invoice_prefix' => [
                'rules' => 'required|alpha|min_length[5]|max_length[5]',
                'errors' => [
                    'required' => 'Le préfixe de facture est obligatoire.',
                    'alpha' => 'Le préfixe de facture doit être composé uniquement de lettres.',
                    'min_length' => 'Le préfixe de facture doit contenir 5 caractères.',
                    'max_length' => 'Le préfixe de facture doit contenir 5 caractères.',
                ]
            ],
            'invoice_no' => [ 
                'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[16]',
                'errors' => [
                    'required' => 'Le numéro de facture est obligatoire.',
                    'alpha_numeric_space' => 'Le numéro de facture doit être alphanumérique.',
                    'min_length' => 'Le numéro de facture doit contenir 1 caractère.',
                    'max_length' => 'Le numéro de facture doit contenir 16 caractères.',
                ]
            ],
            'user_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'L\'id de l\'utilisateur est obligatoire.',
                    'numeric' => 'L\'id de l\'utilisateur doit être un nombre.',
                ]
            ],
            'total' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Le total est obligatoire.',
                    'decimal' => 'Le total doit être un nombre.',
                ]
            ],
            'reduction' => [ 
                'rules' => 'required|decimal|min_length[0]|max_length[0.9]',
                'errors' => [
                    'required' => 'La réduction est obligatoire.',
                    'decimal' => 'La réduction doit être un nombre.',
                    'min_length' => 'La réduction doit contenir 0 caractères.',
                    'max_length' => 'La réduction doit contenir 0.9 caractères.',
                ]
            ],
            'payment_country' => [
                'rules' =>  'required|alpha|min_length[1]|max_length[42]',
                'errors' => [
                    'required' => 'Le pays de paiement est obligatoire.',
                    'alpha' => 'Le pays de paiement doit être un nom.',
                    'min_length' => 'Le pays de paiement doit contenir 1 caractère.',
                    'max_length' => 'Le pays de paiement doit contenir 42 caractères.',
                ]
            ],
            'payment_firstname' =>[ 
                'rules' => 'required|alpha|min_length[1]|max_length[20]',
                'errors' => [
                    'required' => 'Le prénom de paiement est obligatoire.',
                    'alpha' => 'Le prénom de paiement doit être un nom.',
                    'min_length' => 'Le prénom de paiement doit contenir 1 caractère.',
                    'max_length' => 'Le prénom de paiement doit contenir 20 caractères.',
                ]
            ],
            'payment_lastname' => [
                'rules' => 'required|alpha||min_length[1]|max_length[20]',
                'errors' => [
                    'required' => 'Le nom de paiement est obligatoire.',
                    'alpha' => 'Le nom de paiement doit être un nom.',
                    'min_length' => 'Le nom de paiement doit contenir 1 caractère.',
                    'max_length' => 'Le nom de paiement doit contenir 20 caractères.',
                ]
            ],
            'payment_address' => [
                'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[50]',
                'errors' => [
                    'required' => 'L\'adresse de paiement est obligatoire.',
                    'alpha_numeric_space' => 'L\'adresse de paiement doit être alphanumérique.',
                    'min_length' => 'L\'adresse de paiement doit contenir 1 caractère.',
                    'max_length' => 'L\'adresse de paiement doit contenir 50 caractères.',
                ]
            ],
            'payment_city' => [
                'rules' => 'required|alpha|min_length[1]|max_length[38]',
                'errors' => [
                    'required' => 'La ville de paiement est obligatoire.',
                    'alpha' => 'La ville de paiement doit être nom.',
                    'min_length' => 'La ville de paiement doit contenir 1 caractère.',
                    'max_length' => 'La ville de paiement doit contenir 38 caractères.',
                ]
            ],
            'payment_zipcode' =>[
                'rules' =>  'required|numeric|min_length[5]|max_length[5]',
                'errors' => [
                    'required' => 'Le code postal de paiement est obligatoire.',
                    'numeric' => 'Le code postal de paiement doit être un nombre.',
                    'min_length' => 'Le code postal de paiement doit contenir 5 caractères.',
                    'max_length' => 'Le code postal de paiement doit contenir 5 caractères.',
                ]
            ],
            'comment' => [
                'rules' => 'alpha|max_length[255]',
                'errors' => [
                    'alpha' => 'Le commentaire doit être un texte.',
                    'max_length' => 'Le commentaire doit contenir 255 caractères.',
                ]
            ],
            'status' => [
                'rules' => 'numeric|required|max_length[1]|min_length[0]',
                'errors' => [
                    'required'=>'le code postale doit etre donnée',
                    'max_length'=>'la taille doit etre inferieur a 1',
                    'min_length'=>'la taille doit etre superieur a 0',
                    'numeric'=>'il doit contenir que des chiffres',
                ]
            ],
        ];
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->delete($id);
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'commande supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucune commande trouver');
        }
    }
}
