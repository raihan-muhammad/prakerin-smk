<?php

class M_siswa extends CI_Model
{

	// FUNCTION SELECT SEMUA DATA
	public function select($table)
	{
		return $this->db->get($table)->result();
	}

	public function pagination($table, $perPage, $offset)
	{
		return $this->db->get($table, $perPage, $offset)->result();
	}

	// FUNCTION UPDATE
	public function update($dimana, $data, $table)
	{
		$this->db->where($dimana);
		$this->db->update($table, $data);
	}

	// FUNCTION SELECT SATU DATA
	public function get_satu($table, $dimana)
	{
		return $this->db->get_where($table, $dimana)->result();
	}

	public function get_profile($dimana)
	{
		return $this->db->get_where('tb_siswa', $dimana)->result();
	}

	// FUNCTION INSERT BIASA

	public function tambah($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function satNot($dimana)
	{
		return $this->db->get_where('tb_notif', $dimana);
	}
}
