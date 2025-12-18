<?php

namespace App\Controllers;

use App\Models\DBtable2b6;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Table2b6 extends BaseController
{
    public function index()
    {
        $model = new DBtable2b6();
        $data['table2b6'] = $model->findAll();

        return view('table2b6', $data);
    }

    public function create()
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table2b6'))->with('error', 'Anda tidak memiliki akses!');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'jenis_kemampuan' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model = new DBtable2b6();
            $model->insert([
                "jenis_kemampuan" => $this->request->getPost('jenis_kemampuan'),
                "sangat_baik" => $this->request->getPost('sangat_baik'),
                "baik" => $this->request->getPost('baik'),
                "cukup" => $this->request->getPost('cukup'),
                "kurang" => $this->request->getPost('kurang'),
                "rencana_tindak" => $this->request->getPost('rencana_tindak'),
            ]);

            return redirect()->to('table/table2b6');
        }

        return view('table2b6');
    }

    public function edit($id)
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table2b6'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new DBtable2b6();
        $data['table2b6'] = $model->where('id', $id)->first();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'jenis_kemampuan' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $model->update($id, [
                "jenis_kemampuan" => $this->request->getPost('jenis_kemampuan'),
                "sangat_baik" => $this->request->getPost('sangat_baik'),
                "baik" => $this->request->getPost('baik'),
                "cukup" => $this->request->getPost('cukup'),
                "kurang" => $this->request->getPost('kurang'),
                "rencana_tindak" => $this->request->getPost('rencana_tindak'),
            ]);

            return redirect()->to('table/table2b6');
        }

        return view('edittable2b6', $data);
    }

    public function delete($id)
    {
        if (session()->get('role') == 'staff') {
            return redirect()->to(base_url('table/table2b6'))->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new DBtable2b6();
        $model->delete($id);
        return redirect()->to('table/table2b6');
    }

    public function cari()
    {
        $model = new DBtable2b6();
        $cariData = $this->request->getGet('search');

        $data['table2b6'] = $model->cariData($cariData);

        return view('table2b6', $data);
    }

    public function exportExcel()
    {
        $model = new DBtable2b6();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 1. SET HEADER & STYLING HEADER
        $headers = ['No', 'Jenis Kemampuan', 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Rencana Tindak'];
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
                'startColor' => ['argb' => 'FF4F81BD'], // Biru Excel
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

        // Terapkan style ke header (A1 sampai G1)
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        // Atur tinggi baris header agar lebih lega
        $sheet->getRowDimension('1')->setRowHeight(25);

        // 2. ISI DATA (LOOPING)
        $rowIndex = 2;
        foreach ($data as $index => $row) {
            $sheet->setCellValue('A' . $rowIndex, $index + 1);
            $sheet->setCellValue('B' . $rowIndex, $row['jenis_kemampuan']);
            $sheet->setCellValue('C' . $rowIndex, $row['sangat_baik']);
            $sheet->setCellValue('D' . $rowIndex, $row['baik']);
            $sheet->setCellValue('E' . $rowIndex, $row['cukup']);
            $sheet->setCellValue('F' . $rowIndex, $row['kurang']);
            $sheet->setCellValue('G' . $rowIndex, $row['rencana_tindak']);
            $rowIndex++;
        }

        // 3. STYLING BODY / ISI TABEL
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
        $sheet->getStyle('A2:G' . $lastRow)->applyFromArray($styleBorder);

        // Style Alignment (Rata Tengah) Khusus Kolom Angka (No, Sangat Baik s/d Kurang)
        // Kolom: A, C, D, E, F -> Center
        $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C2:F' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // (Kolom B dan G biarkan rata kiri/default karena teks panjang)

        // 4. AUTO SIZE COLUMN (Agar lebar kolom pas otomatis)
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // 5. DOWNLOAD FILE


        $filename = 'Laporan-Table2b6-' . date('Y-m-d-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
