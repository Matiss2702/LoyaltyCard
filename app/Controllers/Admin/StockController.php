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
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'products_id' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'quantity' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
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
        //
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
        //
    }
}
