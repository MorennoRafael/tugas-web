<?php namespace App\Controllers;

use App\Models\DBtable2c;
use CodeIgniter\Exceptions\PageNotFoundException;

class Table2c extends BaseController
{
    protected $dbTable2c;

    public function __construct()
    {
        $this->dbTable2c = new DBtable2c();
    }

    public function index()
    {
        // 1. Ambil semua data
        $dataRaw = $this->dbTable2c->findAll();

        // 2. Panggil fungsi hitung
        $summary = $this->hitungRingkasan($dataRaw);

        // 3. Masukkan data ke array $data
        $data['table2c'] = $dataRaw;
        // Definisi variabel agar terbaca di View
        $data['total']   = $summary['total'];   
        $data['persen']  = $summary['persen'];  

        echo view('table2c', $data);
    }

    public function cari()
    {
        $cariData = $this->request->getGet('search');
        
        $dataRaw = $this->dbTable2c->cariData($cariData);

        // Panggil fungsi hitung juga saat mencari
        $summary = $this->hitungRingkasan($dataRaw);

        $data['table2c'] = $dataRaw;
        $data['total']   = $summary['total'];
        $data['persen']  = $summary['persen'];

        return view('table2c', $data);
    }

    // --- FUNGSI CRUD LAINNYA ---
    public function create() {
         $validation = \Config\Services::validation();
         $validation->setRules(['TahunAkademik' => 'required']);
         $isDataValid = $validation->withRequest($this->request)->run();
 
         if($isDataValid){
             $this->dbTable2c->insert([
                 // Tidak perlu input ID manual jika Auto Increment
                 "TahunAkademik" => $this->request->getPost('TahunAkademik'),
                 "JenisPembelajaran" => $this->request->getPost('JenisPembelajaran'),
                 "TS_2" => $this->request->getPost('TS_2'),
                 "TS_1" => $this->request->getPost('TS_1'), // Diubah menjadi TS_1
                 "TS" => $this->request->getPost('TS'),
                 "LinkBukti" => $this->request->getPost('LinkBukti'),
             ]);
             return redirect()->to('table/table2c');
         }
         return redirect()->to('table/table2c');
    }

    public function edit($id) {
        $data['table2c'] = $this->dbTable2c->where('id', $id)->first();
        
        $validation = \Config\Services::validation();
        $validation->setRules(['id' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
    
        if ($isDataValid) {
            $this->dbTable2c->update($id, [
                "TahunAkademik" => $this->request->getPost('TahunAkademik'),
                "JenisPembelajaran" => $this->request->getPost('JenisPembelajaran'),
                "TS_2" => $this->request->getPost('TS_2'),
                "TS_1" => $this->request->getPost('TS_1'), // Diubah menjadi TS_1
                "TS" => $this->request->getPost('TS'),
                "LinkBukti" => $this->request->getPost('LinkBukti'),
            ]);
            return redirect()->to('table/table2c');
        }
        return view('edittable2c', $data);
    }

    public function delete($id){
        $this->dbTable2c->delete($id);
        return redirect()->to('table/table2c');
    }

    /**
     * ==========================================
     * LOGIKA PERHITUNGAN TOTAL DAN PERSENTASE
     * ==========================================
     */
    private function hitungRingkasan($data)
    {
        // Ubah key 'ts1' menjadi 'ts_1' agar konsisten
        $total   = ['ts_2' => 0, 'ts_1' => 0, 'ts' => 0];
        $pembagi = ['ts_2' => 0, 'ts_1' => 0, 'ts' => 0]; 

        if (empty($data)) {
            return ['total' => $total, 'persen' => $total];
        }

        foreach ($data as $key => $row) {
            // Ubah pengambilan data kolom DB menjadi TS_1
            $val_ts2 = floatval($row['TS_2']);
            $val_ts1 = floatval($row['TS_1']); 
            $val_ts  = floatval($row['TS']);

            if ($key === 0) {
                // Baris Pertama = Pembagi
                $pembagi['ts_2'] = $val_ts2;
                $pembagi['ts_1'] = $val_ts1; // Diubah
                $pembagi['ts']   = $val_ts;
            } else {
                // Baris Selanjutnya = Dijumlahkan
                $total['ts_2'] += $val_ts2;
                $total['ts_1'] += $val_ts1; // Diubah
                $total['ts']   += $val_ts;
            }
        }

        // Hitung Persen
        $persen = [
            'ts_2' => ($pembagi['ts_2'] > 0) ? round(($total['ts_2'] / $pembagi['ts_2']) * 100, 2) : 0,
            // Ubah key menjadi ts_1
            'ts_1' => ($pembagi['ts_1']  > 0) ? round(($total['ts_1']  / $pembagi['ts_1'])  * 100, 2) : 0,
            'ts'   => ($pembagi['ts']   > 0) ? round(($total['ts']   / $pembagi['ts'])   * 100, 2) : 0,
        ];

        return ['total' => $total, 'persen' => $persen];
    }
}