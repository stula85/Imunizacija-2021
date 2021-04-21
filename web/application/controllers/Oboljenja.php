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

    class Oboljenja extends MY_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('oboljenja_model');
            $this->load->config('pagination');
        }

        public function index() {
            $this->pagination->initialize(array(
                'base_url' => site_url(array('oboljenja')),
                'total_rows' => $this->oboljenja_model->count_where('', '')
            ));

            $start = isset($_GET['start']) ? $_GET['start'] : 0;
            $data['pagination'] = $this->pagination->create_links();
            $fid = NULL;
            $data['podaci'] = $this->oboljenja_model->spisak_oboljenja($fid, $start, $this->config->item('per_page'));

            $data['title'] = "Шифрарник обољења";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/oboljenja/index', $data);
            $this->load->view('templates/backend/inc/footer');
        }

        public function dodaj() {

        $this->form_validation->set_rules('oboljenje', 'Назив обољења', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Форма за унос новог обољења";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/oboljenja/dodaj', $data);
            $this->load->view('templates/backend/inc/footer');
        } else {
            $this->oboljenja_model->dodaj();
            $this->session->set_flashdata('uspjeh', 'Нови унос је успјешно сачуван.');
            redirect('oboljenja');
        }
    }
    public function izmjeni($id_oboljenja) {

        $data['oboljenje'] = $this->oboljenja_model->oboljenje($id_oboljenja);
        $data['title'] = "Форма за измјену података о обољењу";

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/oboljenja/izmjeni', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function edit() {
        
        $this->form_validation->set_rules('oboljenje', 'Назив обољења', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['oboljenje'] = $this->oboljenja_model->oboljenje($this->input->post('id_oboljenja'));
            $data['title'] = "Форма за измјену података о обољењу";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/oboljenja/izmjeni', $data);
            $this->load->view('templates/backend/inc/footer');
        } else {
            $this->oboljenja_model->edit();
            $this->session->set_flashdata('uspjeh', 'Унос је успјешно сачуван.');
            redirect('oboljenja');
        }
    }
    public function pretraga_oboljenja(){
        $data['podaci'] = $this->oboljenja_model->pretraga_oboljenja();

        $data['title'] = "Резултат претраге:";

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/oboljenja/pretraga', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function obrisi() {
        $this->oboljenja_model->obrisi();
        $this->session->set_flashdata('uspjeh', 'Унос је успјешно избрисан.');
        echo json_encode([]);
    }
}