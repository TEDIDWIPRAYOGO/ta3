<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToPengaduan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengaduan', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'after' => 'id', // Ubah sesuai dengan nama kolom sebelumnya
                'null' => true,
            ],
        ]);

        // Tambahkan indeks untuk kolom user_id
        $this->forge->addForeignKey('user_id', 'users', 'id');
    }

    public function down()
    {
        $this->forge->disableForeignKeyChecks();

        $this->forge->dropColumn('pengaduan', 'user_id');
    }
}
