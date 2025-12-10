<?php

namespace App\Models;

use CodeIgniter\Model;

class DBtable2d extends Model
{
    protected $table      = 'table2d';
    protected $primaryKey = 'no';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'sumber_rekognisi',
        'jenis_pengakuan_lulusan',
        'tahun_akademik',
        'link_bukti'
    ];

    public function cariData($cariData = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($cariData)) {
            $builder->like('sumber_rekognisi', $cariData);
            $builder->orLike('jenis_pengakuan_lulusan', $cariData);
        }

        return $builder->get()->getResultArray();
    }
}
