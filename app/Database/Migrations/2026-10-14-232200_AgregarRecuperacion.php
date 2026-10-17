<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarRecuperacion extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'token_recuperacion' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'unique'     => true,
            ],
            'recuperacion_expira' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', ['token_recuperacion', 'recuperacion_expira']);
    }
}
