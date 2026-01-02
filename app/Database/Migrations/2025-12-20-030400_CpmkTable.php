<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCpmkTable extends Migration
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
            'cpmk' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');

        $this->forge->createTable('cpmk', true, [
            'ENGINE' => 'InnoDB',
            'DEFAULT CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci',
        ]);

        // Foreign key manual via query (lebih aman)
        $this->db->query("
            ALTER TABLE cpmk
            ADD CONSTRAINT fk_cpmk_penyusun
            FOREIGN KEY (id_penyusun) REFERENCES penyusun(id)
            ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_cpmk_matakuliah
            FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        $this->forge->dropTable('cpmk', true);
    }
}
