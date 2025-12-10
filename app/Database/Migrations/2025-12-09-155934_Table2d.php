<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Table2d extends Migration
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

            'sumber_rekognisi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'jenis_pengakuan_lulusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'tahun_akademik' => [
                'type'       => 'YEAR',
                'constraint' => 4,
            ],

            'link_bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('no', true);
        $this->forge->createTable('table2d');
    }

    public function down()
    {
        $this->forge->dropTable('table2d');
    }
}
