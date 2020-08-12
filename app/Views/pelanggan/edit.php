<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h1>Edit Pelanggan</h1>
            <form action="/pelanggan/update" method="post">
                <input type="hidden" name="id" value="<?= $pelanggan['id']; ?>">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= (old('nama')) ? old('nama') : $pelanggan['nama_pelanggan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" value="<?= (old('no_hp')) ? old('no_hp') : $pelanggan['no_hp']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat"><?= (old('alamat')) ? old('alamat') : $pelanggan['alamat']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit Pelanggan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>