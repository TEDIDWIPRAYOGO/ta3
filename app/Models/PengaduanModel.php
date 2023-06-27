<?php

namespace App\Models;

use CodeIgniter\Model;


class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nik', 'nama', 'slug', 'tmpt_lahir', 'tgl_lahir', 'jns_kelamin', 'jns_kasus', 'status_pengaduan', 'deskripsi', 'alamat', 'agama', 'status_perkawinan', 'pekerjaan', 'pendidikan', 'telepon', 'foto', 'latitude', 'longitude'];
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
        // $builder = $this->table('pengaduan');
        // $builder->like('nama', '$keyword');
        // return $builder;

        return $this->table('pengaduan')->like('nama', $keyword);
    }


    // Fungsi untuk memperbarui status pengaduan
    public function verifikasiPengaduan($id, $status)
    {
        $data = [
            'status_pengaduan' => $status
        ];
        $this->update($id, $data);
    }
}
