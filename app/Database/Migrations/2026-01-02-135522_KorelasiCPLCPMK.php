<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KorelasiCplCpmk extends Migration
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
                'null' => false,
            ],
            'id_matakuliah' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'id_sub_cpmk' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'id_cpmk' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'presentase' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'bobot_penilaian' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');
        $this->forge->addKey('id_cpmk');

        // Add foreign keys using Forge
        $this->forge->addForeignKey('id_penyusun', 'penyusun', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_matakuliah', 'matakuliah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_cpmk', 'cpmk', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('korelasi_cpl_cpmk');
    }

    public function down()
    {
        $this->forge->dropTable('korelasi_cpl_cpmk', true);
    }
}