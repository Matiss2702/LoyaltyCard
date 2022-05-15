<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use App\Models\ProductModel;
use App\Models\OderModel;

class OrderProductController extends ResourcePresenter
{
    protected $modelName = 'App\Models\OrderProductModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {   
        $orderModel = new OrderModel();
        $productModel = new ProductModel();
        $session = \Config\Services::session();
    
        $data = [
            'title' => 'commande',
            'order_product' => $this->model->findAll(),
            'products_id' => $productModel->findAll(),
            'orders_id' => $orderModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/orderproduct', $data);
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
        $orderModel = new OrderModel();
        $productModel = new ProductModel();
        $data = [
            'title'=> 'Commande_Produit',
            'order' => $this->model->find($id),
            'orders_id' => $orderModel->find($this->model->find($id)['orders_id']),
            'products_id' => $productModel->find($this->model->find($id)['products_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_order_product', $data);
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
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];
        $rules = [
            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'status' => [
                'rules' => 'numeric|required|max_length[1]|min_length[0]',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'max_length' => 'la taille doit etre inferieur a 1',
                    'min_length' => 'la taille doit etre superieur a 0',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'categorie de produit creer avec success'
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
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];
        $rules = [
            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'status' => [
                'rules' => 'numeric|required|max_length[1]|min_length[0]',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'max_length' => 'la taille doit etre inferieur a 1',
                    'min_length' => 'la taille doit etre superieur a 0',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
          }
    
          $this->model->update($this->request->getPost('id'), $data);
          $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
              'success' => 'commande de produit creer avec success'
            ]
          ];
          return $this->respond($response);
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
                    'success' => 'commande de produit supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucune commande deproduit trouver');
        }
    }
}
