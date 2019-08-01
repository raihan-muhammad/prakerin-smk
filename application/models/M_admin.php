<?php

class m_admin extends CI_Model
{

	public function jurusan($table)
	{
		return $this->db->get($table)->result();
	}
	// Start Function Ambil siswa
	public function allSiswa()
	{
		return $this->db->get('tb_siswa')->result();
	}

	public function ambil_cari($query, $perPage, $offset)
	{
		// $this->db->select("*");
		// $this->db->from('tb_siswa');
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_siswa WHERE nama_siswa LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->get('tb_siswa', $perPage, $offset);
			$this->db->order_by('jurusan', 'ASC');
		}

		return $oke->result();
	}

	// Start Function All Jurusan
	public function allJurusan($table, $perPage, $offset)
	{
		return $this->db->get($table, $perPage, $offset)->result();
	}

	public function siswaTer($table, $dimana)
	{
		return $this->db->get_where($table, $dimana);
	}

	public function tambahSiswa($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function updateSiswa($data, $dimana)
	{
		$this->db->where($dimana);
		$this->db->update('tb_siswa', $data);
	}

	public function deleteSiswa($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_siswa');
	}

	// START FUNCTION TEMPAT PKL SISWA 

	public function allTempat($query, $perPage, $offset)
	{
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa WHERE nama_siswa LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa");
			$this->db->order_by('jurusan', 'ASC');
		}

		return $oke;
	}

	public function deleteTempat($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_tempat_siswa');
	}

	public function ambil_tempat($id)
	{
		return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa WHERE id = '$id' ");
	}

	public function updateTempat($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_tempat_siswa', $data);
	}

	// START FUNCTION DAFTAR BERKAS 

	public function allBerkas($query, $perPage, $offset)
	{
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_berkas WHERE nama_berkas LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->get('tb_berkas', $perPage, $offset);
		}

		return $oke;
	}

	public function tambahBerkas($data)
	{
		$this->db->insert('tb_berkas', $data);
	}

	public function ambil_berkas($dimana)
	{
		return $this->db->get_where('tb_berkas', $dimana)->result();
	}

	public function updateBerkas($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_berkas', $data);
	}

	public function deleteBerkas($table, $dimana)
	{
		$this->db->where($dimana);
		$this->db->delete($table);
	}
	// START FUNCTION TEMPAT REKOMENDASI

	public function allRekomendasi($query, $perPage, $offset)
	{
		if ($query != "") {
			$hmm = $this->db->query("SELECT * FROM tb_tempat_rekomendasi WHERE nama_perusahaan LIKE '%" . $query . "%' ");
		} else {
			$hmm = $this->db->get('tb_tempat_rekomendasi', $perPage, $offset);
		}
		$this->db->order_by('jurusan', 'ASC');

		return $hmm->result();
	}

	public function tambahRekomendasi($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function ambil_rekomendasi($dimana)
	{
		return $this->db->get_where('tb_tempat_rekomendasi', $dimana)->result();
	}

	public function updateRekomendasi($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_tempat_rekomendasi', $data);
	}

	public function deleteRekomendasi($table, $dimana)
	{
		$this->db->where($dimana);
		$this->db->delete($table);
	}

	// START FUNTION JURUSAN 

	public function tambahJurusan($data)
	{
		$this->db->insert('tb_jurusan', $data);
	}

	public function ambil_jurusan($dimana)
	{
		return $this->db->get_where('tb_jurusan', $dimana);
	}

	public function updateJurusan($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_jurusan', $data);
	}

	public function deleteJurusan($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_jurusan');
	}

	// START FUNCTION NOTIF 
	public function allNotif($perPage, $offset)
	{
		return $this->db->query("SELECT id, nama_siswa, nama_pimpinan, jurusan, jurusan_perusahaan, nama_perusahaan, bukti FROM tb_siswa INNER JOIN tb_sementara ON tb_siswa.id_siswa = tb_sementara.id_siswa LIMIT $offset, $perPage ");
	}
	public function ambilPesan($dimana)
	{
		return $this->db->get_where('tb_sementara', $dimana);
	}

	public function kirimPesan($data)
	{
		$this->db->insert('tb_notif', $data);
	}
}
