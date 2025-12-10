<?php

namespace App\Models;

use CodeIgniter\Model;

class DBtable2c extends Model
{
   protected $table      = '2c';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['TahunAkademik','JenisPembelajaran','TS_2','TS_1','TS','LinkBukti',];

    public function cariData($cariData = null)
    {
        $builder = $this->db->table($this->table);

        if (!empty($cariData)) {

            $builder->like('search', $cariData);
        }

        return $builder->get()->getResultArray();
    }
}