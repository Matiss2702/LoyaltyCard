<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'password',
        'lastname',
        'firstname',
        'mail',
        'address',
        'city',
        'zipcode',
        'country',
        'group_id',
        'fidelity_points',
        'status',
        'created_at',
        'modified_at',
    ];
}
