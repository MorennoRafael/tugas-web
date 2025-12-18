<?php

namespace App\Controllers;

use App\Models\DBtable3a1;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use phpoffice\PhpSpreadsheet\IOFactory;

class Table3a1 extends BaseController
{
    public function index()
    {
        $model = new DBtable3a1();
        $data['table3a1'] = $model->findAll();

        return view('table3a1', $data);
    }

    public function create()
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table3a1'))->with('error', 'Anda tidak memiliki akses!');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_prasarana' => 'required',
            'daya_tampung'   => 'required|integer',
            'luas_ruang'     => 'required',
            'kepemilikan'    => 'required',
            'lisensi'        => 'required',
            'perangkat'      => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new DBtable3a1();
            $model->insert([
                "nama_prasarana" => $this->request->getPost('nama_prasarana'),
                "daya_tampung"   => $this->request->getPost('daya_tampung'),
                "luas_ruang"     => $this->request->getPost('luas_ruang'),
                "kepemilikan"    => $this->request->getPost('kepemilikan'),
                "lisensi"        => $this->request->getPost('lisensi'),
                "perangkat"      => $this->request->getPost('perangkat'),
                "link_bukti"     => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table3a1');
        }

        return view('table3a1');
    }

    public function edit($no)
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table3a1'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new DBtable3a1();
        $data['table3a1'] = $model->where('no', $no)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_prasarana' => 'required',
            'daya_tampung'   => 'required|integer',
            'luas_ruang'     => 'required',
            'kepemilikan'    => 'required',
            'lisensi'        => 'required',
            'perangkat'      => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($no, [
                "nama_prasarana" => $this->request->getPost('nama_prasarana'),
                "daya_tampung"   => $this->request->getPost('daya_tampung'),
                "luas_ruang"     => $this->request->getPost('luas_ruang'),
                "kepemilikan"    => $this->request->getPost('kepemilikan'),
                "lisensi"        => $this->request->getPost('lisensi'),
                "perangkat"      => $this->request->getPost('perangkat'),
                "link_bukti"     => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table3a1');
        }

        return view('edittable3a1', $data);
    }

    public function delete($no)
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table3a1'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new DBtable3a1();
        $model->delete($no);
        return redirect()->to('table/table3a1');
    }

    public function cari()
    {
        $model = new DBtable3a1();
        $cariData = $this->request->getGet('search');

        $data['table3a1'] = $model->cariData($cariData);

        return view('table3a1', $data);
    }

    public function exportExcel()
    {
        $model = new DBtable3a1();
        $dataRaw = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // --- 1. SETUP HEADER & STYLING ---
        $headers = [
            'No', 
            'Nama Prasarana', 
            'Daya Tampung', 
            'Luas Ruang (m2)', 
            'Kepemilikan', 
            'Lisensi', 
            'Perangkat', 
            'Link Bukti'
        ];
        
        $columnIndex = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '1', $header);
            $columnIndex++;
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

        // Terapkan style ke Header (A1 sampai H1)
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);
        // Tinggi baris header agar lebih lega
        $sheet->getRowDimension('1')->setRowHeight(25);


        // --- 2. ISI DATA (LOOPING) ---
        $rowIndex = 2;
        $no = 1; 
        foreach ($dataRaw as $row) {
            $sheet->setCellValue('A' . $rowIndex, $no++); 
            $sheet->setCellValue('B' . $rowIndex, $row['nama_prasarana']);
            $sheet->setCellValue('C' . $rowIndex, $row['daya_tampung']);
            $sheet->setCellValue('D' . $rowIndex, $row['luas_ruang']);
            $sheet->setCellValue('E' . $rowIndex, $row['kepemilikan']);
            $sheet->setCellValue('F' . $rowIndex, $row['lisensi']);
            $sheet->setCellValue('G' . $rowIndex, $row['perangkat']);
            $sheet->setCellValue('H' . $rowIndex, $row['link_bukti']);
            $rowIndex++;
        }

        
        // --- 3. STYLING BODY / ISI TABEL ---
        $lastRow = $rowIndex - 1; // Baris terakhir data

        // Style Border untuk seluruh data
        $styleBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER, // Teks di tengah secara vertikal
            ],
        ];
        $sheet->getStyle('A2:H' . $lastRow)->applyFromArray($styleBorder);

        // Alignment Rata Tengah (Center)
        // Kolom A (No), C (Daya Tampung), D (Luas) kita buat rata tengah agar rapi karena angka
        $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C2:D' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Sisanya (Nama, Kepemilikan, dll) biarkan rata kiri (default)


        // --- 4. FINISHING ---
        // Auto Size Column (Agar lebar kolom pas otomatis)
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output Download File
        $fileName = 'Laporan-Table3a1-' . date('Y-m-d-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    
        
    
}
