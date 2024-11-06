<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Booking</h6>
        </div>
        <div class="card-body">
            <h3>Detail Booking</h3>
            <ul>
                <li> Nama User : <?= $booking['nama']?></li>
                <li> Tanggal : <?= $booking['tgl_booking']?></li>
                <li> Id Booking : <?= $booking['id_booking']?></li>
            </ul>
        </div>
        <div class="card-body">
            <div style="width: 50% !important;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>Tanggal Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($detail_booking)) : ?>
                            <?php $no = 1;
                            foreach ($detail_booking as $b) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $b->judul_buku; ?></td>
                                    <td><?= $b->penerbit; ?></td>
                                    <td><?= $b->pengarang; ?></td>
                                    <td><?= $b->tahun_terbit; ?></td>
                                    <td><?= date('d-m-Y'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data booking.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>