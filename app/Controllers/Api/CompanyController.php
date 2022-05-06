<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class CompanyController extends ResourceController
{
    protected $modelName = 'App\Models\CompanyModel';
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
            return $this->failNotFound('aucune company trouvé');
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
            'company_name' => $this->request->getVar('company_name'),
            'address' => $this->request->getVar('address'),
            'city' => $this->request->getVar('city'),
            'zipcode' => $this->request->getVar('zipcode'),
            'country' => $this->request->getVar('country'),
            'subcription' => $this->request->getVar('subcription'),
            'subcription_date' => $this->request->getVar('subcription_date'),
            'status' => $this->request->getVar('status'),
            'modified_at' => Time::now()->toDateTimeString(),
        ];
        $rules = [
            'company_name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'address' => [
                'rules' => 'alpha_numeric_space|required',
                'errors' => [
                    'required' => 'l\'adresse doit etre',
                    'alpha_numeric_space' => 'il ne doit pas contenir des caractere spéciaux'
                ]
            ],
            'country' => [
                'rules' => 'alpha|required',
                'errors' => [
                    'alpha' => 'il doit contenir que des caractere',
                    'required' => 'le pats doit etre donnée'
                ]
            ],
            'city' => [
                'rules' => 'alpha|required',
                'errors' => [
                    'required' => 'la ville doit etre donnée',
                    'alpha' => 'il doit contenir que des caractere',
                ]
            ],
            'zipcode' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'subcription' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'subcription_date' => [
                'rules' => 'valid_date[Y-m-d]|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'valid_date' => 'la date doit  être sous le format yyyy-mm-dd',
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
                'success' => 'company creer avec success'
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
            'company_name' => $this->request->getVar('company_name'),
            'address' => $this->request->getVar('address'),
            'city' => $this->request->getVar('city'),
            'zipcode' => $this->request->getVar('zipcode'),
            'country' => $this->request->getVar('country'),
            'subcription' => $this->request->getVar('subcription'),
            'subcription_date' => $this->request->getVar('subcription_date'),
            'status' => $this->request->getVar('status'),
            'modified_at' => Time::now()->toDateTimeString(),
        ];
        $rules = [
            'company_name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 30 caractere maximun',
                ]
            ],
            'address' => [
                'rules' => 'alpha_numeric_space|required',
                'errors' => [
                    'required' => 'l\'adresse doit etre',
                    'alpha_numeric_space' => 'il ne doit pas contenir des caractere spéciaux'
                ]
            ],
            'country' => [
                'rules' => 'alpha|required',
                'errors' => [
                    'alpha' => 'il doit contenir que des caractere',
                    'required' => 'le pats doit etre donnée'
                ]
            ],
            'city' => [
                'rules' => 'alpha|required',
                'errors' => [
                    'required' => 'la ville doit etre donnée',
                    'alpha' => 'il doit contenir que des caractere',
                ]
            ],
            'zipcode' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'subcription' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'subcription_date' => [
                'rules' => 'valid_date[Y-m-d]|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'valid_date' => 'la date doit  être sous le format yyyy-mm-dd',
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
                'success' => 'company modifier avec succès'
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
                    'success' => 'company supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucune company trouver');
        }
    }
}
