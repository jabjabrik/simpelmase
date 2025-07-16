<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-size: .8em;
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            text-align: center;
            border: 1px solid #ddd;
        }

        table td {
            border: 1px solid #ddd;
            padding: 7px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            padding: 5px;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            text-transform: capitalize;
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Laporan Bantuan Sosial <?= $filter ?></h2>

    <?php if (!empty($data_result)): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>Nama Penduduk</th>
                    <th>Jenis Bantuan</th>
                    <th>Keterangan</th>
                    <th>Tanggal Penetapan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($data_result as $item) : ?>
                    <?php if ($item->jenis != $filter && $filter != '') continue; ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item->no_kk ?></td>
                        <td><?= $item->nama_penduduk ?></td>
                        <td><?= $item->jenis ?></td>
                        <td><?= $item->keterangan ?></td>
                        <td><?= date('d-m-Y', strtotime($item->tanggal_penetapan)) ?></td>
                        <td><?= $item->nilai ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center;">Tidak ada data tersedia.</p>
    <?php endif; ?>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>