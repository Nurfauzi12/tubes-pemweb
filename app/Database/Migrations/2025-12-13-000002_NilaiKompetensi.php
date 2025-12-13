<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiKompetensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
            'id_rencana_pembelajaran' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'nilai_kompetensi' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('nim');
        $this->forge->addKey('id_rencana_pembelajaran');
        $this->forge->addKey(['nim', 'id_rencana_pembelajaran'], false, true);

        // create table first before adding foreign keys
        $this->forge->createTable('nilai_kompetensi', true);

        // Add foreign keys using direct SQL because Forge's addForeignKey may not persist in some DB setups
        $db = \Config\Database::connect();
        $db->query('ALTER TABLE `nilai_kompetensi` ADD CONSTRAINT `fk_nilai_kompetensi_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa`(`nim`) ON DELETE CASCADE ON UPDATE CASCADE');
        $db->query('ALTER TABLE `nilai_kompetensi` ADD CONSTRAINT `fk_nilai_kompetensi_rencana_pembelajaran` FOREIGN KEY (`id_rencana_pembelajaran`) REFERENCES `rencana_pembelajaran`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('nilai_kompetensi');
    }
}
