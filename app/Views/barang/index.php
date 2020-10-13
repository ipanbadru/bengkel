<?= $this->extend('layout/app'); ?>
<?= $this->section('search'); ?>
<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="/barang" method="get">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" autocomplete="off" placeholder="Cari barang...." name="keyword" type="text">
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
                    <i class="ni ni-box-2 text-black mr-2 ml-2"></i>
                    <h2 class="mb-0 d-inline"><b>Daftar Barang</b></h2>
                </div>
                <div class="container">
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
                    <div class="container">
                        <a href="/barang/tambah" class="btn btn-primary mb-3 mt--3">
                            <i class="ni ni-send mr-2"></i>Tambah Barang</a>
                        <h2 class="float-right">Jumlah Semua Barang : <?= $jumlah; ?></h2>
                        <div class="row">
                            <div class="col-md">

                                <table class="table table-bordered mb-4">
                                    <thead>
                                        <tr>
                                            <th class="table-active">
                                                <h5>NO</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Barang</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Stok</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Harga Beli</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Harga Jual</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Aksi</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1  + (5 * ($currentPage - 1)); ?>
                                        <?php foreach ($barang as $b) : ?>
                                            <tr>
                                                <th scope="row"><?= $no++; ?></th>
                                                <td><?= $b['barang']; ?></td>
                                                <td><?= $b['stok']; ?></td>
                                                <td>Rp.<?= $b['harga_beli']; ?></td>
                                                <td>Rp.<?= $b['harga_jual']; ?></td>
                                                <td><a href="/barang/edit/<?= $b['id']; ?>" class="btn btn-success">Edit</a> |
                                                    <form action="/barang/<?= $b['id']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button onclick="return confirm('Yakin?')" class="btn btn-danger">Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="col-8 float-right"><?= $pager->links('barang', 'my_pagination'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>