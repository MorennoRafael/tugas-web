<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabel2c extends Migration
{
    public function up()
    {
        // 1. Definisi Struktur Tabel
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Auto increment sebaiknya unsigned
                'auto_increment' => true,
            ],
            'TahunAkademik' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'JenisPembelajaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'TS_2' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'TS_1' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'TS' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'LinkBukti' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);

        // 2. Menambahkan Primary Key
        $this->forge->addKey('id', true);

        // 3. Membuat Tabel '2c'
        $this->forge->createTable('2c', true);
    }

    public function down()
    {
        // Menghapus tabel jika rollback
        $this->forge->dropTable('2c');
    }
}
