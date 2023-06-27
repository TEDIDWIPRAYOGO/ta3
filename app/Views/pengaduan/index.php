<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Daftar Kasus</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="pengaduan/create" class="btn btn-primary mb-3">Buat Pengaduan</a>
            <?php

            use CodeIgniter\Filters\CSRF;

            if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
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
                                    <a href="admin/verifikasi/<?= $p['id']; ?>" class="btn btn-info">Detail</a>
                                <?php endif; ?>

                                <?php if (in_groups('user')) : ?>
                                    <a href="/pengaduan/<?= $p['id']; ?>" class="btn btn-info">Detail</a>
                                <?php endif; ?>
                                <form action="/pengaduan/<?= $p['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?');">Hapus</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?= $pager->links('pengaduan', 'pengaduan_pagination'); ?>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>