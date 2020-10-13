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
        <div class="col">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h2 class="mb-2 float-left"><i class="ni ni-chart-bar-32 mr-3"></i>Data Transaksi Perbulan</h2>
                    <a href="/admin/cetakDataPerbulan?bulan=<?= $bulan ?>" class="btn btn-primary float-right" target="_blank">
                        <h4 class="text text-white"><i class="fas fa-print mr-3"></i>PRINT</h4>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <a href="/admin/dataPerbulan?bulan=1" class="btn btn-outline-light <?= ($bulan == 1) ? 'active' : ''; ?> bulan">January</a>
                            <a href="/admin/dataPerbulan?bulan=2" class="btn btn-outline-light <?= ($bulan == 2) ? 'active' : ''; ?> bulan">Februari</a>
                            <a href="/admin/dataPerbulan?bulan=3" class="btn btn-outline-light <?= ($bulan == 3) ? 'active' : ''; ?> bulan">Maret</a>
                            <a href="/admin/dataPerbulan?bulan=4" class="btn btn-outline-light <?= ($bulan == 4) ? 'active' : ''; ?> bulan">April</a>
                            <a href="/admin/dataPerbulan?bulan=5" class="btn btn-outline-light <?= ($bulan == 5) ? 'active' : ''; ?> bulan">Mei</a>
                            <a href="/admin/dataPerbulan?bulan=6" class="btn btn-outline-light <?= ($bulan == 6) ? 'active' : ''; ?> bulan">Juni</a>
                            <a href="/admin/dataPerbulan?bulan=7" class="btn btn-outline-light <?= ($bulan == 7) ? 'active' : ''; ?> bulan">Juli</a>
                            <a href="/admin/dataPerbulan?bulan=8" class="btn btn-outline-light <?= ($bulan == 8) ? 'active' : ''; ?> bulan">Agustus</a>
                        </div>
                        <div class="col-7 mt-2">
                            <a href="/admin/dataPerbulan?bulan=9" class="btn btn-outline-light <?= ($bulan == 9) ? 'active' : ''; ?> bulan">September</a>
                            <a href="/admin/dataPerbulan?bulan=10" class="btn btn-outline-light <?= ($bulan == 10) ? 'active' : ''; ?> bulan">Oktober</a>
                            <a href="/admin/dataPerbulan?bulan=11" class="btn btn-outline-light <?= ($bulan == 11) ? 'active' : ''; ?> bulan">November</a>
                            <a href="/admin/dataPerbulan?bulan=12" class="btn btn-outline-light <?= ($bulan == 12) ? 'active' : ''; ?> bulan">Desember</a>
                        </div>
                    </div>
                    <h2 class="mt-4">Jumlah Semua Transaksi : <span class="jumlah_transaksi"><?= $jumlah; ?></span>, jumlah Pengeluaran barang : <span class="jumlah_barang"><?= $jumlah_barang['jumlah_barang'] ?></span>, Total Pendapatan : Rp.<span class="total_pendapatan"><?= number_format($total_pendapatan['total'], 0, ".", "."); ?></span></h2>
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
                                    <h4>Tanggal</h4>
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
                            <?php $no  = 1 + (5 * ($currentPage - 1)) ?>
                            <?php foreach ($transaksi as $t) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $t['nama_pelanggan']; ?></td>
                                    <td><?= $t['tanggal']; ?></td>
                                    <td><?= $t['waktu_servis']; ?></td>
                                    <td>Rp.<?= $t['total']; ?></td>
                                    <td><button type="button" class="btn btn-info btnDetail" data-toggle="modal" data-target="#exampleModal" data-id="<?= $t['id']; ?>">Detail</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-8 float-right"><?= $pager->links('transaksi', 'my_pagination'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
                            <h4>Montir : <span class="montir"></span></h4>
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
                let id = this.dataset.id;
                fetch('/admin/detailTransaksi/?id=' + id, {
                        method: "get",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                        document.querySelector('span.nama_pelanggan').innerHTML = data.nama_pelanggan;
                        document.querySelector('span.merk_motor').innerHTML = data.merk_motor;
                        document.querySelector('span.tanggal').innerHTML = data.tanggal;
                        document.querySelector('span.kendala').innerHTML = data.kendala;
                        document.querySelector('span.keterangan').innerHTML = data.keterangan;
                        document.querySelector('span.pengeluaran_barang').innerHTML = data.pengeluaran_barang;
                        document.querySelector('span.waktu_servis').innerHTML = data.waktu_servis;
                        document.querySelector('span.total').innerHTML = data.total;
                        document.querySelector('span.montir').innerHTML = data.nama_montir;
                    });
            });
        });
    </script>
    <?= $this->endSection(); ?>