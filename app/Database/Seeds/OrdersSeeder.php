<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrdersSeeder extends Seeder {
    public function run() {
        $data = [
            [
         
            ]
        ];
        $this->db->table('orders')->insertBatch($data);
    }
}
