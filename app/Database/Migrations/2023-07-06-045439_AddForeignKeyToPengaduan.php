<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyToPengaduan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengaduan', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addForeignKey('user_id', 'user', 'id');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pengaduan', 'pengaduan_user_id_foreign');
        $this->forge->dropColumn('pengaduan', 'user_id');
    }
}
