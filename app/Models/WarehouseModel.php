<?php
namespace App\Models;
use CodeIgniter\Model;

class WarehouseModel extends Model{
    protected $table = 'warehouses';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'company_id',
        'address',
        'city',
        'zipcode',
        'country',
        'status',
        'created_at',
        'modified_at',
    ];
}
