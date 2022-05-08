<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'invoice_prefix' => [
                'type' => 'VARCHAR',
                'constraint'=>'5',
                'null' => false
            ],
            'invoice_no' => [
                'type' => 'VARCHAR',
                'constraint' =>'16',
                'null' => false
            ],
            'users_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'total' => [
                'type' => 'FLOAT',
                'constraint' =>'10,2',
                'null' => false
            ],
            'reduction' => [
               'type' => 'FLOAT',
               'null' => false
            ],
            'payment_country' => [
                'type' =>'VARCHAR',
                'constraint' =>'45',
                'null' => true,
            ],   
            'payment_firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false
            ],    
            'payment_lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false
            ],        
            'payment_address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'payment_city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'payment_zipcode' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => false
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true
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
        $this->forge->addForeignKey('users_id', 'users', 'id');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
