<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'name' => 'super_admin',
                'description' => '',
            ],
            [
                'name' => 'admin',
                'description' => '',
            ],
            [
                'name' => 'manager',
                'description' => '',
            ],
            [
                'name' => 'user',
                'description' => '',
            ]
        ];
        $this->db->table('groups')->insertBatch($data);
    }
}
