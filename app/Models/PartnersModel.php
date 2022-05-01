<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnersModel extends Model
{
  protected $table = 'partners';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'lastname',
    'firstname', 
    'password',
    'mail',
    'groups_id',
    'company_id',
    'subcription_id',
    'subcription_date',
    'status',
    'created_at',
    'modified_at',
];
}
