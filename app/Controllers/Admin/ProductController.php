<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use App\Models\ProductTypeModel;


class ProductController extends ResourcePresenter
{
    protected $modelName = 'App\Models\ProductModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $session = \Config\Services::session();
        $productTypeModel = new ProductTypeModel();
        $data = [
            'title' => 'produit',
            'products' => $this->model->findAll(),
            'productTypes' => $productTypeModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/product', $data);
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
        $productTypeModel = new ProductTypeModel();
        $data = [
            'title'=> 'Produit',
            'product' => $this->model->find($id),
            'product_type' => $productTypeModel->find($this->model->find($id)['product_types_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_product', $data);
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
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'image' => $this->request->getPost('image'),
            'reduction' => $this->request->getPost('reduction'),
            'product_types_id' => $this->request->getPost('product_types_id'),
            'status' => $this->request->getPost('status'),
        ];
        //var_dump($data['image']);
        $product_rules = [
            'name' => [
              'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[30]',
              'errors' => [
                'required' => 'le nom est requis',
                'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                'min_length' => 'le nom doit contenir 3 caractere minimun',
                'max_length' => ' le nom doit contenir 30 caractere maximun',
              ]
            ],
              'price'=>[
                'rules'=>'decimal|required',
                'errors'=>[
                'required'=>'l\'adresse doit etre',
                'decimal'=>'il doit contenir que des chiffre',
               ]
              ],
              'image'=>[
                'rules'=> 'required',
                'errors'=>[
                    'required'=>'l\'image est requise',
               ]
              ],
              'reduction'=>[
                'rules'=>'decimal|required',
                'errors'=>[
                  'required'=>'la ville doit etre donnée',
                'decimal'=>'la reduction doit etre donnée'
                ]
              ],
              'product_types_id'=>[
                'rules'=>'numeric|required',
                'errors'=>[
                  'required'=>'le code postale doit etre donnée',
                  'numeric'=>'il doit contenir que des chiffres',
                ]
              ],
              'status'=>[
                'rules'=>'numeric|required|max_length[1]|min_length[0]',
                'errors'=>[
                  'required'=>'le code postale doit etre donnée',
                  'max_length'=>'la taille doit etre inferieur a 1',
                  'min_length'=>'la taille doit etre superieur a 0',
                  'numeric'=>'il doit contenir que des chiffres',
                ]
                ],
            ];

        if(!$this->validate($product_rules)){
         return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'produit creer avec success'
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
        'name' => $this->request->getPost('name'),
        'price' => $this->request->getPost('price'),
        'reduction' => $this->request->getPost('reduction'),
        'product_types_id' => $this->request->getPost('product_types_id'),
        'status' => $this->request->getPost('status'),
        'modified_at' => Time::now()->toDateTimeString(),
      ];

      $product_rules = [
        'name' => [
          'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
          'errors' => [
            'required' => 'le nom est requis',
            'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
            'min_length' => 'le nom doit contenir 3 caractere minimun',
            'max_length' => ' le nom doit contenir 30 caractere maximun',
          ]
        ],
        'price' => [
          'rules' => 'decimal|required',
          'errors' => [
            'required' => 'l\'adresse doit etre',
            'decimal' => 'il doit contenir que des chiffre',
          ]
        ],
        'reduction' => [
          'rules' => 'decimal|required',
          'errors' => [
            'required' => 'la ville doit etre donnée',
            'decimal' => 'la reduction doit etre donnée'
          ]
        ],
        'product_types_id' => [
          'rules' => 'numeric|required',
          'errors' => [
            'required' => 'le code postale doit etre donnée',
            'numeric' => 'il doit contenir que des chiffres',
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

      if (!$this->validate($product_rules)) {
        return $this->fail($this->validator->getErrors());
      }

      $this->model->update($this->request->getPost('id'), $data);
      $response = [
        'status'   => 201,
        'error'    => null,
        'messages' => [
          'success' => 'produit creer avec success'
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
                    'success' => 'produit supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun produit trouver');
        }
    }
}