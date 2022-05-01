<?php
namespace App\Models;
use CodeIgniter\Model;

class CompanysModel extends Model{
    protected $table = 'companys';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'company_name',
        'address',
        'city',        
        'zipcode',
        'country',
        'subcription',
        'subcription_date',
        'status',
        'created_at',
        'modified_at',
    ];
}