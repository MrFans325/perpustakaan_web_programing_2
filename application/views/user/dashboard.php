<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            foreach ($buku as $vb) {
            ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= base_url() ?>upload/img/<?= $vb['image'] ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= $vb['judul_buku'] ?></h5>
                                <!-- Product price-->
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url()?>user/detailbuku/<?=$vb['id_buku']?>" target="_blank">Detail</a></div>
                        </div>
                        <?php
                        if (isset($user)) { 
                        ?>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('booking/booking/' . $vb['id_buku']); ?>">Booking</a></div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</section>