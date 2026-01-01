<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Matakuliah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'matakuliah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'rumpun' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'bobot_teori' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 0,
            ],
            'bobot_praktek' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 0,
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('kode');
        $this->forge->addKey('rumpun');
        $this->forge->addKey('semester');
        $this->forge->createTable('matakuliah', true);
    }

    public function down()
    {
        $this->forge->dropTable('matakuliah');
    }
}


