<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubCpmkTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // wajib UNSIGNED
                'auto_increment' => true,
            ],
            'id_penyusun' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // wajib UNSIGNED
            ],
            'id_matakuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // wajib UNSIGNED
            ],
            'sub_cpmk' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');

        $this->forge->createTable('sub_cpmk', true, [
            'ENGINE' => 'InnoDB',
            'DEFAULT CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci',
        ]);

        // Foreign key manual
        $this->db->query("
            ALTER TABLE sub_cpmk
            ADD CONSTRAINT fk_sub_penyusun
                FOREIGN KEY (id_penyusun) REFERENCES penyusun(id)
                ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_sub_matakuliah
                FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id)
                ON DELETE CASCADE ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        $this->forge->dropTable('sub_cpmk', true);
    }
}
