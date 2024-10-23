<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            foreach ($buku as $vb) {
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= base_url() ?>upload/img/<?= $vb['image'] ?>" alt="..." />
                        <div class="card-body p-6">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $vb['judul_buku'] ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-left">
                                <label>Pengarang :<?= $vb['pengarang'] ?></label> <br>
                                <label>Penerbit :<?= $vb['penerbit'] ?></label> <br>
                                <label>Tahun Terbit:<?= $vb['tahun_terbit'] ?></label> <br>
                                <label><?= $vb['isbn'] ?></label>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Booking</a></div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</section>