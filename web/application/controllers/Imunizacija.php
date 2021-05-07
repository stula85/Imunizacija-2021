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

class Imunizacija extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('imunizacija_model');
		$this->load->model('pacijent_model');
		$this->load->model('opstine_model');
		$this->load->model('vakcina_model');
	}

	public function index()
	{
		$this->load->view('templates/frontend/inc/header');
		$this->load->view('templates/frontend/index');
		$this->load->view('templates/frontend/inc/footer');
	}

	public function prijava() {
		$this->form_validation->set_rules('drzavljanstvo', 'Држављанство', 'required');
		$this->form_validation->set_rules('jmbg_pasos', 'ЈМБГ/Број пасоша', 'required');
		$this->form_validation->set_rules('ime', 'Име', 'required');
		$this->form_validation->set_rules('prezime', 'Презиме', 'required');
		$this->form_validation->set_rules('imejl', 'Адреса електронске поште', 'required');
		$this->form_validation->set_rules('brmob', 'Број мобилног телефона', 'required');
		$this->form_validation->set_rules('id_opstine', 'Одаберите локацију на којој желите да примите вакцину', 'required');
		$this->form_validation->set_rules('id_vakcine', 'Одаберите произвођача вакцине', 'required|greater_than[0]');
		$this->form_validation->set_rules('oboljenja', 'Да ли имате неко од специфичних обољења?', 'required');
		$this->form_validation->set_rules('pokretan', 'Да ли због здравствених проблема не можете да излазите из куће/стана?', 'required');
		$this->form_validation->set_rules('davalac_krvi', 'Да ли сте добровољни давалац крви?', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['opstine'] = $this->opstine_model->opstine();
			$data['oboljenja'] = $this->imunizacija_model->oboljenja();
			$data['vakcine'] = $this->vakcina_model->vakcine();

			$this->load->view('templates/frontend/inc/header');
			$this->load->view('templates/frontend/prijave/prijava', $data);
			$this->load->view('templates/frontend/inc/footer');
		} else {
			$id_pacijenta = $this->imunizacija_model->prijava();
			$this->posalji_obavjestenje($id_pacijenta);
			$this->session->set_flashdata('uspjeh', 'Захваљујемо Вам се на исказаном интересовању за процес имунизације. Потврду ћете ускоро добити на имејл. Уколико потврду нисте добили, провјерите Ваш SPAM или JUNK фолдер.');
			redirect('imunizacija','refresh');
		}

		
	}

	public function posalji_obavjestenje($id_pacijenta) {
		$pacijent = $this->pacijent_model->pacijent($id_pacijenta);

		$this->load->library('email');

		$config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
        $this->email->initialize($config);

		$od = "noreply@imunizacija2021.com";
		$posiljalac = "Имунизација 2021!";
		$tema = "Обавјештење о исказаном интересовању";
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
			'naziv_opstine' => $pacijent['naziv_opstine']
		);

		$body = $this->load->view('templates/email/obavjestenje.php',$data,TRUE);
    	$this->email->message($body);
		$this->email->send();
	}
	
	public function change_lang(){
		$lang = $this->input->get("lang");

		if(!empty($lang) && $lang != null)
			$this->session->set_userdata( array("lang" => $lang));
		else
			$this->session->set_userdata( array("lang" => "srpski"));

		$subLang = $this->input->get("sublang");

		if(!empty($subLang) && $subLang != null)
			$this->session->set_userdata( array("subLang" => $subLang));
		else
			$this->session->set_userdata( array("subLang" => "cir"));

		$url = base_url();

		if(null !== $this->input->server('HTTP_REFERER'))
			$url = $this->input->server('HTTP_REFERER');

		if(isset($_GET['url']) && $_GET['url'] == "index")
			$url = site_url('naslovna');

		redirect($url);
	}
}
