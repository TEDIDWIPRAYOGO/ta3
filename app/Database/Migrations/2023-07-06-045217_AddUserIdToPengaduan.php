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
                'after' => 'id',
                'unsigned' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pengaduan', 'user_id');
    }
}
