<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder {
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
                'group_id' => 1,
                'status'=> '1',
            ],
            [
                'password' => sha1('TOTO56'),
                'lastname' => 'fl',
                'firstname' => 'miss',
                'mail' => 'mis@gmail.com',
                'address' => '20 rue jean paul',
                'city' => 'paris',
                'zipcode' => '77000',
                'country' => 'pologne',
                'group_id' => 2,
                'status'=> '1',
            ]

        ];
        $this->db->table('users')->insertBatch($data);
    }
}
