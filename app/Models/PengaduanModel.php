<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Models\UserModel;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nik', 'nama', 'slug', 'tmpt_lahir', 'tgl_lahir', 'jns_kelamin', 'jns_kasus', 'status_pengaduan', 'deskripsi', 'alamat', 'agama', 'status_perkawinan', 'pekerjaan', 'pendidikan', 'telepon', 'foto', 'latitude', 'longitude', 'user_id'];
    // EDIT
    protected $primaryKey = 'id';
    // ------
    public function getPengaduan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $slug])->first();
    }


    public function search($keyword)
    {
        return $this->table('pengaduan')->like('nama', $keyword)->orLike('jns_kasus', $keyword);
    }



    // Fungsi untuk memperbarui status pengaduan
    public function verifikasiPengaduan($id, $status)
    {
        $data = [
            'status_pengaduan' => $status
        ];
        $this->update($id, $data);
    }



    // Fungsi untuk mendapatkan data pengaduan berdasarkan ID pengguna
    public function getPengaduanByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
