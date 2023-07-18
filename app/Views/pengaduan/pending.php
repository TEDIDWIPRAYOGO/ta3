<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- No Pengaduan -->
<style>
    @keyframes zoom-in {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .card {
        animation: zoom-in 2s infinite;
    }

    .card:hover {
        animation: none;
    }
</style>

<!-- BENAR -->
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-6">
            <!-- <h1 class="mt-2"><i class='bx bx-list-ul'></i>Menunggu Verifikasi</h1> -->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="pengaduan/create" class="btn btn-primary mb-3"><i class='bx bx-plus'></i> Buat Pengaduan</a>
            <form action="<?= base_url('pengaduan') ?>" method="post">
                <!-- <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit"><i class='bx bx-search'></i> Cari</button>
                </div> -->
            </form>
            <?php

            use CodeIgniter\Filters\CSRF;

            if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <?php if (empty($pengaduan)) : ?>
                <div class="card text-center" style="max-width: 400px; margin: 0 auto; background-color: #E6E6FA; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);">
                    <div class="card-body">
                        <h5 class="card-title">Tidak ada pengaduan</h5>
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
                <?php endif; ?>
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
                                    <a href="/admin/verifikasi/<?= $p['id']; ?>" class="btn btn-info"><i class='bx bx-detail'></i> Detail</a>
                                <?php endif; ?>

                                <?php if (in_groups('user')) : ?>
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

        </div>
    </div>
</div>



<?= $this->endSection(); ?>