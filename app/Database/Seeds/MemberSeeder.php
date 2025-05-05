<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password_hash' => password_hash('123', PASSWORD_DEFAULT),
                'full_name' => 'Administrator',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'tian',
                'password_hash' => password_hash('123', PASSWORD_DEFAULT),
                'full_name' => 'Dystian En',
                'role' => 'member',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('members')->insertBatch($data);
    }
}
