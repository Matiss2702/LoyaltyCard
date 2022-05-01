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
        $data = $this->model->where('id', $id)->first();
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
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'image' => $this->request->getPost('img'),
            'reduction' => $this->request->getPost('reduction'),
            'product_type_id' => $this->request->getPost('type'),
            'status' => $this->request->getPost('status'),
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
              'image'=>[
                'rules'=>'is_image[image]|max_dims[image,600,500]|max_size[image,2048]|uploaded[image]|ext_in[image,png,jpg,gif,jpeg]|required|regex_match[/\d{4}-(0?[1-9]|1[012])-(0?[1-9]|[12][0-9]|3[01])*([0-9a-zA-Z :\-!@$%^&*()])+(.jpg|.JPG|.jpeg|.JPEG|.png|.PNG|.gif|.GIF)/]',
                'errors'=>[
                    'is_image'=>'ce n\'est pas une image',
                    'required'=>'le pats doit etre donnée',
                    'max_dims'=>'la taille de l\'image doit etre inferieur a 600*500',
                    'max_size'=>'la taille de l\'image doit etre inferieur a 2Mo',
                    'uploaded'=>'le fichier n\'est pas téléchargé',
                    'regex_match'=>'le nom du fichier doit etre nomée sous le format 2022-01-24_nom_de_fichier.ext',
                    'ext_in'=>'le format de l\'image doit etre png,jpg,gif,jpeg',
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
        $imageFile = $this->request->getFile('file');
        $imageFile->move(WRITEPATH.'public/images');
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
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */

    
    public function update($id = null)
    {
        $data = [
            'name' => $this->request->getPost(''),
            'price' => $this->request->getPost(''),
            'image' => $this->request->getPost(''),
            'reduction' => $this->request->getPost(''),
            'product_type_id' => $this->request->getPost(''),
            'status' => $this->request->getPost(''),
            'modified_at' => Time::now()->toDateTimeString(),
        ];

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Employee updated successfully'
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
