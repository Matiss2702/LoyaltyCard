<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Stocks extends Migration
{
    public function up()
    {   
        $this->forge->addField([
        'warehouses_id'=>[
            'type' => 'INT',
            'unsigned' => true,
        ], 
        'products_id' => [
            'type' => 'INT',
            'unsigned' => true,
            'null' => false
        ],
        'quantity'=> [
            'type' => 'INT',
            'null' => false,
        ],

    ]);
        
        $this->forge->addPrimaryKey([
            'warehouses_id',
            'products_id',
        ]);
        $this->forge->addForeignKey('warehouses_id', 'warehouses', 'id');
        $this->forge->addForeignKey('products_id', 'products', 'id');
        $this->forge->createTable('stocks');
    }

    public function down()
    {
        $this->forge->dropTable('stocks');
    }
}
