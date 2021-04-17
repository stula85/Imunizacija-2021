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

    class Korisnik_model extends CI_Model {
    	public function __construct() {
    		$this->load->database();
    	}
        public function spisak_korisnika($id = NULL, $limit, $offset) {
            $this->db->order_by('id_korisnika', 'DESC');
            $this->db->limit($offset, $limit);
            $query = $this->db->get('korisnici');
            return $query->result_array();
        }
        public function count_where($column = "", $value = "") {
            if(!empty($column) && !empty($where))
                $this->db->where($column, $value);

            $query=$this->db->get('korisnici');
            return $query->num_rows();
        }
        public function dodaj() {
            $lozinka = $this->input->post('lozinka');

            // Pravim hash za lozinku
            $hash_pwd = md5($lozinka);
            $has_na_hash = 'Imuni34c1j@Pr0jekat';
            $moj_hash = md5($has_na_hash);
            $pwd_za_bazu = $hash_pwd . $moj_hash;

            $data = array(
                'ime' => $this->input->post('ime'),
                'prezime' => $this->input->post('prezime'),
                'adresa' => $this->input->post('adresa'),
                'grad' => $this->input->post('grad'),
                'broj_telefona' => $this->input->post('broj_telefona'),
                'email' => $this->input->post('email'),
                'korisnicko_ime' => $this->input->post('korisnicko_ime'),
                'lozinka' => $pwd_za_bazu,
                'aktivan' => $this->input->post('aktivan'),
                'admin_nivo' => $this->input->post('admin_nivo'),
                'super_user' => $this->input->post('super_user')
            );
            return $this->db->insert('korisnici', $data);
        }
        public function korisnik($id_korisnika) {
            $this->db->where('id_korisnika', $id_korisnika);
            $q = $this->db->get('korisnici');
            return $q->row_array();
        }
        public function edit() {
            $lozinka = $this->input->post('lozinka');

            // Pravim hash za lozinku
            $hash_pwd = md5($lozinka);
            $has_na_hash = 'Imuni34c1j@Pr0jekat';
            $moj_hash = md5($has_na_hash);
            $pwd_za_bazu = $hash_pwd . $moj_hash;

            $data = array(
                'ime' => $this->input->post('ime'),
                'prezime' => $this->input->post('prezime'),
                'adresa' => $this->input->post('adresa'),
                'grad' => $this->input->post('grad'),
                'broj_telefona' => $this->input->post('broj_telefona'),
                'email' => $this->input->post('email'),
                'korisnicko_ime' => $this->input->post('korisnicko_ime'),
                'lozinka' => $pwd_za_bazu,
                'aktivan' => $this->input->post('aktivan'),
                'admin_nivo' => $this->input->post('admin_nivo'),
                'super_user' => $this->input->post('super_user')
            );
            $this->db->where('id_korisnika', $this->input->post('id_korisnika'));
            return $this->db->update('korisnici', $data);
        }
        public function pretraga_korisnika() {
            $this->db->like('ime', $this->input->post('pretraga'));
            $this->db->or_like('prezime', $this->input->post('pretraga'));
            $this->db->or_like('korisnicko_ime', $this->input->post('pretraga'));
            $this->db->or_like('email', $this->input->post('pretraga'));
            $q = $this->db->get('korisnici');
            return $q->result_array();
        }
        public function obrisi() {
            $this->db->where('id_korisnika', $this->input->post('id_korisnika'));
            return $this->db->delete('korisnici');
        }
    }