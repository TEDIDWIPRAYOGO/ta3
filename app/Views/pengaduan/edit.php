<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Form Edit Pengaduan</h2>
            <form action="/pengaduan/update/<?= $pengaduan['id']; ?>" method="post" class="row g-3" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $pengaduan['slug']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $pengaduan['foto']; ?>">
                <div class="col-md-6">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control mb-3 <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" autofocus value="<?= (old('nik')) ? old('nik') : $pengaduan['nik'] ?> ">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nik'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="agama" class="form-label">Agama</label>
                    <input type="text" class="form-control" id="agama" name="agama" value="<?= (old('agama')) ? old('agama') : $pengaduan['agama'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control mb-3" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $pengaduan['nama'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                    <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" value="<?= (old('status_perkawinan')) ? old('status_perkawinan') : $pengaduan['status_perkawinan'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control mb-3" id="tmpt_lahir" name="tmpt_lahir" value="<?= (old('tmpt_lahir')) ? old('tmpt_lahir') : $pengaduan['tmpt_lahir'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= (old('pekerjaan')) ? old('pekerjaan') : $pengaduan['pekerjaan'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control mb-3" id="tgl_lahir" name="tgl_lahir" value="<?= (old('tgl_lahir')) ? old('tgl_lahir') : $pengaduan['tgl_lahir'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="pendidikan" class="form-label">Pendidikan</label>
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?= (old('pendidikan')) ? old('pendidikan') : $pengaduan['pendidikan'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="jns_kelamin" class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control mb-3" id="jns_kelamin" name="jns_kelamin" value="<?= (old('jns_kelamin')) ? old('jns_kelamin') : $pengaduan['jns_kelamin'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="telepon" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= (old('telepon')) ? old('telepon') : $pengaduan['telepon'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="jns_kasus" class="form-label">Jenis Kasus</label>
                    <input type="text" class="form-control mb-3" id="jns_kasus" name="jns_kasus" value="<?= (old('jns_kasus')) ? old('jns_kasus') : $pengaduan['jns_kasus'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $pengaduan['alamat'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="deskripsi" class="form-label">Keterangan</label>
                    <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"><?= (old('deskripsi')) ? old('deskripsi') : $pengaduan['deskripsi'] ?></textarea>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="custom-form-label">Foto KTP/KK</label>
                        <div class="col-sm-2">
                            <img src="/img/<?= $pengaduan['foto']; ?>" class="img-thumbnail img-preview">
                        </div>
                        <input class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" type="file" onchange="previewImg()">
                    </div>
                </div>

                <div class="col-md-6">
                    <br>
                    <h6>Lokasi</h6>
                    <div id="map" style="width: 530px; height: 350px;"></div>
                    <input type="hidden" name="latitude" id="latitude" value="<?= $pengaduan['latitude'] ?>">
                    <input type="hidden" name="longitude" id="longitude" value="<?= $pengaduan['longitude'] ?>">


                    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
                    <script>
                        var map = L.map('map').setView([<?= $pengaduan['latitude'] ?>, <?= $pengaduan['longitude'] ?>], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                        }).addTo(map);

                        var marker = L.marker([<?= $pengaduan['latitude'] ?>, <?= $pengaduan['longitude'] ?>], {
                            draggable: false
                        }).addTo(map);

                        marker.bindPopup("Lokasi saat ini").openPopup();
                    </script>



                    <div class=" col-12">
                        <button type="submit" class="btn btn-primary mt-3 mb-3">Kirim</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>