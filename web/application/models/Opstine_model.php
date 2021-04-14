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

		class Opstine_model extends CI_Model {
			public function __construct() {
				$this->load->database();
			}
			public function opstine() {
				$q = $this->db->get('opstine');
				return $q->result_array();
			}
			public function filter_opstine() {
				$this->db->where('pacijenti.id_opstine', $this->input->post('opstina'));
				$this->db->join('opstine', 'opstine.id_opstine = pacijenti.id_opstine', 'left');
				$q = $this->db->get('pacijenti');
				return $q->result_array();
			}
			public function spisak_opstina($id = NULL, $limit, $offset) {
				$this->db->order_by('id_opstine', 'DESC');
				$this->db->limit($offset, $limit);
				$query = $this->db->get('opstine');
				return $query->result_array();
			}
			public function dodaj() {
				$data = array(
					'naziv_opstine' => $this->input->post('naziv_opstine')
				);
				return $this->db->insert('opstine', $data);
			}
			public function opstina($id_opstine) {
				$this->db->where('id_opstine', $id_opstine);
				$q = $this->db->get('opstine');
				return $q->row_array();
			}
			public function edit() {
				$data = array(
					'naziv_opstine' => $this->input->post('naziv_opstine')
				);
				$this->db->where('id_opstine',  $this->input->post('id_opstine'));
				return $this->db->update('opstine', $data);
			}
			public function pretraga_opstine() {
				$this->db->like('naziv_opstine',  $this->input->post('pretraga'));
				$q = $this->db->get('opstine');
				return $q->result_array();
			}
			public function obrisi() {
				$this->db->where('id_opstine', $this->input->post('id_opstine'));
				return $this->db->delete('opstine');
			}
			public function count_where($column = "", $value = "") {
				if(!empty($column) && !empty($where))
					$this->db->where($column, $value);

				$query=$this->db->get('opstine');
				return $query->num_rows();
			}
		}