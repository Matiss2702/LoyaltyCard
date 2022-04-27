<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'name',
    'price',
    'image',
    'reduction',
    'product_type_id',
    'status',
    'created_at',
    'modified_at',
  ];
}
