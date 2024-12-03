<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_buku.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<div class="container-fluid">
    <h3>
        <center>Laporan Data Buku Perputakaan Online</center>
    </h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>ISBN</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $a = 1;
            foreach ($buku as $b) { ?>
                <tr>
                    <th><?= $a++; ?></th>
                    <td><?= $b['judul_buku']; ?></td>
                    <td><?= $b['pengarang']; ?></td>
                    <td><?= $b['penerbit']; ?></td>
                    <td><?= $b['tahun_terbit']; ?></td>
                    <td><?= $b['isbn']; ?></td>
                    <td><?= $b['stok']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>