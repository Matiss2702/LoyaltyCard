<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'barcelet',
                'price' => '10',
                'image' => 'barcelet.jpg',
                'reduction' => '0.1',
                'product_types_id' => 3,
                'status' => 1
            ],
            
            [
                'name' =>'t-short',
                'price' =>'25',
                'image'=>'t-short.png',
                'reduction'=>'0.2',
                'product_types_id'=>4,
                'status' => 1
            ],
            
            [
                'name' => 'caftiere',
                'price' =>'120',
                'image'=>'cafetiere.jpg',
                'reduction'=>'0.4',
                'product_types_id'=>2,
                'status' => 1
            ],
            
            [
                'name' => 'collier' ,
                'price' =>'300',
                'image'=>'collier.jpg',
                'reduction'=>'0.2',
                'product_types_id'=>3,
                'status' => 1
            ],
            
            [
                'name' => 'ecran' ,
                'price' => '500',
                'image'=>'ecran.jpg',
                'reduction'=>'0.5',
                'product_types_id'=>5,
                'status' => 1
            ],
            
            [
                'name' =>'iphone 5' ,
                'price' =>'400',
                'image'=>'iphone.jpg',
                'reduction'=>'0.1',
                'product_types_id'=>1,
                'status' => 1
            ],
            
            [
                'name' =>'boucle d\'oreille' ,
                'price' =>'30',
                'image'=>'boucle.jpg',
                'reduction'=>'0.0',
                'product_types_id'=>3,
                'status' => 1
            ],
            
            [
                'name' => 'tablette',
                'price' =>'500',
                'image'=>'tablette.jpg',
                'reduction'=>'0.4',
                'product_types_id'=>1,
                'status' => 1
            ],
            
            [
                'name' =>'trotinette' ,
                'price' => '150',
                'image'=>'trotinette.jpg',
                'reduction'=>'0.6',
                'product_types_id'=>3,
                'status' => 1
            ],
            
            [
                'name' => 'chaussure',
                'price' =>'200',
                'image'=>'chaussure.jpg',
                'reduction'=>'0.3',
                'product_types_id'=>3,
                'status' => 1
            ],
            

        ];
        $this->db->table('users')->insertBatch($data);
    }
}
