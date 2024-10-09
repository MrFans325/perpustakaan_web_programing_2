<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td>Nomor</td>
                        <td>Nama</td>
                        <td>Alamat</td>
                        <td>Email</td>
                        <td>Role Id</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Nomor</td>
                        <td>Nama</td>
                        <td>Alamat</td>
                        <td>Email</td>
                        <td>Role Id</td>
                        <td>Aksi</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =0;
                    foreach ($user as $vu) {
                    $no++;
                        ?>
                        <tr>
                            <td><?= $no?></td>
                            <td><?= $vu['nama']?></td>
                            <td><?= $vu['alamat']?></td>
                            <td><?= $vu['email']?></td>
                            <td><?= $vu['role_id']?></td>
                            <td>
                            <a href="<?= base_url('admin/hapus_anggota/')?><?=$vu['id_user']?>">Hapus</a>
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

</div>