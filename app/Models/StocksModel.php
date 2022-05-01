<?php
namespace App\Models;
use CodeIgniter\Model;

class StocksModel extends Model{
    protected $table = 'stocks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'warehouses_id',
        'products_id',
        'quantity',
    ];
}