<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;


class Admin extends BaseController
{
    protected $pengaduanModel;
    protected $db, $builder;



    public function __construct()
    {

        $this->db = \Config\Database::connect();
        $this->builder =  $this->db->table('users');
        $this->pengaduanModel = new PengaduanModel();
    }

    // public function index()
    // {
    //     $data = [
    //         'title' => 'Dashboard'
    //     ];
    //     return view('admin/index', $data);
    // }

    public function index()
    {
        // Menghitung jumlah pengaduan
        $totalPengaduan = $this->db->table('pengaduan')->countAllResults();

        // Menghitung jumlah user
        $totalUser = $this->db->table('users')->countAllResults();

        // Mengirim data ke view
        $data = [
            'totalPengaduan' => $totalPengaduan,
            'totalUser' => $totalUser,
            'title' => 'Dashboard'
        ];

        // Menampilkan view dashboard_admin.php
        return view('admin/index', $data);
    }


    public function userlist()
    {
        $data['title'] = 'User List';

        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();


        return view('admin/userlist', $data);
    }

    public function detail($id = 0)
    {
        $data['title'] = 'Detail User';


        $this->builder->select('users.id as userid, username, email, user_image, fullname, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query =  $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }



    public function report()
    {
        $this->request->getVar();

        $data = [
            'title' => 'Report',
            'pengaduan' => $this->pengaduanModel->findAll()
        ];
        return view('admin/report', $data);
    }



    public function export()
    {
        $pengaduanModel = new PengaduanModel();
        // ambil data dari database
        $pengaduan = $this->pengaduanModel->findAll();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Jenis Kasus');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Tanggal Lapor');
        $sheet->setCellValue('F1', 'Status Laporan');

        // Set data pengaduan pada baris selanjutnya
        $row = 2;
        foreach ($pengaduan as $pengaduan) {
            $sheet->setCellValue('A' . $row, ($row - 1));
            $sheet->setCellValue('B' . $row, $pengaduan['nama']);
            $sheet->setCellValue('C' . $row, $pengaduan['jns_kasus']);
            $sheet->setCellValue('D' . $row, $pengaduan['alamat']);
            $sheet->setCellValue('E' . $row, date('d M Y', strtotime($pengaduan['created_at'])));
            $sheet->setCellValue('F' . $row, $pengaduan['status_pengaduan']);

            $row++;
        }

        // Gaya judul
        $titleStyle = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FFFFFF00', // Warna latar belakang (misalnya merah)
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FF000000'], // Warna border (misalnya hitam)
                ],
            ],
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($titleStyle);

        // Gaya kolom A
        $columnAStyle = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle('A')->applyFromArray($columnAStyle);

        // Gaya kolom B
        $columnBStyle = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle('B')->applyFromArray($columnBStyle);

        // Auto size kolom
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);


        // Simpan ke file atau output ke browser
        $writer = new Xlsx($spreadsheet);
        // $fileName = 'pengaduan_report.xlsx';
        // $writer->save($fileName);

        // Set header response untuk file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=report_pengaduan.xlsx');
        header('Cache-Control: max-age=0');

        // Output file Excel ke browser
        $writer->save('php://output');
        exit();
    }



    public function verifikasi($slug)
    {

        $data = [
            'title' => 'Verifikasi',
            'pengaduan' => $this->pengaduanModel->getPengaduan($slug)
        ];

        // jika pengaduan tidak ada di tabel
        if (empty($data['pengaduan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan ' . $slug . ' tidak ditemukan.');
        }
        return view('admin/verifikasi', $data);
    }

    // Fungsi untuk memverifikasi status pengaduan
    public function verifikasiStatus($id, $status)
    {
        $model = new PengaduanModel();
        $model->verifikasiPengaduan($id, $status);

        // Redirect ke halaman pengaduan setelah memperbarui status
        return redirect()->to(site_url('/pengaduan'));
    }
}
