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
}