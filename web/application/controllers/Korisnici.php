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

    class Korisnici extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('korisnik_model');
        }
        public function index() {
            if(!$this->session->userdata('admin_nivo') == "7") {
                $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
                redirect('prijava');
            }

            $config['per_page'] = 10;
            $config['base_url'] = site_url("korisnici");
            $config['total_rows'] = $this->korisnik_model->count_where('', '');
            $config['query_string_segment'] = 'start';
            $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_link'] = "Прва";
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_link'] = "Посљедња";
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_link'] = 'Сљедећа';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_link'] = 'Претходна';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item"><a class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['page_query_string'] = TRUE;
            $config['attributes'] = array('class' => 'page-link');
            $config['num_links'] = 9;

            $this->pagination->initialize($config);
            $start = isset($_GET['start']) ? $_GET['start'] : 0;
            $data['pagination'] = $this->pagination->create_links();
            $fid = NULL;
            $data['podaci'] = $this->korisnik_model->spisak_korisnika($fid, $start, 10);

            $data['title'] = "Шифрарник корисника";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/korisnici/index', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function dodaj() {
            if(!$this->session->userdata('admin_nivo') == "7") {
                $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
                redirect('prijava');
            }

            $this->form_validation->set_rules('ime', 'Име', 'required');
            $this->form_validation->set_rules('prezime', 'Презиме', 'required');
            $this->form_validation->set_rules('korisnicko_ime', 'Корисничко име', 'required');
            $this->form_validation->set_rules('lozinka', 'Лозинка', 'required');
            $this->form_validation->set_rules('broj_telefona', 'Број телефона', 'required');
            $this->form_validation->set_rules('email', 'Имејл', 'required|valid_email');

            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Форма за унос новог корисника";

                $this->load->view('templates/backend/inc/header');
                $this->load->view('templates/backend/korisnici/dodaj', $data);
                $this->load->view('templates/backend/inc/footer');
            } else {
                $this->korisnik_model->dodaj();
                $this->session->set_flashdata('uspjeh', 'Нови унос је успјешно сачуван.');
                redirect('korisnici');
            }
        }
        public function izmjeni($id_korisnika) {
            if(!$this->session->userdata('admin_nivo') == "7") {
                $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
                redirect('prijava');
            }

            $data['title'] = "Форма за измјену података о кориснику";
            $data['korisnik'] = $this->korisnik_model->korisnik($id_korisnika);

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/korisnici/izmjeni', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function edit() {
            if(!$this->session->userdata('admin_nivo') == "7") {
                $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
                redirect('prijava');
            }

            $this->form_validation->set_rules('ime', 'Име', 'required');
            $this->form_validation->set_rules('prezime', 'Презиме', 'required');
            $this->form_validation->set_rules('korisnicko_ime', 'Корисничко име', 'required');
            $this->form_validation->set_rules('lozinka', 'Лозинка', 'required');
            $this->form_validation->set_rules('broj_telefona', 'Број телефона', 'required');
            $this->form_validation->set_rules('email', 'Имејл', 'required|valid_email');

            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Форма за измјену података о кориснику";
                $data['korisnik'] = $this->korisnik_model->korisnik($this->input->post('id_korisnika'));

                $this->load->view('templates/backend/inc/header');
                $this->load->view('templates/backend/korisnici/izmjeni', $data);
                $this->load->view('templates/backend/inc/footer');
            } else {
                $this->korisnik_model->edit();
                $this->session->set_flashdata('uspjeh', 'Унос је успјешно сачуван.');
                redirect('korisnici');
            }
        }
        public function pretraga_korisnika() {
            if(!$this->session->userdata('admin_nivo') == "7") {
                $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
                redirect('prijava');
            }
            $data['podaci'] = $this->korisnik_model->pretraga_korisnika();

            $data['title'] = "Резултат претраге:";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/korisnici/pretraga', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function obrisi() {
            if(!$this->session->userdata('admin_nivo') == "7") {
                $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
                redirect('prijava');
            }
            $this->korisnik_model->obrisi();
            $this->session->set_flashdata('uspjeh', 'Унос је успјешно избрисан.');
            echo json_encode([]);
        }
        public function generisi_lozinku() {
            $velikaSlova = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $malaSlova = "abcdefghijklmnopqrstuvwxyz";
            $brojevi = "0123456789";
            $specijalniKarakteri = "!%*|";

            $genVelikaSlova = substr(str_shuffle($velikaSlova), 0,2);
            $genMalaSlova = substr(str_shuffle($malaSlova), 0,2);
            $genBrojevi = substr(str_shuffle($brojevi), 0,2);
            $genSpecijalniKarakteri = substr(str_shuffle($specijalniKarakteri), 0,2);

            $genVelikoSlovo = substr(str_shuffle($velikaSlova), 0,1);
            $genMaloSlovo = substr(str_shuffle($malaSlova), 0,1);
            $genBroj = substr(str_shuffle($brojevi), 0,1);

            $mix = $genVelikaSlova.$genMalaSlova.$genBrojevi.$genSpecijalniKarakteri;
            $tempLozinka = substr(str_shuffle($mix), 0,10);
            $novaLozinka = $genVelikoSlovo.$genMaloSlovo.$genBroj.$tempLozinka;
            echo json_encode($novaLozinka);
        }
    }