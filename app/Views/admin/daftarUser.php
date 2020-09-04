<?= $this->extend('layout/app'); ?>
<?= $this->section('search'); ?>
<!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="/barang" method="post">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" autocomplete="off" placeholder="Cari barang...." name="keyword" type="text">
        </div>
    </div>
</form> -->
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
                    <i class="ni ni-badge text-black mr-2 ml-2"></i>
                    <h2 class="mb-0 d-inline"><b>Daftar User</b></h2>
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
                        <h2 class="">Jumlah Semua user : <?= $jumlah; ?></h2>
                        <div class="row">
                            <div class="col-md">

                                <table class="table table-bordered mb-4">
                                    <thead>
                                        <tr>
                                            <th class="table-active">
                                                <h5>NO</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Nama</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Username</h5>
                                            </th>
                                            <th class="table-active">
                                                <h5>Role</h5>
                                            </th>
                                            <th class="table-active text-center">
                                                <h5><b>Aksi</b></h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($user as $u) : ?>
                                            <tr>
                                                <th scope="row"><?= $no++; ?></th>
                                                <td><?= $u['nama']; ?></td>
                                                <td><?= $u['username']; ?></td>
                                                <td><?= $u['role']; ?></td>
                                                <td><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btnEdit" data-id="<?= $u['id']; ?>">Edit</button> |
                                                    <form action="/user/<?= $u['id']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button onclick="return confirm('Yakin?')" class="btn btn-danger">Hapus
                                                        </button>
                                                    </form> | <button data-toggle="modal" data-target="#passwordModal" class="btn btn-info resetPsd" data-id="<?= $u['id']; ?>">Reset Pswd</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Password -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Reset Password User untuk user <span id="nama_user"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/resetPassword" method="post">
                    <input type="hidden" name="id" id="idPswd">
                    <label>Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="password1" name="password2" onkeyup="validationPswd(this);" onclick="validationPswd(this);">
                        <div class="invalid-feedback">
                            Input harus di isi
                        </div>
                    </div>
                    <label>Repeat Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="password2" name="password2" onkeyup="validationPswd(this);" onclick="validationPswd(this);">
                        <div class="invalid-feedback invalidPswd2">
                            Input harus di isi
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnSave">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/update" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="role">
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    const btnEdit = document.querySelectorAll('.btnEdit');
    const pswd1 = document.querySelector('#password1');
    const btnSave = document.querySelector('.btnSave');
    const pswd2 = document.querySelector('#password2');
    btnSave.style.display = 'none';
    btnEdit.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch('/user/edit?id=' + id, {
                method: "get",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => response.json()).then(data => {
                let option = document.querySelectorAll('option');
                option.forEach(select => {
                    if (select.hasAttribute('selected')) {
                        select.removeAttribute('selected');
                    }
                });
                document.getElementById('id').value = data.id;
                document.getElementById('nama').value = data.nama;
                document.getElementById('username').value = data.username;
                option.forEach(select => {
                    if (select.getAttribute('value') == data.role) {
                        select.setAttribute('selected', 'selected');
                    }
                });
            });
        });
    });
    const btnPsd = document.querySelectorAll('.resetPsd');
    btnPsd.forEach(btn => {
        btn.addEventListener('click', function() {
            pswd1.value = '';
            pswd2.value = '';
            pswd1.classList.remove('is-invalid');
            pswd1.classList.remove('is-valid');
            pswd2.classList.remove('is-invalid');
            pswd2.classList.remove('is-valid');
            btnSave.style.display = 'none';
            const id = this.dataset.id;
            fetch('/user/edit?id=' + id, {
                method: "get",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => response.json()).then(data => {
                document.querySelector('span#nama_user').innerHTML = data.username;
                document.getElementById('idPswd').setAttribute('value', data.id);
            });
        });
    });


    function validationPswd(input) {
        if (input.value == '') {
            if (input.classList.contains('is-valid')) {
                input.classList.remove('is-valid');
            }
            input.classList.add('is-invalid');
            if (input.value == pswd2.value) {
                document.querySelector('div.invalidPswd2').innerHTML = 'Input harus di isi';
            }
            btnSave.style.display = 'none';
        } else {
            if (input == pswd2) {
                if (input.value == pswd1.value) {
                    if (input.classList.contains('is-invalid')) {
                        input.classList.remove('is-invalid');
                    }
                    input.classList.add('is-valid');
                    btnSave.style.display = 'block';
                } else {
                    if (input.classList.contains('is-valid')) {
                        input.classList.remove('is-valid');
                    }
                    input.classList.add('is-invalid');
                    document.querySelector('div.invalidPswd2').innerHTML = 'Input anda tidak sama dengan password sebelumnya';
                    btnSave.style.display = 'none';
                }
            } else {
                if (input.classList.contains('is-invalid')) {
                    input.classList.remove('is-invalid');
                }
                input.classList.add('is-valid');
            }
        }
    }
</script>
<?= $this->endSection(); ?>