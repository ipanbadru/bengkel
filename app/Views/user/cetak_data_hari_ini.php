<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h2 {
            text-align: center;
            font-size: 30;
            font-family: arial, sans-serif;
            text-transform: uppercase;
        }

        table {
            margin: auto;
            border-collapse: collapse;
        }

        th {
            text-transform: uppercase;
            background-color: lightblue;
        }

        table,
        th,
        td {
            padding: 10px;
            border: 1px solid black;
        }
    </style>
    <title>Data tanggal <?= $tanggal; ?></title>
</head>

<body>
    <h2>Data tanggal <?= $tanggal; ?></h2>
    <hr>
    <table>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th>Kendala</th>
            <th>Merk Motor</th>
            <th>pengeluaran Barang</th>
            <th>Montir</th>
            <th>waktu servis</th>
            <th>Total Harga</th>
        </tr>
        <?php foreach ($transaksi as $t) : ?>
            <tr>
                <td><?= $t['nama_pelanggan']; ?></td>
                <td><?= $t['keterangan']; ?></td>
                <td><?= $t['kendala']; ?></td>
                <td><?= $t['merk_motor']; ?></td>
                <td><?= $t['pengeluaran_barang']; ?></td>
                <td><?= $t['nama_montir']; ?></td>
                <td><?= $t['waktu_servis']; ?></td>
                <td>Rp.<?= $t['total']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>