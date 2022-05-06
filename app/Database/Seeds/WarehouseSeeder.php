<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WarehouseSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'name' => 'entrepot b',
                'company_id' => 1,
                'address' => '444 rue jean paul',
                'city' => 'paris',
                'zipcode' => '77000',
                'country' => 'pologne',
                'status' => '1',
            ]
        ];
        $this->db->table('warehouses')->insertBatch($data);
    }
}
