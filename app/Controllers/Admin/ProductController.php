<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use App\Models\ProductTypeModel;


class ProductController extends ResourcePresenter
{
    protected $modelName = 'App\Models\ProductModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {   
        $productTypeModel = new ProductTypeModel();
        $data = [
            'title' => 'produit',
            'products' => $this->model->findAll(),
            'productTypes' => $productTypeModel->findAll(),
        ];
        return view('admin/products', $data);
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
            'title'=> 'Produit',
            'product' => $this->model->find($id),
            'product_type' => $productTypeModel->find($this->model->find($id)['product_types_id']),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_product', $data);
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
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'image' => $this->request->getPost('image'),
            'reduction' => $this->request->getPost('reduction'),
            'product_types_id' => $this->request->getPost('product_types_id'),
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
                'rules'=>'is_image[image]|max_dims[image,600,500]|mime_in[image,image/png,image/jpg,image/jpeg,image/gif]|max_size[image,2048]|uploaded[image]|ext_in[image,png,jpg,gif,jpeg]|required|regex_match[/\d{4}-(0?[1-9]|1[012])-(0?[1-9]|[12][0-9]|3[01])*([0-9a-zA-Z :\-!@$%^&*()])+(.jpg|.JPG|.jpeg|.JPEG|.png|.PNG|.gif|.GIF)/]',
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
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
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
