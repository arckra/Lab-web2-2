<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
        
        $model->insert([
            'username' => 'admin',
            'useremail' => 'admin@email.com',
            'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
        
        // Optional: Tambah user lain
        $model->insert([
            'username' => 'user1',
            'useremail' => 'user1@email.com',
            'userpassword' => password_hash('user123', PASSWORD_DEFAULT),
        ]);
        
        $this->db->table('user')->insert([
            'username' => 'admin2',
            'useremail' => 'admin2@email.com',
            'userpassword' => password_hash('admin456', PASSWORD_DEFAULT),
        ]);
        
        echo "Seeder berhasil! User telah ditambahkan.\n";
    }
}