<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarFoto extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', 'foto');
    }
}
