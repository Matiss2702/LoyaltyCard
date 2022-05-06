<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'company_name' => "Mongomery",
                'address' => '20 rue jean paul',
                'city' => 'paris',
                'zipcode' => '77000',
                'country' => 'pologne',
                'subcription' => 2,
                'subcription_date' => "",
                'status' => '1',
            ],
            [
                'company_name' => "Catexo",
                'address' => '20 rue jean paul',
                'city' => 'paris',
                'zipcode' => '77000',
                'country' => 'pologne',
                'subcription' => 1,
                'subcription_date' => "",
                'status' => '1',
            ],
        ];
        $this->db->table('companys')->insertBatch($data);
    }
}
