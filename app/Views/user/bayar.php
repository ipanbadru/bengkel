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
                            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga_total" aria-label="Username" onkeyup="splitInDots(this);" aria-describedby="basic-addon1" name="harga"">
                        </div>
                        <div class=" invalid-feedback">
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
<script src="/assets/js/simple.money.format.js"></script>
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
                            <div class="col-sm-4 barang">
                                <label for="">Nama Barang</label>
                                <select class="custom-select" id="barang` + nilai + `" name="barang` + nilai + `">
                                    <option selected value=""></option>
                                    <?php foreach ($barang as $b) : ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4 jumlah">
                                <label for="">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah_barang` + nilai + `" value="1" name="jumlah_barang` + nilai + `">
                            </div>
                            <div class="col-sm-3">
                            <label for="">Sub total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                                <input type="text" class="form-control sub_total" id="sub_total` + nilai + `" value="" name="sub_total" readonly>
                            </div>
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
                if ($('#harga_total').val() != '') {
                    const sub_harga = $(this).parent().parent().children('.col-sm-3').children('.input-group').children('input').val();
                    $('#harga_total').val(parseInt($('#harga_total').val().replace(/\./g, '')) - parseInt(sub_harga.replace(/\./g, '')));
                    if ($('#harga_total').val() == 0) {
                        $('#harga_total').val('');
                        $('#harga_total').attr('readonly', false);
                    } else {
                        $('#harga_total').simpleMoneyFormat();
                    }
                }
                $(this).parent().parent().remove();
            });
            $('#barang' + nilai).change(function() {
                if ($(this).children("option:selected").val() == '') {
                    return false;
                }
                let jumlah = $(this).parents('div.row').children('div.jumlah').children('input').val();
                let sub_total = $(this).parents('div.row').children('div.col-sm-3').children('div.input-group').children('input');
                $.ajax({
                    url: '/pembayaran/tampilTotal',
                    method: 'post',
                    data: {
                        barang: $(this).children("option:selected").val(),
                        jumlah: jumlah
                    },
                    dataType: 'json',
                    success: function(data) {
                        const subTotalLama = sub_total.val();
                        sub_total.val(data);
                        if (sub_total.val() !== 0) {
                            if ($('#harga_total').is('[readonly')) {
                                if (subTotalLama != '') {
                                    $('#harga_total').val(parseInt($('#harga_total').val().replace(/\./g, '')) - parseInt(subTotalLama.replace(/\./g, '')));
                                    $('#harga_total').val(parseInt($('#harga_total').val()) + parseInt(sub_total.val().replace(/\./g, '')));
                                    $('#harga_total').simpleMoneyFormat();
                                } else {
                                    $('#harga_total').val(parseInt($('#harga_total').val().replace(/\./g, '')) + parseInt(sub_total.val().replace(/\./g, '')));
                                    $('#harga_total').simpleMoneyFormat();
                                }
                            } else {
                                $('#harga_total').attr('readonly', 'readonly');
                                $('#harga_total').val(sub_total.val());
                                $('#harga_total').simpleMoneyFormat();
                            }
                        }
                        sub_total.simpleMoneyFormat();
                    }
                });
            });
            $('#jumlah_barang' + nilai).change(function() {
                if ($(this).parents('div.row').children('div.barang').children('select').children("option:selected").val() == '') {
                    return false;
                }
                let barang = $(this).parents('div.row').children('div.barang').children('select').children("option:selected").val();
                let sub_total = $(this).parents('div.row').children('div.col-sm-3').children('div.input-group').children('input');
                $.ajax({
                    url: '/pembayaran/tampilTotal',
                    method: 'post',
                    data: {
                        barang: barang,
                        jumlah: $(this).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        const subTotalLama = sub_total.val();
                        sub_total.val(data);
                        if (sub_total.val() !== 0) {
                            if ($('#harga_total').is('[readonly')) {
                                if (subTotalLama != '') {
                                    $('#harga_total').val(parseInt($('#harga_total').val().replace(/\./g, '')) - parseInt(subTotalLama.replace(/\./g, '')));
                                    $('#harga_total').val(parseInt($('#harga_total').val()) + parseInt(sub_total.val().replace(/\./g, '')));
                                    $('#harga_total').simpleMoneyFormat();
                                } else {
                                    $('#harga_total').val(parseInt($('#harga_total').val().replace(/\./g, '')) + parseInt(sub_total.val().replace(/\./g, '')));
                                    $('#harga_total').simpleMoneyFormat();
                                }
                            } else {
                                $('#harga_total').attr('readonly', 'readonly');
                                $('#harga_total').val(sub_total.val());
                                $('#harga_total').simpleMoneyFormat();
                            }
                        }
                        sub_total.simpleMoneyFormat();
                    }
                });
            });
            nilai++;
        });
    });
</script>
<?= $this->endSection(); ?>