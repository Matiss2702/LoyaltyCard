<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;


class UploadController extends BaseController
{
    use ResponseTrait;

    public function add_image()
    {
        $img_rules = [
            'file' => [
                'rules' => 'is_image[file]|mime_in[file,image/png,image/jpg,image/jpeg,image/gif]|max_dims[file,700,700]|max_size[file,2048]|uploaded[file]|ext_in[file,png,jpg,gif,jpeg]',
                'errors' => [
                    'is_image' => 'ce n\'est pas une image',
                    'max_dims' => 'la taille de l\'image doit etre inferieur a 700x700',
                    'max_size' => 'la taille de l\'image doit etre inferieur a 2Mo',
                    'uploaded' => 'le fichier n\'est pas téléchargé',
                    'ext_in' => 'le format de l\'image doit etre png,jpg,gif,jpeg',
                ]
            ]
        ];

        if (!$this->validate($img_rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $file = $this->request->getFile('file');
        $name = $file->getName();
        $file->move('images', $name);

        if(!$file->hasMoved()) {
            $response = [
                'status'   => 400,
                'error'    => null,
                'messages' =>  [
                    'l\'image n\'a pas été upload'
                ],
            ];
            return $this->fail($response);
        }

        $response = [
            'status'   => 200,
            'error'    => null,
            'message' =>'l\'image a  été upload',
        ];
        return $this->respond($response);
    }
}
