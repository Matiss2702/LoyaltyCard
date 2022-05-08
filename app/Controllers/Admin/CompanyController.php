<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;

class CompanysController extends ResourcePresenter
{
    protected $modelName = 'App\Models\CompanyModel';
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
            'title' => 'entreprise',
            'company' => $this->model->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/company', $data);
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
            'title'=> 'Entreprise',
            'company' => $this->model->find($id),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_entreprise', $data);
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        //
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
            'company_name' => $this->request->getPost('company_name'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'zipcode' => $this->request->getPost('zipcode'),
            'country' => $this->request->getPost('country'),
            'subcription' => $this->request->getPost('subcription'),
            'subcription_date' => $this->request->getPost('subcription_date'),
            'status' => $this->request->getPost('status'),
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
            'company_name' => $this->request->getPost('company_name'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'zipcode' => $this->request->getPost('zipcode'),
            'country' => $this->request->getPost('country'),
            'subcription' => $this->request->getPost('subcription'),
            'subcription_date' => $this->request->getPost('subcription_date'),
            'status' => $this->request->getPost('status'),
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
                    'success' => 'company supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun company trouver');
        }
    }
}
