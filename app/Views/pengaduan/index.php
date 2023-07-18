<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>


<!-- BENAR -->
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h1 class="mt-2"><i class='bx bx-list-ul'></i> Daftar Kasus</h1> -->
        </div>
    </div>
    <div class="row">
        <div class="col">

            <a href="pengaduan/create" class="btn btn-primary mb-3"><i class='bx bx-plus'></i> Buat Pengaduan</a>

            <form action="<?= base_url('pengaduan') ?>" method="post">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit"><i class='bx bx-search'></i> Cari</button>
                </div>
            </form>
            <?php

            use CodeIgniter\Filters\CSRF;

            if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <?php if (in_groups('admin') || in_groups('upt_heads')) : ?>
                <?php if (empty($pengaduan)) : ?>
                    <div class="card text-center" style="max-width: 400px; margin: 0 auto; background-color: #E6E6FA; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);">
                        <div class="card-body">
                            <h5 class="card-title">Tidak ada pengaduan</h5>
                            <p class="card-text">Silahkan buat pengaduan Anda</p>
                        </div>
                    </div>
                <?php else : ?>
                    <table class="table table-striped border">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($pengaduan as $p) : ?>
                                <tr>
                                    <th><?= $i++; ?></th>
                                    <td><?= $p['nik']; ?></td>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['status_pengaduan']; ?></td>
                                    <td>
                                        <?php if (in_groups('admin')) : ?>
                                            <a href="admin/verifikasi/<?= $p['id']; ?>" class="btn btn-info"><i class='bx bx-detail'></i> Detail</a>
                                        <?php endif; ?>
                                        <?php if (in_groups('upt_heads')) : ?>
                                            <a href="/pengaduan/<?= $p['id']; ?>" class="btn btn-info"><i class='bx bx-detail'></i> Detail</a>
                                        <?php endif; ?>
                                        <form action="/pengaduan/<?= $p['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?');"><i class='bx bx-trash'></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('pengaduan', 'pengaduan_pagination'); ?>
                <?php endif; ?>
            <?php else : ?>
                <?php if (empty($pengaduan)) : ?>
                    <div class="card text-center" style="max-width: 400px; margin: 0 auto; background-color: #E6E6FA; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);">
                        <div class="card-body">
                            <h5 class="card-title">Tidak ada pengaduan</h5>
                            <p class="card-text">Silahkan buat pengaduan Anda</p>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <?php foreach ($pengaduan as $p) : ?>
                            <div class="col-md-4 mb-4">
                                <div class="card" id="special-card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $p['jns_kasus']; ?></h5>
                                        <p class="card-text"><?= date('l, F j Y', strtotime($p['created_at'])); ?></p>
                                        <p class="card-text"><?= $p['status_pengaduan']; ?></p>
                                        <a href="/pengaduan/<?= $p['id']; ?>" class="btn btn-info"><i class='bx bx-detail'></i> Detail</a>
                                        <form action="/pengaduan/<?= $p['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?');"><i class='bx bx-trash'></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?= $pager->links('pengaduan', 'pengaduan_pagination'); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>