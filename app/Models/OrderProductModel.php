<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderProductModel extends Model{
    protected $table = 'order_products';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'orders_id',
        'products_id',
        'quantity',
        'sub_total',
    ];
}
