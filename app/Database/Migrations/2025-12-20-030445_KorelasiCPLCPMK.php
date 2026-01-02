<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KorelasiCplCpmk extends Migration
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
                'unsigned'   => true,
            ],
            'id_matakuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_sub_cpmk' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_cpmk' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'presentase' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'bobot_penilaian' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyusun');
        $this->forge->addKey('id_matakuliah');
        $this->forge->addKey('id_sub_cpmk');
        $this->forge->addKey('id_cpmk');

        // Buat tabel dulu tanpa FK
        $this->forge->createTable('korelasi_cpl_cpmk', true, [
            'ENGINE' => 'InnoDB',
            'DEFAULT CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci',
        ]);

        // Tambahkan FK manual agar aman
        $this->db->query("
            ALTER TABLE korelasi_cpl_cpmk
            ADD CONSTRAINT fk_korelasi_penyusun
                FOREIGN KEY (id_penyusun) REFERENCES penyusun(id)
                ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_korelasi_matakuliah
                FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id)
                ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_korelasi_sub_cpmk
                FOREIGN KEY (id_sub_cpmk) REFERENCES sub_cpmk(id)
                ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_korelasi_cpmk
                FOREIGN KEY (id_cpmk) REFERENCES cpmk(id)
                ON DELETE CASCADE ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        $this->forge->dropTable('korelasi_cpl_cpmk', true);
    }
}
