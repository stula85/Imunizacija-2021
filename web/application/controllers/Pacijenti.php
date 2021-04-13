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

    class Pacijenti extends CI_Controller {
       public function __construct()
       {
          parent::__construct();
          $this->load->model('pacijent_model');
          $this->load->model('opstine_model');
      }
      public function index() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $config['per_page'] = 10;
        $config['base_url'] = site_url("pacijenti");
        $config['total_rows'] = $this->pacijent_model->count_where('', '');
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
        $data['podaci'] = $this->pacijent_model->spisak_pacijenata($fid, $start, 10);
        $data['opstine'] = $this->opstine_model->opstine();

        $data['title'] = "Списак пацијената";

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/pacijenti/index', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function pretraga_pacijenata(){
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $data['title'] = "Резултат претраге:";
        $data['podaci'] = $this->pacijent_model->pretraga_pacijenata();

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/pacijenti/pretraga', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function filter_opstina() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $data['title'] = "Резултат претраге:";
        $data['podaci'] = $this->opstine_model->filter_opstine();

        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/pacijenti/pretraga', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function pacijent($id_pacijenta) {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }
        $data['title'] = "Подаци о пацијенту:";
        $data['podaci'] = $this->pacijent_model->pacijent($id_pacijenta);
        $data['oboljenja'] = $this->pacijent_model->spisak_oboljenja($id_pacijenta);
        $data['termini_vakcinacije'] = $this->pacijent_model->termini_vakcinacije($id_pacijenta);
        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/pacijenti/pacijent', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function pozovi($id_pacijenta) {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $data['title'] = "Форма за заказивање термина имунизације:";
        $data['podaci'] = $this->pacijent_model->pacijent($id_pacijenta);
        $this->load->view('templates/backend/inc/header');
        $this->load->view('templates/backend/pacijenti/zakazivanje', $data);
        $this->load->view('templates/backend/inc/footer');
    }
    public function zakazi_termin() {
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }

        $this->form_validation->set_rules('datum_vrijeme', 'Датум и вријеме', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Форма за заказивање термина имунизације:";
            $data['podaci'] = $this->pacijent_model->pacijent($this->input->post('id_pacijenta'));
            $this->load->view('templates/backend/inc/header');
            $this->load->view('templates/backend/pacijenti/zakazivanje', $data);
            $this->load->view('templates/backend/inc/footer');
        } else {
            $id_pacijenta = $this->input->post('id_pacijenta');
            $this->pacijent_model->zakazivanje();
            $this->posalji_obavjestenje($id_pacijenta);
            $this->session->set_flashdata('uspjeh', 'Термин имунизације је успјешно заказан. Обавјештење је послано пацијенту на имејл.');
            redirect('pacijenti','refresh');
        }
    }

    public function posalji_obavjestenje($id_pacijenta) {
        $pacijent = $this->pacijent_model->pacijent_termin($id_pacijenta);

        $this->load->library('email');

        $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
        $this->email->initialize($config);

        $od = "noreply@imunizacija2021.com";
        $posiljalac = "Имунизација 2021!";
        $tema = "Обавјештење о датуму и времену вакцинације";
        $this->email->from($od, $posiljalac);
        $this->email->to($pacijent['imejl']);
        $this->email->subject($tema);

        
        $data = array(
            'jmbg_pasos' => $pacijent['jmbg_pasos'],
            'ime' => $pacijent['ime'],
            'prezime' => $pacijent['prezime'],
            'imejl' => $pacijent['imejl'],
            'brmob' => $pacijent['brmob'],
            'brfiks' => $pacijent['brfiks'],
            'naziv_opstine' => $pacijent['naziv_opstine'],
            'broj_prijave' => $pacijent['id_termina'],
            'datum_vrijeme' => $pacijent['datum_vrijeme']
        );

        $body = $this->load->view('templates/email/obavjestenje_termin.php',$data,TRUE);
        $this->email->message($body);
        $this->email->send();
    }
}