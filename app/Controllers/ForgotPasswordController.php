<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class ForgotPasswordController extends BaseController {
    use ResponseTrait;

    public function forgot() {
        $userModel =  new UserModel();
        $validation = \Config\Services::validation();
        $data = [
            'mail' => $this->request->getPost('mail'),
        ];

        $register_rules = [
          'mail' => [
            'rules' =>'required|valid_email',
            'errors' => [
              'required' => 'le mail est requis',
              'valid_email' => 'le mail doit etre valid',
            ]
          ],
        ];

        if($this->validate($register_rules)){
          $userModel = new UserModel();
          $user = $userModel->where('mail', $data['mail'])->first();
          $userInfo = [
              'lastname' => $user['lastname'],
              'firstname' => $user['firstname'],
              'url' => 'reset/'.$user['id'].'a'.sha1($user['mail'])

          ];
          $email = \Config\Services::email(); // loading for use
          $email->setTo($user['mail']);
          $email->setSubject('mots de passe oublié');
          // Using a custom template
          $template = view('mail/reset-mail', $userInfo);
          $email->setMessage($template);
          // Send email
          $reponse = [
            'message' => 'Vous allez recevoir un email pour changer votre mots de passe.'
          ];
          if ($email->send()) {
            return $this->respondCreated($reponse);
          } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
          }
          }else{
            $errors = $validation->getErrors();
            return $this->fail($errors);
          }
    }

    public function reset($hash) {
      $session = \Config\Services::session();
      $userModel =  new UserModel();
      $id = substr($hash, 0, strpos($hash, 'a'));
      $user = $userModel->where('id', $id)->first();
      $data = [
        'lastname' => $user['lastname'],
        'firstname' => $user['firstname'],
        'id' => $id
      ];
      return view('forgot',$data);
    }
    public function reset_confirm(){
        
    }
}
