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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($booking)): ?>
                    <?php $no = 1;
                    foreach ($booking as $b): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b->judul_buku; ?></td>
                            <td><?= $b->penerbit; ?></td>
                            <td><?= $b->pengarang; ?></td>
                            <td><?= $b->tahun_terbit; ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($b->tgl_booking)); ?></td>
                            <td>
                                <!-- Tombol Hapus -->
                                <a href="<?= base_url('User/hapus_booking/' . $b->id_buku); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini?');">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data booking.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tombol "Lanjutkan ke Peminjaman" -->
        <div class="d-flex justify-content-end">
            <a href="<?= base_url('User/peminjaman'); ?>" class="btn btn-primary">
                Lanjutkan ke Peminjaman
            </a>
        </div>
    </div>

