<?php
namespace App\Models;
use CodeIgniter\Model;

class SubcriptionsModel extends Model{
    protected $table = 'subcriptions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'price',
        'nb_users',
        'descritpion',
        'status',
        'created_at',
        'modified_at',
    ];
}
