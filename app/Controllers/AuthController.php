<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class AuthController extends BaseController {
    use ResponseTrait;

    public function login() {
        $session = \Config\Services::session();
        $mail = $this->request->getPost('mail');
        $pwd = $this->request->getPost('password');
        $userModel =  new UserModel();
        $user = $userModel->where('mail', $mail)->first();
        $data = [ 'user' => $user, 'mail' => $mail, 'pwd' => sha1($pwd)];
        if($user){
            if($user['status']==1){
                if(sha1($pwd)==$user['password']){
                    $ses_data = [
                        'id' => $user['id'],
                        'lastname' => $user['lastname'],
                        'firstname' => $user['firstname'],
                        'mail' => $user['mail'],
                        'group_id' => $user['groups_id'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    $data['message'] = 'connexion reussi!';
                    return $this->respond($data, 200,'connexion réussi');
                }else{
                    return $this->respond($data, 400,'mauvais mot de passe');
                }
            }else{
                return $this->respond($data, 400,'votre compte n\'est pas activé');
            }
        }else{
                return $this->respond($data, 400,'t\'existe pas mec');
        }
    }

    public function logout() {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect('/');
    }
}
