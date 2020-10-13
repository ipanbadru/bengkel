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
            <div class="card bg-secondary">
                <div class="card-header bg-primary">
                </div>
                <div class="col">
                    <div class="card-profile-image">
                        <img src="/img/profile.png" class="rounded-circle mb-4">
                    </div>
                </div>
                <div class="card-body bg-secondary">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-primary alert-dismissible fade show mt-5" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between mt-1">
                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal">edit Profile</button>
                            <button class="btn btn-info changePassword" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <button type="button" class="list-group-item list-group-item-action">
                            Nama : <?= $user['nama']; ?>
                        </button>
                        <button type="button" class="list-group-item list-group-item-action">Username : <?= $user['username']; ?></button>
                        <button type="button" class="list-group-item list-group-item-action">Role : <?= $user['role']; ?></button>
                        <button type="button" class="list-group-item list-group-item-action">Transaksi : <?= $transaksi; ?></button>
                        <button type="button" class="list-group-item list-group-item-action">Pembayaran : <?= $bayar; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Change password modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/profile/changePassword" method="post">
                <input type="hidden" name="password" id="password">
                <div class="modal-body passwordModalBody">
                    <label for="">Masukan Password saat ini</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control inputChange" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary changePswd">Oke</button>
            </form>
        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/profile/updateProfile" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="username" value="<?= $user['username'] ?>">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    const modalChange = document.querySelector('.changePassword');
    const content = document.querySelector('.passwordModalBody');
    const btnChange = document.querySelector('.changePswd');
    btnChange.addEventListener('click', function() {
        if (this.type == 'button') {
            let inputPassword = document.querySelector('.inputChange');
            content.innerHTML = `<div class="text text-center">
                    <img src="/img/loading2.gif" alt="" width="100" height="100">
                </div>`;
            setTimeout(function() {
                fetch('/profile/checkPassword?password=' + inputPassword.value, {
                    method: "get",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }).then(response => response.json()).then(check => {
                    if (check == true) {
                        content.innerHTML = `<label for="">Password baru</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password1" name="password1" aria-label="Username" aria-describedby="basic-addon1" onclick="validationPswd(this)" onkeyup="validationPswd(this)">
                    <div class="invalid-feedback">
                    Input Harus di isi
                    </div>
                </div> 
                <label for="">Ulangi password</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password2" name="password2" aria-label="Username" aria-describedby="basic-addon1" onclick="validationPswd(this)" onkeyup="validationPswd(this)">
                    <div class="invalid-feedback invalidPswd2">
                    Input Harus di isi
                    </div>
                </div>`;
                        btnChange.setAttribute('type', 'submit');
                        btnChange.style.display = 'none';
                    } else {
                        content.innerHTML = `<label for="">Masukan Password saat ini</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control inputChange is-invalid" aria-label="Username" aria-describedby="basic-addon1">
                    <div class="invalid-feedback">
                        Password yang anda masukan salah
                    </div>
                </div>`;
                        btnChange.setAttribute('type', 'button');
                    }
                });
            }, 100);
        }
    });
    modalChange.addEventListener('click', function() {
        content.innerHTML = `<label for="">Masukan Password saat ini</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control inputChange" aria-label="Username" aria-describedby="basic-addon1">
                </div>`;
        btnChange.setAttribute('type', 'button');
        btnChange.style.display = 'block';
    });

    async function validationPswd(input) {
        const pswd1 = await document.querySelector('#password1');
        const pswd2 = await document.querySelector('#password2');
        document.querySelector('#password').value = input.value;
        if (input.value == '') {
            if (input.classList.contains('is-valid')) {
                input.classList.remove('is-valid');
            }
            input.classList.add('is-invalid');
            if (input.value == pswd2.value) {
                document.querySelector('div.invalidPswd2').innerHTML = 'Input harus di isi';
            }
            btnChange.style.display = 'none';
        } else {
            if (input == pswd2) {
                if (input.value == pswd1.value) {
                    if (input.classList.contains('is-invalid')) {
                        input.classList.remove('is-invalid');
                    }
                    input.classList.add('is-valid');
                    btnChange.style.display = 'block';
                } else {
                    if (input.classList.contains('is-valid')) {
                        input.classList.remove('is-valid');
                    }
                    input.classList.add('is-invalid');
                    document.querySelector('div.invalidPswd2').innerHTML = 'Input anda tidak sama dengan password sebelumnya';
                    btnChange.style.display = 'none';
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