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
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'electromenager',
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'accesoire',
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'vettement',
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'burautique',
                'description' => '',
                'status' => '1',
            ],
        ];
        $this->db->table('product_types')->insertBatch($data);
    }
}
