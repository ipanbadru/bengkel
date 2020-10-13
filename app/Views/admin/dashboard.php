<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Pelanggan</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $jumlah_pelanggan; ?></span>
                                </div>   
                                <div class="col-auto">
                                    <div class="ni icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-single-02"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-1 mb-0 text-sm">
                                <span class="text-success mr-2"><a href="/pelanggan">Lihat detail pelanggan</a></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Stok barang</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $jumlah_stok['stok']; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-1 mb-0 text-sm">
                                <span class="text-success mr-2"><a href="/barang">Lihat detail barang</a></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Transaksi</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $jumlah_transaksi; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-1 mb-0 text-sm">
                                <span class="text-success mr-2"><a href="/admin/dataTransaksi">Lihat Detail Transaksi</a></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0"> Pelanggan bulan ini</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $jumlah_pelanggan_bulan_ini; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-chart-bar-32"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-1 mb-0 text-sm">
                                <span class="text-success mr-2"><a href="/admin/dataPerbulan">Lihat Data perbulan</a></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Pelanggan Paling sering datang</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">No telepon</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Datang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            <?php foreach ($pelanggan as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $p['nama_pelanggan']; ?></th>
                                    <td><?= $p['no_hp']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['jml_datang']; ?> kali</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
    <?= $this->section('script'); ?>
    <script>
        const ctx = document.getElementById('myChart');
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($nama_barang); ?>,
                datasets: [{
                    label: 'Stok',
                    data: <?= json_encode($jumlah_barang); ?>,
                    backgroundColor: [
                        'rgba(137, 196, 244, .8)'

                    ],
                    borderColor: [
                        'blue'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <?= $this->endSection(); ?>
    <!-- Footer -->