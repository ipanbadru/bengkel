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
                    <h2 class="mb-2"><i class="ni ni-money-coins mr-2"></i>Data Transaksi</h2>
                </div>
                <div class="card-body">
                    <h2>Jumlah Semua Transaksi : <?= $jumlah; ?></h2>
                    <table class="table table-bordered">
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
                            <?php $no  = 1 ?>
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
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>