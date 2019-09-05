<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * @author [joshua kisee] <[<kiseej@gmail.com>]>
	 * @version 1.0.0
	 */
	
	public function __construct()
	 {
	      parent::__construct();
	      if(empty($this->session->userdata('phone'))){
			   $this->session->set_flashdata('false', 'Please login to continue.');
	           $this->logout();
	           return; 
	     }

	 }

	public function index()
	{	
		//load categories
		$get_cat = array(
			'category' => $this->Create_event->getCategory(),
			'ticket_type' => $this->Create_event->get_ticket_types(),
		);

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Create Event";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/create_event', $get_cat);
		$this->load->view('global/footer');
	}

	/*public function sendEmail($emailfrom, $eventid){
		$this->email->initialize($this->config->item('email_conf'));
		$this->email->set_newline("\r\n");

		//$this->email->from('jo@gmail.com', 'Josh');
		$this->email->from($emailfrom);
		$this->email->to('joansha988@gmail.com');

		$this->email->subject('New Event Notifacation');
		$this->email->message('A new Event created. View Event '.base_url().'index.php/Welcome/singleEvent/'.$eventid);
		$this->email->send();

		return true;
	}*/

	public function createEvent()
	{
		
		if ($_POST) {
			//validate image size
			
			// $file_sponsor = $this->validateImgSize('file_sponsor');
			// if ($file_sponsor == 0) {/*error occured*/
			// 	$this->session->set_flashdata('false', 'Invalid sponsor logo ensure width : 500px and Height 80px');        	
			// 	redirect('', 'refresh');
			// 	return; //TODO return error and undo changes
			// }

			$primary_data = array('event_title' => $_POST['title'],
								  'event_venue' => $_POST['venue'],
								  'event_coodinates' => $_POST['location'],
								  'event_date' => $_POST['date'],
								  'event_free' => 1, 
								  'event_category_id' => $_POST['category'],
								  'account_id' => $this->session->userdata('account_id'),
                                  'end_date' => $_POST['end_date'],
								  'event_created_by' => $this->session->userdata('email')); /**TODO get from session**/

			/*save primary data*/
			$insert_event_id = $this->Create_event->saveprimary($primary_data);
						
			if ($insert_event_id <= 0) {/*error occured*/
				$this->session->set_flashdata('false', 'Error occured while creating event! please try again or contact customercare');        	
				redirect('', 'refresh');
				return; //TODO return error and undo changes
			}
		
			//event assets
			$sponsor = "";
			$file_name = 'file_sponsor';
			$file_sponsor = $this->uploadFiles($file_name);
			if ($file_sponsor) {
				$sponsor = base_url().'assets/uploads/'.$file_sponsor;
			}

			$slider = "";
			$file_name = 'slider_images';
			$file_slider = $this->uploadFiles($file_name);
			if ($file_slider) {
				$slider = base_url().'assets/uploads/'.$file_slider;
			}

			$banner = "";
			$file_name = 'banner_images';
			$file_banner = $this->uploadFiles($file_name);
			if ($file_banner) {
				$banner = base_url().'assets/uploads/'.$file_banner;
			}
			
			$event_Assets = array('event_id' => $insert_event_id,
			 					  'video' => $_POST['video_link'],
			 					  'sponsor_logo' => $sponsor,
			 					  'slider_image' => $slider,
			 					  'cover_image' => $banner,
			 					  'event_description' => $_POST['event_description'],
			 					  'snapshots' => null);

			/*save assets data*/
			$insert_assets = $this->Create_event->saveAssets($event_Assets);
			
			if ($insert_assets <= 0) {
				$this->session->set_flashdata('false', 'Error occured while uploading images! please try again or contact customercare');        	
				redirect('', 'refresh');
				return; //TODO return error and undo changes
			}

			//get tickets
			for ($i=1; $i <= $_POST['num_ticket_generated']; $i++) { 
				$explode = explode(",", $_POST[$i]);
				
				$event_tickets = array('event_id' => $insert_event_id, 
								   'ticket_type' => $explode[0],
								   'amount' => $explode[1],
								   'total_tickets' => $explode[2],
								   'available_tickets' => $explode[2],
								   'ticket_close_on' => $explode[3],);
				/*save tickets data*/
				$insert_assets = $this->Create_event->saveTickets($event_tickets);
			}

			$this->session->set_flashdata('success', 'Confirm & Submit your event. We will get in touch within 3 hours');        	
			//redirect('Welcome/event_preview/$insert_event_id', 'refresh');

			redirect(base_url('index.php/Welcome/event_preview/'.$insert_event_id));
		}
	}

	public function event_preview($event_id){
		$current_user = $this->session->userdata('account_id');
		$event_preview = array(
			'single_event' => $this->Create_event->getEventById($event_id, $current_user),
			'eventtype' => $this->Create_event->getEventType($event_id),
			'page' => 'Event Preview',
		);
		$title['title'] = "TICKETS4U :: TICKETS4U";
		$this->load->view('global/header', $title);
		$this->load->view('main/event_preview', $event_preview);
		$this->load->view('global/footer');
	}

	public function cancel_event($event_id){
		$canceled_event= $this->Create_event->deleteEvent($event_id);

		if ($canceled_event) {
			$this->session->set_flashdata('success', 'Event cancelled'); 		
			}	else 	{
				$this->session->set_flashdata('false', 'Event created, wait response');	
			}
			return redirect('', 'refresh');
	}

	public function update_event($id){
		if ($_POST) {

			$primary_data = array('event_title' => $_POST['title'],
								  'event_venue' => $_POST['venue'],
								  'event_coodinates' => $_POST['location'],
								  'event_date' => $_POST['date'],
								  'event_free' => 1, 
								  'event_category_id' => $_POST['category'],
								  'account_id' => $this->session->userdata('account_id'),
								  'event_created_by' => $this->session->userdata('email')); /**TODO get from session**/

			/*save primary data*/
			$updated_row = $this->Create_event->saveprimaryupdate($id, $primary_data);
		
			//event assets
			$sponsor = "";
			$file_name = 'file_sponsor';
			$file_sponsor = $this->uploadFiles($file_name);
			if ($file_sponsor) {
				$sponsor = base_url().'assets/uploads/'.$file_sponsor;
			} else {
				$sponsor = $_POST['file_sponsor_update'];
			}

			$slider = "";
			$file_name = 'slider_images';
			$file_slider = $this->uploadFiles($file_name);
			if ($file_slider) {
				$slider = base_url().'assets/uploads/'.$file_slider;
			} else {
				$slider = $_POST['slider_images_update'];
			}

			$banner = "";
			$file_name = 'banner_images';
			$file_banner = $this->uploadFiles($file_name);
			if ($file_banner) {
				$banner = base_url().'assets/uploads/'.$file_banner;
			} else {
				$banner = $_POST['banner_images_update'];
			}
			
			$event_Assets = array('video' => $_POST['video_link'],
			 					  'sponsor_logo' => $sponsor,
			 					  'slider_image' => $slider,
			 					  'cover_image' => $banner,
			 					  'event_description' => $_POST['event_description'],
			 					  'snapshots' => null);

			/*save assets data*/
			$update_assets = $this->Create_event->saveAssetsupdate($id, $event_Assets);

			if($updated_row > 0 || $update_assets > 0 || $update_assets >0 && $updated_row > 0){
				$this->session->set_flashdata('success', 'Successfully Updated');  
				} else{
					$this->session->set_flashdata('error', 'Nothing Updated');  
				}     	
			redirect('/my-event', 'refresh');
		}
	}	

	public function getEvents()
	{
		$event_data = $this->session->userdata('account_id');
		$user_role = $this->session->userdata('role');
		
		/*get balance*/
		$myEvents = array(
			'event' => $this->Create_event->getEvent($event_data, $user_role),
			'user_role' => $this->session->userdata('role'),
			'user_id' => $this->session->userdata('account_id'),
		); 
		
		// echo "<pre>";
		// print_r($myEvents);
		// return;

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "My Events";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/myevents', $myEvents);
		$this->load->view('global/footer');
	}

	public function singleEvent($id){
		$currentUser = $this->session->userdata('account_id');
		$eventdata = array(
			'single_event' => $this->Create_event->getEventById($id, $currentUser),
			'eventtype' => $this->Create_event->getEventType($id),
			'eventid' => $id,
		);

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Event";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('main/singleEvent', $eventdata);
		$this->load->view('global/footer');
	}

	public function edit_ticket_type($id){
		$tickets = array(
			'ticket' => $this->Create_event->getEventTypeById($id),
			'ticket_type' => $this->Create_event->get_ticket_types(),
		);

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Tickets";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('main/edit_ticket_type', $tickets);
		$this->load->view('global/footer');
	}

	public function getEventType($id){
		$event_type['type'] = $this->Create_event->getEventType($id);
	}

	public function updateTicketType($id){
		if ($_POST) {

			$ticket_type_info = array(
				'ticket_type' => $_POST['ticket_type'],
				'amount' => $_POST['amount_ticket'],
				'total_tickets' => $_POST['number_ticket'],
				'available_tickets' => $_POST['number_ticket'],
				'ticket_close_on' => $_POST['date_ticket'],
				'updated_at' => date('Y-m-d H:i:s')
			);

			$update_ticket = $this->Create_event->update_ticket_info($id, $ticket_type_info);

			if ($update_ticket) {
				$evnt_type_id = $update_ticket["event_id"];

				redirect(base_url().'index.php/Welcome/singleEvent/'.$evnt_type_id);
			}

			
		}
	}

	public function change_date($id){
		if ($_POST) {

			$ticket_type_info = array(
				'ticket_close_on' => $_POST['date_ticket'],
				'updated_at' => date('Y-m-d H:i:s')
			);

			$update_ticket = $this->Create_event->update_ticket_info($id, $ticket_type_info);

			if ($update_ticket) {
				$evnt_type_id = $update_ticket["event_id"];

				redirect(base_url().'index.php/Welcome/singleEvent/'.$evnt_type_id);
			}			
		}
	}

	public function edit_event($id){
		//Load specific event
		$current_user = $this->session->userdata('account_id');
		
		$get_event = array(
			'events' => $this->Create_event->getEventById($id, $current_user),
			'category' => $this->Create_event->getCategory(),
		);

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Edit Event";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/edit_event', $get_event);
		$this->load->view('global/footer');
	}

	public function deleteEvent($delid){
		$deletedEvent = $this->Create_event->deleteEvent($delid);
		if ($deletedEvent) {
			$this->session->set_flashdata('success', 'Event deleted Successfully');
		}	else {
			$this->session->set_flashdata('error', 'Deletion failed');
		}
		redirect('/my-event', 'refresh');
	}

	public function approveEvent($id){
		$approve = $this->Create_event->approveEvent($id);
		if ($approve) {
			$this->session->set_flashdata('success', 'Event updated Successfully');
		}	else {
			$this->session->set_flashdata('error', 'Did not update');
		}
		redirect('/my-event', 'refresh');
	}

	public function rejectEvent($id){
		$reject = $this->Create_event->rejectEvent($id);
		if ($reject) {
			$this->session->set_flashdata('success', 'Event Rejected');
		}	else {
			$this->session->set_flashdata('error', 'Did not update');
		}
		redirect('/my-event', 'refresh');
	}

	public function pending_events(){
		$pendingEvent['status'] = $this->Create_event->pendingEvent();

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Pending Events";

		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/pending_events', $pendingEvent);
		$this->load->view('global/footer');
	}

	public function approved_events(){
		$approved = array(
			'status' => $this->Create_event->approvedEvent(),
			'user_role' => $this->session->userdata('role'),
			'user_id' => $this->session->userdata('account_id'),
		);

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Approved Events";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/pending_events', $approved);
		$this->load->view('global/footer');
	}

	public function rejected_events(){
		$rejects['status'] = $this->Create_event->rejectedEvent();

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Rejected Events";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/pending_events', $rejects);
		$this->load->view('global/footer');
	}

	public function getSoldTickets()
	{
		$event_data = array('event_id' => $_GET['sold']);
		/*get balance*/
		$myTickets['tickets'] = $this->Create_event->getSoldTickets($event_data);

		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Sold Tickets";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/soldTickets', $myTickets);
		$this->load->view('global/footer');
	}

	private function uploadFiles($file_name)
	{
		$configUpload['upload_path']    = 'assets/uploads';                 #the folder placed in the root of project
	    $configUpload['allowed_types']  = 'jpg|png|jpeg';       #allowed types description
	    $configUpload['max_size']       = '0';                          #max size
	    $configUpload['max_width']      = '0';                          #max width
	    $configUpload['max_height']     = '0';                          #max height
	    $configUpload['encrypt_name']   = true;                         #encrypt name of the uploaded file
	    $this->load->library('upload', $configUpload);                  #init the upload class
	    if(!$this->upload->do_upload($file_name)) {
	        $uploadedDetails    = $this->upload->display_errors();
	        return false;
	    }else{
	        $uploadedDetails    = $this->upload->data('file_name'); 
	        return $uploadedDetails;   
	    }
	}

	public function validateImgSize($file_name)
	{

		// if($file_name == "file_sponsor")
		// {
		// 	$data = getimagesize($_FILES[$file_name]['tmp_name']);
		// 	$width = $data[0];
		// 	$height = $data[1];

		// 	if ($width < 500 || $width > 520 || $height < 80 || $height > 85) {
		// 		return false;
		// 	}

		// 	return true;
		// }

		if($file_name == "banner_images")
		{
			$data = getimagesize($_FILES[$file_name]['tmp_name']);
			$width = $data[0];
			$height = $data[1];

			if ($width < 65 || $width > 90000 || $height < 90 || $height >100000) {
				return false;
			}
			return true;
		}

		if($file_name == "slider_images")
		{
			$data = getimagesize($_FILES[$file_name]['tmp_name']);
			$width = $data[0];
			$height = $data[1];

			if ($width < 150 || $width > 16000 || $height < 50 || $height >60000) {
				return false;
			}
			return true;
		}
		
	}

	//get balance
	public function accountDetails()
	{
		$acc_id = $this->session->userdata('account_id');
		/*get balance*/
		$balance = $this->Create_event->getBalance($acc_id);

		return $balance;
	}

	public function balance()
	{
		$balance = $this->accountDetails();
		print_r('available balance: KES. '.$balance[0]['available_balance']);
	}

	public function paynow()
	{
		$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Send Money";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/paynow');
		$this->load->view('global/footer');
	}

	public function paynowb2c()
	{
		if ($_POST) {
			$vid 			= $this->config->item('vid');
			$reference 		= $this->generateOid();
			$phone 			= $_POST['phone'];
			$amount 		= $_POST['amount'];
			$channel 		= $_POST['wallet_category'];
			$hashkey  		= $this->config->item('hashkey');

			if($amount <= 0)
			{
				$this->session->set_flashdata('false', 'Invalid amount!');        	
				redirect(	base_url().'index.php/payment-option', 'refresh');
				return;
			}
			//check balance
			$balance = $this->accountDetails();
			if($amount > $balance[0]['available_balance'])
			{
				$this->session->set_flashdata('false', 'No enough amount to transact KES. '. $amount .' ! Available balance KES. '. $balance[0]['available_balance']);        	
				redirect(	base_url().'index.php/payment-option', 'refresh');
				return;
			}

			//check transaction fee
			if ($channel == 'mpesa' || $channel == 'airtelmoney') {
				$trans_amount = ($amount + 40);
				if($trans_amount > $balance[0]['available_balance'])
				{
					$this->session->set_flashdata('false', 'Transaction fee of KES. 40 is required to transact KES. '. $amount .' ! Available balance KES. '. $balance[0]['available_balance']. '. You can only send KES '. ($balance[0]['available_balance'] - 40));        	
					redirect(	base_url().'index.php/payment-option', 'refresh');
					return;
				}
			}

			$phone = $this->validatephone($phone);
			if($phone == "invalid phone number")
			{
				print_r($phone);
				return;
			}

			//hash
			$datastring = "amount=".$amount."&phone=".$phone."&reference=".$reference."&vid=".$vid;

        	$hashid = hash_hmac("sha256", $datastring, $hashkey);

        	//log data to db
			$save = array('amount' 	=> $amount,
							'reference' => $reference,
							'vid' 		=> $vid,
							'session_id' => $this->session->userdata('phone'),
							'status' 	=>'PENDING',
							'channel' 	=> $channel,
							'account_no' 	=> $phone); /*can be bank acc or phone number*/

			/*save data*/
			$insert_data = $this->Create_event->saveRecon($save);

			if ($insert_data < 1) {
				return;
			}

			//call ipay
			$data = array('vid' => $vid,
						'reference' => $reference,
						'phone' => $phone, 
						'amount' => $amount,
						'hash' => $hashid, );

			$url = "https://apis.ipayafrica.com/b2c/v3/mobile/".$channel;

			$b2c = $this->PostData($url, $data);
			/***********process results ********/
			if ($b2c->status == 200) {
				//update account balance
				$acc_id = $this->session->userdata('account_id');
				$update_amount = $amount;
				if ($channel == 'mpesa' || $channel == 'airtelmoney') {
					$update_amount = ($amount+40);
				}
				$curent_bal = $this->accountDetails();
				$update_amount = ($curent_bal[0]['available_balance'] - $update_amount); 
				$current_run_balance = $this->Create_event->updateBalance($acc_id, $update_amount);

				//update recon table
				$recon_update = array('status' => $b2c->text,
									'ipay_ref' => $b2c->reference);

				$recon = $this->Create_event->updateRecon($reference, $recon_update);

				$this->session->set_flashdata('success', 'Transaction queued for processing please wait.');        	
				redirect(	base_url().'index.php/payment-option', 'refresh');
				return;
			}
			if ($b2c->status == 400) {
				$this->session->set_flashdata('false', 'Error occured please contact Tickets4u support 0713129623 || info@tickets4u.co.ke');        	
				redirect(	base_url().'index.php/payment-option', 'refresh');
				return;
			}
		}
	}

	public function paynowb2b()
	{
		if ($_POST) {
			$vid 		= $this->config->item('vid'); 
			$hashkey 	= $this->config->item('hashkey');
			$reference 	= $this->generateOid();
			$account 	= $_POST['b2baccount']; 
			$amount 	= $_POST['b2bamount']; 
			$channel 	= $_POST['b2bcategory'];
			$narration 	= "NA"; 
			$curr 		= "KES";

			if($amount <= 0)
			{
				$this->session->set_flashdata('false', 'Invalid amount!');        	
				redirect(	base_url().'index.php/payment-option', 'refresh');
				return;
			}

			if ($channel == 'mpesapaybill') {
				$narration 	= $_POST['b2bnarration'];
			}
			
			//gen hash
			$datastring = "account=".$account."&amount=".$amount."&curr=".$curr."&narration=".$narration."&reference=".$reference."&vid=".$vid;
			$hashid = hash_hmac("sha256", $datastring, $hashkey);

			//log data to db
			$save = array('amount' 	=> $amount,
							'reference' => $reference,
							'vid' 		=> $vid,
							'session_id' => $this->session->userdata('phone'),
							'status' 	=>'PENDING',
							'channel' 	=> $channel,
							'account_no' 	=> $account."|".$narration); /*can be bank acc or phone number*/

			/*save data*/
			$insert_data = $this->Create_event->saveRecon($save);

			if ($insert_data < 1) {
				return;
			}


			$b2b_data = array('vid' => $vid, 
						'reference' => $reference,
						'account' => $account,
						'hash' => $hashid,
						'amount' => $amount,
						'narration' => $narration,
						'curr' => $curr);
			//external endpoint
			$base_url = "https://apis.ipayafrica.com/b2b/v1/external/send/$channel";

			//internal endpoint
			if ($channel == 'ipay') {
				$base_url = "https://apis.ipayafrica.com/b2b/v1/internal/send/$channel";
			}
			
			$b2b = $this->PostData($base_url, $b2b_data);
			print_r($b2b);
		}
	}

	private function generateOid()
    {
    	$oid = md5(date("Ymdhis"));
    	$oid = substr($oid, 0, 15);
    	return $oid;
    }

    private function validatephone($phone_number)
    {
    	//clean phone to buy
    	$phone_number = str_replace(' ', '', $phone_number); 
   		$phone_number = preg_replace('/[^0-9\-]/', '', $phone_number);
   		
   		//check if phone starts with 07
   		$error_string = false;
   		if(substr($phone_number, 0, 2) == "07"):
   			//check length of phone
   			( strlen($phone_number ) != 10) ? $error_string = 'invalid phone number' : '';
   			if ($error_string) :return $error_string; endif;
   			//add 254 to phone
	        $phone_number = "254".substr($phone_number, -9, 9);
	        return $phone_number;

	    endif;

	    ( strlen($phone_number ) != 12) ? $error_string = 'invalid phone number' : '';
		if ($error_string) :return $error_string; endif;
        return $phone_number;
    }

	//curl post
	private function PostData($url, $data)
	{
	  	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, 
		         http_build_query($data));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close ($ch);
		$server_output = json_decode($server_output);

		return $server_output;
	}

	public function logout() 
    {
		$data = ['id', 'account_id', 'name', 'phone', 'email', 'role'];
		$this->session->unset_userdata($data);

		redirect('login');
    }

    public function dashboard(){
    	$title['title'] = "TICKETS4U :: TICKETS4U";
		$page['page'] = "Manage Events";
		$this->load->view('global/header', $title);
		$this->load->view('global/top_nav');
		$this->load->view('global/sub_title', $page);
		$this->load->view('global/side_nav');
		$this->load->view('main/dashboard');
		$this->load->view('global/footer');
    }
}
