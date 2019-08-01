<?php

$session = $this->session->userdata('user');
$select = $this->db->query("SELECT * FROM tb_siswa INNER JOIN tb_jurusan ON tb_siswa.jurusan = tb_jurusan.nama_singkat WHERE user = '$session' ");
$fetch = $select->row();

if ($this->session->flashdata('update_profile') == TRUE) : ?>
	<script>
		Swal.fire({
			type: 'success',
			title: 'Update Berhasil!',
			text: '<?php echo $this->session->flashdata('update_profile') ?>'
		});
	</script>
<?php endif; ?>
<?php
if ($this->session->flashdata('unggah_bukti') ==  TRUE) { ?>
	<script>
		Swal.fire({
			type: 'success',
			title: 'Berhasil di Unggah!',
			text: '<?php echo $this->session->flashdata('unggah_bukti') ?>'
		});
	</script>
<?php } ?>
<?php 

	if($this->session->flashdata('tambah_daf') == TRUE){ ?>
		<script>
			Swal.fire({
				type: 'success',
				text: '<?= $this->session->flashdata('tambah_daf') ?>'
			})
		</script>		
	<?php }

?>
<style>
	.modal-content {
		margin: auto;
		width: 90%;
	}
</style>

<div class="back">
	<h4 class="text-center text-white pt-4">M-ONEKLIK</h4>
</div>
<div class="row">
	<div class="col-11" style="margin-left: 4%; margin-top: -15%">
		<div class="card" id="kotak">
			<div class="card-body">
				<img src="<?php echo base_url('assets/uploads/profile-siswa/') . $fetch->foto ?>" alt="Foto Profile siswa" class="img-thumbnail" style="width: 125px; height: 125px; border-radius: 50%; margin-left: 29%; margin-top: -25%;">
				<h4 class="text-center mt-3" style="color: #148ba0; text-transform: uppercase;"><?= substr($fetch->nama_siswa, 0, 10) ?></h4>
				<p class="text-center mt--2" style="color: #148ba0;"><i class="ni ni-hat-3"></i> <?= $fetch->nama_panjang  ?></p>
				<div class="row text-center mt-4" style="font-family: 'quick'; font-weight: bold;">
					<div class="col-4">
						<a href="<?php echo base_url('siswa/profile/') . $fetch->id_siswa ?>" style="color: #148ba0;">
							<i class="fa fa-user-circle" style="font-size: 50px;"></i>Profile
						</a>
					</div>
					<div class="col-4">
						<a href="" style="color: #148ba0;">
							<i class="fa fa-calendar-alt" style="font-size: 50px;"></i>Absensi
						</a>
					</div>
					<div class="col-4">
					<?php
						$idR	= $fetch->id_siswa;
						$cekSe = $this->db->query("SELECT * FROM tb_sementara WHERE id_siswa = '$idR' ");
						$bar	= $cekSe->num_rows();
						if($bar > 0){?>
							<a href="" style="color: #148ba0;" data-toggle="modal" data-target="#modal-notificationdua">
								<i class="fa fa-hospital" style="font-size: 50px;"></i><br>Daftar
							</a>
							<div class="modal fade" id="modal-notificationdua" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
								<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
									<div class="modal-content bg-gradient-danger">

										<div class="modal-header">
											<h6 class="modal-title" id="modal-title-notification">Pemberitahuan</h6>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>

										<div class="modal-body">

											<div class="py-3 text-center">
												<i class="ni ni-bell-55 ni-3x"></i>
												<h4 class="heading mt-4">Menu tidak dapat di akses!</h4>
												<p style="font-size: 13px;">Maaf di karenakan kamu sudah mendaftarkan tempat prakerin kamu, kamu tidak dapet mengakses menu ini. Tunggu sampai konfirmasi selanjutnya ya </p>
											</div>

										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Oke, Saya paham</button>
										</div>

									</div>
								</div>
							</div>
						<?php } else {
					?>
					
						<a href="<?php echo base_url('siswa/daftarPkl/') . $fetch->id_siswa; ?>" style="color: #148ba0;">
							<i class="fa fa-hospital" style="font-size: 50px;"></i><br>Daftar
						</a>
					
					<?php } ?>
					</div>
				</div>
				<div class="row text-center mt-4" style="font-family: 'quick'; font-weight: bold;">
					<div class="col-4">
						<?php

						$sess 	= $this->session->userdata('user');
						$cekSes = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$sess' ");
						$pecah 	= $cekSes->row();
						$id		= $pecah->id_siswa;
						$kue	= $this->db->query("SELECT * FROM tb_sementara WHERE id_siswa = '$id' ");
						$angka	= $kue->num_rows();

						if ($angka > 0) { ?>
							<a href="" style="color: #148ba0;" data-toggle="modal" data-target="#modal-notificationsatu">
								<i class="fa fa-building" style="font-size: 50px;"></i><br>Tempat
							</a>
							<div class="modal fade" id="modal-notificationsatu" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
								<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
									<div class="modal-content bg-gradient-danger">

										<div class="modal-header">
											<h6 class="modal-title" id="modal-title-notification">Pemberitahuan</h6>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>

										<div class="modal-body">

											<div class="py-3 text-center">
												<i class="ni ni-bell-55 ni-3x"></i>
												<h4 class="heading mt-4">Menu tidak dapat di akses!</h4>
												<p style="font-size: 13px;">Maaf di karenakan kamu sudah mendaftarkan tempat prakerin kamu, kamu tidak dapat mengakses menu ini (: </p>
											</div>

										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Oke, Saya paham</button>
										</div>

									</div>
								</div>
							</div>
						<?php } else { ?>
							<a href="<?php echo base_url('siswa/rekomendasi') ?>" style="color: #148ba0;">
								<i class="fa fa-building" style="font-size: 50px;"></i><br>Tempat
							</a>
						<?php }

						?>

					</div>
					<?php
					$oo 	= $fetch->id_siswa;
					$cek 	= $this->db->query("SELECT * FROM tb_notif WHERE id_siswa = '$oo' ");
					$joo	= $cek->row();

					if ($cek->num_rows() > 0) {
						?>
						<div class="col-4">
							<a href="<?php echo base_url('siswa/notif/') . $fetch->id_siswa ?>" style="color: #148ba0;">
								<i class="fa fa-bell" style="font-size: 50px;"></i>Notifikasi<span class="text-danger">*</span>
							</a>
						</div>
					<?php } else { ?>
						<div class="col-4">
							<a href="<?php echo base_url('siswa/notif/') . $fetch->id_siswa ?>" style="color: #148ba0;">
								<i class="fa fa-bell" style="font-size: 50px;"></i>Notifikasi
							</a>
						</div>
					<?php } ?>

					<div class="col-4">
						<a href="<?php echo base_url('login/logout') ?>" style="color: #148ba0;">
							<i class="fa fa-sign-out-alt" style="font-size: 50px;"></i>logout
						</a>
					</div>

				</div>
			</div>

		</div>

	</div>

</div>