<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit Barang</h1>
            <form action="/barang/update" method="post">
                <input type="hidden" name="id" value="<?= $barang['id']; ?>">
                <div class="form-group row">
                    <label for="barang" class="col-sm-2 col-form-label">Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('barang')) ? 'is-invalid' : ''; ?>" name="barang" id="barang" value="<?= (old('barang')) ? old('barang') : $barang['barang']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('barang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $barang['stok']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Harga Beli</label>
                    <div class="input-group col-sm-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">RP</span>
                        </div>
                        <input type="text" class="form-control rupiah <?= ($validation->hasError('harga_beli')) ? 'is-invalid' : ''; ?>" id="harga_beli" name="harga_beli" value="<?= (old('harga_beli')) ? old('harga_beli') : $barang['harga_beli']; ?>" onkeyup="splitInDots(this)">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga_beli'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Harga Jual</label>
                    <div class="input-group col-sm-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">RP</span>
                        </div>
                        <input type="text" class="form-control rupiah <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" value="<?= (old('harga_jual')) ? old('harga_jual') : $barang['harga_jual']; ?>" onkeyup="splitInDots(this)">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga_jual'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit Barang</button>
                    </div>
                </div>
            </form>
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
</script>
<?= $this->endSection(); ?>