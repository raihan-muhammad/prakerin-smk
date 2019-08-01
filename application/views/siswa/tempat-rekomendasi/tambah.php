<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modal-kepo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-default" role="alert">
                    <strong>Informasi!</strong> Bukti bisa berupa dokumen pdf, doc atau bisa juga berupa gambar yang ber format png atau jpg. Jika bukti yang anda upload adalah gambar, pastikan terlihat jelas!
                </div>
                <?php echo form_open_multipart('siswa/tambahRekomendasi')  ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-building"></i></span>
                                </div>
                                <input class="form-control form-control-alternative" placeholder=" Nama Pimpinan" type="text" name="pimpinan" data-toggle="popover" data-placement="top" data-content="Isi sesuai dengan nama pimpinan tempat prakerin kamu saat ini" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">

                            <?php
                            $user  = $this->session->userdata('user');
                            $ambil = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$user' ");
                            $satu  = $ambil->row();
                            foreach ($rekomen as $r) :
                                ?>
                                <!-- Data Siswa Hidden -->
                                <input type="hidden" name="id" value="<?php echo $satu->id_siswa; ?>">
                                <input type="hidden" name="perusahaan" value="<?php echo $r->nama_perusahaan ?>">
                                <input type="hidden" name="jurusan" value="<?php echo $r->jurusan_perusahaan; ?>">
                                <input type="hidden" name="alamat" value="<?php echo $r->alamat ?>">
                                <input type="hidden" name="cp" value="<?= $r->cp ?>">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="bukti" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Unggah Bukti Di Terima</label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('siswa/rekomendasi') ?>" class="btn btn-secondary">Tutup</a>
                <button type="submit" class=" btn btn-primary">Unggah</button>
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