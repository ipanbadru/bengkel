<?= $this->extend('layout/app'); ?>
<?= $this->section('search'); ?>
<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="/pelanggan" method="get">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" autocomplete="off" placeholder="Cari Pelanggan...." name="keyword" type="text">
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
                    <h2 class="mb-2"><i class="ni ni-single-02 mr-2"></i>Pelanggan</h2>
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
                    <a href="/pelanggan/tambah" class="btn btn-primary mb-3">
                        <i class="ni ni-send mr-2"></i>
                        Tambah Pelanggan
                    </a>
                    <div class="float-right">
                        <h2>Jumlah Pelanggan semua : <?= $jumlah; ?></h2>
                    </div>
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">
                                    <h4>No</h4>
                                </th>
                                <th scope="col">
                                    <h4>Nama Pelanggan</h4>
                                </th>
                                <th scope="col">
                                    <h4>Alamat</h4>
                                </th>
                                <th scope="col">
                                    <h4>No Hp</h4>
                                </th>
                                <th scope="col">
                                    <h4>Aksi</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($pelanggan as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $p['nama_pelanggan']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['no_hp']; ?></td>
                                    <td>
                                        <a class="btn btn-success" href="/pelanggan/edit/<?= $p['id']; ?>">Edit</a> /
                                        <form action="/pelanggan/<?= $p['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-8 float-right"><?= $pager->links('pelanggan', 'my_pagination'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>