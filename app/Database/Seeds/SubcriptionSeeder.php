<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubcriptionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Free',
                'price' => 0,
                'nb_users' => 1,
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'Mini',
                'price' => 9.99,
                'nb_users' => 4,
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'Medium',
                'price' => 29.99,
                'nb_users' => 20,
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'Maxi',
                'price' => 99.99,
                'nb_users' => 100,
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'Unlimited',
                'price' => 299999.99,
                'nb_users' => 100000,
                'description' => '',
                'status' => '1',
            ],
        ];
        $this->db->table('subcriptions')->insertBatch($data);
    }
}
