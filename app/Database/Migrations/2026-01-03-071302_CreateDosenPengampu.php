<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDosenPengampu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_penyusun' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_matakuliah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'dosen_pengampu' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'semester' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tahun_akademik' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('id_penyusun', 'penyusun', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_matakuliah', 'matakuliah', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('dosen_pengampu');
    }

    public function down()
    {
        $this->forge->dropTable('dosen_pengampu');
    }
}
