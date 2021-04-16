<?php
/*
	This file is part of Imunizacija 2021!.

		Imunizacija 2021! is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		Imunizacija 2021! is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with Imunizacija 2021!.  If not, see <https://www.gnu.org/licenses/>.
*/
		defined('BASEPATH') OR exit('No direct script access allowed');

		class Oboljenja_model extends CI_Model {
			public function __construct() {
				$this->load->database();
			}
			public function spisak_oboljenja($id = NULL, $limit, $offset) {
				$this->db->order_by('id_oboljenja', 'DESC');
				$this->db->limit($offset, $limit);
				$query = $this->db->get('oboljenja');
				return $query->result_array();
			}
			public function dodaj() {
				$data = array(
					'oboljenje' => $this->input->post('oboljenje')
				);
				return $this->db->insert('oboljenja', $data);
			}
			public function oboljenje($id_oboljenja) {
				$this->db->where('id_oboljenja', $id_oboljenja);
				$q = $this->db->get('oboljenja');
				return $q->row_array();
			}
			public function edit() {
				$data = array(
					'oboljenje' => $this->input->post('oboljenje')
				);
				$this->db->where('id_oboljenja',  $this->input->post('id_oboljenja'));
				return $this->db->update('oboljenja', $data);
			}
			public function count_where($column = "", $value = "") {
				if(!empty($column) && !empty($where))
					$this->db->where($column, $value);

				$query=$this->db->get('oboljenja');
				return $query->num_rows();
			}
			public function pretraga_oboljenja() {
				$this->db->like('oboljenje',  $this->input->post('pretraga'));
				$q = $this->db->get('oboljenja');
				return $q->result_array();
			}
			public function obrisi() {
				$this->db->where('id_oboljenja', $this->input->post('id_oboljenja'));
				return $this->db->delete('oboljenja');
			}
		}