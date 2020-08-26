<?= $this->extend('layout/app'); ?>
<?= $this->section('search'); ?>
<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="/admin/dataTransaksi" method="post">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" autocomplete="off" placeholder="Masukan Keyword Pencarian...." name="keyword" type="text">
        </div>
    </div>
</form>
<?= $this->endSection(); ?>
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
                    <h2 class="mb-2"><i class="ni ni-money-coins mr-2"></i>Data Transaksi</h2>
                </div>
                <div class="card-body">
                    <h2>Jumlah Semua Transaksi : <?= $jumlah; ?></h2>
                    <table class="table table-bordered mb-4">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">
                                    <h4>No</h4>
                                </th>
                                <th scope="col">
                                    <h4>Nama Pelanggan</h4>
                                </th>
                                <th scope="col">
                                    <h4>Merk Motor</h4>
                                </th>
                                <th scope="col">
                                    <h4>Tanggal</h4>
                                </th>
                                <th scope="col">
                                    <h4>Waktu Servis</h4>
                                </th>
                                <th scope="col">
                                    <h4>Total Harga</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no  = 1 + (5 * ($currentPage - 1)) ?>
                            <?php foreach ($transaksi as $t) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $t['nama_pelanggan']; ?></td>
                                    <td><?= $t['merk_motor']; ?></td>
                                    <td><?= $t['tanggal']; ?></td>
                                    <td><?= $t['waktu_servis']; ?></td>
                                    <td>Rp.<?= $t['total']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-8 float-right"><?= $pager->links('transaksi', 'my_pagination'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>