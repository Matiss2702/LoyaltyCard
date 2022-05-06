<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class SubscriptionController extends ResourceController
{
    protected $modelName = 'App\Models\SubcriptionModel';
    protected $format    = 'json';
    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return  $this->respond($this->model->findAll());
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('aucune formule trouvé');
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'nb_users' => $this->request->getPost('nb_users'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getPost('status'),
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
            'price' => [
                'rules' => 'decimal|required',
                'errors' => [
                    'required' => 'l\'adresse doit etre',
                    'decimal' => 'il doit contenir que des chiffre',
                ]
            ],
            'nb_users' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'numeric' => 'ce n\'est pas une image',
                    'required' => 'le pats doit etre donnée',

                ]
            ],
            'status' => [
                'rules' => 'numeric|required|max_length[1]|min_length[1]',
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
                'success' => 'formule creer avec success'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'nb_users' => $this->request->getPost('nb_users'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getPost('status'),
            'modified_at' => Time::now()->toDateTimeString(),
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
            'price' => [
                'rules' => 'decimal|required',
                'errors' => [
                    'required' => 'l\'adresse doit etre',
                    'decimal' => 'il doit contenir que des chiffre',
                ]
            ],
            'nb_users' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'numeric' => 'ce n\'est pas une image',
                    'required' => 'le pats doit etre donnée',

                ]
            ],
            'status' => [
                'rules' => 'numeric|required|max_length[1]|min_length[1]',
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
                'success' => 'formule modifier avec succès'
            ]
        ];

        return $this->respond($response);

    }

    /**
     * Delete the designated resource object from the model
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
                    'success' => 'formule supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucune formule trouver');
        }
    }
}
