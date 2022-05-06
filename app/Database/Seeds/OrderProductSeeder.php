<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrderProductSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'quantity' => '300',
                'sub_total' => '',
            ]

        ];
        $this->db->table('order_products')->insertBatch($data);
    }
}
