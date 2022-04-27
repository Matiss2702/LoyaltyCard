<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Order_Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'orders_id'=>[
                'type'=> 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'products_id'=>[
                'type'=> 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'quantity'=> [
                'type' => 'INT',
                'null' => false
            ],
            'sub_total'=>[
                'type'=>'FLOAT',
                'null' => false
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('orders_id', 'orders', 'id');
        $this->forge->addForeignKey('products_id', 'products', 'id');
        $this->forge->createTable('order_products');
    }

    public function down()
    {
        $this->forge->dropTable('order_products');
    }
}
