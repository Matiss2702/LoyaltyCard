<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Product extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ], 
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
			],
            'price' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'product_types_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
			],
             'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
			],
             'reduction' => [
                'type' => 'FLOAT',
                'null' => false,
			],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM("0","1")',
                'default' => '0',
                'null' => false,
			],
            'created_at datetime default current_timestamp',
            'modified_at' => [
                'type' => 'datetime',
                'null' => true,
			],
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_types_id', 'product_types', 'id');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}