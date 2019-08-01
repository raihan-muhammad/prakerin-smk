<?php  

	// $session = $this->session->userdata('nama_siswa');
	// $select = $this->db->query("SELECT * FROM tb_siswa INNER JOIN tb_jurusan ON tb_siswa.jurusan = tb_jurusan.nama_singkat WHERE nama_siswa = '$session' ");
	// $fetch = $select->row();
	foreach($siswa as $o): 

?>
<div class="back"><h2 class="text-center text-white pt-5">My Profile</h2></div>
<div class="row">
	<div class="col-11" style="margin-left: 4%; margin-top: -15%; margin-bottom: -20%;">
		<div class="card" id="kotak">
			
		  <div class="card-body" style="overflow: hidden;">
		  	<section class="miring-satu"></section>
		  	<div class="row">
		  		<div class="col-8" style="margin-top: -75%;">
		  			<h4 class="mt-3 mb-3 pl-1" style="color: #fff; text-transform: uppercase; border-bottom: 2px solid #fff;"><?= substr($o->nama_siswa, 0,10) ?></h4>
		  			<p class="mt--2 pl-1" style="color: #fff;"><i class="ni ni-hat-3"></i> <?= $o->jurusan  ?></p>
		  		</div>

		  		<div class="col-4">	
		  			<img src="<?php echo base_url('assets/uploads/profile-siswa/').$o->foto ?>" alt="Foto Profile siswa" style="width: 80px; height: 80px; border-radius: 50%; margin: -530% 0 0 8%; position: relative; border: 3px solid #fff;">
		  			<a href="<?php echo base_url('siswa/edit/').$o->id_siswa ?>" class="btn btn-sm btn-primary" style="margin-top: -350%; margin-left: 14.2%; border: none; background-color: #17a2b8;">
		   				  <i class="ni ni-settings"></i><span style="font-weight: bold;">EDIT</span>
		   			</a>
		  		</div>
		  	</div>

		   	<div class="row mt--8">
		   		<div class="col-12 ml-9">
		   			
		   		</div>
		   	</div>
			
		  </div>
		  
		</div>		

	</div>

</div>

<?php endforeach; ?>
<div class="row">
	<div class="col-1"></div>
	<div class="col-10">
		<nav class="navbar fixed-bottom" style="width: 96%;">	
			<a href="<?php echo base_url('siswa') ?>" class="btn btn-primary" style="width: 100%;" id="kembali">Kembali</a>
		</nav>
	</div>
</div>

