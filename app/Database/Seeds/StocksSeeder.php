<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StocksSeeder extends Seeder {
    public function run() {
        $data = [
            [
            ]
        ];
        $this->db->table('stocks')->insertBatch($data);
    }
}
