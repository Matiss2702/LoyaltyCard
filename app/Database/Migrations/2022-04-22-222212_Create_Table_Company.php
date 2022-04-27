<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Company extends Migration
{ 
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
             'address' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
			],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
			],
             'zipcode' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => true,
			],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
			],
            'subcription' => [
                'type' => 'FLOAT',
                'default' => '29.99',
                'null' => true,
			],
            'subcription_date' => [
                'type' => 'datetime',
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
        $this->forge->createTable('companys');
    }
    

    public function down()
    {
        $this->forge->dropTable('companys');
    }
}
