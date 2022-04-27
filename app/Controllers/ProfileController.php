<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class ProfileController extends BaseController {
    use ResponseTrait;

    public function profile() {
        $session = \Config\Services::session();
        $userModel =  new UserModel();
        $id = $session->get('id');
        $user = $userModel->where('id', $id)->first();
        $data = [
            'title'=> 'Profile',
            'user' => $user,         
            'is_login' => $session->get('isLoggedIn'),
        ];
            
        return view('profile',$data);
 //requete get faire un new user model -> where find user by id revoie des donnée sur une vieuw qui s appellera profil.php
    }

    public function update() {
        $session = \Config\Services::session();
        $validation = \Config\Services::validation();
        $profile_rules = [
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
            'address'=>[
              'rules'=>'alpha_numeric_space|required',
              'errors'=>[
              'required'=>'l\'adresse doit etre',
              'alpha_numeric_space'=>'il ne doit pas contenir des caractere spéciaux'
             ]
            ],
            'country'=>[
              'rules'=>'alpha|required',
              'errors'=>[
                  'alpha'=>'il doit contenir que des caractere',
                  'required'=>'le pats doit etre donnée'
             ]
            ],
            'city'=>[
              'rules'=>'alpha|required',
              'errors'=>[
                'required'=>'la ville doit etre donnée',
                'alpha'=>'il doit contenir que des caractere',
              ]
            ],
            'zipcode'=>[
              'rules'=>'numeric|required',
              'errors'=>[
                'required'=>'le code postale doit etre donnée',
                'numeric'=>'il doit contenir que des chiffres',
              ]
            ],
            //a finir
          ];
          $password = $this->request->getPost('password');
          if(isset($password)){
            $profile_rules['password'] = [
              'rules' =>'required|min_length[8]',
              'errors' =>  [
                'required' =>'le mot de passe est requis',
                'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
              ]
              ];
              
              $profile_rules['pass_confirm'] = [
              'rules' =>'required_with[password]|matches[password]',
              'errors' => [
                'required_with' =>'le mot de passe doit etre remplis avant ',
                'matches' =>'le confirmation doit corespondre au mot de passe',
              ]
              ]; 
          }
        if($this->validate($profile_rules)){
            $userModel = new UserModel();
           $data = [ 
            'lastname' =>  $this->request->getPost('lastname'),
            'firstname' =>  $this->request->getPost('firstname'),
            'address' =>  $this->request->getPost('address'),
            'city' =>  $this->request->getPost('city'),
            'zipcode' =>  $this->request->getPost('zipcode'),
            'country' =>  $this->request->getPost('country'),
           ];
           
           
           if(isset($password)){
              $data['password'] = sha1($password);
           }
            $userModel->update((int)$session->get('id'),$data);
            $reponse = [
              'message' => 'votre profile a bien été modifié.'
            ];
             return $this->respond($reponse,200);
          }else{
              $errors = $validation->getErrors();
              return $this->fail($errors);
          }
      }
 //copier la façon du formulaire de forgot dans le main?js add function update_user() parametre token requete post en ajax dans le controller on fait un update look reset confirm
}

    