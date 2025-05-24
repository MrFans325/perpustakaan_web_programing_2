<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Booking</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Booking</h6>
        </div>
        <div class="card-body">
            <div style="width: 50% !important;">
                <table class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Id Booking</td>
                            <td>Tanggal Booking</td>
                            <td>Id User</td>
                            <td>Aksi</td>
                            <td>Denda Pinjam Perhari</td>
                            <td>Lama Pinjam</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($booking as $vb) {
                            $no++;
                            // //get denda 
                            // $now = time(); // or your date as well
                            // // $date_pinjam = strtotime($vb->tgl_booking);
                            // $date_batas = strtotime($vb->batas_ambil);
                            // if ($now > $date_batas) {
                            //     $beda_hari = $now - $date_batas;
                            //     $beda_hari = round($beda_hari / (60 * 60 * 24));
                            //     $denda = 5000 * $beda_hari;
                            // } else {
                            //     $beda_hari = 0;
                            //     $denda = 0;
                            // }

                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><a type="button" href="<?= base_url()?>admin/detail_booking/<?= $vb->id_booking ?>"><?= $vb->id_booking ?></a></td>
                                <td><?= $vb->tgl_booking ?></td>
                                <td><?= $vb->id_user ?></td>
                                <td><a href="<?= base_url()?>admin/aksi_booking/<?= $vb->id_booking ?>"><button class="btn btn-outline-info" >Pinjam</button></a></td>
                                <td>5000</td>
                                <td>3 Hari</td>
                                <!-- <td> -->
                                <!-- <a type="button" class="btn btn-info btn-sm rounded" data-toggle="modal" data-target="#Modal_edit_kategori" data-kategori="<?= $vk['jenis_kategori'] ?>" data-id="<?= $vk['id_kategori'] ?>" onclick="modal_edit(this)"><i class="fas fa-edit"></i> Ubah</a> -->
                                <!-- <a type="button" class="btn btn-danger btn-sm rounded" data-kategori="<?= $vk['jenis_kategori'] ?>" data-href="<?= base_url('admin/hapusKategori/') ?><?= $vk['id_kategori'] ?>" onclick="hapus_kategori(this)"><i class="fas fa-trash"></i> Hapus</a> -->
                                <!-- </td> -->
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" id="Modal_edit_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>admin/data_kategori" method="post">
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-3">
                            <label for="">Kategori</label>
                        </div>
                        <div class="col">
                            <input type="hidden" name="id" id="id_kategori" class="form-control" <?= isset($_POST['id']) ? "value='" . $_POST['id_kategori'] . "'" : "" ?>>
                            <?php echo form_error('kategori'); ?>
                            <input type="text" name="kategori" id="form_kategori" class="form-control" <?= isset($_POST['kategori']) ? "value='" . $_POST['kategori'] . "'" : "" ?>>
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
    </div> -->
</div>
<script>
    function modal_edit(element) {
        var id_kategori = $(element).data('id');
        var kategori = $(element).data('kategori');
        if (id_kategori == "") {
            $("#exampleModalLabel").text("Tambah Kategori");
        } else {
            $("#exampleModalLabel").text("Edit Kategori");
        }
        $("#form_kategori").val(kategori);
        $("#id_kategori").val(id_kategori);
    }

    function hapus_kategori(element) {
        var data_kategori = $(element).data('kategori');
        var data_href = $(element).data('href');
        Swal.fire({
            title: "Hapus?",
            text: `Apakah kamu yakin ingin menghapus ${data_kategori} ?`,
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