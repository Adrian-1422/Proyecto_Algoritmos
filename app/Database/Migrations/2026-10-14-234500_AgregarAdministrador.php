<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarAdministrador extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'administrador' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ]);

        $this->db->table('usuarios')
            ->where('correo', 'adrianvalle200@gmail.com')
            ->update(['administrador' => 1]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', 'administrador');
    }
}
