<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'practice_id'    => ['type' => 'INT'],
            'patient_id'     => ['type' => 'INT'],
            'user_id'        => ['type' => 'INT'],
            'notes'          => ['type' => 'TEXT', 'null' => true],
            'appointment_at' => ['type' => 'DATETIME'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('practice_id', 'practices', 'id');
        $this->forge->addForeignKey('patient_id', 'patients', 'id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('appointments');
    }

    public function down()
    {
        $this->forge->dropTable('appointments');
    }
}
