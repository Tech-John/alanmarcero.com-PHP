<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

    /**
     * [index description]
     * @return [type] [description]
     */
	public function index()
	{
		$this->load->view('header');
        $this->load->view('footer');
	}
}
