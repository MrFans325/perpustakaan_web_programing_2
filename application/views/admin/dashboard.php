<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <!-- Color System -->
            <h1 class="h3 mb-4 text-gray-800">Selamat Datang <?= $user['nama']?></h1>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Data Anggota
                            <div class="text-white-50 small"><?= count($pengguna)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Data Admin
                            <div class="text-white-50 small"><?= count($admin)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Total Judul Buku
                            <div class="text-white-50 small"><?= count($buku)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Total Kategori
                            <div class="text-white-50 small"><?= count($kategori)?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->