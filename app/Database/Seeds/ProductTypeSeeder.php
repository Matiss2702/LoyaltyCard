<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'multimedia',
                'description'=>'',
            ],
            [
                'name' => 'electromenager',
                'description'=>'',
            ],
            [
                'name' => 'accesoire',
                'description'=>'',
            ],
            [
                'name' => 'vettement',
                'description'=>'',
            ],
            [
                'name' => 'burautique',
                'description'=>'',
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
