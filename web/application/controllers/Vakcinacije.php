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

		class Vakcinacije extends MY_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->load->model('vakcinacija_model');
				$this->load->model('pacijent_model');
				$this->load->config('pagination');
			}
			public function index() {
				$this->pagination->initialize(array(
					'base_url' => site_url(array('vakcinacije')),
					'total_rows' => $this->vakcinacija_model->count_where('', '')
				));

				$start = isset($_GET['start']) ? $_GET['start'] : 0;
				$data['pagination'] = $this->pagination->create_links();
				$fid = NULL;
				$data['podaci'] = $this->vakcinacija_model->spisak_pacijenata($fid, $start, $this->config->item('per_page'));

				$data['title'] = "Списак заказаних пацијената";

				$this->load->view('templates/backend/inc/header');
				$this->load->view('templates/backend/pacijenti/vakcinacija', $data);
				$this->load->view('templates/backend/inc/footer');
			}
			public function pacijent($id) {
				$data['title'] = "Подаци о пацијенту:";
				$data['termin'] = $this->vakcinacija_model->termin($id);
				$data['podaci'] = $this->pacijent_model->pacijent($data['termin']['id_pacijenta']);
				$data['oboljenja'] = $this->pacijent_model->spisak_oboljenja($data['termin']['id_pacijenta']);
				$data['termini_vakcinacije'] = $this->pacijent_model->termini_vakcinacije($data['termin']['id_pacijenta']);
				$this->load->view('templates/backend/inc/header');
				$this->load->view('templates/backend/pacijenti/termin', $data);
				$this->load->view('templates/backend/inc/footer');
			}
			public function nova($id_termina) {
				$data['title'] = "Имунизација:";
				$data['pacijent'] = $this->vakcinacija_model->pacijent($id_termina);
				$data['podaci'] = $this->pacijent_model->pacijent($data['pacijent']['id_pacijenta']);
				$data['imunizacija'] = $this->vakcinacija_model->imunizacije($data['pacijent']['id_pacijenta']);
				$data['vakcine'] = $this->vakcinacija_model->vakcine();
				$data['termin'] = $id_termina;
				$this->load->view('templates/backend/inc/header');
				$this->load->view('templates/backend/pacijenti/nova_imunizacija', $data);
				$this->load->view('templates/backend/inc/footer');
			}
			public function snimi() {
				$this->form_validation->set_rules('id_vakcine', 'Вакцина', 'required|greater_than[0]');
				$this->form_validation->set_rules('serija_prve_doze', 'Назив серије', 'required');

				if ($this->form_validation->run() === FALSE) {
					$data['title'] = "Имунизација:";
					$id_termina = $this->input->post('id_termina');
					$data['pacijent'] = $this->vakcinacija_model->pacijent($id_termina);
					$data['podaci'] = $this->pacijent_model->pacijent($data['pacijent']['id_pacijenta']);
					$data['imunizacija'] = $this->vakcinacija_model->imunizacije($data['pacijent']['id_pacijenta']);
					$data['vakcine'] = $this->vakcinacija_model->vakcine();
					$data['termin'] = $id_termina;
					$this->load->view('templates/backend/inc/header');
					$this->load->view('templates/backend/pacijenti/nova_imunizacija', $data);
					$this->load->view('templates/backend/inc/footer');
				} else {
					$this->vakcinacija_model->snimi();
					$this->session->set_flashdata('uspjeh', 'Имунизација је успјешно спроведена. Потврда о успјешној имунизацији је креирана.');
					redirect('vakcinacije');
				}
			}
			public function potvrda($id) {
				$status = $this->vakcinacija_model->da_li_je_potvrda_validna($id);
				if($status) {
					$pacijent = $this->vakcinacija_model->podaci_za_potvrdu($id);

					/*
					** Pravimo QR Code na osnovu $id potvrde
					*/

					$this->load->library('ci_qr_code');
					$this->config->load('qr_code');

					$qr_code_config = array();
					$qr_code_config['cacheable'] = $this->config->item('cacheable');
					$qr_code_config['cachedir'] = $this->config->item('cachedir');
					$qr_code_config['imagedir'] = $this->config->item('imagedir');
					$qr_code_config['errorlog'] = $this->config->item('errorlog');
					$qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
					$qr_code_config['quality'] = $this->config->item('quality');
					$qr_code_config['size'] = $this->config->item('size');
					$qr_code_config['black'] = $this->config->item('black');
					$qr_code_config['white'] = $this->config->item('white');
					$this->ci_qr_code->initialize($qr_code_config);

					$image_name = $id . ".png";

        			// Podaci za QR Code
        			// Prvo šišam latinicu
					$tmp_ime_prezime = $pacijent['ime'] . " " . $pacijent['prezime'];
					$ime_prezime = clearUTF($tmp_ime_prezime);
					$codeContents = "Ime i Prezime: ";
					$codeContents .= "$ime_prezime";
					$codeContents .= "\n";
					$codeContents .= "Broj potvrde: ";
					$codeContents .= "$id";
					$codeContents .= "\n";
					$codeContents .= "Status: ";
					$codeContents .= $pacijent['status'];

					$params['data'] = $codeContents;
					$params['level'] = 'H';
					$params['size'] = 4;

					$params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
					$this->ci_qr_code->generate($params);
					
					/*KRAJ QR Code*/
					$this->load->library('pdf');
					$html = $this->load->view('templates/backend/pacijenti/potvrda', ['ime' => $pacijent["ime"], 'prezime' => $pacijent["prezime"], 'jmbg_pasos' => $pacijent["jmbg_pasos"], 'datum_vrijeme_prve_doze' => $pacijent['datum_vrijeme_prve_doze'], 'serija_prve_doze' => $pacijent['serija_prve_doze'],'datum_vrijeme_druge_doze' => $pacijent['datum_vrijeme_druge_doze'], 'serija_druge_doze' => $pacijent['serija_druge_doze'], 'naziv_vakcine' => $pacijent['naziv_vakcine'], 'id_termina' => $pacijent['id_termina']], true);
					$this->pdf->createPDF($html, 'mypdf', false);

				} else {
					$this->session->set_flashdata('greska', 'Дошло је до грешке. Потврда није пронађена.');
					redirect('vakcinacije');
				}
			}
		}