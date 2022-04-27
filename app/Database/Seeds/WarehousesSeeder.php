<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WarehousesSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'address' => '444 rue jean paul',
                'city' => 'paris',
                'zipcode' => '77000',
                'country' => 'pologne',
            ]
        ];
        $this->db->table('warehouses')->insertBatch($data);
    }
}
