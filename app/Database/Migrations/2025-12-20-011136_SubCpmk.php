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
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'id_penyusun' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
            'id_matakuliah' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'id_sub_cpmk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],

        ]);
        // create primary key
        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');
        $this->forge->addKey('id_sub_cpmk');

        // create table first before adding foreign keys
        $this->forge->createTable('sub_cmpk', true);
    }
    public function down()
    {
        $this->forge->dropTable('sub_cpmk');
    }
}
