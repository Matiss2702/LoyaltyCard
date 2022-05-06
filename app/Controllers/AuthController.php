<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\GroupModel;
use App\Models\PartnerModel;
use CodeIgniter\CLI\Console;

class AuthController extends BaseController {
    use ResponseTrait;

    public function login() {
        $session = \Config\Services::session();
        $mail = $this->request->getPost('mail');
        $pwd = $this->request->getPost('password');
        $userModel =  new UserModel();
        $groupModel = new GroupModel();
        $partnerModel = new PartnerModel();

        $user = $userModel->where('mail', $mail)->first();

        if(empty($user)) {
            $user = $partnerModel->where('mail', $mail)->first();
        }

        if($user){
            if($user['status']==1){
                if(sha1($pwd)==$user['password']){
                    $ses_data = [
                        'id' => $user['id'],
                        'lastname' => $user['lastname'],
                        'firstname' => $user['firstname'],
                        'mail' => $user['mail'],
                        'group' => $groupModel->find($user['group_id'])['name'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'message' =>  'connexion réussi'
                    ];
                    return $this->respond($response);
                }else{
                    return $this->fail('mauvais mot de passe');
                }
            }else{
                return $this->fail('votre compte n\'est pas activé');
            }
        }else{
            return $this->failNotFound('t\'existe pas mec');
        }
    }

    public function logout() {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect('/');
    }
}
