<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>


<h1 class="h3 mb-4 text-gray-800">Profile</h1>
<div class="container-fluid">
    <!-- Page Heading -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css" />

    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;" id="special-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('/img/' . user()->user_image); ?>" class="img-fluid rounded-start" alt="<?= user()->username; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h4><?= user()->username; ?></h4>
                                </li>
                                <?php if (user()->fullname) : ?>
                                    <li class="list-group-item"><?= user()->fullname; ?></li>
                                <?php endif; ?>
                                <li class="list-group-item"><?= user()->email; ?></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>