<?php

namespace App\Models;

use CodeIgniter\Model;

class DBtable2b6 extends Model
{
    protected $table      = 'kepuasan_pengguna_lulusan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id',
        'jenis_kemampuan',
        'sangat_baik',
        'baik',
        'cukup',
        'kurang',
        'rencana_tindak'
    ];

    public function cariData($cariData = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($cariData)) {
            $builder->like('jenis_kemampuan', $cariData);
        }

        return $builder->get()->getResultArray();
    }
}
