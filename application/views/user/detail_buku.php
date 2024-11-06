<section class="py-5">
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= base_url('upload/img/' . $buku['image']); ?>" alt="Book Image" /></div>
            <div class="col-md-6">
                <div class="small mb-1"><?= 'ISBN :' . $buku['isbn']; ?></div>
                <h1 class="display-5 fw-bolder"><?= $buku['judul_buku']; ?></h1>
                <h4 class="display-8 fw-bolder"><?= 'Kategori : ' . $buku['kategori']; ?></h4>
                <div class="fs-5 mb-5">
                    <span><?= 'Tahun Terbit :' . $buku['tahun_terbit']; ?></span> <br>
                    <span><?= 'Penerbit :' . $buku['penerbit']; ?></span>
                </div>
                <!-- <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p> -->
                <div class="d-flex">
                    <!-- <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" /> -->
                    <a href="<?= base_url('booking/booking/' . $buku['id_buku']); ?>" class="btn btn-warning">
                        <i class="bi-cart-fill me-1"></i> Tambahkan Ke Daftar Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($related_books)) : ?>
                <?php foreach ($related_books as $related) : 
                    if($related->id_buku ==$buku['id_buku']){
                        continue;
                    }
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image -->
                            <img class="card-img-top" src="<?= base_url('upload/img/' . $related->image); ?>" alt="Book Image" />

                            <!-- Product details -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name -->
                                    <h5 class="fw-bolder"><?= $related->judul_buku; ?></h5>
                                    <!-- Product author or publisher -->
                                    <span class="text-muted">Penulis: <?= $related->pengarang; ?></span><br>
                                    <span class="text-muted">Tahun Terbit: <?= $related->tahun_terbit; ?></span>
                                </div>
                            </div>

                            <!-- Product actions -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="<?= base_url('User/detail_buku/' . $related->id_buku); ?>">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Tidak ada buku terkait yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
        
</section>
