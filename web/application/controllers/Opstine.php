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

    class Opstine extends CI_Controller {
        public function __construct()
        {
          parent::__construct();
          $this->load->model('opstine_model');
          $this->load->config('pagination');
      }
      public function index() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $this->pagination->initialize(array(
          'base_url' => site_url(array('opstine')),
          'total_rows' => $this->opstine_model->count_where('', '')
        ));
        $start = isset($_GET['start']) ? $_GET['start'] : 0;
        $data['pagination'] = $this->pagination->create_links();
        $fid = NULL;
        $data['podaci'] = $this->opstine_model->spisak_opstina($fid, $start, $this->config->item('per_page'));

        $data['title'] = "Списак општина и градова";

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/opstine/index', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function dodaj() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $this->form_validation->set_rules('naziv_opstine', 'Назив општине / града', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Форма за унос нове општине или града";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/opstine/dodaj', $data);
            $this->load->view('templates/backend/inc/footer');
        } else {
            $this->opstine_model->dodaj();
            $this->session->set_flashdata('uspjeh', 'Нови унос је успјешно сачуван.');
            redirect('opstine');
        }
    }
    public function izmjeni($id_opstine) {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $data['opstina'] = $this->opstine_model->opstina($id_opstine);
        $data['title'] = "Форма за измјену података општине или града";

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/opstine/izmjeni', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function edit() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }
        
        $this->form_validation->set_rules('naziv_opstine', 'Назив општине / града', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['opstina'] = $this->opstine_model->opstina($this->input->post('id_opstine'));
            $data['title'] = "Форма за измјену података општине или града";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/opstine/izmjeni', $data);
            $this->load->view('templates/backend/inc/footer');
        } else {
            $this->opstine_model->edit();
            $this->session->set_flashdata('uspjeh', 'Унос је успјешно сачуван.');
            redirect('opstine');
        }
    }
    public function pretraga_opstine(){
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }
        $data['podaci'] = $this->opstine_model->pretraga_opstine();

        $data['title'] = "Резултат претраге:";

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/opstine/pretraga', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function obrisi() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }
        $this->opstine_model->obrisi();
        $this->session->set_flashdata('uspjeh', 'Унос је успјешно избрисан.');
        echo json_encode([]);
    }
}