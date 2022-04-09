<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductTypeModel extends Model
{
  protected $table = 'product_types';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'name',
    'descritpion',
  ];
}
