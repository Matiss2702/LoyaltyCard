<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;

class StocksController extends ResourcePresenter
{
    protected $modelName = 'App\Models\StockModel';
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
            'title' => 'Stockage',
            'products_id' => $this->model->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/stock', $data);
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
            'title'=> 'Stockage',
            'stock' => $this->model->find($id),
            'products_id' => $productModel->find($this->model->find($id)['products_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/show_stock', $data);
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
            'warehouses_id' => $this->request->getPost('warehouses_id'),
            'products_id' => $this->request->getPost('products_id'),
            'quantity' => $this->request->getPost('quantity'),
        ];

        $rules = [
            'warehouses_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le nom est requis',
                    'numeric' => 'le nom ne doit pas contenir des chiffres',
                ]
            ],
            'products_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le nom est requis',
                    'numeric' => 'le nom ne doit pas contenir des chiffres',
                ]
            ],
            'quantity' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'le nom ne doit pas contenir de caractere spéciaux',
                ]
            ],
        ];
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
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'le stock est modifier avec succès'
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
                    'success' => 'le stock est supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun stock trouver');
        }
    }
}
