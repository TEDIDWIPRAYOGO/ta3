<?php

namespace App\Controllers;


use App\Models\PengaduanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;
    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }
    public function index()
    {

        $currentPage = $this->request->getVar('page_pengaduan') ? $this->request->getVar('page_pengaduan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengaduan = $this->pengaduanModel->search($keyword);
        } else {
            $pengaduan = $this->pengaduanModel;
        }

        // $pengaduan = $this->pengaduanModel->findAll();

        $data = [
            'title' => 'Halaman Tabel Pengaduan',
            // 'pengaduan' => $this->pengaduanModel->findAll()
            'pengaduan' => $pengaduan->paginate(5, 'pengaduan'),
            'pager' => $this->pengaduanModel->pager,
            'currentPage' => $currentPage
        ];

        // $pengaduanModel = new \App\Models\PengaduanModel();



        return view('pengaduan/index', $data);
    }


    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Pengaduan',
            'pengaduan' => $this->pengaduanModel->getPengaduan($slug)
        ];

        // jika pengaduan tidak ada di tabel
        if (empty($data['pengaduan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan ' . $slug . ' tidak ditemukan.');
        }
        return view('pengaduan/detail', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Buat Pengaduan',
            'validation' => \Config\Services::validation()
        ];

        return view('pengaduan/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nik' => 'required[pengaduan.nik]',
            'nama' => 'required[pengaduan.nama]',
            'tmpt_lahir' => 'required[pengaduan.tmpt_lahir]',
            'tgl_lahir' => 'required[pengaduan.tgl_lahir]',
            'jns_kelamin' => 'required[pengaduan.jns_kelamin]',
            'jns_kasus' => 'required[pengaduan.jns_kasus]',
            'deskripsi' => 'required[pengaduan.deskripsi]',
            'alamat' => 'required[pengaduan.alamat]',
            'agama' => 'required[pengaduan.agama]',
            'status_perkawinan' => 'required[pengaduan.status_perkawinan]',
            'pekerjaan' => 'required[pengaduan.pekerjaan]',
            'pendidikan' => 'required[pengaduan.pendidikan]',
            'telepon' => 'required[pengaduan.telepon]',

            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Upload gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/pengaduan/create')->withInput()->with('validation', $validation);
            return redirect()->to('/pengaduan/create')->withInput();
        }

        // ambil gambar
        $fileFoto = $this->request->getFile('foto');
        // generate nama foto random
        $namaFoto = $fileFoto->getRandomName();
        // pindahkan file ke folder img
        $fileFoto->move('img', $namaFoto);

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->pengaduanModel->save([
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'tmpt_lahir' => $this->request->getVar('tmpt_lahir'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'jns_kelamin' => $this->request->getVar('jns_kelamin'),
            'jns_kasus' => $this->request->getVar('jns_kasus'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat' => $this->request->getVar('alamat'),
            'agama' => $this->request->getVar('agama'),
            'status_perkawinan' => $this->request->getVar('status_perkawinan'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'telepon' => $this->request->getVar('telepon'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/pengaduan');
    }

    public function delete($id)
    {

        // cari gambar berdasarkan id
        $pengaduan = $this->pengaduanModel->find($id);

        // hapus gambar
        unlink('img/' . $pengaduan['foto']);

        $this->pengaduanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/pengaduan');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Pengaduan',
            'validation' => \Config\Services::validation(),
            'pengaduan' => $this->pengaduanModel->getPengaduan($slug)
        ];

        return view('pengaduan/edit', $data);
    }

    public function update($id)
    {


        // validasi input
        if (!$this->validate([
            'nik' => 'required[pengaduan.nik]',
            'nama' => 'required[pengaduan.nama]',
            'tmpt_lahir' => 'required[pengaduan.tmpt_lahir]',
            'tgl_lahir' => 'required[pengaduan.tgl_lahir]',
            'jns_kelamin' => 'required[pengaduan.jns_kelamin]',
            'jns_kasus' => 'required[pengaduan.jns_kasus]',
            'deskripsi' => 'required[pengaduan.deskripsi]',
            'alamat' => 'required[pengaduan.alamat]',
            'agama' => 'required[pengaduan.agama]',
            'status_perkawinan' => 'required[pengaduan.status_perkawinan]',
            'pekerjaan' => 'required[pengaduan.pekerjaan]',
            'pendidikan' => 'required[pengaduan.pendidikan]',
            'telepon' => 'required[pengaduan.telepon]',
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Upload gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/pengaduan/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        // cek gambar apakah tetap gambar lama
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            // generate nama file random
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('img', $namaFoto);
            // hapus file lama
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->pengaduanModel->save([
            'id' => $id,
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'tmpt_lahir' => $this->request->getVar('tmpt_lahir'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'jns_kelamin' => $this->request->getVar('jns_kelamin'),
            'jns_kasus' => $this->request->getVar('jns_kasus'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat' => $this->request->getVar('alamat'),
            'agama' => $this->request->getVar('agama'),
            'status_perkawinan' => $this->request->getVar('status_perkawinan'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'telepon' => $this->request->getVar('telepon'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil di edit');

        return redirect()->to('/pengaduan');
    }
}
