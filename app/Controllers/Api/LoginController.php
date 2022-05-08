<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use App\Models\UserModel;
use App\Models\PartnerModel;
use App\Models\GroupModel;


class LoginController extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $userModel =  new UserModel();
        $groupModel = new GroupModel();
        $partnerModel = new PartnerModel();

        $data = [
            'password' => sha1($this->request->getVar('password')),
            'mail' => $this->request->getVar('mail'),
        ];
        $rules = [
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' =>  [
                    'required' => 'le mot de passe est requis',
                    'min_length' => 'le mot de passe doit contenir 6 caractere minimun',
                ]
            ],
       
            'mail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'le mail est requis',
                    'valid_email' => 'le mail doit etre valid',
                ]
            ],          
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }
        $user = $userModel->where('mail', $data['mail'])->first();

        if(empty($user)) {
            $user = $partnerModel->where('mail', $data['mail'])->first();
        }
        if(empty($user)) {
            return $this->failNotFound('aucun utilisateur trouvé');
        }
        if($user['password'] != $data['password']) {
            return $this->fail('mot de passe incorrect');
        }
        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + (60 * 60 * 24 * 7);
        $user_data ='{ 
            "id" :'.$user['id'].',
            "lastname":"'.$user['lastname'].'",
            "firstname":"'.$user['firstname'].'",
            "mail":"'.$user['mail'].'",
            "group":"'.$groupModel->find($user['group_id'])['name'].'"
        }';
        $payload = array(
            "iat" => $iat,
            "exp" => $exp,
            "user" => $user_data
        );
        $token = JWT::encode($payload, $key,'HS256');
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
        return $this->respond($response,200);
    }
}
