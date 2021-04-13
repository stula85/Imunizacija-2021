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

    class Pacijent_model extends CI_Model {
    	public function __construct() {
    		$this->load->database();
    	}
    	public function spisak_pacijenata($id = NULL, $limit, $offset) {
    		$this->db->order_by('id_pacijenta', 'DESC');
    		$this->db->limit($offset, $limit);
    		$query = $this->db->get('pacijenti');
    		return $query->result_array();
    	}
    	public function pacijent($id_pacijenta) {
    		$this->db->join('opstine', 'opstine.id_opstine = pacijenti.id_opstine', 'left');
    		$this->db->where('id_pacijenta', $id_pacijenta);
    		$q = $this->db->get('pacijenti');
    		return $q->row_array();
    	}
        public function pacijent_termin($id_pacijenta) {
            $this->db->join('opstine', 'opstine.id_opstine = pacijenti.id_opstine', 'left');
            $this->db->join('zakazani_termini_vakcinacije', 'zakazani_termini_vakcinacije.id_pacijenta = pacijenti.id_pacijenta', 'left');
            $this->db->where('pacijenti.id_pacijenta', $id_pacijenta);
            $q = $this->db->get('pacijenti');
            return $q->row_array();
        }
        public function spisak_oboljenja($id_pacijenta) {
            $this->db->join('oboljenja', 'oboljenja.id_oboljenja = pacijeni_oboljenja.id_oboljenja', 'left');
            $this->db->where('id_pacijenta', $id_pacijenta);
            $q = $this->db->get('pacijeni_oboljenja');
            return $q->result_array();
        }
        public function termini_vakcinacije($id_pacijenta) {
            $this->db->where('id_pacijenta', $id_pacijenta);
            $q = $this->db->get('zakazani_termini_vakcinacije');
            return $q->result_array();
        }
        public function pretraga_pacijenata() {
            $this->db->like('ime', $this->input->post('pretraga'));
            $this->db->or_like('prezime', $this->input->post('pretraga'));
            $this->db->or_like('jmbg_pasos', $this->input->post('pretraga'));
            $q = $this->db->get('pacijenti');
            return $q->result_array();
        }
        public function zakazivanje() {
            $data = array(
                'id_pacijenta' => $this->input->post('id_pacijenta'),
                'datum_vrijeme' => $this->input->post('datum_vrijeme')
            );
            return $this->db->insert('zakazani_termini_vakcinacije', $data);
        }
        public function count_where($column = "", $value = "") {
            if(!empty($column) && !empty($where))
            $this->db->where($column, $value);

            $query=$this->db->get('pacijenti');
            return $query->num_rows();
        }
    }