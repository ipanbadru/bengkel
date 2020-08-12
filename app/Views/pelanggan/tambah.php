<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h1>Tambah Pelanggan</h1>
            <form action="/pelanggan/save" method="post">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= old('nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" value="<?= old('no_hp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>