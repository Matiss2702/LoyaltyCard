<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerModel extends Model
{
  protected $table = 'partners';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'lastname',
    'firstname',
    'password',
    'mail',
    'group_id',
    'company_id',
    'status',
    'created_at',
    'modified_at',
];
}
