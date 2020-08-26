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
                    <h2 class="mb-2"><i class="ni ni-chart-pie-35 mr-2"></i>History Pembayaran/Transaksi hari ini</h2>
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
                    <?php if ($transaksi == []) : ?>
                        <h1 class="text text-center">Belum Ada Pembayaran/Transaksi hari ini</h1>
                    <?php else : ?>
                        <h2>Jumlah pembayaran hari ini : <?= $jumlah; ?></h2>
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
                                        <h4>Keterangan</h4>
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
                                        <td><?= $t['keterangan']; ?></td>
                                        <td><?= $t['waktu_servis']; ?></td>
                                        <td>Rp.<?= $t['total']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>