<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scanticket extends CI_Controller {

	/**
	 * @author [joshua kisee] <[<kiseej@gmail.com>]>
	 * @version 1.0.0
	 */
	
	public function __construct()
	{
	     parent::__construct();
	     
	}

	public function scanWeb()
	{
		if($_POST)
		{
			$serial = $_POST['serial'];
			$status = $this->scanTicket($serial);
			if ($status == "invalid serial") {
				$this->session->set_flashdata('false', 'Invalid serial');        	
				redirect('', 'refresh');
				return;
			}

			if ($status == "ticket used") {
				$this->session->set_flashdata('false', 'Ticket Used');        	
				redirect('', 'refresh');
				return;
			}
			
			$this->session->set_flashdata('success', 'Successfully Scanned ');        	
			redirect('', 'refresh');
			return;
		}

		redirect('', 'refresh');
		return;
	}

	//no views involved
	public function scanApp()
	{
		/*TODO create json*/
		return scanTicket($serial);
	}

	public function scanTicket($serial)
	{
		$scan = $this->Create_event->ScanTicket($serial);
		return $scan;
	}
}