<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="modalregistrasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url() ?>auth/registrasi" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" name="role" value="user">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modallogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url() ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 mb-3">
                        <?php echo form_error('email'); ?>
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                    </div>
                    <div class="col-sm-12 mb-3">
                        <?php echo form_error('password'); ?>
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>