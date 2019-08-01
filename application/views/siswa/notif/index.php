<?php

if ($this->session->flashdata('oke') == TRUE) { ?>
    <script>
        Swal.fire({
            type: 'success',
            title: 'Terimakasih!',
            text: '<?= $this->session->flashdata("oke") ?>'
        });
    </script>
<?php }

?>
<div class="bubble"></div>
<div class="bubble2"></div>
<div class="bubble3"></div>

<h4 class="text-right mt--7 mr-3 text-uppercase" style="color: #dc3545;"><strong>Notifikasi</strong></h4>
<?php
$sos    = $this->session->userdata('user');
$cekA   = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$sos' ");
$paluA  = $cekA->row();
$idb    = $paluA->id_siswa;
$kue    = $this->db->query("SELECT * FROM tb_notif WHERE id_siswa = '$idb' ");
$paluB  = $kue->row();

if ($kue->num_rows() > 0) {

    ?>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="alert alert-default" role="alert" style="background-color: #4f71a9;">
                <div class="col-12">
                    <strong>Hallo, <?= $this->session->userdata('user') ?>!</strong> <?= $paluB->pesan ?>
                </div>
                <div class="col-2 mt-1">
                    <a href="<?php echo base_url('siswa/oke/') . $paluB->id_siswa; ?>" class="btn-sm btn-info ">Oke</a>
                </div>

            </div>
        </div>
    </div>
<?php  } else { ?>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="alert alert-default" role="alert" style="background-color: #4f71a9;">
                <strong>Hallo, <?= $this->session->userdata('user') ?>!</strong> Saat ini belum ada pemberitahuan buat kamu hehe
            </div>
        </div>
    </div>
<?php } ?>
<div class="fixed-bottom">

    <div class="bubble4"></div>
    <div class="bubble5"></div>
    <div class="bubble6"></div>
    <div class="row">

        <nav class="navbar fixed-bottom">
            <a href="<?php echo base_url('siswa') ?>" class="btn btn-primary" style="width: 95%;" id="kembali">Kembali</a>
        </nav>

    </div>

</div>