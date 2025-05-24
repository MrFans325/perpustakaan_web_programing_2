<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Buku</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data buku</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#Modal_edit_kategori" data-id="" onclick="modal_edit(this)"><i class="fas fa-plus-square"></i>Tambah Data</button>
                <table class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Judul</td>
                            <td>Pengarang</td>
                            <td>Penerbit</td>
                            <td>Tahun Terbit</td>
                            <td>ISBN</td>
                            <td>STOK</td>
                            <td>Di Pinjam</td>
                            <td>Di Booking</td>
                            <td>Gambar</td>
                            <td>Pilihan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($buku as $vb) {
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $vb['judul_buku'] ?></td>
                                <td><?= $vb['pengarang'] ?></td>
                                <td><?= $vb['penerbit'] ?></td>
                                <td><?= $vb['tahun_terbit'] ?></td>
                                <td><?= $vb['isbn'] ?></td>
                                <td><?= $vb['stok'] ?></td>
                                <td><?= $vb['dipinjam'] ?></td>
                                <td><?= $vb['dibooking'] ?></td>
                                <td><img src="<?= base_url() ?>upload/img/<?= $vb['image'] ?>" height="100" width="auto"></td>
                                <td>
                                    <a type="button" class="btn btn-info btn-sm rounded" data-toggle="modal" data-target="#Modal_edit_kategori" data-judul="<?= $vb['judul_buku'] ?>" data-stok="<?= $vb['stok'] ?>" data-isbn="<?= $vb['isbn'] ?>" data-tahun="<?= $vb['tahun_terbit'] ?>" data-pengarang="<?= $vb['pengarang'] ?>" data-penerbit="<?= $vb['penerbit'] ?>" data-kategori="<?= $vb['id_kategori'] ?>" data-id="<?= $vb['id_buku'] ?>" onclick="modal_edit(this)"><i class="fas fa-edit"></i> Ubah</a>
                                    <a type="button" class="btn btn-danger btn-sm rounded" data-judul="<?= $vb['judul_buku'] ?>" data-href="<?= base_url('admin/hapusBuku/') ?><?= $vb['id_buku'] ?>" onclick="hapus_buku(this)"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modal_edit_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>admin/data_buku" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <label for="">Judul Buku</label>
                            </div>
                            <div class="col">
                                <input type="hidden" name="id" id="id_buku" class="form-control" <?= isset($_POST['id']) ? "value='" . $_POST['id_kategori'] . "'" : "" ?>>
                                <?php echo form_error('judul_buku'); ?>
                                <input type="text" name="judul_buku" id="form_judul" class="form-control" <?= isset($_POST['judul_buku']) ? "value='" . $_POST['judul_buku'] . "'" : "" ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Kategori</label>
                            </div>
                            <div class="col">
                                <?php echo form_error('id_kategori'); ?>
                                <select name="id_kategori" id="form_kategori" class="form-control form-control-sm">
                                    <option value="" selected disabled></option>
                                    <?php foreach ($kategori as $vk) { ?>
                                        <option value="<?= $vk['id_kategori'] ?>"><?= $vk['jenis_kategori'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Pengarang</label>
                            </div>
                            <div class="col">
                                <?php echo form_error('pengarang'); ?>
                                <input type="text" name="pengarang" id="form_pengarang" class="form-control" <?= isset($_POST['pengarang']) ? "value='" . $_POST['pengarang'] . "'" : "" ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Penerbit</label>
                            </div>
                            <div class="col">
                                <?php echo form_error('penerbit'); ?>
                                <input type="text" name="penerbit" id="form_penerbit" class="form-control" <?= isset($_POST['penerbit']) ? "value='" . $_POST['penerbit'] . "'" : "" ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Tahun Terbit</label>
                            </div>
                            <div class="col">
                                <?php echo form_error('tahun_terbit'); ?>
                                <input type="text" name="tahun_terbit" id="form_tahun_terbit" class="form-control" <?= isset($_POST['tahun_terbit']) ? "value='" . $_POST['tahun_terbit'] . "'" : "" ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">ISBN</label>
                            </div>
                            <div class="col">
                                <?php echo form_error('isbn'); ?>
                                <input type="text" name="isbn" id="form_isbn" class="form-control" <?= isset($_POST['isbn']) ? "value='" . $_POST['isbn'] . "'" : "" ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Stok</label>
                            </div>
                            <div class="col">
                                <?php echo form_error('stok'); ?>
                                <input type="number" name="stok" id="form_stok" class="form-control" <?= isset($_POST['stok']) ? "value='" . $_POST['stok'] . "'" : "" ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Gambar</label>
                            </div>
                            <div class="col">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function modal_edit(element) {
        var id_buku = $(element).data('id');
        if (id_buku == "") {
            $("#exampleModalLabel").text("Tambah Buku");
            $(".form-control").each(function() {
                $(this).val('');
            });
        } else {
            var judul = $(element).data('judul');
            var stok = $(element).data('stok');
            var isbn = $(element).data('isbn');
            var tahun = $(element).data('tahun');
            var pengarang = $(element).data('pengarang');
            var penerbit = $(element).data('penerbit');
            var kategori = $(element).data('kategori');
            $("#id_buku").val(id_buku);
            $("#exampleModalLabel").text("Edit Kategori");
            $("#form_judul").val(judul);
            $("#form_kategori").val(kategori);
            $("#form_pengarang").val(pengarang);
            $("#form_penerbit").val(penerbit);
            $("#form_tahun_terbit").val(tahun);
            $("#form_isbn").val(isbn);
            $("#form_stok").val(stok);
        }
    }

    function hapus_buku(element) {
        var data_judul = $(element).data('judul');
        var data_href = $(element).data('href');
        Swal.fire({
            title: "Hapus?",
            text: `Apakah kamu yakin ingin menghapus ${data_judul} ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = data_href;
            }
        });
    }
</script>