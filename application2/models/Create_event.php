<?php
class Create_event extends CI_Model{
	
public function __construct(){
		$this->load->database();
}

function getCategory()
{
	$query = $this->db->get('category');
	return $query->result_array();
}

function saveprimary($data)
{
	$this->db->insert('events', $data);
	$insert_id = $this->db->insert_id();

	return $insert_id;
}

function saveprimaryupdate($id, $data){
	$this->db->where('events.id', $id);
	$this->db->update('events', $data);

	$updated = $this->db->affected_rows();
	return $updated;
}

function saveAssets($data)
{
	$this->db->insert('event_Assets', $data);
	$insert_id = $this->db->insert_id();

	return $insert_id;
}

function saveAssetsupdate($id, $data){
	$this->db->where('event_Assets.event_id', $id);
	$this->db->update('event_Assets', $data);
	$query = $this->db->affected_rows();

	return $query;
}

function countsaveticket($data){
	$this->db->where('event_tickets_types.event_id', $data);
	$this->db->select('event_tickets_types.id');
	$this->db->from('event_tickets_types');
	$query = $this->db->get();
	return $query->result_array();
	
}

function saveTickets($data)
{
	$this->db->insert('event_tickets_types', $data);
	$insert_id = $this->db->insert_id();

	return $insert_id;
}
 
function update_ticket_info($id, $data)
{
	$this->db->where('event_tickets_types.id', $id);
 	$this->db->update('event_tickets_types', $data);
 	$query = $this->db->affected_rows();

 	if ($query) {
 		$this->db->where('event_tickets_types.id', $id);
 		$this->db->select('event_id');
 		$this->db->from('event_tickets_types');
 		$event_type = $this->db->get();
 		$event_type_id = $event_type->row();

 		return get_object_vars($event_type_id);
 	}
}

function getEvent($data, $data2)
{
	if ($data2 == 1) {
		$this->db->select('users.id, users.user_role, events.id, events.account_id, events.ipay_commission, events.event_title, 
		events.event_venue, events.event_coodinates, events.event_status, events.event_date, events.event_created_by, 
		event_Assets.event_id, event_Assets.video, event_Assets.sponsor_logo, event_Assets.slider_image,
		event_Assets.cover_image, event_Assets.event_description');

	}	else {
		$this->db->where('events.account_id', $data);
		$this->db->select('users.id, users.user_role, events.id, events.account_id, events.ipay_commission, events.event_title, 
		events.event_venue, events.event_coodinates, events.event_status, events.event_date, events.event_created_by, 
		event_Assets.event_id, event_Assets.video, event_Assets.sponsor_logo, event_Assets.slider_image,
		event_Assets.cover_image, event_Assets.event_description');
	}
	
	$this->db->from('events');
	$this->db->join('event_Assets', 'event_Assets.event_id = events.id');
	$this->db->join('users', 'users.id = events.account_id');
	$query = $this->db->get();
	return $query->result_array();
}

function getEventType($id){
	$this->db->where('event_tickets_types.event_id', $id);
	$this->db->select('event_tickets_types.id, event_tickets_types.event_id, event_tickets_types.ticket_type, event_tickets_types.amount, event_tickets_types.total_tickets, event_tickets_types.available_tickets, event_tickets_types.ticket_close_on, event_tickets_types.created_at, ticket_types.typeid, ticket_types.type_name');
	$this->db->from('event_tickets_types');
	$this->db->join('ticket_types', 'ticket_types.typeid = event_tickets_types.ticket_type');
	$query = $this->db->get();
	
	return $query->result_array();

}

function getEventTypeById($id){
	$this->db->where('event_tickets_types.id', $id);
	$this->db->select('event_tickets_types.id, event_tickets_types.event_id, event_tickets_types.ticket_type, event_tickets_types.amount, event_tickets_types.total_tickets, event_tickets_types.available_tickets, event_tickets_types.ticket_close_on, event_tickets_types.created_at, ticket_types.typeid, ticket_types.type_name');
	$this->db->from('event_tickets_types');
	$this->db->join('ticket_types', 'ticket_types.typeid = event_tickets_types.ticket_type');
	$query = $this->db->get();

	return $query->row();
}

function get_ticket_types() {
	$query = $this->db->get('ticket_types');
	return $query->result_array();
}

function getEventById($data, $current_user)
{
	if ($this->session->userdata('role') == 1) {
		$this->db->where('events.id', $data);
	} else {
		$this->db->where('events.id', $data);
		$this->db->where('events.account_id', $current_user);
	}
	$this->db->select('users.user_name, users.id, events.id, events.account_id, events.ipay_commission, events.event_title, events.event_status,
		events.event_venue, events.event_coodinates, events.event_date, events.created_at, events.event_created_by, events.event_category_id, category.id, category.category_name,
		event_Assets.event_id, event_Assets.video, event_Assets.sponsor_logo, event_Assets.slider_image,
		event_Assets.cover_image, event_Assets.event_description');
	$this->db->from('events');
	$this->db->join('users', 'users.id = events.account_id');
	$this->db->join('event_Assets', 'event_Assets.event_id = events.id');
	$this->db->join('category', 'category.id = events.event_category_id');
	$query = $this->db->get();
	return $query->row();
}

function approveEvent($id){
	$data = array(
		"event_status" => 1
	);
	$this->db->where('events.id', $id);
	$this->db->update('events', $data);
	
	if ($this->db->affected_rows()) {
		return true;
	}
}

function deleteEvent($delid){
	$this->db->where('id', $delid);
	$this->db->delete('events');
	if ($this->db->affected_rows() > 0) {
		return true;
	}	else {
		return false;
	}
}

function pendingEvent(){
	$this->db->where('event_status', 0);
	$query = $this->db->get('events');

	return $query->result_array();
}

function getTicket_type($data){
	$this->db->where('events.id', $data);
	$this->db->select('events.id, event_tickets_types.id, event_tickets_types.event_id, event_tickets_types.ticket_type, event_tickets_types.amount, event_tickets_types.total_tickets, event_tickets_types.available_tickets, event_tickets_types.ticket_close_on');
	$this->db->from('events');
	$this->db->join('event_tickets_types', 'event_tickets_types.event_id = events.id');
	//$this->db->group_by('event_tickets_types.event_id');
	$query = $this->db->get();
	//return $query->row();
	return $query->result_array();
}

function getSoldTickets($data)
{
	$this->db->where($data);
	$this->db->select('number_of_tickets, ticket_amount, ticket_type, clientName, phone, email, order_id, 
		transaction_status');
	$query = $this->db->get('sell_ticket');
	return $query->result_array();
}

function saveRecon($data)
{
	$this->db->insert('event_recon', $data);
	$insert_id = $this->db->insert_id();

	return $insert_id;
}

function getBalance($acc_id)
{
	$this->db->where('id', $acc_id);
	$this->db->select('account_name, available_balance, account_ref');
	$query = $this->db->get('accounts');
	return $query->result_array();
}

function updateBalance($acc_id, $update_amount)
{
	$data = array('available_balance' => $update_amount);
	$this->db->where('id', $acc_id);
	$this->db->update('accounts', $data);
	$update = $this->db->affected_rows();

	return $update;
}

function updateRecon($reference, $recon_update)
{
	$this->db->where('reference', $reference);
	$this->db->update('event_recon', $recon_update);
	$update = $this->db->affected_rows();

	return $update;
}

function login($data)
{
	$this->db->where($data);
	$query = $this->db->get('users');
	return $query->result_array();
}

function createAccount($data)
{
	$create_acc = array('account_name' =>$data['username'],
                  		'account_ref' => $data['phone']);

	 $this->db->where('account_ref', $data['phone']);
	 $check_acc_exist = $this->db->get('accounts');
	 $check_acc_exist = $check_acc_exist->result_array();

	if ($check_acc_exist) {
		$account_exist = array('status' => 'account exist');
		return $account_exist;
	}

	//check phone and email exist
	 $this->db->where('user_phone', $data['phone']);
	 $this->db->or_where('user_email', $data['email']);
	 $check_user_exist = $this->db->get('users');
	 $check_user_exist = $check_user_exist->result_array();

	if ($check_user_exist) {
		$account_exist = array('status' => 'Phone or email exist');
		return $account_exist;
	}

	$this->db->insert('accounts', $create_acc);
	$insert_id = $this->db->insert_id();

	if ($insert_id > 0) {
		$create_user = array('account_id' 	=> $insert_id, 
							'user_name' 	=> $data['username'],
							'user_phone' 	=> $data['phone'], 
							'user_email' 	=> $data['email'],
							'user_password' => $data['password'], 
							'user_role' 	=> 3);

		return $this->createUser($create_user);
	}
}

function createUser($create_user)
{
	//check phone and email exist
	 $this->db->where('user_phone', $create_user['user_phone']);
	 $this->db->or_where('user_email', $create_user['user_email']);
	 $check_user_exist = $this->db->get('users');
	 $check_user_exist = $check_user_exist->result_array();

	if ($check_user_exist) {
		$account_exist = array('status' => 'Phone or email exist');
		return $account_exist;
	}

	//Performing insertion into users table
	$this->db->insert('users', $create_user);
	$insert_id = $this->db->insert_id();
	if ($insert_id > 0) {
		$account_created = array('status' => 'account created');
		return $account_created;
	}
}

function check_email($data)
{
	//check phone and email exist
	 $this->db->where($data);
	 $check_user_exist = $this->db->get('users');
	 return $check_user_exist->result_array();
}

function updatePassword($data, $email)
{
	$this->db->where('user_email', $email);
	$this->db->update('users', $data);
	$update = $this->db->affected_rows();

	return $update;
}
  
function ScanTicket($serial)
{
	//chech if scanned
	$this->db->where('serial_number', $serial);
	$this->db->where('transaction_status', 'SUCCESS');
	$this->db->or_where('transaction_status', 'OVERPAID');
	$this->db->select('number_of_tickets, used_status');
	$query = $this->db->get('sell_ticket');
	$query = $query->result_array();

	if (empty($query)) {
		return "invalid serial";
	}
	
	//used ticket
	if ($query[0]['used_status'] == $query[0]['number_of_tickets']) {
		return "ticket used";
	}

	//not used
	if ($query[0]['used_status'] < $query[0]['number_of_tickets']) {
		$scan_check = ($query[0]['used_status'] + 1);
		$data = array('used_status' => $scan_check);
		$this->db->where('serial_number', $serial);
		$this->db->update('sell_ticket', $data);
		$update = $this->db->affected_rows();

		return $update;
	}
}

}
?>
