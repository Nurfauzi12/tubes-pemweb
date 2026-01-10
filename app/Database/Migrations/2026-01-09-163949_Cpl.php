<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cpl extends Migration
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
            'id_penyusun' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false,
            ],
            'id_matakuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false,
            ],
            'cpl_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('cpl');

        // Add indexes with unique names for CPL table
        $this->db->query('CREATE INDEX idx_cpl_penyusun ON cpl(id_penyusun)');
        $this->db->query('CREATE INDEX idx_cpl_matakuliah ON cpl(id_matakuliah)');

        // Add foreign keys using Forge API
        $this->forge->addForeignKey('id_penyusun', 'penyusun', 'id', 'CASCADE', 'CASCADE', 'fk_cpl_penyusun');
        $this->forge->addForeignKey('id_matakuliah', 'matakuliah', 'id', 'CASCADE', 'CASCADE', 'fk_cpl_matakuliah');
        $this->forge->processIndexes('cpl');
    }

    public function down()
    {
        $this->forge->dropTable('cpl', true);
    }
}
