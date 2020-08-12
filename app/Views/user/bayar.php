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
                <div class="card-body">
                    <h1>Bayar</h1>
                    <form action="/pembayaran/transaksi" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $notification['id']; ?>">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="nama_pelanggan" value="<?= $notification['nama_pelanggan']; ?>" readonly>
                        </div>
                        <label for="jenis_motor">Jenis Motor</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="jenis_motor" value="<?= $notification['detail_merk']; ?>" readonly>
                        </div>
                        <label for="kendala">Kendala</label>
                        <div class="input-group mb-3">
                            <textarea type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="kendala" readonly><?= $notification['kendala']; ?></textarea>
                        </div>
                        <label for="jenis_motor">Nama Montir</label>
                        <select class="custom-select mb-3 <?= ($validation->hasError('nama_montir')) ? 'is-invalid' : ''; ?>" name="nama_montir">
                            <option selected value=""></option>
                            <?php foreach ($montir as $m) : ?>
                                <option value="<?= $m['id']; ?>" <?= (old('nama_montir') == $m['id']) ? 'selected' : ''; ?>><?= $m['nama_montir']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_montir'); ?>
                        </div>
                        <div>
                            <input type="hidden" name="pengeluaran_barang" id="pengeluaran_barang">
                            <button type="button" class="btn btn-info pengeluaran"><i class="ni ni-fat-add mr-2"></i>Pengeluaran barang</button>
                        </div>
                        <label for="keterangan" class="mt-2">Keterangan</label>
                        <div class="input-group mb-3">
                            <textarea type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" name="keterangan" aria-label="Username" aria-describedby="basic-addon1" id="keterangan"><?= old('keterangan'); ?></textarea>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('keterangan'); ?>
                        </div>
                        <label>Total Harga</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" aria-label="Username" onkeyup="splitInDots(this);" aria-describedby="basic-addon1" name="harga" value="<?= old('harga'); ?>">
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                        <button type="submit" class="btn btn-default">Oke</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    function reverseNumber(input) {
        return [].map.call(input, function(x) {
            return x;
        }).reverse().join('');
    }

    function plainNumber(number) {
        return number.split('.').join('');
    }

    function splitInDots(input) {
        var value = input.value,
            plain = plainNumber(value),
            reversed = reverseNumber(plain),
            reversedWithDots = reversed.match(/.{1,3}/g).join('.'),
            normal = reverseNumber(reversedWithDots);
        input.value = normal;
    }
    $(document).ready(function() {
        let nilai = 1;
        $('.pengeluaran').click(function() {
            $('#pengeluaran_barang').val(nilai);
            $(this).after(` <div class="row mt-2">
                            <div class="col-sm-5">
                                <label for="">Nama Barang</label>
                                <select class="custom-select" id="barang" name="barang` + nilai + `">
                                    <option selected value=""></option>
                                    <?php foreach ($barang as $b) : ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <label for="">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah" value="1" name="jumlah_barang` + nilai + `">
                            </div>
                            <div class="col mt-4 ml--3">
                                <button type="button" class="btn btn-outline-danger d-inline nilai` + nilai + `">
                                    <h3><i class="ni ni-fat-remove"></i></h3>
                                </button>
                            </div>
                        </div>`);
            $('.nilai' + nilai).click(function() {
                let barang = $('#pengeluaran_barang').val();
                $('#pengeluaran_barang').val(barang - 1);
                $(this).parent().parent().remove();
            });
            nilai++;
        });
    });
</script>
<?= $this->endSection(); ?>