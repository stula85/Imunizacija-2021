<?php
class My_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
        if(!$this->session->userdata('admin_nivo') == "7") {
            $this->session->set_flashdata('greska', 'Ваше корисничко име нема администраторске привилегије за приступ систему.');
            redirect('prijava');
        }
    }
}
?>