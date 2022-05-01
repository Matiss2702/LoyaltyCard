<?php
namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model{
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
        'groups_id',
        'fidelity_points',
        'status',
        'created_at',
        'modified_at',
    ];
}