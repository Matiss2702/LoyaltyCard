<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
class SubcriptionController extends ResourcePresenter
{
    protected $modelName = 'App\Models\SubcriptionModel';
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
            'title' => 'subcription',
            'nb_users' => $this->model->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/subcription', $data);
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
        $GroupModel = new GroupModel();
        $data = [
            'title'=> 'subscrire',
            'product' => $this->model->find($id),
            'group_id' => $groupModel->find($this->model->find($id)['group_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_subcription', $data);
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
            'price' => $this->request->getVar('price'),
            'nb_users' => $this->request->getVar('bn_users'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];
        $subcription_rules = [
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
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le prix est requis',
                    'numeric' => 'le prix doit etre un nombre',
                ]
            ],
            'nb_users' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le nombre d\'utilisateur est requis',
                    'numeric' => 'le nombre d\'utilisateur doit etre un nombre',
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
        if (!$this->validate($subcription_rules)) {
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
            'price' => $this->request->getVar('price'),
            'nb_users' => $this->request->getVar('bn_users'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];
        $subcription_rules = [
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
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le prix est requis',
                    'numeric' => 'le prix doit etre un nombre',
                ]
            ],
            'nb_users' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'le nombre d\'utilisateur est requis',
                    'numeric' => 'le nombre d\'utilisateur doit etre un nombre',
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
        
        if (!$this->validate($subcription_rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'categorie de produit modifier avec succès'
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
                    'success' => 'subcription supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun subcription trouver');
        }
    }
}
