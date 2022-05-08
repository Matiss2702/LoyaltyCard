<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
class PartnerController extends ResourcePresenter
{
    protected $modelName = 'App\Models\PartnerModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $session = \Config\Services::session();
        $GroupModel = new GroupModel();
        $PartnerModel = new PartnerModel();
        $data = [
            'title' => 'partenaire',
            'products' => $this->model->findAll(),
            'group_id' => $productTypeModel->findAll(),
            'company_id' => $productTypeModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/partner', $data);
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
        $PartnerModel = new PartnerModel();
        $data = [
            'title'=> 'partenaire',
            'product' => $this->model->find($id),
            'group_id' => $groupModel->find($this->model->find($id)['group_id']),
            'company' => $companyModel->find($this->model->find($id)['company_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_partner', $data);
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
            'password' => sha1($this->request->getVar('password')),
            'lastname' => $this->request->getVar('lastname'),
            'firstname' => $this->request->getVar('firstname'),
            'mail' => $this->request->getVar('mail'),
            'group_id' => $this->request->getVar('group_id'),
            'company_id' => $this->request->getVar('company_id'),
            'status' => $this->request->getVar('status'),
        ];
        $rules = [
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' =>  [
                    'required' => 'le mot de passe est requis',
                    'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
                ]
            ],
            'pass_confirm' => [
                'rules' => 'required_with[password]|matches[password]',
                'errors' => [
                    'required_with' => 'le mot de passe doit etre remplis avant ',
                    'matches' => 'le confirmation doit corespondre au mot de passe',
                ]
            ],
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
                'rules' => 'required|valid_email|is_unique[users.mail]',
                'errors' => [
                    'required' => 'le mail est requis',
                    'valid_email' => 'le mail doit etre valid',
                    'is_unique' => 'le mail est déjà utilisé',
                ]
            ],
            'group_id' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'company_id' => [
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

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'partenaire creer avec success'
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
            'password' => sha1($this->request->getVar('password')),
            'lastname' => $this->request->getVar('lastname'),
            'firstname' => $this->request->getVar('firstname'),
            'mail' => $this->request->getVar('mail'),
            'group_id' => $this->request->getVar('group_id'),
            'company_id' => $this->request->getVar('company_id'),
            'status' => $this->request->getVar('status'),
            'modified_at' => Time::now()->toDateTimeString(),
        ];
        $rules = [
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' =>  [
                    'required' => 'le mot de passe est requis',
                    'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
                ]
            ],
            'pass_confirm' => [
                'rules' => 'required_with[password]|matches[password]',
                'errors' => [
                    'required_with' => 'le mot de passe doit etre remplis avant ',
                    'matches' => 'le confirmation doit corespondre au mot de passe',
                ]
            ],
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
                'rules' => 'required|valid_email|is_unique[users.mail]',
                'errors' => [
                    'required' => 'le mail est requis',
                    'valid_email' => 'le mail doit etre valid',
                    'is_unique' => 'le mail est déjà utilisé',
                ]
            ],
            'group_id' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'company_id' => [
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

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'partenaire modifier avec succès'
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
        $data = $this->model->find($id);
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'partenaire supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun partenaire trouver');
        }
    }
}
