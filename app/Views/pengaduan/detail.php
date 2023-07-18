<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card text-center col-md-12">
                <div class="card-header">
                    <h5 class="card-title">Detail Pengaduan</h5>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mt-4 text-left">Isi Pengaduan</h5>
                                            <hr class="my-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Jenis Kasus</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['jns_kasus']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Keterangan</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['deskripsi']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Status Laporan</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['status_pengaduan']; ?></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card-body">
                                                <h5 class="card-title text-left">Lokasi</h5>
                                                <hr class="my-4">
                                                <div id="map" style="width: 495px; height: 350px;"></div>

                                                <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
                                                <script>
                                                    var map = L.map('map').setView([<?= $pengaduan['latitude'] ?>, <?= $pengaduan['longitude'] ?>], 13);

                                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                                                    }).addTo(map);

                                                    var marker = L.marker([<?= $pengaduan['latitude'] ?>, <?= $pengaduan['longitude'] ?>]).addTo(map);
                                                    marker.bindPopup("Lokasi Saya").openPopup();
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <a href="/pengaduan" class="btn btn-primary mb-3">&laquo Kembali</a>
                                    <?php if (in_groups('user')) : ?>
                                        <a href="/pengaduan/edit/<?= $pengaduan['id']; ?>" class="btn btn-warning mb-3"> Edit &raquo</a>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-5">
                                    <div class="card">
                                        <img src="/img/<?= $pengaduan['foto']; ?>" class="card-img-top" alt="Foto">
                                        <br>
                                        <div class="card-body">
                                            <h5 class="card-title text-left">Data Diri</h5>
                                            <hr class="my-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">NIK</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['nik']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Nama</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['nama']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Tempat Lahir</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['tmpt_lahir']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Tanggal Lahir</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= date('d M Y', strtotime($pengaduan['tgl_lahir'])); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Jenis Kelamin</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['jns_kelamin']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Agama</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['agama']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Pekerjaan</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['pekerjaan']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Pendiidkan</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['pendidikan']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Telp/WA</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['telepon']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="font-weight-bold text-left bg-light">Alamat</p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-left bg-light">: <?= $pengaduan['alamat']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>