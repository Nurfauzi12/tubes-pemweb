<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
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
            'nama_mahasiswa' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'null' => false,
            ],
            'id_prodi' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
            'periode_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nim');
        $this->forge->addKey('id_prodi');
        $this->forge->createTable('mahasiswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
