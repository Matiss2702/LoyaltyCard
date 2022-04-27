<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Warehouses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'company_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
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
            'zipcode' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => true,
			],
            
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('company_id', 'companys', 'id');
        $this->forge->createTable('warehouses');
    }

    public function down()
    {
        $this->forge->dropTable('warehouses');
    }
}
