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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
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
        $this->forge->addForeignKey('company_id', 'companys', 'id');
        $this->forge->createTable('warehouses');
    }

    public function down()
    {
        $this->forge->dropTable('warehouses');
    }
}
