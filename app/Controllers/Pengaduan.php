<?php

namespace App\Controllers;


use App\Models\PengaduanModel;
// use CodeIgniter\Session\SessionInterface;
// use Config\Services;
use Myth\Auth\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Pager\PagerInterface;



class Pengaduan extends BaseController
{
    protected $pengaduanModel;
    protected $session;

    public function __construct()
    {
        // $this->session = Services::session();
        $this->session = session();
        $this->pengaduanModel = new PengaduanModel();
    }

    // BARU
    // public function index()
    // {

    //     $currentPage = $this->request->getVar('page_pengaduan') ? $this->request->getVar('page_pengaduan') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $pengaduan = $this->pengaduanModel->search($keyword);
    //     } else {
    //         $pengaduan = $this->pengaduanModel;
    //     }

    //     // $pengaduan = $this->pengaduanModel->findAll();

    //     $data = [
    //         'title' => 'Halaman Tabel Pengaduan',
    //         // 'pengaduan' => $this->pengaduanModel->findAll()
    //         'pengaduan' => $pengaduan->paginate(5, 'pengaduan'),
    //         'pager' => $this->pengaduanModel->pager,
    //         'currentPage' => $currentPage
    //     ];

    //     // $pengaduanModel = new \App\Models\PengaduanModel();


    //     return view('pengaduan/index', $data);
    // }


    public function index()
    {
        // Periksa apakah pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to(site_url('login'));
        }

        //     // Dapatkan ID pengguna yang saat ini login dari sesi
        // $userId = session()->get('user_id');
        $currentPage = $this->request->getVar('page_pengaduan') ? $this->request->getVar('page_pengaduan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengaduan = $this->pengaduanModel->search($keyword);
            if (empty($pengaduan)) {
                $data['message'] = 'Tidak ada hasil pencarian yang sesuai.';
            }
        } else {
            $pengaduan = $this->pengaduanModel;
        }

        $data = [
            'title' => 'Pengaduan',
            'currentPage' => $currentPage,
        ];

        if ($this->isAdmin()) {
            $data['isAdmin'] = true;
            $data['pengaduan'] = $pengaduan->paginate(5, 'pengaduan', $currentPage);
            $data['pager'] = $pengaduan->pager;
        } else {
            $userId = $this->session->get('user_id');
            $data['isAdmin'] = false;
            $data['pengaduan'] = $pengaduan->where('user_id', $userId)->paginate(5, 'pengaduan', $currentPage);
            $data['pager'] = $pengaduan->where('user_id', $userId)->pager;
        }

