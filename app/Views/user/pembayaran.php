<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class=" col ">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h2 class="mb-2"><i class="ni ni-laptop mr-2"></i>Pembayaran</h2>
                </div>
                <div class="session">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 content-pembayaran">
                        <?php foreach ($notifications as $n) : ?>
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nama Pelanggan : <?= $n['nama_pelanggan']; ?></h5>
                                        <h5 class="card-title">Jenis Motor : <?= $n['detail_merk']; ?></h5>
                                        <p class="card-text">Kendala : <?= $n['kendala']; ?></p>
                                        <a href="pembayaran/bayar/<?= $n['id']; ?>" class="btn btn-success">Bayar</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>