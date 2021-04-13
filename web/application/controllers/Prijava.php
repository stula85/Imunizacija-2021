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

class Prijava extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prijava_model');
	}

	public function index()
	{
		if($this->session->userdata('admin_nivo') == "7") {
			redirect('panel');
		}
		$data['title'] = 'Пријава у систем';

		$this->form_validation->set_rules('korisnicko_ime', 'Korisničko ime', 'required');
		$this->form_validation->set_rules('lozinka', 'Lozinka', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->load->view('templates/backend/inc/header');
			$this->load->view('templates/backend/index', $data);
			$this->load->view('templates/backend/inc/footer');
		} else {
			$korisnicko_ime = $this->input->post('korisnicko_ime');
			$lozinka = $this->input->post('lozinka');

			// Pravim hash za lozinku
			$hash_pwd = md5($lozinka);
			$has_na_hash = 'Imuni34c1j@Pr0jekat';
			$moj_hash = md5($has_na_hash);
			$pwd_za_bazu = $hash_pwd . $moj_hash;

			$user_id = $this->prijava_model->prijava($korisnicko_ime, $pwd_za_bazu);

			if($user_id) {

				//NABAVI NIVO KORISNIKA
				$an = $this->prijava_model->admin_nivo($user_id);
				$admin_nivo = $an['admin_nivo'];
				$super_user = $an['super_user'];

				// Čuvam podatke u SESSION

				$user_data = array(
					'user_id' => $user_id,
					'korisnicko_ime' => $korisnicko_ime,
					'admin_nivo' => $admin_nivo,
					'super_user' => $super_user,
					'prijavljen' => true
				);

				$this->session->set_userdata($user_data);

				// Postavljam obavještenje za korisnika

				if(!$this->session->userdata('admin_nivo') == "7") {
					$this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
					redirect('prijava/index');
				} else {
					$this->session->set_flashdata('uspjeh', 'Пријава је успјешна!');

					redirect('panel/index/');
				}
			} else {
					// Postavljam obavještenje za korisnika
				$this->session->set_flashdata('greska', 'Погрешно корисничко име и/или лозинка. Молимо Вас да покушате поново.');

				redirect('prijava');
			}
		}
	}
}
