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

		class Vakcina_model extends CI_Model {
			public function __construct() {
				$this->load->database();
			}
			public function spisak_vakcina($id = NULL, $limit, $offset) {
				$this->db->order_by('id_vakcine', 'DESC');
				$this->db->limit($offset, $limit);
				$query = $this->db->get('vakcine');
				return $query->result_array();
			}
			public function vakcine() {
				$this->db->order_by('id_vakcine', 'ASC');
				$query = $this->db->get('vakcine');
				return $query->result_array();
			}
			public function count_where($column = "", $value = "") {
				if(!empty($column) && !empty($where))
					$this->db->where($column, $value);

				$query=$this->db->get('vakcine');
				return $query->num_rows();
			}
			public function dodaj() {
				$data = array(
					'naziv_vakcine' => $this->input->post('naziv_vakcine')
				);
				return $this->db->insert('vakcine', $data);
			}
			public function vakcina($id_vakcine) {
				$this->db->where('id_vakcine', $id_vakcine);
				$q = $this->db->get('vakcine');
				return $q->row_array();
			}
			public function edit() {
				$data = array(
					'naziv_vakcine' => $this->input->post('naziv_vakcine')
				);
				$this->db->where('id_vakcine',  $this->input->post('id_vakcine'));
				return $this->db->update('vakcine', $data);
			}
			public function obrisi() {
				$this->db->where('id_vakcine', $this->input->post('id_vakcine'));
				return $this->db->delete('vakcine');
			}
			public function pretraga_vakcine() {
				$this->db->like('naziv_vakcine',  $this->input->post('pretraga'));
				$q = $this->db->get('vakcine');
				return $q->result_array();
			}
		}