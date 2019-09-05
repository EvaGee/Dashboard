<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CallBack extends CI_Controller {

	/**
	 * @author [joshua kisee] <[<kiseej@gmail.com>]>
	 * @version 1.0.0
	 */
	
	public function __construct()
     {
          parent::__construct();
	     
     }

	public function b2c()
	{
		$merchant_reference = $_GET['merchant_reference'];
		$ipay_reference 	= $_GET['ipay_reference'];
		$status 			= $_GET['status'];
		$hash 				= $_GET['hash'];
		$mmref 				= $_GET['mmref'];

		//update db
		
	}
}