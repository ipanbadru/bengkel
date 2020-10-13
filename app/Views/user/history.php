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
                <div class="card-body">
                    <?php if ($transaksi == []) : ?>
                        <h1 class="text text-center">Belum Ada Pembayaran/Transaksi hari ini</h1>
                    <?php else : ?>
                        <h2 class="d-inline">Jumlah pembayaran hari ini : <?= $jumlah; ?></h2>
                        <a href="/pembayaran/cetakDataHariIni" class="btn btn-primary float-right mb-3" target="_blank">
                            <h4 class="text text-white"><i class="fas fa-print mr-3"></i>PRINT</h4>
                        </a>
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
                                        <h4>Waktu Servis</h4>
                                    </th>
                                    <th scope="col">
                                        <h4>Total Harga</h4>
                                    </th>
                                    <th scope="col">
                                        <h4>Aksi</h4>
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
                                        <td><?= $t['waktu_servis']; ?></td>
                                        <td>Rp.<?= $t['total']; ?></td>
                                        <td><button type="button" class="btn btn-info btnDetail" data-toggle="modal" data-target="#exampleModal" data-id="<?= $t['id']; ?>">Detail</button></td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h3>Nama Pelanggan : <span class="nama_pelanggan"></span></h3>
                    </li>
                    <li class="list-group-item">
                        <h4>Merk Motor : <span class="merk_motor"></span></h4>
                    </li>
                    <li class="list-group-item">
                        <h4>Tanggal : <span class="tanggal"></span></h4>
                    </li>
                    <li class="list-group-item">
                        <h4>kendala : <span class="kendala"></span></h4>
                    </li>
                    <li class="list-group-item">
                        <h4>keterangan : <span class="keterangan"></span></h4>
                    </li>
                    <li class="list-group-item">
                        <h4>pengeluaran barang : <span class="pengeluaran_barang"></span></h4>
                    </li>
                    <li class="list-group-item">
                        <h4>Waktu servis : <span class="waktu_servis"></span></h4>
                    </li>
                    <li class="list-group-item">
                        <h4>Total Harga : Rp.<span class="total"></span></h4>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    const tombol = document.querySelectorAll('.btnDetail');
    tombol.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch('/admin/detailTransaksi/?id=' + id, {
                    method: "get",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }).then(response => response.json())
                .then(data => {
                    document.querySelector('span.nama_pelanggan').innerHTML = data.nama_pelanggan;
                    document.querySelector('span.merk_motor').innerHTML = data.merk_motor;
                    document.querySelector('span.tanggal').innerHTML = data.tanggal;
                    document.querySelector('span.kendala').innerHTML = data.kendala;
                    document.querySelector('span.keterangan').innerHTML = data.keterangan;
                    document.querySelector('span.pengeluaran_barang').innerHTML = data.pengeluaran_barang;
                    document.querySelector('span.waktu_servis').innerHTML = data.waktu_servis;
                    document.querySelector('span.total').innerHTML = data.total;
                });
        });
    });
</script>
<?= $this->endSection(); ?>