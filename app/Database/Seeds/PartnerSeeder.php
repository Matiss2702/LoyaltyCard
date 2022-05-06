<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PartnerSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'password' => sha1('TOTO55'),
                'lastname' => 'flemme',
                'firstname' => 'matiss',
                'mail' => 'nis@gmail.com',
                'company_id' => 1,
                'group_id' => 2,
                'status'=> '1'
            ],
            [
                'password' => sha1('TOTO55'),
                'lastname' => 'flemme',
                'firstname' => 'matiss',
                'mail' => 'momo@gmail.com',
                'company_id' => 1,
                'group_id' => 3,
                'status'=> '1'
            ],
            [
                'password' => sha1('TOTO55'),
                'lastname' => 'flemme',
                'firstname' => 'matiss',
                'mail' => 'jojo@gmail.com',
                'company_id' => 2,
                'group_id' => 2,
                'status' => '1'
            ],
            [
                'password' => sha1('TOTO55'),
                'lastname' => 'flemme',
                'firstname' => 'matiss',
                'mail' => 'nana@gmail.com',
                'company_id' => 2,
                'group_id' => 3,
                'status' => '1'
            ],
        ];
        $this->db->table('partners')->insertBatch($data);
    }
}
