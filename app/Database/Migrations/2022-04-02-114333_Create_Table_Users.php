<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Users extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
			],
             'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
			],
             'mail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
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
             'group_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
			],
             'fidelity_points' => [
                'type' => 'INT',
                'default' => '0',
                'unsigned' => true,
                'null' => false,
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
        $this->forge->addForeignKey('group_id', 'groups', 'id');
        $this->forge->createTable('users');
    }

    public function down() {
        $this->forge->dropTable('users');
    }
}
