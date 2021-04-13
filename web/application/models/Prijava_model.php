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

class Prijava_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function prijava($korisnicko_ime, $pwd_za_bazu) {
		$this->db->where('korisnicko_ime', $korisnicko_ime);
		$this->db->where('lozinka', $pwd_za_bazu);
		
		$result = $this->db->get('korisnici');
		
		if($result->num_rows() == 1) {
			return $result->row(0)->id_korisnika;
		} else {
			return false;
		}
	}
	
	public function admin_nivo($user_id) {
		$q = $this->db->get_where('korisnici', array('id_korisnika' => $user_id));
		return $q->row_array();
	}
}