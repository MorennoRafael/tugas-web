<?php

namespace App\Models;

use CodeIgniter\Model;

class DBtable3a1 extends Model
{
    protected $table      = 'table3a1';
    protected $primaryKey = 'no';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nama_prasarana',
        'daya_tampung',
        'luas_ruang',
        'kepemilikan',
        'lisensi',
        'perangkat',
        'link_bukti'
    ];

    public function cariData($cariData = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($cariData)) {
            $builder->like('nama_prasarana', $cariData);
            $builder->orLike('kepemilikan', $cariData);
            $builder->orLike('lisensi', $cariData);
        }

        return $builder->get()->getResultArray();
    }
}
