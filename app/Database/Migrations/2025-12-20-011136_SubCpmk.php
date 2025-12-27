<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubCpmk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_penyusun' => [
                'type'       => 'INT',
                'constraint' => 11,
                //'unsigned'   => true,
                'null'       => false,
            ],
            'id_matakuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
                //'unsigned'   => true,
                'null'       => false,
            ],
            'sub_cpmk' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');

        $this->forge->addForeignKey(
            'id_penyusun', 'penyusun', 'id', 'CASCADE', 'CASCADE'
        );
        $this->forge->addForeignKey(
            'id_matakuliah', 'matakuliah', 'id', 'CASCADE', 'CASCADE'
        );

        $this->forge->createTable('sub_cpmk', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('sub_cpmk', true);
    }
}
