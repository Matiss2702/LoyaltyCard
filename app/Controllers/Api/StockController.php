<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class StockController extends ResourceController
{
    protected $modelName = 'App\Models\StockModel';
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
            return $this->failNotFound('aucun stock trouvé');
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
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
                    'success' => 'stock supprimer avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun stock trouver');
        }
    }
}
