<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="<?= base_url('auth/registrasi') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 ">
                                <?php echo form_error('nama'); ?>
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Lengkap" name="nama" required>
                                </div>
                                <div class="col-sm-12 mb-3">
                                <?php echo form_error('email'); ?>
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                                </div>
                                <div class="col-sm-12 mb-3">
                                <?php echo form_error('alamat'); ?>
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Alamat" name="alamat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                <?php echo form_error('password'); ?>
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                                </div>
                                <div class="col-sm-6">
                                <?php echo form_error('repassword'); ?>
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="repassword">
                                </div>
                            </div>
                            <input type="hidden" name="role" value="user">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftar Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>