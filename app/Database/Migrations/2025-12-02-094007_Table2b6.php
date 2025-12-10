<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Table2b6 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'jenis_kemampuan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'sangat_baik' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'baik' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'cukup' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'kurang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'rencana_tindak' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('kepuasan_pengguna_lulusan', true);
    }

    public function down()
    {
        $this->forge->dropTable('kepuasan_pengguna_lulusan');
    }
}
