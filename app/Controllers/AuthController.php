<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class AuthController extends BaseController {
    use ResponseTrait;

    public function login() {
        $session = session();
        $mail = $this->request->getPost('mail');
        $pwd = $this->request->getPost('password');
        $userModel =  new UserModel();
        $user = $userModel->where('mail', $mail)->first();
        $data = [ 'user' => $user, 'mail' => $mail, 'pwd' => $pwd];
        if($user){
            $pwd_check = password_verify(sha1($pwd), $user['password']);
            if($pwd_check){
                $ses_data = [
                    'id' => $user['id'],
                    'lastname' => $user['lastname'],
                    'firstname' => $user['firstname'],
                    'mail' => $user['email'],
                    'group_id' => '',
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return $this->respond($data, 200,'connexion réussi');
            }else{
                return $this->respond($data, 400,'mauvais mot de passe');
            }
        }else{
                return $this->respond($data, 400,'t\'existe pas mec');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('home');
    }
}
