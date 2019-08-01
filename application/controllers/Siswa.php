<?php

class Siswa extends CI_Controller
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
		//$dimana = array('id_siswa' => $id);
		//$data['siswa'] = $this->m_siswa->select_satu('tb_siswa', $dimana);
		$this->load->view('siswa/header');
		$this->load->view('siswa/content');
		$this->load->view('siswa/footer');
	}

	public function profile($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['siswa'] = $this->m_siswa->get_satu('tb_siswa', $dimana);

		$this->load->view('siswa/header');
		$this->load->view('siswa/profile/index', $data);
		$this->load->view('siswa/footer');
	}

	public function edit($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['profile'] = $this->m_siswa->get_profile($dimana, 'tb_siswa');
		$this->load->view('siswa/header');
		$this->load->view('siswa/profile/edit', $data);
		$this->load->view('siswa/footer');
	}

	public function update()
	{

		$config['upload_path']   = './assets/uploads/profile-siswa';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size']      = 0;
		$config['max-width']     = 0;
		$config['max-height']    = 0;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$id     = $this->input->post('id');
			$nama   = $this->input->post('nama');
			$gambar = $this->input->post('gambar');
			$dimana = array('id_siswa' => $id);
			$data = array(
				'nama_siswa' => $nama,
				'foto' => $gambar
			);

			$this->m_siswa->update($dimana, $data, 'tb_siswa');
			$this->session->set_flashdata('update_profile', 'Profile Berhasil di Update!');
			$data_session = array(
				'nama_siswa' => $nama,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);

			redirect('siswa');
		} else {
			$id   	= $this->input->post('id');
			$nama 	= $this->input->post('nama');
			$upload = $this->upload->data();

			$dimana = array('id_siswa' => $id);
			$data	= array(
				'nama_siswa' => $nama,
				'foto' => $upload['file_name']
			);

			$this->m_siswa->update($dimana, $data, 'tb_siswa');
			$this->session->set_flashdata('update_profile', 'Profile Berhasil di Update!');
			$data_session = array(
				'nama_siswa' => $nama,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);

			redirect('siswa');
		}
	}

	// START FUNCTION REKOMENDASI

	public function rekomendasi($offset = 0)
	{

		$kepo = $this->db->get('tb_tempat_rekomendasi');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'siswa/rekomendasi';
		$config['per_page'] = 3;

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
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link" style="background-color: #17a2b8; border-color: transparent;">';
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


		$data['rekomendasi'] = $this->m_siswa->pagination('tb_tempat_rekomendasi', $config['per_page'], $offset);

		$this->load->view('siswa/header');
		$this->load->view('siswa/tempat-rekomendasi/index', $data);
		$this->load->view('siswa/footer');
	}

	public function tambahRekomen($id)
	{
		$dimana 		 = array('id_rekomendasi' => $id);
		$data['rekomen'] = $this->m_siswa->get_satu('tb_tempat_rekomendasi', $dimana);
		$this->load->view('siswa/header');
		$this->load->view('siswa/tempat-rekomendasi/tambah', $data);
		$this->load->view('siswa/footer');
	}

	public function tambahRekomendasi()
	{
		$config['upload_path']		= './assets/uploads/daftar-rekomendasi';
		$config['allowed_types']	= 'png|jpg|pdf|doc|docx';
		$config['max_size']         = 0;
		$config['max_height']		= 0;
		$config['max_width']		= 0;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('bukti')) {
			$id 		= $this->input->post('id');
			$perusahaan = $this->input->post('perusahaan');
			$jurusan	= $this->input->post('jurusan');
			$file 		= $this->upload->data();
			$alamat		= $this->input->post('alamat');
			$cp 		= $this->input->post('cp');
			$pimpinan   = $this->input->post('pimpinan');

			$data = array(
				'nama_perusahaan' => $perusahaan,
				'jurusan_perusahaan' => $jurusan,
				'bukti'			  => $file['file_name'],
				'id_siswa'		  => $id,
				'nama_pimpinan'	  => $pimpinan,
				'alamat'		  => $alamat,
				'cp'			  => $cp
			);

			$this->m_siswa->tambah('tb_sementara', $data);
			$this->session->set_flashdata('unggah_bukti', 'Tunggu Konfirmasi Selanjutnya ya!');

			redirect('siswa');
		}
	}

	public function notif($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data['notif'] 	= $this->m_siswa->satNot($dimana)->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/notif/index', $data);
		$this->load->view('siswa/footer');
	}
	public function oke($id)
	{
		$dimana = array('id_siswa' => $id);
		$eko	= $this->db->query("SELECT nama_siswa FROM tb_siswa WHERE id_siswa = '$id' ");
		$ho 	= $eko->row();
		$this->db->delete('tb_notif', $dimana);
		$this->session->set_flashdata('oke', ' silahkan di coba lagi ya, ' . $ho->nama_siswa);
		redirect('siswa/notif/' . $id);
	}

	// FUNCTION DAFTAR PRAKERIN

	public function daftarPkl($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data['daftar'] = $this->m_siswa->get_satu('tb_siswa', $dimana);
		$this->load->view('siswa/header');
		$this->load->view('siswa/daftar-pkl/index', $data);
		$this->load->view('siswa/footer');
	}

	public function regPkl()
	{
		$config['upload_path'] 		= './assets/uploads/tempat-siswa/';
		$config['allowed_types']	= 'png|doc|docx|jpg|pdf';
		$config['max_size']			= 0;
		$config['max_width']		= 0;
		$config['max_height']		= 0;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('bukti')) {
			$perusahaan	= $this->input->post('perusahaan');
			$alamat		= $this->input->post('alamat');
			$cp 		= $this->input->post('cp');
			$bukti		= $this->upload->data();
			$id			= $this->input->post('id');
			$pimpinan	= $this->input->post('pimpinan');

			$data = array(
				'nama_perusahaan' 	=> $perusahaan,
				'bukti'				=> $bukti['file_name'],
				'alamat'			=> $alamat,
				'cp'				=> $cp,
				'id_siswa'			=> $id,
				'nama_pimpinan'		=> $pimpinan
			);

			$this->m_siswa->tambah('tb_sementara', $data);
			$this->session->set_flashdata('tambah_daf', 'Tunggu konfirmasi dulu ya');
			redirect('siswa');
		}
	}
}
