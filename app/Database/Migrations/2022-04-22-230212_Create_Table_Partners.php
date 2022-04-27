<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Partners extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'mail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'group_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'company_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'subcription_id' => [
                'type' => 'INT',
                'unsigned' => true,
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
        $this->forge->addForeignKey('group_id', 'groups', 'id',);
        $this->forge->addForeignKey('subcription_id', 'subcriptions', 'id',);
        $this->forge->addForeignKey('company_id', 'companys', 'id',);
        $this->forge->createTable('partners');
    }
    

    public function down()
    {
        $this->forge->dropTable('partners');
    }
}
