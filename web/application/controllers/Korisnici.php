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

    class Korisnici extends MY_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('korisnik_model');
            $this->load->config('pagination');
        }
        public function index() {
            $this->pagination->initialize(array(
                'base_url' => site_url(array('korisnici')),
                'total_rows' => $this->korisnik_model->count_where('', '')
            ));

            $start = isset($_GET['start']) ? $_GET['start'] : 0;
            $data['pagination'] = $this->pagination->create_links();
            $fid = NULL;
            $data['podaci'] = $this->korisnik_model->spisak_korisnika($fid, $start, $this->config->item('per_page'));

            $data['title'] = "Шифрарник корисника";

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/korisnici/index', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function dodaj() {
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
            $data = array(
                'title' => "Форма за измјену података о кориснику",
                'korisnik' => $this->korisnik_model->korisnik($id_korisnika)
            );

            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/korisnici/izmjeni', $data);
            $this->load->view('templates/backend/inc/footer');
        }
        public function edit() {
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