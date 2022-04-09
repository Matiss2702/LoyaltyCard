<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGroups extends Migration {
    public function up() {
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
            'description' => [
                'type' => 'TEXT',
                'null' => true
			],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('groups');
    }

    public function down() {
        $this->forge->dropTable('groups');
    }
}
