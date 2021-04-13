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

class Stranice extends CI_Controller {
	public function view($stranica) {
		if(!file_exists(APPPATH.'views/templates/frontend/stranice/'.$stranica.'.php')){
			show_404();
		}
		$this->load->view('templates/frontend/inc/header');
		$this->load->view('templates/frontend/stranice/'.$stranica);
		$this->load->view('templates/frontend/inc/footer');
	}
}