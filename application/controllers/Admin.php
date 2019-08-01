<?php

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/content');
	}

	// START FUNCTION daftarSiswaPKL

	public function daftarSiswa($offset = 0)
	{

		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_siswa');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/daftarSiswa';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;


		$data['siswa'] = $this->m_admin->ambil_cari($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/daftar-siswa/index', $data);
	}

	public function tambahSiswa()
	{

		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/daftar-siswa/tambah', $data);
	}

	public function doTambahSiswa()
	{
		$config['upload_path'] = './assets/uploads/profile-siswa';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['max_size']             = 100;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto')) {
			$nis = $this->input->post('nis');
			$nama = $this->input->post('nama');
			$kelas = $this->input->post('kelas');
			$jurusan = $this->input->post('jurusan');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$upload = $this->upload->data();
			$jk = $this->input->post('jk');

			$data = array(
				'nis' => $nis,
				'nama_siswa' => $nama,
				'kelas' => $kelas,
				'jurusan' => $jurusan,
				'user' => $user,
				'pass' => $pass,
				'foto' => $upload['file_name'],
				'jk' => $jk
			);

			$this->m_admin->tambahSiswa('tb_siswa', $data);
			$this->session->set_flashdata('tambah_siswa', 'Siswa Berhasil Di tambah');
			redirect('admin/daftarSiswa');
		}
	}

	public function editSiswa($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['data_siswa'] = $this->m_admin->siswaTer('tb_siswa', $dimana)->result();
		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/daftar-siswa/update', $data);
	}

	public function updateSiswa()
	{
		$config['upload_path'] = './assets/uploads/profile-siswa';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['max_size']             = 100;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$id = $this->input->post('id');
			$dimana = array('id_siswa' => $id);
			$nama = $this->input->post('nama');
			$jurusan = $this->input->post('jurusan');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$kelas = $this->input->post('kelas');
			$nis = $this->input->post('nis');
			$jk = $this->input->post('jk');
			$foto = $this->input->post('gambar');

			$data = array(
				'nis' => $nis,
				'nama_siswa' => $nama,
				'kelas' => $kelas,
				'jurusan' => $jurusan,
				'jk' => $jk,
				'user' => $user,
				'pass' => $pass,
				'foto' => $foto
			);

			$this->m_admin->updateSiswa($data, $dimana);
			$this->session->set_flashdata('update_siswa', 'Data Berhasil Di Update!');
			redirect('admin/daftarSiswa');
		} else {
			$id = $this->input->post('id');
			$dimana = array('id_siswa' => $id);
			$nama = $this->input->post('nama');
			$jurusan = $this->input->post('jurusan');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$kelas = $this->input->post('kelas');
			$nis = $this->input->post('nis');
			$jk = $this->input->post('jk');
			$foto = $this->input->post('gambar');
			$upload = $this->upload->data();

			$data = array(
				'nis' => $nis,
				'nama_siswa' => $nama,
				'kelas' => $kelas,
				'jurusan' => $jurusan,
				'jk' => $jk,
				'user' => $user,
				'pass' => $pass,
				'foto' => $upload['file_name']
			);

			$this->m_admin->updateSiswa($data, $dimana);
			$this->session->set_flashdata('update_siswa', 'Data Berhasil Di Update!');
			redirect('admin/daftarSiswa');
		}
	}

	public function deleteSiswa($id)
	{
		$dimana = array("id_siswa" => $id);
		$this->m_admin->deleteSiswa($dimana);
		$this->session->set_flashdata('delete_siswa', 'Data Berhasil Di Hapus!');
		redirect('admin/daftarSiswa');
	}

	// START FUNCTION TEMPAT PKL SISWA

	public function tempatSiswa($offset = 0)
	{
		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_tempat_siswa');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/tempatSiswa';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$data['tempat_siswa'] = $this->m_admin->allTempat($query, $config['per_page'], $offset)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-siswa/index', $data);
	}

	public function editTempat($id)
	{

		$data['tempat_siswa'] = $this->m_admin->ambil_tempat($id)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-siswa/update', $data);
	}

	public function updateTempat()
	{
		$id = $this->input->post('id');
		$dimana = array('id' => $id);
		$perusahaan = $this->input->post('perusahaan');
		$cp = $this->input->post('cp');
		$alamat = $this->input->post('alamat');

		$data = array(
			'nama_perusahaan' => $perusahaan,
			'alamat' => $alamat,
			'cp' => $cp
		);

		$this->m_admin->updateTempat($dimana, $data);
		$this->session->set_flashdata('update_tempat', 'Data Berhasil Di Update!');
		redirect('admin/tempatSiswa');
	}

	public function deleteTempat($id)
	{
		$dimana = array('id_siswa' => $id);
		$this->m_admin->deleteTempat($dimana);
		redirect('admin/tempatSiswa');
	}

	// START FUNCTION BERKAS PKL 

	public function daftarBerkas($offset = 0)
	{
		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_berkas');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/daftarBerkas';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$data['berkas'] = $this->m_admin->allBerkas($query, $config['per_page'], $offset)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/berkas/index', $data);
	}

	public function tambahBerkas()
	{
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/berkas/tambah');
	}

	public function doTambahBerkas()
	{
		$config['upload_path']    = './assets/uploads/berkas-prakerin';
		$config['allowed_types']  = 'doc|docx|pdf|txt';
		$config['max_size']       = 0;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('berkas')) {
			$nama = $this->input->post('nama');
			$berkas = $this->upload->data();
			$data = array(
				'nama_berkas' => $nama,
				'file_berkas' => $berkas['file_name']
			);
			$this->m_admin->tambahBerkas($data);
			$this->session->set_flashdata('tambah_berkas', 'Berkas Berhasil di tambah!');
			$this->load->view('admin/sidebar');
			redirect('admin/daftarBerkas');
		} else {
			$this->session->set_flashdata('gagal_berkas', 'Tipe Berkas File tidak di dukung!');
			redirect('admin/daftarBerkas');
		}
	}

	public function editBerkas($id)
	{
		$dimana = array('id_berkas' => $id);
		$data['ambil_berkas'] = $this->m_admin->ambil_berkas($dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/berkas/update', $data);
	}

	public function updateBerkas()
	{
		$config['upload_path']    = './assets/uploads/berkas-prakerin';
		$config['allowed_types']  = 'doc|docx|pdf|txt';
		$config['max_size']       = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('berkas')) {
			$id = $this->input->post('id');

			$dimana = array('id_berkas' => $id);
			$nama = $this->input->post('nama');
			$berkas = $this->input->post('hmm');

			$data = array(
				'nama_berkas' => $nama,
				'file_berkas' => $berkas
			);

			$this->m_admin->updateBerkas($dimana, $data);
			$this->session->set_flashdata('update_berkas', 'Berkas Berhasil di Update!');
			redirect('admin/daftarBerkas');
		} else {
			$id = $this->input->post('id');

			$dimana = array('id_berkas' => $id);
			$nama = $this->input->post('nama');
			$berkas = $this->upload->data();

			$data = array(
				'nama_berkas' => $nama,
				'file_berkas' => $berkas['file_name']
			);

			$this->m_admin->updateBerkas($dimana, $data);
			$this->session->set_flashdata('update_berkas', 'Berkas Berhasil di Update!');
			redirect('admin/daftarBerkas');
		}
	}

	public function deleteBerkas($id)
	{

		$dimana = array('id_berkas' => $id);
		$this->m_admin->deleteBerkas('tb_berkas', $dimana);

		redirect('admin/daftarBerkas');
	}
	// START FUNCTION TEMPAT REKOMENDASI

	public function tempatRekomendasi($offset = 0)
	{
		$kepo = $this->db->get('tb_tempat_rekomendasi');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/tempatRekomendasi';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$query = $this->input->post('cari');
		$data['rekomendasi'] = $this->m_admin->allRekomendasi($query, $config['per_page'], $offset);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-rekomendasi/index', $data);
	}

	public function tambahRekomendasi()
	{

		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-rekomendasi/tambah', $data);
	}

	public function doTambahRekomendasi()
	{

		$config['upload_path']   = './assets/uploads/tempat-rekomendasi';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size']      = 0;
		$config['max_height']    = 0;
		$config['max_width']     = 0;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			$perusahaan = $this->input->post('perusahaan');
			$jurusan    = $this->input->post('jurusan');
			$alamat     = $this->input->post('alamat');
			$cp         = $this->input->post('cp');
			$foto       = $this->upload->data();
			$jumlah     = implode(", ", $jurusan);


			$data = array(
				'nama_perusahaan' => $perusahaan,
				'jurusan' => $jumlah,
				'alamat'  => $alamat,
				'foto'    => $foto['file_name'],
				'cp'      => $cp
			);



			$this->m_admin->tambahRekomendasi('tb_tempat_rekomendasi', $data);

			$this->session->set_flashdata('tambah_rekomendasi', 'Data berhasil di tambah!');

			redirect('admin/tempatRekomendasi');
		}
	}

	public function updateRekomendasi($id)
	{
		$dimana = array('id_rekomendasi' => $id);
		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');
		$data['ambil_rekomendasi'] = $this->m_admin->ambil_rekomendasi($dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-rekomendasi/update', $data);
	}

	public function doUpdateRekomendasi()
	{
		$config['upload_path']   = './assets/uploads/tempat-rekomendasi';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size']      = 0;
		$config['max_height']    = 0;
		$config['max_width']     = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$id 		= $this->input->post('id');
			$perusahaan = $this->input->post('perusahaan');
			$jurusan 	= $this->input->post('jurusan');
			$alamat 	= $this->input->post('alamat');
			$cp 		= $this->input->post('cp');
			$foto 		= $this->input->post('gambar');
			$jumlah 	= implode(", ", $jurusan);

			if ($jumlah == "") {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan' => $jurusan,
					'foto' => $foto
				);
			} else {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan' => $jumlah,
					'foto' => $foto
				);
			}
			$dimana = array('id_rekomendasi' => $id);

			$this->m_admin->updateRekomendasi($dimana, $data);
			$this->session->set_flashdata('update_rekomendasi', 'Data Berhasil di Update!');
			redirect('admin/tempatRekomendasi');
		} else {
			$id = $this->input->post('id');
			$perusahaan = $this->input->post('perusahaan');
			$jurusan = $this->input->post('jurusan');
			$alamat = $this->input->post('alamat');
			$cp = $this->input->post('cp');
			$foto = $this->upload->data();
			$jumlah 	= implode(", ", $jurusan);

			if ($jumlah == "") {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan' => $jurusan,
					'foto' => $foto
				);
			} else {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan' => $jumlah,
					'foto' => $foto
				);
			}
			$dimana = array('id_rekomendasi' => $id);

			$this->m_admin->updateRekomendasi($dimana, $data);
			$this->session->set_flashdata('update_rekomendasi', 'Data Berhasil di Update!');
			redirect('admin/tempatRekomendasi');
		}
	}

	public function deleteRekomendasi($id)
	{
		$dimana = array('id_rekomendasi' => $id);
		$this->m_admin->deleteRekomendasi('tb_tempat_rekomendasi', $dimana);
		$this->session->set_flashdata('delete_rekomendasi', 'Data Berhasil di Hapus!');
		redirect('admin/tempatRekomendasi');
	}
	// START FUNCTION JURUSAN

	public function jurusan($offset = 0)
	{
		$kepo = $this->db->get('tb_jurusan');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/jurusan';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;
		$data['jurusan'] = $this->m_admin->allJurusan('tb_jurusan', $config['per_page'], $offset);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/jurusan/index', $data);
	}

	public function tambahJurusan()
	{


		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/jurusan/tambah');
	}

	public function doTambahJurusan()
	{
		$singkat = $this->input->post('singkat');
		$panjang = $this->input->post('panjang');
		$data = array(
			'nama_singkat' => $singkat,
			'nama_panjang' => $panjang
		);
		$this->m_admin->tambahJurusan($data);
		$this->session->set_flashdata('tambah_jurusan', 'Data Berhasil di Tambah!');
		redirect('admin/jurusan');
	}

	public function editJurusan($id)
	{
		$dimana = array('id_jurusan' => $id);

		$data['ambil_jurusan'] = $this->m_admin->ambil_jurusan($dimana)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/jurusan/update', $data);
	}

	public function updateJurusan()
	{
		$id = $this->input->post('id');
		$singkat = $this->input->post('singkat');
		$panjang = $this->input->post('panjang');
		$dimana = array('id_jurusan' => $id);
		$data = array(
			'nama_singkat' => $singkat,
			'nama_panjang' => $panjang
		);
		$this->m_admin->updateJurusan($dimana, $data);
		$this->session->set_flashdata('update_jurusan', 'Data Berhasil di Update!');
		redirect('admin/jurusan');
	}

	public function deleteJurusan($id)
	{
		$dimana = array('id_jurusan' => $id);
		$this->m_admin->deleteJurusan($dimana);
		$this->session->set_flashdata('delete_jurusan', 'Data Berhasil di Hapus!');
		redirect('admin/jurusan');
	}

	// START FUNCTION NOTIF

	public function notif($offset = 0)
	{
		$kepo = $this->db->get('tb_sementara');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/notif';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$data['notif']	= $this->m_admin->allNotif($config['per_page'], $offset)->result();
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/notif/index', $data);
	}
	// FUNCTION UNDUH 
	public function unduh($bukti)
	{
		force_download('assets/uploads/daftar-rekomendasi/' . $bukti, NULL);
	}

	public function tolakRekomen($id)
	{
		$dimana = array('id' => $id);
		$data['pesan'] = $this->m_admin->ambilPesan($dimana)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/notif/pesan', $data);
	}
	public function masukPesan()
	{
		$perusahaan = $this->input->post('perusahaan');
		$siswa		= $this->input->post('siswa');
		$pesan		= $this->input->post('pesan');
		$id			= $this->input->post('id');
		$dimana		= array('id' => $id);
		$data 		= array(
			'nama_perusahaan' 	=> $perusahaan,
			'id_siswa'			=> $siswa,
			'pesan'				=> $pesan
		);

		$this->m_admin->kirimPesan($data);
		$this->db->delete('tb_sementara', $dimana);
		$this->session->set_flashdata('kirim_pesan', 'Pesan anda telah di kirim ke siswa!');
		redirect('admin/notif');
	}

	public function taOke($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data['oke']	= $this->m_siswa->get_satu('tb_sementara', $dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/oke/index', $data);
		$this->load->view('admin/sidebar');
	}

	public function oke($id)
	{
		$oke 		= $this->db->query("SELECT * FROM tb_sementara WHERE id = '$id' ");
		$pecah 		= $oke->row();
		$perusahaan = $pecah->nama_perusahaan;
		$pimpinan	= $pecah->pimpinan;
		$alamat		= $pecah->alamat;
		$cp			= $pecah->cp;
		$id_siswa	= $pecah->id_siswa;

		$data 		= array(
			'nama_perusahaan' 	=> $perusahaan,
			'nama_pimpinan'		=> $pimpinan,
			'alamat'			=> $alamat,
			'cp'				=> $cp,
			'id_siswa'			=> $id
		);

		$this->db->insert('tb_tempat_siswa', $data);
		redirect('admin/notif');
	}

	public function cus()
	{
		$perusahaan		= $this->input->post('perusahaan');
		$pimpinan		= $this->input->post('pimpinan');
		$alamat			= $this->input->post('alamat');
		$cp				= $this->input->post('cp');
		$id				= $this->input->post('id');

		$data = array(
			'nama_perusahaan' 	=> $perusahaan,
			'nama_pimpinan'		=> $pimpinan,
			'alamat'			=> $alamat,
			'cp'				=> $cp,
			'id_siswa'			=> $id
		);

		$dimana = array('id_siswa' => $id);

		$this->m_siswa->tambah('tb_tempat_siswa', $data);
		$this->db->delete('tb_sementara', $dimana);
		$this->session->set_flashdata('oke', 'Siswa telah di konfirmasi');
		redirect('admin/notif');
	}
}
