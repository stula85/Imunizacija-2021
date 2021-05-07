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

	class Vakcinacija_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}
		public function spisak_pacijenata($id = NULL, $limit, $offset) {
			$this->db->order_by('zakazani_termini_vakcinacije.datum_vrijeme', 'DESC');
			$this->db->join('pacijenti', 'pacijenti.id_pacijenta = zakazani_termini_vakcinacije.id_pacijenta', 'left');
			$this->db->limit($offset, $limit);
			$query = $this->db->get('zakazani_termini_vakcinacije');
			return $query->result_array();
		}
		public function count_where($column = "", $value = "") {
			if(!empty($column) && !empty($where))
				$this->db->where($column, $value);

			$query=$this->db->get('zakazani_termini_vakcinacije');
			return $query->num_rows();
		}
		public function termin($id) {
			$this->db->where('id_termina', $id);
			$q = $this->db->get('zakazani_termini_vakcinacije');
			return $q->row_array();
		}
		public function pacijent($id_termina) {
			$this->db->select('id_pacijenta');
			$this->db->where('id_termina', $id_termina);
			$q = $this->db->get('zakazani_termini_vakcinacije');
			return $q->row_array();
		}
		public function imunizacije($id_pacijenta) {
			$this->db->where('id_pacijenta', $id_pacijenta);
			$q = $this->db->get('imunizacija');
			return $q->row_array();
		}
		public function vakcine() {
			$q = $this->db->get('vakcine');
			return $q->result_array();
		}
		public function snimi() {
			$data = array(
				'id_pacijenta' => $this->input->post('id_pacijenta'),
				'id_termina' => $this->input->post('id_termina'),
				'id_vakcine' => $this->input->post('id_vakcine'),
				'datum_vrijeme_prve_doze' => $this->input->post('datum_vrijeme_prve_doze'),
				'serija_prve_doze' => $this->input->post('serija_prve_doze'),
				'datum_vrijeme_druge_doze' => $this->input->post('datum_vrijeme_druge_doze'),
				'serija_druge_doze' => $this->input->post('serija_druge_doze'),
			);
			$this->db->insert('imunizacija', $data);
			$data_update = array(
				'status' => 'OK'
			);
			$this->db->where('id_termina', $this->input->post('id_termina'));
			return $this->db->update('zakazani_termini_vakcinacije', $data_update);
		}
		public function da_li_je_potvrda_validna($id) {
			$this->db->where('status', 'OK');
			$this->db->where('id_termina', $id);
			$q = $this->db->get('zakazani_termini_vakcinacije');
			if($q->num_rows()==1) {
				return true;
			} else {
				return false;
			}
		}
		public function podaci_za_potvrdu($id) {
			$this->db->where('zakazani_termini_vakcinacije.id_termina', $id);
			$this->db->join('pacijenti', 'zakazani_termini_vakcinacije.id_pacijenta = pacijenti.id_pacijenta', 'left');
			$this->db->join('imunizacija', 'zakazani_termini_vakcinacije.id_termina = imunizacija.id_termina', 'left');
			$this->db->join('vakcine', 'imunizacija.id_vakcine = vakcine.id_vakcine', 'left');
			$q = $this->db->get('zakazani_termini_vakcinacije');
			return $q->row_array();
		}
	}