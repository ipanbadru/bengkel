<?= $this->extend('layout/app'); ?>
<?= $this->section('search'); ?>
<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="/montir" method="post">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" autocomplete="off" placeholder="Cari Montir...." name="keyword" type="text">
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
                    <h2 class="mb-2"><i class="ni ni-settings mr-2"></i>Montir</h2>
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
                    <button type="button" class="btn btn-primary mb-3 tambahButton" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-send mr-2"></i>Tambah Montir</button>
                    <div class="float-right">
                        <h2>Jumlah Montir : <?= $jumlah; ?></h2>
                    </div>
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">
                                    <h4>No</h4>
                                </th>
                                <th scope="col">
                                    <h4>Nama</h4>
                                </th>
                                <th scope="col">
                                    <h4>Alamat</h4>
                                </th>
                                <th scope="col">
                                    <h4>Aksi</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 + (5 * ($currentPage - 1)); ?>
                            <?php foreach ($montir as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $m['nama_montir']; ?></td>
                                    <td><?= $m['alamat_montir']; ?></td>
                                    <td>
                                        <button class="btn btn-success editButton" data-toggle="modal" data-target="#exampleModal" data-id="<?= $m['id']; ?>">Edit</button> /
                                        <form action="/montir/<?= $m['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-8 float-right"><?= $pager->links('montir', 'my_pagination'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Montir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="id">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">Tambah Montir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('.editButton').click(function() {
            const id = $(this).data('id');
            $('#exampleModalLabel').html('Edit Montir');
            $('.save').html('Edit Montir');
            $.ajax({
                url: '/montir/edit',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#nama').val(data.nama_montir);
                    $('#alamat').val(data.alamat_montir);
                }
            });
        });
        $('.tambahButton').click(function() {
            $('#id').val('');
            $('#nama').val('');
            $('#alamat').val('');
            $('#exampleModalLabel').html('Tambah Montir');
            $('.save').html('Tambah Montir');
        });
        $('.save').click(function() {
            if ($('#nama').val() == '') {
                if ($('#alamat').val() == '') {
                    if (!$('#nama').hasClass('is-invalid')) {
                        $('#nama').addClass('is-invalid');
                        $('#nama').after(`<div class="invalid-feedback">
                                    Input nama harus di isi
                                </div>`);
                    }
                    if (!$('#alamat').hasClass('is-invalid')) {
                        $('#alamat').addClass('is-invalid');
                        $('#alamat').after(`<div class="invalid-feedback">
                                    Input alamat harus di isi
                                </div>`);
                    }
                } else {
                    if (!$('#nama').hasClass('is-invalid')) {
                        $('#nama').addClass('is-invalid');
                        $('#nama').after(`<div class="invalid-feedback">
                                    Input nama harus di isi
                                </div>`);
                    }
                    $('#alamat').removeClass('is-invalid');
                }
            } else {
                if ($('#alamat').val() == '') {
                    $('#alamat').addClass('is-invalid');
                    $('#alamat').after(`<div class="invalid-feedback">
                                    Input alamat harus di isi
                                </div>`);
                    $('#nama').removeClass('is-invalid');
                }
            }
            if ($('#alamat').val() != '' || $('#nama').val() != '') {
                $.ajax({
                    url: '/montir/tambah',
                    method: 'post',
                    data: {
                        id: $('#id').val(),
                        nama: $('#nama').val(),
                        alamat: $('#alamat').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        document.location.reload(true);
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>