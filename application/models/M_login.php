<?php  

	class M_login extends CI_Model {
		public function cekSiswa($table, $dimana){
			return $this->db->get_where($table, $dimana);
		}
		public function cekAdmin($table, $dimana){
			return $this->db->get_where($table, $dimana);
		}
		public function cekGuru($table, $dimana){
			return $this->db->get_where($table, $dimana);
		}
	}

?>