<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">Laporan</h1> -->

    <a href="<?= base_url('admin/export'); ?>" class="btn btn-success mb-3">
        <li class="fas fa-file-download"></li>Eksport Excel
    </a>

    <table class="table custom-table table-bordered">
        <thead class="table-success">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kasus</th>
                <th scope="col">Alamat</th>
                <th scope="col">Dilaporkan</th>
                <th scope="col">Status Laporan</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $i = 1; ?>
            <?php foreach ($pengaduan as $p) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['jns_kasus']; ?></td>
                    <td><?= $p['alamat']; ?></td>
                    <td> <?= date('d M Y', strtotime($p['created_at'])); ?></td>
                    <td><?= $p['status_pengaduan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>

<?= $this->endSection(); ?>