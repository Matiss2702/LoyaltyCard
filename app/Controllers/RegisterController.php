<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class RegisterController extends BaseController {
    use ResponseTrait;

    public function register() {
        $userModel =  new UserModel();
        $validation = \Config\Services::validation();
        $data = [
                'lastname' => $this->request->getPost('lastname'),
                'firstname' => $this->request->getPost('firstname'),
                'mail' => $this->request->getPost('mail'),
                'password' => sha1($this->request->getPost('password')),
                'groups_id' => 4,
        ];

        $register_rules = [
          'lastname' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
            'errors' => [
              'required' => 'le nom est requis',
              'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
              'min_length' => 'le nom doit contenir 3 caractere minimun',
              'max_length' => ' le nom doit contenir 10 caractere maximun',
            ]
          ],
          'firstname' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
            'errors' =>  [
              'required' => 'le prenom est requis',
              'alpha_numeric_space' => 'le prenom ne doit pas contenir de caractere spéciaux' ,
              'min_length' => 'le prenom doit contenir 3 caractere minimun',
              'max_length' => ' le prenom doit contenir 10 caractere maximun',
            ]
          ],
          'mail' => [
            'rules' =>'required|valid_email|is_unique[users.mail]',
            'errors' => [
              'required' => 'le mail est requis',
              'valid_email' => 'le mail doit etre valid',
              'is_unique' => 'le mail est déjà utilisé',
            ]
          ],
          'password' => [
            'rules' =>'required|min_length[8]',
            'errors' =>  [
              'required' =>'le mot de passe est requis',
              'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
            ]
          ],
          'pass_confirm' => [
            'rules' =>'required_with[password]|matches[password]',
            'errors' => [
              'required_with' =>'le mot de passe doit etre remplis avant ',
              'matches' =>'le confirmation doit corespondre au mot de passe',
            ]
          ]
        ];

        if($this->validate($register_rules)){
          $userModel = new UserModel();
          $user = $userModel->insert($data);
          $id = $userModel->insertID;
          $userInfo = [
              'lastname' => $data['lastname'],
              'firstname' => $data['firstname'],
              'url' => 'confirm/'.$id.'a'.sha1($data['mail'])

          ];
          $email = \Config\Services::email(); // loading for use
          $email->setTo($data['mail']);
          $email->setSubject('Activation de Votre Compte LoyaltyCard');
          // Using a custom template
          $template = view('mail/activate-mail', $userInfo);
          $email->setMessage($template);
          // Send email
          $reponse = [
            'message' => 'votre compte à bien été crée. Vous allez recevoir un email pour valider votre compte.'
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

    public function confirm($hash) {
      $session = \Config\Services::session();
      $userModel =  new UserModel();
      $id = substr($hash, 0, strpos($hash, 'a'));
      $user = $userModel->where('id', $id)->first();
      if($user['status'] == 0) {
        $data = [
          'status' => '1'
        ];
        $userModel->update((int)$id,$data);
        $session->setFlashdata('activate', 'Votre compte a bien été activer');
        return redirect('/');
      } else {
        $session->setFlashdata('activate', 'Votre compte est déjà activer');
        return redirect('/');
      }
    }
}
