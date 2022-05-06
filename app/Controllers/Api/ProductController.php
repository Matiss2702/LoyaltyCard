<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class ProductController extends ResourceController
{
    protected $modelName = 'App\Models\ProductModel';
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
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('aucun produit trouvé');
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
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
            'image' => $this->request->getVar('image'),
            'reduction' => $this->request->getVar('reduction'),
            'product_types_id' => $this->request->getVar('product_types_id'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];

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
            'image' => [
                'rules' => 'required|regex_match[/\d{4}-(0?[1-9]|1[012])-(0?[1-9]|[12][0-9]|3[01])_[A-Za-z0-9_@#-]*+(.jpg|.JPG|.jpeg|.JPEG|.png|.PNG|.gif|.GIF)/]',
                'errors' => [
                    'required' => 'l\'image est requise',
                    'regex_match' => 'le nom du fichier doit etre nomée sous le format 2022-01-24_nom_de_fichier.ext',
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
                'success' => 'produit créer avec succès'
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
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
            'image' => $this->request->getVar('image'),
            'reduction' => $this->request->getVar('reduction'),
            'product_types_id' => $this->request->getVar('product_types_id'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
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
            'image' => [
                'rules' => 'required|regex_match[/\d{4}-(0?[1-9]|1[012])-(0?[1-9]|[12][0-9]|3[01])_[A-Za-z0-9_@#-]*+(.jpg|.JPG|.jpeg|.JPEG|.png|.PNG|.gif|.GIF)/]',
                'errors' => [
                    'required' => 'l\'image est requise',
                    'regex_match' => 'le nom du fichier doit etre nomée sous le format 2022-01-24_nom_de_fichier.ext',
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

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'produit modifier avec succès'
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
                    'success' => 'produit supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun produit trouver');
        }
    }
}
