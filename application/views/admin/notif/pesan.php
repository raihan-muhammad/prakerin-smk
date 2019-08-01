<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesan Kesalahan</h5>

            </div>
            <form method="POST" action="<?php echo base_url('admin/masukPesan') ?>">
                <?php foreach ($pesan as $p) : ?>
                    <div class="modal-body">
                        <div class="alert alert-default" role="alert">
                            <strong>Contoh </strong>"<i>Maaf jurusan anda tidak sesuai yang di butuhkan perusahaan!</i>"
                        </div>
                        <?php
                        $id_siswa   = $p->id_siswa;
                        $getNama    = $this->db->query("SELECT id_siswa FROM tb_siswa WHERE id_siswa = '$id_siswa' ");
                        $pecah      = $getNama->row();

                        ?>

                        <input type="hidden" value="<?= $p->nama_perusahaan; ?>" name="perusahaan">
                        <input type="hidden" value="<?= $pecah->id_siswa ?>" name="siswa">
                        <input type="hidden" value="<?= $p->id ?>" name="id">

                        <textarea class="form-control form-control-alternative" rows="3" placeholder="Masukan pesan kesalahan" name="pesan"></textarea>

                    </div>
                <?php endforeach; ?>
                <div class="modal-footer">
                    <a href="<?php echo base_url('admin/notif') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary"> Kirim </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    })
</script>