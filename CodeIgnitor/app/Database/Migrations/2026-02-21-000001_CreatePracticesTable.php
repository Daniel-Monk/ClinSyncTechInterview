<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePracticesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('practices');
    }

    public function down()
    {
        $this->forge->dropTable('practices');
    }
}
