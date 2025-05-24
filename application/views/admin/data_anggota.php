<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Table User</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Table User</h6>
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
                            <a href="<?= base_url('admin/hapus_anggota/')?><?=$vu['id_user']?>" onclick="return confirm('Apakah Kamu ingin menghapus akun ini ?')"> <button class="btn btn-danger"> Hapus</button></a>
                            <?php
                            if($vu['is_active'] ==0){
                            ?>
                            <a href="<?= base_url('admin/konfirmasi/')?><?=$vu['id_user']?>" onclick="return confirm('Apakah Kamu ingin mengaktifkan akun ini ?')"><button class="btn btn-danger"> Aktivasi</button></a>
                            <?php
                            }
                            ?>
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>