<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
class WarehouseController extends ResourcePresenter
{
    protected $modelName = 'App\Models\WarehouseModel';
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
            'title' => 'entrepot',
            'company_id' => $this->model->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/warehouse', $data);
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
        $companyModel = new CompanyModel();
        $data = [
            'title'=> 'entrepot',
            'warehouses' => $this->model->find($id),
            'company_id' => $companyModel->find($this->model->find($id)['company_id'],),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_warehouse', $data);
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
            'company_id' => $this->request->getPost('company_id'),
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'zipcode' => $this->request->getPost('zipcode'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
            'company_id' => $this->request->getPost('company_id'),
        ];
        $warehouse_rules = [
            'company_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le nom est requis',
                    'numeric' => 'le nom doit être un nombre',
                ]
            ],
            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'address' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'zipcode' => [
                'rules' => 'required|numeric|min_length[5]|max_length[5]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'numeric' => 'le nom doit être un nombre',
                    'min_length' => 'le nom doit contenir 5 caractere minimun',
                    'max_length' => ' le nom doit contenir 5 caractere maximun',
                ]
            ],
            'city' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'country' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
        ];
        if (!$this->validate($warehouse_rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'l\'entrepot à été creer avec success'
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
            'company_id' => $this->request->getPost('company_id'),
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'zipcode' => $this->request->getPost('zipcode'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
            'company_id' => $this->request->getPost('company_id'),
        ];
        $warehouse_rules = [
            'company_id' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le nom est requis',
                    'numeric' => 'le nom doit être un nombre',
                ]
            ],
            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'address' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'zipcode' => [
                'rules' => 'required|numeric|min_length[5]|max_length[5]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'numeric' => 'le nom doit être un nombre',
                    'min_length' => 'le nom doit contenir 5 caractere minimun',
                    'max_length' => ' le nom doit contenir 5 caractere maximun',
                ]
            ],
            'city' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'country' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
        ];
        if (!$this->validate($warehouse_rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'l\'entrepot à été modifier avec succès'
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
                    'success' => 'entrepot supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun entrepot trouver');
        }
    }
}
