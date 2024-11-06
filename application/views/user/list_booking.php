<div class="container py-5">
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

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
            <?php if (!empty($booking)) : ?>
                <?php $no = 1;
                foreach ($booking as $b) : ?>
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