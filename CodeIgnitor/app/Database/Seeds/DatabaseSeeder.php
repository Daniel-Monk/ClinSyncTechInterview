<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('practices')->insertBatch([
            ['name' => 'Dans Dental', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Tays Teeth', 'created_at' => date('Y-m-d H:i:s')],
        ]);

        $this->db->table('users')->insertBatch([
            [
                'practice_id' => 1,
                'name'        => 'Daniel Monk',
                'email'       => 'daniel@dansdental.com',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'practice_id' => 2,
                'name'        => 'Tay',
                'email'       => 'tay@taysteeth.com',
                'password'    => password_hash('password123', PASSWORD_BCRYPT),
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ]);

        $this->db->table('patients')->insertBatch([
            [
                'practice_id'   => 1,
                'name'          => 'John Doe',
                'email'         => 'john@example.com',
                'phone'         => '07194728593',
                'date_of_birth' => '1991-06-15',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'practice_id'   => 1,
                'name'          => 'jane Doe',
                'email'         => 'jane@example.com',
                'phone'         => '077241728593',
                'date_of_birth' => '1995-11-05',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'practice_id'   => 2,
                'name'          => 'Mike Leif',
                'email'         => 'mike@example.com',
                'phone'         => '07194728593',
                'date_of_birth' => '2000-01-19',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ]);
        $this->db->table('appointments')->insertBatch([
            [
                'practice_id'    => 1,
                'patient_id'     => 1,
                'user_id'        => 1,
                'appointment_at' => '2026-03-01 09:00:00',
                'notes'          => 'Routine checkup',
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'practice_id'    => 2,
                'patient_id'     => 3,
                'user_id'        => 2,
                'appointment_at' => '2026-03-01 10:00:00',
                'notes'          => 'Initial consultation',
                'created_at'     => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
