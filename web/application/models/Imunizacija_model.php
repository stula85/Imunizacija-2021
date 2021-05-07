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

class Imunizacija_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function oboljenja() {
		$q = $this->db->get('oboljenja');
		return $q->result_array();
	}
	public function prijava() {
		$data = array(
			'drzavljanstvo' => $this->input->post('drzavljanstvo'),
			'jmbg_pasos' => $this->input->post('jmbg_pasos'),
			'ime' => $this->input->post('ime'),
			'prezime' => $this->input->post('prezime'),
			'imejl' => $this->input->post('imejl'),
			'brmob' => $this->input->post('brmob'),
			'brfiks' => $this->input->post('brfiks'),
			'id_opstine' => $this->input->post('id_opstine'),
			'id_vakcine' => $this->input->post('id_vakcine'),
			'oboljenja' => $this->input->post('oboljenja'),
			'pokretan' => $this->input->post('pokretan'),
			'davalac_krvi' => $this->input->post('davalac_krvi')
		);
		if($this->input->post('spisak_oboljenja') != null) {
			$this->db->insert('pacijenti', $data);
			$id_pacijenta = $this->db->insert_id();
			foreach ($this->input->post('spisak_oboljenja') as $key => $oboljenje) {
				$spisak = array(
					'id_pacijenta' => $id_pacijenta,
					'id_oboljenja' => $oboljenje
				);
				$this->db->insert('pacijeni_oboljenja', $spisak);
			}
			return $id_pacijenta;
		} else {			
			$this->db->insert('pacijenti', $data);
			$id_pacijenta = $this->db->insert_id();
			return $id_pacijenta;
		}
	}
}