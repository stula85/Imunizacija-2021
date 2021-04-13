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

    class Panel extends CI_Controller {
    	public function __construct()
    	{
    		parent::__construct();
    	}

    	public function index(){
    		if(!$this->session->userdata('admin_nivo') == "7") {
    			$this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
    			redirect('prijava');
    		}
    		$data['title'] = 'Добро дошли';

    		$this->load->view('templates/backend/inc/header');
    		$this->load->view('templates/backend/panel', $data);
    		$this->load->view('templates/backend/inc/footer');
    	}
        
        public function odjava($id_korisnika = null) {
          if($id_korisnika != $this->session->userdata('user_id')) {
             show_404();
         }

         $this->session->unset_userdata('user_id');
         $this->session->unset_userdata('korisnicko_ime');
         $this->session->unset_userdata('admin_nivo');
         $this->session->unset_userdata('super_user');
         $this->session->unset_userdata('prijavljen');

			// Postavljam obavještenje za korisnika

         $this->session->set_flashdata('uspjeh', 'Успјешно сте се одјавили из система.');

         redirect('imunizacija');
     }
 }