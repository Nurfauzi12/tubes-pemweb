<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MatakuliahSyarat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_penyusun' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'id_matakuliah' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'mk_syarat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');
        
        // Add foreign keys using Forge
        $this->forge->addForeignKey('id_penyusun', 'penyusun', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_matakuliah', 'matakuliah', 'id', 'SET NULL', 'CASCADE');
        
        $this->forge->createTable('matakuliah_syarat', true);
    }

    public function down()
    {
        $this->forge->dropTable('matakuliah_syarat');
    }
}
