<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {
  public function __construct()
     {
          parent::__construct();
          
     }

    public function index()
    {

      $data = ['id', 'account_id', 'name', 'phone', 'email', 'role'];
      $this->session->unset_userdata($data);


      if ($_POST) {
        //get the data from fields
          $login_data = array('user_phone' => $this->input->post('login_username'),
                              'user_password' => md5($this->input->post('login_password')));

        //load model
        $login_check = $this->Create_event->login($login_data);

        if ($login_check) {

          $s_data = array('id'  => $login_check[0]['id'],
                          'account_id'    => $login_check[0]['account_id'],
                          'name' => $login_check[0]['user_name'],
                          'phone' => $login_check[0]['user_phone'],
                          'email' => $login_check[0]['user_email'],
                          'role' => $login_check[0]['user_role']);

          //add to session
          $this->session->set_userdata($s_data);
          redirect(base_url().'index.php');
          return;
        }
        $this->session->set_flashdata('false', 'Invalid credentials');          
        redirect(base_url().'index.php/login', 'refresh');
        return;
      }
        $data['title'] = "Tickets4U::Tickets4U";
        $this->load->view('global/header',$data);
        $this->load->view('login/login');
    }


    public function signup()
    {

      //create accounts
      $save_data= array('username'  => $this->input->post('username'),
                        'email'     => $this->input->post('email'),
                        'phone'     => $this->input->post('phone'),
                        'password'  => md5($this->input->post('password')));

        //load model
        $signup = $this->Create_event->createAccount($save_data);

        if ($signup['status'] == 'account exist') {
          $this->session->set_flashdata('false', 'Account Exist');          
          redirect(base_url().'index.php/login', 'refresh');
          return;
        }

        if ($signup['status'] == 'Phone or email exist') {
          $this->session->set_flashdata('false', 'Phone or email exist');          
          redirect(base_url().'index.php/login', 'refresh');
          return;
        }

        if ($signup['status'] == 'account created') {
          $this->session->set_flashdata('success', 'Account Created');          
          redirect(base_url().'index.php/login', 'refresh');
          return;
        }
        
    }

    public function send_recover_email()
    {
       //check if email exist
       $email = $this->input->post('Email', TRUE);
       //invoke model to confirm email
      $email_data = array('user_email' => $email);

     //load model
      $email_check = $this->Create_event->check_email($email_data);

       if(empty($email_check))
       { 
       $this->session->set_flashdata('false', 'Email does not exist');          
        redirect(base_url().'index.php/login', 'refresh');
        return;
       }
        
        $this->load->helper("php_aes_cipher_helper");
        $iv = $this->config->item('iv'); 
        $key = $this->config->item('encrytkey'); 
        $data = $email;
        $encrypt = encrypt($key, $iv, $data);
        $encrypted = base64_encode($encrypt);
        
         $dataEmail['data_email'] = $encrypted;
        
        //send email       
         $from_email = "info@ticket4u.co.ke"; 
         $to_email = $email; 
   
         //Load email library 
         $this->load->library('email'); 

         $this->email->from($from_email, 'tickets4u'); 
         $this->email->to($to_email);
         $this->email->subject('Recover Password'); 
         $this->email->message($this->load->view('login/recover_password_temp', $dataEmail, TRUE)); 
         $this->email->set_mailtype("html");
   
         //Send mail 
         $this->email->send();

          $this->session->set_flashdata('success', 'Check your email to reset your password');          
          redirect(base_url().'index.php/login', 'refresh');
          return;
    }

    public function recover()
    {
      if ($_POST) {
        $password_update = array('user_password' => md5($this->input->post('new_password')));
        $email_data = $this->session->userdata('email');
        //load model
        $update = $this->Create_event->updatePassword($password_update, $email_data);

        if ($update > 0) {
          $this->session->set_flashdata('success', 'Password reset successfully');          
          redirect(base_url().'index.php/login', 'refresh');
          return;
        }
        
        $this->session->set_flashdata('false', 'Error resetting password!');          
        redirect(base_url().'index.php/login', 'refresh');
        return;

      }
        
        $this->load->helper("php_aes_cipher_helper");
        $iv = 'fedcba9876543210'; #Same as in JAVA
        $key = '0123456789abcdef'; #Same as in JAVA
        $data = $_GET['i'];
        $encrypted = base64_decode($data);
        $decryptedPayload = decrypt($key, $encrypted);

        $email_data = array('user_email' => $decryptedPayload);
      
      //load model
      $email_check = $this->Create_event->check_email($email_data);

       if(empty($email_check))
       { 
        $this->session->set_flashdata('false', 'Invalid request');          
        redirect(base_url().'index.php/login', 'refresh');
        return;
       }

         //add to session
        $s_data = array('email'  => $decryptedPayload);
        $this->session->set_userdata($s_data);

        $data_view['title'] = "Tickets4U::Tickets4U";
        $this->load->view('global/header',$data_view);
        $this->load->view('login/recover_password');
    }

/********************************************************************/
   

    
    public function set_new_password()
    {
     //check if session has value
     $session_id = $this->session->userdata('user_email');
    
         if($session_id == "")
          {
           //obtain email from url
 //$url_email = $this->uri->segment('2');
            //  $url_email = $_GET['i'];

$this->load->helper('url');

$url_email = $this->input->get();

print_r($url_email);

           //decrypt email
             $cryptKey  = 'smartevent@Ipay'.date("Y/m/d");
             $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode($url_email), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
   
            
              $email = $qDecoded;
              $password = $this->input->post('new_password', TRUE);

              $email_data = array('user_email' => $email, 
                                  'password' => $password);

           print_r($email_data);

          }
          else{
             $email = $session_id;
              $password = $this->input->post('Email', TRUE);
          }
      
    }

 


    public function subaccount()
    {
  $session_id = $this->session->userdata('user_email');
  //auto generate password
   $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $alpha_length = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) 
    {
        $n = rand(0, $alpha_length);
        $password[] = $alphabet[$n];
    }
    implode($password);

        //get the checked role
        $all = $this->input->post('all');
          $scan = $this->input->post('scan');
              $create_event = $this->input->post('create_event');
        
         if(isset($_POST['all'])){$role = "3";}
         if(isset($_POST['scan']) && isset($_POST['create_event'])){$role = "3";}
         elseif(isset($_POST['scan'])){$role = "1";}
         elseif(isset($_POST['create_event'])){$role = "2";}
         
   
        

        //get the data from fields
          $save_data= array('user_name' => $this->input->post('name'),
                                  'user_email' => $this->input->post('email'),
                                  'user_phone' => $this->input->post('phone'),
                                              'user_role' => $role,
                                              'created_by' => $session_id,
                                  'user_password' => implode($password));


          $this->load->library('user_agent');

          //load model
        $signup_check = $this->Signup_model->subaccount($save_data);
           
           if($signup_check=== True)
           {redirect($this->agent->referrer()); }
           else{ redirect($this->agent->referrer()); }
        
    }

  public function system_users()
    {
      $user_data = $this->session->userdata('user_email');
 //get the data from fields
          //$user_data= array('created_by' => $session_id);

          //load model
        $data['users'] = $this->Signup_model->users($user_data);

        
        
                $this->load->view('templates/header');
        $this->load->view('templates/navigation');
        $this->load->view('myusers', $data);
        //$this->load->view('templates/footer');
        
    }
}