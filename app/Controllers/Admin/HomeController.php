<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
      
        $session = \Config\Services::session();
        $data = [
            'title' => 'Acceuil',
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/home', $data);
    }
}