        return view('pengaduan/index', $data);
    }

    public function isAdmin()
    {
        $userStatus = $this->session->get('user_id');
        return ($userStatus === '8' || $userStatus === '15');
    }

    // public function isAdmin()
    // {
    //     $userStatus = $this->session->get('user_id');
    //     return ($userStatus === '8');
    // }


    // public function index()
    // {
    //     // Periksa apakah pengguna sudah login
    //     if (!session()->has('user_id')) {
    //         return redirect()->to(site_url('/login'));
    //     }

    //     // Dapatkan ID pengguna yang saat ini login dari sesi
    //     $userId = session()->get('user_id');

    //     // Dapatkan semua pengaduan yang dibuat oleh pengguna tersebut
    //     $pengaduan = $this->pengaduanModel->getPengaduanByUserId($userId);

    //     // Data yang diperlukan untuk tampilan
    //     $data = [
    //         'title' => 'Daftar Pengaduan',
    //         'pengaduan' => $pengaduan
    //     ];

    //     // Tampilkan data pada tampilan
    //     return view('pengaduan/index', $data);
    // }



    // BENAR
    // public function index()
    // {

    //     $currentPage = $this->request->getVar('page_pengaduan') ? $this->request->getVar('page_pengaduan') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $pengaduan = $this->pengaduanModel->search($keyword);
    //     } else {
    //         $pengaduan = $this->pengaduanModel;
    //     }

    //     // $pengaduan = $this->pengaduanModel->findAll();

    //     $data = [
    //         'title' => 'Halaman Tabel Pengaduan',
    //         // 'pengaduan' => $this->pengaduanModel->findAll()
    //         'pengaduan' => $pengaduan->paginate(5, 'pengaduan'),
    //         'pager' => $this->pengaduanModel->pager,
    //         'currentPage' => $currentPage
    //     ];

    //     // $pengaduanModel = new \App\Models\PengaduanModel();


    //     return view('pengaduan/index', $data);
    // }



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



    // public function save()
    // {
    //     // validasi input
    //     if (!$this->validate([
    //         'nik' => 'required[pengaduan.nik]',
    //         'nama' => 'required[pengaduan.nama]',
    //         'tmpt_lahir' => 'required[pengaduan.tmpt_lahir]',
    //         'tgl_lahir' => 'required[pengaduan.tgl_lahir]',
    //         'jns_kelamin' => 'required[pengaduan.jns_kelamin]',
    //         'jns_kasus' => 'required[pengaduan.jns_kasus]',
    //         'deskripsi' => 'required[pengaduan.deskripsi]',
    //         'alamat' => 'required[pengaduan.alamat]',
    //         'agama' => 'required[pengaduan.agama]',
    //         'status_perkawinan' => 'required[pengaduan.status_perkawinan]',
    //         'pekerjaan' => 'required[pengaduan.pekerjaan]',
    //         'pendidikan' => 'required[pengaduan.pendidikan]',
    //         'telepon' => 'required[pengaduan.telepon]',
    //         // 'latitude' => '[pengaduan.latitude]',
    //         // 'longitude' => '[pengaduan.longitude]',

    //         'foto' => [
    //             'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    //             'errors' => [
    //                 'uploaded' => 'Upload gambar terlebih dahulu',
    //                 'max_size' => 'Ukuran gambar terlalu besar',
    //                 'is_image' => 'Yang anda pilih bukan gambar',
    //                 'mime_in' => 'Yang anda pilih bukan gambar'
    //             ]
    //         ]
    //     ])) {
    //         // $validation = \Config\Services::validation();
    //         // return redirect()->to('/pengaduan/create')->withInput()->with('validation', $validation);
    //         return redirect()->to('/pengaduan/create')->withInput();
    //     }

    //     // ambil gambar
    //     $fileFoto = $this->request->getFile('foto');
    //     // generate nama foto random
    //     $namaFoto = $fileFoto->getRandomName();
    //     // pindahkan file ke folder img
    //     $fileFoto->move('img', $namaFoto);

    //     $slug = url_title($this->request->getVar('nama'), '-', true);
    //     $this->pengaduanModel->save([
    //         'nik' => $this->request->getVar('nik'),
    //         'nama' => $this->request->getVar('nama'),
    //         'slug' => $slug,
    //         'tmpt_lahir' => $this->request->getVar('tmpt_lahir'),
    //         'tgl_lahir' => $this->request->getVar('tgl_lahir'),
    //         'jns_kelamin' => $this->request->getVar('jns_kelamin'),
    //         'jns_kasus' => $this->request->getVar('jns_kasus'),
    //         'deskripsi' => $this->request->getVar('deskripsi'),
    //         'alamat' => $this->request->getVar('alamat'),
    //         'agama' => $this->request->getVar('agama'),
    //         'status_perkawinan' => $this->request->getVar('status_perkawinan'),
    //         'pekerjaan' => $this->request->getVar('pekerjaan'),
    //         'pendidikan' => $this->request->getVar('pendidikan'),
    //         'telepon' => $this->request->getVar('telepon'),
    //         'latitude' => $this->request->getVar('latitude'),
    //         'longitude' => $this->request->getVar('longitude'),
    //         'foto' => $namaFoto
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

    //     return redirect()->to('/pengaduan');
    // }



    // BENAR
    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'jns_kasus' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'telepon' => 'required',
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Upload gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang Anda pilih bukan gambar',
                    'mime_in' => 'Yang Anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/pengaduan/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil ID pengguna yang sedang login dari session atau token otentikasi
        $userId = session()->get('user_id'); // Gantikan dengan metode otentikasi yang Anda gunakan

        // Ambil gambar
        $fileFoto = $this->request->getFile('foto');
        // Generate nama foto random
        $namaFoto = $fileFoto->getRandomName();
        // Pindahkan file ke folder img
        $fileFoto->move('img', $namaFoto);

        $this->pengaduanModel->save([
            'user_id' => $this->request->getVar('user_id'),
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
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
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
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
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil di edit');

        return redirect()->to('/pengaduan');
    }


    public function pending()
    {
        $currentPage = $this->request->getVar('page_pengaduan') ? $this->request->getVar('page_pengaduan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengaduan = $this->pengaduanModel->search($keyword);
        } else {
            $pengaduan = $this->pengaduanModel;
        }

        $data = [
            'title' => 'Pengaduan Selesai',
            'currentPage' => $currentPage,
        ];

        $data['pengaduan'] = $pengaduan->where('status_pengaduan', 'menunggu')->paginate(5, 'pengaduan', $currentPage);
        $data['pager'] = $pengaduan->where('status_pengaduan', 'menunggu')->pager;

        return view('pengaduan/pending', $data);
    }


    public function finish()
    {

        $currentPage = $this->request->getVar('page_pengaduan') ? $this->request->getVar('page_pengaduan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengaduan = $this->pengaduanModel->search($keyword);
        } else {
            $pengaduan = $this->pengaduanModel;
        }

        $data = [
            'title' => 'Pengaduan Selesai',
            'currentPage' => $currentPage,
        ];

        $data['pengaduan'] = $pengaduan->where('status_pengaduan', 'diterima')->orWhere('status_pengaduan', 'ditolak')->paginate(5, 'pengaduan', $currentPage);
        $data['pager'] = $pengaduan->where('status_pengaduan', 'diterima')->orWhere('status_pengaduan', 'ditolak')->pager;

        return view('pengaduan/finish', $data);
    }
}
