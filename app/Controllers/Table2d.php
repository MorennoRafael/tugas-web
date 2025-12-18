<?php

namespace App\Controllers;

use App\Models\DBtable2d;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;  
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class Table2d extends BaseController
{
    public function index()
    {
        $model = new DBtable2d();
        $data['table2d'] = $model->findAll();

        return view('table2d', $data);
    }

    public function create()
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table2d'))->with('error', 'Anda tidak memiliki akses!');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'sumber_rekognisi'        => 'required',
            'jenis_pengakuan_lulusan' => 'required',
            'tahun_akademik'          => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new DBtable2d();
            $model->insert([
                "sumber_rekognisi"        => $this->request->getPost('sumber_rekognisi'),
                "jenis_pengakuan_lulusan" => $this->request->getPost('jenis_pengakuan_lulusan'),
                "tahun_akademik"          => $this->request->getPost('tahun_akademik'),
                "link_bukti"              => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table2d');
        }

        return view('table2d');
    }

    public function edit($no)
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table2d'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new DBtable2d();
        $data['table2d'] = $model->where('no', $no)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'sumber_rekognisi'        => 'required',
            'jenis_pengakuan_lulusan' => 'required',
            'tahun_akademik'          => 'required',
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($no, [
                "sumber_rekognisi"        => $this->request->getPost('sumber_rekognisi'),
                "jenis_pengakuan_lulusan" => $this->request->getPost('jenis_pengakuan_lulusan'),
                "tahun_akademik"          => $this->request->getPost('tahun_akademik'),
                "link_bukti"              => $this->request->getPost('link_bukti'),
            ]);

            return redirect()->to('table/table2d');
        }

        return view('edittable2d', $data);
    }

    public function delete($no)
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table2d'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new DBtable2d();
        $model->delete($no);
        return redirect()->to('table/table2d');
    }

    public function cari()
    {
        $model = new DBtable2d();
        $cariData = $this->request->getGet('search');

        $data['table2d'] = $model->cariData($cariData);

        return view('table2d', $data);
    }

    public function exportExcel()
    {
        $model = new DBtable2d();
        $table2dData = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // --- 1. SETUP HEADER & STYLING ---
        $headers = ['No', 'Sumber Rekognisi', 'Jenis Pengakuan Lulusan', 'Tahun Akademik', 'Link Bukti'];
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

        // Terapkan style ke Header (A1 sampai E1)
        $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
        // Tinggi baris header agar lebih lega
        $sheet->getRowDimension('1')->setRowHeight(25);


        // --- 2. ISI DATA (LOOPING) ---
        $rowIndex = 2;
        $no = 1; // Counter nomor urut
        foreach ($table2dData as $row) {
            $sheet->setCellValue('A' . $rowIndex, $no++); 
            $sheet->setCellValue('B' . $rowIndex, $row['sumber_rekognisi']);
            $sheet->setCellValue('C' . $rowIndex, $row['jenis_pengakuan_lulusan']);
            $sheet->setCellValue('D' . $rowIndex, $row['tahun_akademik']);
            $sheet->setCellValue('E' . $rowIndex, $row['link_bukti']);
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
        $sheet->getStyle('A2:E' . $lastRow)->applyFromArray($styleBorder);

        // Alignment Rata Tengah (Center)
        // Kolom A (No) dan D (Tahun Akademik) kita buat rata tengah agar rapi
        $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:D' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Kolom B, C, E biarkan rata kiri (default) karena isinya teks/link


        // --- 4. FINISHING ---
        // Auto Size Column (Agar lebar kolom pas otomatis)
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output Download File
        $fileName = 'Laporan-Table2d-' . date('Y-m-d-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


}
