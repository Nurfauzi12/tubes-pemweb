<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penyusun extends Migration
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
            'pengembangan_rps' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'koordinator_rumpun' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'ka_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('pengembangan_rps');
        $this->forge->createTable('penyusun');
    }

    public function down()
    {
        $this->forge->dropTable('penyusun');
    }
}
