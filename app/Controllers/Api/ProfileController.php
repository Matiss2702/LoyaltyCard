<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserModel;
use App\Models\PartnerModel;

class ProfileController extends ResourceController
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
        $partnerModel = new PartnerModel();

        $key = getenv('JWT_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = null;
 
        // extract the token from the header
        if(!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $token = $matches[1];
            }
        }
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $data=$decoded->user;
            var_dump($data);
            var_dump(json_decode(json_encode($data), true)['id']);
            $user = $userModel->find($decoded->user['id']);
            

            if(empty($user)) {
                $user = $partnerModel->find($decoded->user['id']);
            }
            if(empty($user)) {
                return $this->failNotFound('aucun utilisateur trouvé');
            }
            return $this->respond($data);
        } catch (Exception $ex) {
            return $this->fail('Invalid Token');
        }
    }
}
