<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Pengaduan</h2>
            <div class="col border bg-light">
                <form class="row g-2">
                    <div class="col-md-6 mt-3">
                        <label for="nik" class="form-label ms-3">NIK</label>
                        <label class="form-control"><?= $pengaduan['nik']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Agama</label>
                        <label class="form-control"><?= $pengaduan['agama']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nama" class="form-label ms-3">Nama</label>
                        <label class="form-control"><?= $pengaduan['nama']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Status Perkawinan</label>
                        <label class="form-control"><?= $pengaduan['status_perkawinan']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nik" class="form-label ms-3">Tempat Lahir</label>
                        <label class="form-control"><?= $pengaduan['tmpt_lahir']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Pekerjaan</label>
                        <label class="form-control"><?= $pengaduan['pekerjaan']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nik" class="form-label ms-3">Tanggal Lahir</label>
                        <label class="form-control"><?= $pengaduan['tgl_lahir']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Pendidikan</label>
                        <label class="form-control"><?= $pengaduan['pendidikan']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nik" class="form-label ms-3">Jenis Kelamin</label>
                        <label class="form-control"><?= $pengaduan['jns_kelamin']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">No. Telepon</label>
                        <label class="form-control"><?= $pengaduan['telepon']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nik" class="form-label ms-3">Jenis Kasus</label>
                        <label class="form-control"><?= $pengaduan['jns_kasus']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Alamat</label>
                        <label class="form-control"><?= $pengaduan['alamat']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Status Laporan</label>

                        <?php if (in_groups('admin')) : ?>
                            <input placeholder="menunggu.." type="text" class="form-control" id="status_laporan" name="status_laporan"">
                        <?php endif; ?>

                        <?php if (in_groups('user')) : ?>
                        <label class=" form-control"><?= $pengaduan['status_pengaduan']; ?></label>
                        <?php endif; ?>


                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Keterangan</label>
                        <label class="form-control"><?= $pengaduan['deskripsi']; ?></label>
                    </div>
                    <div class="col-md-6 mt-3 mb-5">
                        <label for="foto" class="form-label ms-3">Foto KTP/KK</label>
                        <img src="/img/<?= $pengaduan['foto']; ?>" class="card-img">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label ms-3">Lokasi</label>
                        <img src="/img/<?= $pengaduan['foto']; ?>" class="card-img">
                    </div>





            </div>
            </form>
            <div class="col-md-6 mt-3 mb-5">

                <a href="/pengaduan" class="btn btn-primary">&laquo Kembali</a>
                <?php if (in_groups('user')) : ?>
                    <a href="/pengaduan/edit/<?= $pengaduan['id']; ?>" class="btn btn-warning"> Edit &raquo</a>
                <?php endif; ?>

                <?php if (in_groups('admin')) : ?>
                    <a href="/pengaduan/<?= $pengaduan['id']; ?>" class="btn btn-success"> Verifikasi Pengaduan &raquo</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>