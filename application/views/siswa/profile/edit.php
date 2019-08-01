<?php  

	// $session = $this->session->userdata('nama_siswa');
	// $select = $this->db->query("SELECT * FROM tb_siswa INNER JOIN tb_jurusan ON tb_siswa.jurusan = tb_jurusan.nama_singkat WHERE nama_siswa = '$session' ");
	// $fetch = $select->row();
	foreach($profile as $o):
?>
<div class="back"><h2 class="text-center text-white pt-5">Edit Profile</h2></div>
<?php echo form_open_multipart('siswa/update/') ?>
<input type="hidden" name="id" value="<?php echo $o->id_siswa ?>">
<div class="row">
	<div class="col-11" style="margin-left: 4%; margin-top: -20%; margin-bottom: -20%;">
		<div class="card" id="kotak">
		  <div class="card-body" style="overflow: hidden;">
		  	
		  	<div class="row">
		  		<div class="col ml-7">
		  			<img src="<?php echo base_url('assets/uploads/profile-siswa/').$o->foto ?>" alt="Foto Profile" style="width: 100px; height: 100px; border-radius: 50%;">
		  		</div>
		  	</div>

		  	<br>

		  	<div class="row">
		  		<div class="col-12" style="margin-left: 0%;">
		  			<div class="custom-file" style="color: #17a2b8;">
		  				<input type="file" class="custom-file-input" name="foto">
		  				<label class="custom-file-label" for="customFile" data-browse="Ganti" style="color: #17a2b8;"><?php echo $o->foto ?></label>
		  				<input type="hidden" name="gambar" value="<?php echo $o->foto ?>">	
		  			</div>  			
		  		</div>

		  		<div class="col-12 mt-3">
		  			<!-- <h4 class="text-center" style="color: #17a2b8;"><?php echo $o->nama_siswa ?></h4> -->
					<div class="input-group">
						<div class="input-group-text" style="background-color: transparent; border: none;">
							<i class="ni ni-circle-08" style="color: #17a2b8;"></i>
						</div>
						 
		  				<input type="text" class="form-control" placeholder="Ganti Nama" style="border: none; border-bottom: 1px solid #17a2b8; color: #17a2b8;" class="input-nama" value="<?php echo $o->nama_siswa; ?>" name="nama">
		  			</div>
		  		</div>

		  		<div class="col-12 mt-3">
		  			<input type="submit" class="btn btn-sm btn-primary float-right" value="Update" style="background-color: #17a2b8; border: none;">
		  		</div>

		  	</div>

		   	
			
		  </div>
		  
		</div>		

	</div>

</div>
</form>

<?php endforeach; ?>
<div class="row">
	<div class="col-1"></div>
	<div class="col-10">
		<nav class="navbar fixed-bottom" style="width: 96%;">	
			<a href="<?php echo base_url('siswa/profile/').$o->id_siswa ?>" class="btn btn-primary" style="width: 100%;" id="kembali">Kembali</a>
		</nav>
	</div>
</div>

