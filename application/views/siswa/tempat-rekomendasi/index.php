<?php

// $session = $this->session->userdata('nama_siswa');
// $select  = $this->db->query("SELECT * FROM tb_siswa INNER JOIN tb_jurusan ON tb_siswa.jurusan = tb_jurusan.nama_singkat WHERE user = '$session' ");
// $r   = $select->row();

if ($this->session->flashdata('update_profile') == TRUE) { ?>
	<script>
		Swal.fire({
			type: 'success',
			title: 'Update Berhasil!',
			text: '<?php echo $this->session->flashdata('update_profile') ?>'
		});
	</script>
<?php }



?>

<style>
	.modal-backdrop {
		position: static;
	}
</style>



<div class="col-md-4">

	<div class="modal-sm fade" id="modal-notification1" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="false">
		<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
			<div class="modal-content bg-gradient-primary">

				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">Pemberitahuan!</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="modal-body">

					<div class="py-3 text-center">
						<i class="ni ni-bell-55 ni-3x"></i>
						<h4 class="heading mt-4">Baca Dengan Teliti!</h4>
						<p>Jika anda ingin mendaftar lewat menu rekomendasi, pastikan anda telah menghubungi tempat prakerin tersebut, dan unggah bukti di terima melalui form upload yang di sediakan setelah anda meng klik tombol daftar. Terimakasih!</p>

					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Oke, Saya Paham!</button>
				</div>

			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#modal-notification1').modal('show');
		});
	</script>

	<div class="back">
		<h4 class="text-center text-white pt-5">TEMPAT REKOMENDASI</h4>
	</div>

	<div class="row">
		<div class="col-11" style="margin-left: 4%; margin-top: -33%">
			<?php foreach ($rekomendasi as $r) : ?>



				<div class="card" id="kotak" style="margin-top: 25%; ">


					<div class="card-body">

						<img src="<?php echo base_url('assets/uploads/tempat-rekomendasi/') . $r->foto ?>" alt="Foto Profile siswa" class="img-thumbnail" style="width: 400px; height: 155px; margin-top: -25%;">
						<h4 class="text-center mt-3" style="color: #148ba0; text-transform: uppercase; "><?= substr($r->nama_perusahaan, 0, 20) ?></h4>

					</div>

					<div class="row">
						<div class="col-11 ml-3">

							<!-- Visi -->
							<div class="row">
								<div class="col-2"></div>
								<div class="col-8">
									<p class="text-center" id="alamat2"><i class="ni ni-building"></i> Visi</p>

								</div>

							</div>

							<div class="row">
								<div class="col">
									<p class="ml-4"><?php echo $r->visi ?></p>
								</div>
							</div>
							<!-- Misi -->
							<div class="row">
								<div class="col-2"></div>
								<div class="col-8">
									<p class="text-center" id="alamat3"><i class="fa fa-building"></i> Misi</p>

								</div>

							</div>

							<div class="row">
								<div class="col">
									<p class="ml-4"><?php echo $r->misi ?></p>
								</div>
							</div>
							<!-- Alamat -->
							<div class="row">
								<div class="col-2"></div>
								<div class="col-8">
									<p class="text-center" id="alamat"><i class="ni ni-pin-3"></i> Alamat</p>

								</div>

							</div>
							<div class="row">
								<div class="col">
									<p class="ml-4"><?php echo $r->alamat ?></p>
								</div>
							</div>


						</div>
					</div>


					<div class="row ml-4 mr-2">
						<?php
						$ro		 = $r->jurusan_perusahaan;
						$jurusan = explode(',', $ro);
						$jumlah	 = count($jurusan);
						for ($i = 0; $i < $jumlah; $i++) {

							?>
							<div class="col-4 mt-1 mb-1 ">
								<span class="badge badge-pill badge-info" data-toggle="popover" data-color="info" data-placement="top" data-content="This is a very beautiful popover, show some love."><i class="ni ni-hat-3"></i> <?php echo $jurusan[$i] ?></span>
							</div>
						<?php } ?>
					</div>




					<div class="row">
						<a href="<?php echo base_url('siswa/tambahRekomen/') . $r->id_rekomendasi ?>" class="tombol"><i class="ni ni-send"></i> Daftar</a>
					</div>

				</div>
				</form>
			<?php endforeach; ?>
			<br>
			<?php echo $halaman; ?>
		</div>


	</div>
	<br><br><br><br>
	<div class="row">

		<div class="col-12">
			<nav class="navbar">
				<a href="<?php echo base_url('siswa') ?>" class="btn btn-primary" style="width: 100%;" id="kembali">Kembali</a>
			</nav>
		</div>
	</div>