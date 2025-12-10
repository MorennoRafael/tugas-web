<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Table3a1 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],

            'nama_prasarana' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'daya_tampung' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'luas_ruang' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],

            'kepemilikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'lisensi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'perangkat' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'link_bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('no', true);
        $this->forge->createTable('table3a1');
    }

    public function down()
    {
        $this->forge->dropTable('table3a1');
    }
}
