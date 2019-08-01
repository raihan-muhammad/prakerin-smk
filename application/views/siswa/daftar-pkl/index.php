<!-- Modal -->
<div class="modal fade bg-gradient-info" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pendaftaran Tempat Prakerin</h5>

            </div>
            <div class="modal-body">
                <div class="alert alert-default" role="alert">
                    <strong>Perhatian!</strong> Silahkan mengisi semua input form yang di sediakan. <strong>Bukti</strong> bisa berupa pdf, doc atau juga gambar ber format png, jpg
                </div>
                <?php echo form_open_multipart('siswa/regPkl') ?>
                <?php foreach ($daftar as $d) : ?>
                    
                    <input type="hidden" value="<?= $d->id_siswa; ?>" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                                    </div>
                                    <input class="form-control form-control-alternative" placeholder=" Nama Perusahaan" type="text" name="perusahaan" data-toggle="popover" data-placement="top" data-content="Isi sesuai dengan nama perusahaan tempat prakerin kamu" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                    </div>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="  Masukan alamat perusahaan" name="alamat" data-toggle="popover" data-placement="top" data-content="Isi sesuai dengan alamat perusahaan tempat prakerin kamu." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                    </div>
                                    <input class="form-control form-control-alternative" placeholder=" Email atau nomer perusahaan" type="text" name="cp" data-toggle="popover" data-placement="top" data-content="Isi contact person perusahaan tempat prakerin kamu yang dapat di hubungi" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input class="form-control form-control-alternative" placeholder=" Nama pimpinan perusahaan" type="text" name="pimpinan" data-toggle="popover" data-placement="top" data-content="Isi sesuai nama pimpinan perusahaan saat ini" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-archive-2"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="bukti" class="custom-file-input" id="customFile" required>
                                        <label class="custom-file-label" for="customFile">Unggah Bukti Di Terima</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('siswa') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>