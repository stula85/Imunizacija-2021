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

    class Vakcine extends MY_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('vakcina_model');
            $this->load->config('pagination');
        }
        public function index() {
            $this->pagination->initialize(array(
                'base_url' => site_url(array('vakcine')),
                'total_rows' => $this->vakcina_model->count_where('', '')
            ));

            $start = isset($_GET['start']) ? $_GET['start'] : 0;
            $data['pagination'] = $this->pagination->create_links();
            $fid = NULL;
            $data['podaci'] = $this->vakcina_model->spisak_vakcina($fid, $start, $this->config->item('per_page'));

            $data['title'] = "Шифрарник вакцина";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/vakcine/index', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function dodaj() {

            $this->form_validation->set_rules('naziv_vakcine', 'Назив вакцине', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Форма за унос нове вакцине";

                $this->load->view('templates/backend/inc/header');
                $this->load->view('templates/backend/vakcine/dodaj', $data);
                $this->load->view('templates/backend/inc/footer');
            } else {
                $this->vakcina_model->dodaj();
                $this->session->set_flashdata('uspjeh', 'Нови унос је успјешно сачуван.');
                redirect('vakcine');
            }
        }
        public function izmjeni($id_vakcine) {

            $data['vakcina'] = $this->vakcina_model->vakcina($id_vakcine);
            $data['title'] = "Форма за измјену података о вакцини";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/vakcine/izmjeni', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function edit() {
            
            $this->form_validation->set_rules('naziv_vakcine', 'Назив вакцине', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['vakcina'] = $this->vakcina_model->vakcina($this->input->post('id_vakcine'));
                $data['title'] = "Форма за измјену података о вакцини";

                $this->load->view('templates/backend/inc/header');
                $this->load->view('templates/backend/vakcine/izmjeni', $data);
                $this->load->view('templates/backend/inc/footer');
            } else {
                $this->vakcina_model->edit();
                $this->session->set_flashdata('uspjeh', 'Унос је успјешно сачуван.');
                redirect('vakcine');
            }
        }
        public function obrisi() {
            $this->vakcina_model->obrisi();
            $this->session->set_flashdata('uspjeh', 'Унос је успјешно избрисан.');
            echo json_encode([]);
        }
        public function pretraga_vakcine(){
            $data['podaci'] = $this->vakcina_model->pretraga_vakcine();

            $data['title'] = "Резултат претраге:";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/vakcine/pretraga', $data);
            $this->load->view('templates/backend/inc/footer');
        }
    }