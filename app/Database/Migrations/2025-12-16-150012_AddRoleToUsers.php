<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'staff', 'manajer'],
                'default'    => 'staff',
                'after'      => 'name'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role');
    }
}
