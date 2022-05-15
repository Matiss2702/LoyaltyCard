<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'invoice_prefix',
        'invoice_no',
        'users_id',
        'total',
        'reduction',
        'payment_country',
        'payment_firstname',
        'payment_lastname',
        'payment_compagny',
        'payment_address',
        'payment_city',
        'payment_zipcode' ,
        'comment' ,
        'status',
        'created_at',
        'modified_at',
    ];
}

