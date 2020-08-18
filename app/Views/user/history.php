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
                    <h2 class="mb-2"><i class="ni ni-chart-pie-35 mr-2"></i>History Pembayaran hari ini</h2>
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
                        <h1 class="text text-center">Belum Ada pembayaran hari ini</h1>
                    <?php else : ?>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">
                                        <b>No</b>
                                    </th>
                                    <th scope="col">
                                        <b>Nama Pelanggan</b>
                                    </th>
                                    <th scope="col">
                                        <b>Merk Motor</b>
                                    </th>
                                    <th scope="col">
                                        <b>Keterangan</b>
                                    </th>
                                    <th scope="col">
                                        <b>Waktu Servis</b>
                                    </th>
                                    <th scope="col">
                                        <b>Total Harga</b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no  = 1 ?>
                                <?php foreach ($transaksi as $t) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $t['nama_pelanggan']; ?></td>
                                        <td><?= $t['merk']; ?></td>
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