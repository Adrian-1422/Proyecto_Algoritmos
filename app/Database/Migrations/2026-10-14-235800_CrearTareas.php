<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTareas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'descripcion' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'creado_en' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'actualizado_en' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tareas');
    }

    public function down()
    {
        $this->forge->dropTable('tareas');
    }
}
