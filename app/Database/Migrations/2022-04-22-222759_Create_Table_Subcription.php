<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Subcription extends Migration
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
                'constraint' => '100',
                'null' => false
            ],
            'price' => [
                'type' => 'FLOAT',
                'default' => '29.99',
                'null' => false
			],
            'nb_users' => [
                'type' => 'INT',
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
        $this->forge->createTable('subcriptions');
    }
    

    public function down()
    {
        $this->forge->dropTable('subcriptions');
    }
}
