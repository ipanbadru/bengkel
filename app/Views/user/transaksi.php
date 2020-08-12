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
                    <h2 class="mb-2"><i class="ni ni-cart mr-2"></i>Transaksi</h2>
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
                    <form action="/transaksi/transaksion" method="post">
                        <label for="nama">Nama Pelanggan</label>
                        <select class="custom-select mb-2 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama">
                            <option selected value=""></option>
                            <?php foreach ($pelanggan as $p) : ?>
                                <option value="<?= $p['id']; ?>" <?= (old('nama') == $p['id']) ? 'selected' : ''; ?>><?= $p['nama_pelanggan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                        <label for="merk">Merk</label>
                        <select class="custom-select mb-2 <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" name="merk" id="merk">
                            <option selected value=""></option>
                            <option value="honda">Honda</option>
                            <option value="yamaha">Yamaha</option>
                            <option value="suzuki">Suzuki</option>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('merk'); ?>
                        </div>
                        <label for="merk_motor">Merk motor</label>
                        <select class="custom-select mb-2 <?= ($validation->hasError('merk_motor')) ? 'is-invalid' : ''; ?>" name="merk_motor" id="merk_motor" disabled>
                            <option selected value=""></option>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('merk_motor'); ?>
                        </div>
                        <label for="jenis_motor">Jenis Motor</label>
                        <select class="custom-select mb-2 <?= ($validation->hasError('jenis_motor')) ? 'is-invalid' : ''; ?>" name="jenis_motor" id="jenis_motor" disabled>
                            <option selected value=""></option>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('jenis_motor'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Kendala</label>
                            <textarea class="form-control <?= ($validation->hasError('kendala')) ? 'is-invalid' : ''; ?>" id="exampleFormControlTextarea1" name="kendala" rows="3"><?= old('kendala'); ?></textarea>
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                <?= $validation->getError('kendala'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
    <?= $this->section('script'); ?>
    <script>
        $(document).ready(function() {
            $('#merk').change(function() {
                $('#jenis_motor').empty().append(`<option value=""></option>`);
                $('#merk_motor').empty().append(`<option value=""></option>`);
                if ($(this).children("option:selected").val() == '') {
                    $('#jenis_motor').attr('disabled', 'disabled');
                    $('#merk_motor').attr('disabled', 'disabled');
                }
                $.ajax({
                    url: '/transaksi/tampilMerk',
                    method: 'post',
                    data: {
                        merk: $(this).children("option:selected").val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(i, data) {
                            $('#merk_motor').removeAttr('disabled');
                            $('#merk_motor').append(`<option value="` + data.merk_motor + `">` +
                                data.merk_motor + `</option>`);
                        });
                    }
                });
            });
            $('#merk_motor').change(function() {
                $('#jenis_motor').empty().append(`<option value=""></option>`);
                if ($(this).children("option:selected").val() == '') {
                    $('#jenis_motor').attr('disabled', 'disabled');
                }
                $.ajax({
                    url: '/transaksi/tampilJenis',
                    method: 'post',
                    data: {
                        merk_motor: $(this).children("option:selected").val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(i, data) {
                            $('#jenis_motor').removeAttr('disabled');
                            $('#jenis_motor').append(`<option value="` + data.id + `">` +
                                data.detail_merk + `</option>`);
                        });
                    }
                });
            });
        });
    </script>
    <?= $this->endSection(); ?>