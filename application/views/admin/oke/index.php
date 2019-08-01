<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modal-kepo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <?php echo form_open_multipart('admin/cus')  ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php foreach ($oke as $o) : ?>
                            <input type="hidden" name="perusahaan" value="<?= $o->nama_perusahaan;  ?>">
                            <input type="hidden" name="pimpinan" value="<?= $o->nama_pimpinan; ?>">
                            <input type="hidden" name="alamat" value="<?= $o->alamat; ?>">
                            <input type="hidden" name="cp" value="<?= $o->cp; ?>">
                            <input type="hidden" name="id" value="<?= $o->id_siswa; ?>">
                            <h4>Yakin data sudah benar?</h4>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('admin/notif') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class=" btn btn-primary">Yoi</button>
            </div>
        </div>
        </form>


    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-kepo').modal('show');
    });
</script>