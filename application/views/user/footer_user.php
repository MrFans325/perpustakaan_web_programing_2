<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
</body>

</html>
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if ($this->session->flashdata('message') != '') { ?>
    <script>
        $(document).ready(function() {
            alert("<?= $this->session->flashdata('message') ?>");
        });
    </script>
<?php
}
?>
<?php
if ($this->session->flashdata('success') != '') { ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "<?= $this->session->flashdata('success') ?>",
                icon: "success"
            });
        });
    </script>
<?php
}
?>
<?php
if ($this->session->flashdata('error') != '') { ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "<?= $this->session->flashdata('error') ?>",
                icon: "error"
            });
        });
    </script>
<?php
}
?>