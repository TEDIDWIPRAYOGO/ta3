<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Form Membuat Pengaduan</h2>
            <form action="/pengaduan/save" method="post" class="row g-3" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="col-md-6">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control mb-3 <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" autofocus value="<?= old('nik'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nik'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="agama" class="form-label">Agama</label>
                    <input type="text" class="form-control" id="agama" name="agama" value="<?= old('agama'); ?>">
                </div>
                <div class=" col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control mb-3" id="nama" name="nama" value="<?= old('nama'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                    <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" value="<?= old('status_perkawinan'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control mb-3" id="tmpt_lahir" name="tmpt_lahir" value="<?= old('tmpt_lahir'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control mb-3" id="tgl_lahir" name="tgl_lahir" value="<?= old('tgl_lahir'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="pendidikan" class="form-label">Pendidikan</label>
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?= old('pendidikan'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="jns_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select mb-3" id="jns_kelamin" name="jns_kelamin" value="<?= old('jns_kelamin'); ?>">
                        <option value=""></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="telepon" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= old('telepon'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="jns_kasus" class="form-label">Jenis Kasus</label>
                    <input type="text" class="form-control mb-3" id="jns_kasus" name="jns_kasus" value="<?= old('jns_kasus'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                </div>

                <div class="col-md-6">
                    <label for="deskripsi" class="form-label">Keterangan</label>
                    <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= old('deskripsi'); ?>"></textarea>
                </div>


                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto KTP/KK</label>
                        <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                    </div>
                </div>



                <!-- MAPS -->
                <div class="col-md-6">
                    <br>
                    <h6>Lokasi</h6>
                    <div id="map" style="width: 530px; height: 350px;"></div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
                    <script>
                        var map = L.map('map').setView([1.5060640410332051, 102.24833645407905], 10); // Set default view to Jakarta, Indonesia

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                        }).addTo(map);

                        map.locate({
                            setView: true,
                            maxZoom: 16
                        });

                        function onLocationFound(e) {
                            var marker = L.marker(e.latlng, {
                                draggable: false
                            }).addTo(map);
                            document.getElementById('latitude').value = e.latlng.lat;
                            document.getElementById('longitude').value = e.latlng.lng;

                            marker.bindPopup("Lokasi saat ini").openPopup();
                        }

                        function onLocationError(e) {
                            alert(e.message);
                        }

                        map.on('locationfound', onLocationFound);
                        map.on('locationerror', onLocationError);
                    </script>


                </div>
        </div>

        <!-- <div class="col-md-6">
                    <label for="lokasi" class="form-label">Foto KTP/KK</label>
                    <div class="col-sm-2">
                        <img src="/img/g2.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                        <div class="invalid-feedback">
                            
                        </div>
                        <label class="custom-file-label" for="foto">Upload</label>
                    </div>
                </div> -->

        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-5 mb-4">Kirim</button>
        </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>