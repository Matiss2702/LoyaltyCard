<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class RegisterController extends BaseController {
    use ResponseTrait;

    public function profile() {
        $session = \Config\Services::session();
 //requete get faire un new user model -> where find user by id revoie des donnée sur une vieuw qui s appellera profil.php
    }

    public function update() {
        $session = \Config\Services::session();
 //copier la façon du formulaire de forgot dans le main?js add function update_user() parametre token requete post en ajax dans le controller on fait un update look reset confirm

    }
}
