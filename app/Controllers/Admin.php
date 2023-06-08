<?php

namespace App\Controllers;

use App\Models\PengaduanModel;

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

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
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


        // $pengaduan = $this->pengaduanModel->findAll();

        $data = [
            'title' => 'Halaman Tabel Pengaduan',
            'pengaduan' => $this->pengaduanModel->findAll()
            // 'pengaduan' => $pengaduan,
            // 'pager' => $this->pengaduanModel,
            // 'currentPage' => $currentPage
        ];
        return view('admin/report', $data);
    }


    // public function progress()
    // {
    //     $data = [
    //         'title' => 'Dashboard'
    //     ];
    //     return view('admin/progress', $data);
    // }

    // public function export()
    // {
    //     // $data = [
    //     //     'title' => 'Export File'
    //     // ];
    //     // return view('admin/export', $data);
    // }
}
