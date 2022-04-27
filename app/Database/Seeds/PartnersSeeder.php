<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PartnersSeeder extends Seeder {
    public function run() {
        $data = [
            [
            'password' => sha1('TOTO55'),
            'lastname' => 'flemme',
            'firstname' => 'matiss',
            'mail' => 'matis@gmail.com',
            'address' => '20 rue jean paul',
            'city' => 'paris',
            'zipcode' => '77000',
            'country' => 'pologne',
            'groups_id' => 1,
            'status'=> 1
            ]
        ];
        $this->db->table('partners')->insertBatch($data);
    }
}
