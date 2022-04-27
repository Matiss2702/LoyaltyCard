<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanysSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            ]
        ];
        $this->db->table('companys')->insertBatch($data);
    }
}
