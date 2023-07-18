<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropUserIdColumnPengaduan extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('pengaduan', 'user_id');
    }

    public function down()
    {
        //
    }
}
