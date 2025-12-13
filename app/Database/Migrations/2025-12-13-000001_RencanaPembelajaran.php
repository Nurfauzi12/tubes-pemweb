<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RencanaPembelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
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
            'minggu_ke' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'sub_cpmk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'penilaian_indikator' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'penilaian_teknik' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'bentuk_pembelajaran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'materi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'bobot_penilaian' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');
        $this->forge->addKey('minggu_ke');
        $this->forge->createTable('rencana_pembelajaran', true);

        // Add foreign key only to penyusun (penyusun migration exists)
        $db = \Config\Database::connect();
        $db->query('ALTER TABLE `rencana_pembelajaran` ADD CONSTRAINT `fk_rencana_pembelajaran_penyusun` FOREIGN KEY (`id_penyusun`) REFERENCES `penyusun`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('rencana_pembelajaran');
    }
}
