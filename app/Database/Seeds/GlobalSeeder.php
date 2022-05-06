<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GlobalSeeder extends Seeder{
    public function run(){
        $this->call('GroupSeeder');
        $this->call('ProductTypeSeeder');
        $this->call('SubcriptionSeeder');
        $this->call('UserSeeder');
        $this->call('ProductSeeder');
        $this->call('CompanySeeder');
        $this->call('PartnerSeeder');
    }
}
