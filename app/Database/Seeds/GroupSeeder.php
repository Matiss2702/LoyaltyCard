<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'name' => 'super_admin',
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'admin',
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'manager',
                'description' => '',
                'status' => '1',
            ],
            [
                'name' => 'user',
                'description' => '',
                'status' => '1',
            ]
        ];
        $this->db->table('groups')->insertBatch($data);
    }
}
