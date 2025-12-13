<?php

namespace App\Controllers;

use App\Models\DBtable2c;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Controllers\BaseController;

// [PENTING] Load Library Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;  
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules(['TahunAkademik' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $this->dbTable2c->insert([
                // Tidak perlu input ID manual jika Auto Increment
                "TahunAkademik"     => $this->request->getPost('TahunAkademik'),
                "JenisPembelajaran" => $this->request->getPost('JenisPembelajaran'),
                "TS_2"              => $this->request->getPost('TS_2'),
                "TS_1"              => $this->request->getPost('TS_1'),
                "TS"                => $this->request->getPost('TS'),
                "LinkBukti"         => $this->request->getPost('LinkBukti'),
            ]);
            return redirect()->to('table/table2c');
        }
        return redirect()->to('table/table2c');
    }

    public function edit($id)
    {
        $data['table2c'] = $this->dbTable2c->where('id', $id)->first();

        $validation = \Config\Services::validation();
        $validation->setRules(['id' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $this->dbTable2c->update($id, [
                "TahunAkademik"     => $this->request->getPost('TahunAkademik'),
                "JenisPembelajaran" => $this->request->getPost('JenisPembelajaran'),
                "TS_2"              => $this->request->getPost('TS_2'),
                "TS_1"              => $this->request->getPost('TS_1'),
                "TS"                => $this->request->getPost('TS'),
                "LinkBukti"         => $this->request->getPost('LinkBukti'),
            ]);
            return redirect()->to('table/table2c');
        }
        return view('edittable2c', $data);
    }

    public function delete($id)
    {
        $this->dbTable2c->delete($id);
        return redirect()->to('table/table2c');
    }

    // ==========================================
    // FUNGSI BARU: EXPORT EXCEL
    // ==========================================
   public function exportExcel()
    {
        // 1. Ambil Data & Hitung Ringkasan
        $dataRaw = $this->dbTable2c->findAll();
        $summary = $this->hitungRingkasan($dataRaw);

        // 2. Siapkan Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // --- A. SETUP HEADER & STYLING ---
        // Set Nama Kolom
        $headers = [
            'A' => 'No',
            'B' => 'Tahun Akademik',
            'C' => 'Jenis Pembelajaran',
            'D' => 'TS-2',
            'E' => 'TS-1',
            'F' => 'TS',
            'G' => 'Link Bukti'
        ];

        foreach ($headers as $col => $val) {
            $sheet->setCellValue($col . '1', $val);
        }

        // Style Header (Background Biru, Teks Putih, Bold, Rata Tengah)
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE], // Teks Putih
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4F81BD'], // Warna Biru Excel
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        
        // Terapkan style ke Header (A1:G1)
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        // Tinggi baris header lebih lega
        $sheet->getRowDimension('1')->setRowHeight(25);


        // --- B. ISI DATA UTAMA ---
        $rows = 2;
        $no = 1;
        foreach ($dataRaw as $val) {
            $sheet->setCellValue('A' . $rows, $no++);
            $sheet->setCellValue('B' . $rows, $val['TahunAkademik']);
            $sheet->setCellValue('C' . $rows, $val['JenisPembelajaran']);
            $sheet->setCellValue('D' . $rows, $val['TS_2']);
            $sheet->setCellValue('E' . $rows, $val['TS_1']);
            $sheet->setCellValue('F' . $rows, $val['TS']);
            $sheet->setCellValue('G' . $rows, $val['LinkBukti']);
            $rows++;
        }

        // --- C. STYLING DATA UTAMA ---
        $lastRowData = $rows - 1;

        // 1. Border untuk seluruh tabel data
        $styleBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER, // Teks selalu di tengah vertikal
            ],
        ];
        $sheet->getStyle('A2:G' . $lastRowData)->applyFromArray($styleBorder);

        // 2. Alignment Rata Tengah untuk kolom tertentu
        // Kolom A (No), B (Tahun), D, E, F (Angka) -> Center
        $sheet->getStyle('A2:B' . $lastRowData)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:F' . $lastRowData)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Kolom C (Jenis) dan G (Link) biarkan default (Left)


        // --- D. BAGIAN RINGKASAN (TOTAL & PERSEN) ---
        $rows++; // Beri jarak 1 baris kosong (Gap)
        
        $startSummary = $rows; // Tandai baris awal summary

        // Baris Total
        $sheet->setCellValue('C' . $rows, 'TOTAL (Capaian)');
        $sheet->setCellValue('D' . $rows, $summary['total']['ts_2']);
        $sheet->setCellValue('E' . $rows, $summary['total']['ts_1']);
        $sheet->setCellValue('F' . $rows, $summary['total']['ts']);
        
        // Style text Total
        $sheet->getStyle('C'.$rows.':F'.$rows)->getFont()->setBold(true);
        $sheet->getStyle('C'.$rows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT); // Label "Total" rata kanan

        $rows++; // Pindah ke baris Persen
        
        // Baris Persentase
        $sheet->setCellValue('C' . $rows, 'PERSENTASE (%)');
        $sheet->setCellValue('D' . $rows, $summary['persen']['ts_2'] . '%');
        $sheet->setCellValue('E' . $rows, $summary['persen']['ts_1'] . '%');
        $sheet->setCellValue('F' . $rows, $summary['persen']['ts'] . '%');
        
        // Style text Persen
        $sheet->getStyle('C'.$rows.':F'.$rows)->getFont()->setBold(true);
        $sheet->getStyle('C'.$rows.':F'.$rows)->getFont()->getColor()->setARGB(Color::COLOR_BLUE); // Warna Biru
        $sheet->getStyle('C'.$rows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT); // Label rata kanan

        // 3. Terapkan Border Khusus pada kotak Summary (C s/d F)
        $sheet->getStyle('C' . $startSummary . ':F' . $rows)->applyFromArray($styleBorder);
        // Alignment Center untuk angkanya
        $sheet->getStyle('D' . $startSummary . ':F' . $rows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        // --- E. FINISHING ---
        // Auto Size Kolom
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output Download File
        $filename = 'Laporan-Table2c-' . date('Y-m-d-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
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
            $val_ts2 = floatval($row['TS_2']);
            $val_ts1 = floatval($row['TS_1']);
            $val_ts  = floatval($row['TS']);

            if ($key === 0) {
                // Baris Pertama = Pembagi
                $pembagi['ts_2'] = $val_ts2;
                $pembagi['ts_1'] = $val_ts1;
                $pembagi['ts']   = $val_ts;
            } else {
                // Baris Selanjutnya = Dijumlahkan
                $total['ts_2'] += $val_ts2;
                $total['ts_1'] += $val_ts1;
                $total['ts']   += $val_ts;
            }
        }

        // Hitung Persen
        $persen = [
            'ts_2' => ($pembagi['ts_2'] > 0) ? round(($total['ts_2'] / $pembagi['ts_2']) * 100, 2) : 0,
            'ts_1' => ($pembagi['ts_1'] > 0) ? round(($total['ts_1'] / $pembagi['ts_1']) * 100, 2) : 0,
            'ts'   => ($pembagi['ts']   > 0) ? round(($total['ts']   / $pembagi['ts'])   * 100, 2) : 0,
        ];

        return ['total' => $total, 'persen' => $persen];
    }
}