<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToPengaduanTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengaduan', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addForeignKey('user_id', 'users', 'id');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pengaduan', 'pengaduan_user_id_foreign');
        $this->forge->dropColumn('pengaduan', 'user_id');
    }
}
