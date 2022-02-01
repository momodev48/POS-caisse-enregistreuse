<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(FCPATH.'application/modules/facebooklogin/vendor/autoload.php');
   
class Facebooklogin extends MX_Controller {
    public $fb;
     public $version='';
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
         $this->load->model(array(  
            'facebooklogin/facebooklogin_model', 
        ));
         $api_val = $this->facebooklogin_model->show_api();
         if(!empty($api_val)){
       $this->fb = new Facebook\Facebook([
          'app_id' => $api_val->app_id,
          'app_secret' => $api_val->app_secret,
          'default_graph_version' => 'v2.10',
          ]);
     }
     else{
      redirect(base_url(), 'refresh');
     }
         
    $this->version=1;
    }
    public function index($rurl=null)
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = ['public_profile','email']; // optional
        $loginUrl = $helper->getLoginUrl(base_url('facebooklogin/facebooklogin/callbackurl'), $permissions);
        if($rurl !=null){
          $this->session->set_userdata('rurl',$rurl);
        }
        else{
          $this->session->set_userdata('rurl',2);
        }
        redirect($loginUrl);
        
    }
    public function headcode(){
      $coa = $this->facebooklogin_model->headcode();
        if($coa->HeadCode!=NULL){
          $headcode=$coa->HeadCode+1;
        }
        else{
          $headcode="102030101";
        }
        return $headcode;
      }

    public function customerid(){
        $lastid=$this->db->select("*")->from('customer_info')->order_by('cuntomer_no','desc')->get()->row();
        $sl=$lastid->cuntomer_no;
        if(empty($sl)){
        $sl = "cus-0001"; 
        }
        else{
        $sl = $sl;  
        }
        $supno=explode('-',$sl);
        $nextno=$supno[1]+1;
        $si_length = strlen((int)$nextno); 
        
        $str = '0000';
        $cutstr = substr($str, $si_length); 
        $sino = $supno[0]."-".$cutstr.$nextno;
        return $sino;
    } 
    public function callbackurl()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exception\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exception\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        if (isset($accessToken)) {
          // Logged in!

          $_SESSION['facebook_access_token'] = (string) $accessToken;
          $this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
          $response = $this->fb->get('/me');
            $usernode = $response->getGraphUser()->asArray();

           
           $sino = $this->customerid();
            $indata['cuntomer_no']                = $sino;
                $indata['customer_name']          = $usernode['name'];
                $indata['customer_email']       = $usernode['id'].'@facebook.com';
                $indata['facebook_id']       = $usernode['id'];
				$indata['crdate']       = date('Y-m-d');
               // $indata['password']               = md5($this->input->post('u_pass', TRUE));
              $usercount=$this->db->select("*")->from('customer_info')->where('facebook_id',$usernode['id'])->get()->row();
               
              $rurl = $this->session->has_userdata('rurl')? $this->session->userdata('rurl') : NULL;
                if(!$usercount){
                  $insert_ID = $this->facebooklogin_model->insert_data('customer_info', $indata);
                  $c_acc= $sino.'-'.$usernode['name'];
                  $headcode = $this->headcode();
                  $this->accountinsert($headcode,$c_acc,$insert_ID);
                 $sessiondata = array(
                  'CusUserID' =>$insert_ID,
                  'cusfname' =>$usernode['name'],
                  'customerno' =>$sino,
                  'CustomerEmail' =>$usernode['id'].'@facebook.com'
                );
                 $pointdata = array(
                    'customerid' => $insert_ID,
                    'amount' => '0.00',
                    'points' => '10',
                 );
                 $query = $this->db->table_exists('tbl_customerpoint');
                  $count = count($query);
                  if($count ==1){
                $this->facebooklogin_model->insert_data('tbl_customerpoint', $pointdata);
                  }
               $this->session->set_userdata($sessiondata);
                 if($rurl == 1){
                  redirect('myprofile');
                }
                else{
                  redirect('checkout'); 
                }

                }
                else
                {
                   $sessiondata = array(
                  'CusUserID' =>$usercount->customer_id,
                  'cusfname' =>$usercount->customer_name,
                  'customerno' =>$usercount->cuntomer_no,
                  'CustomerEmail' =>$usercount->customer_email
                );
                   $this->session->set_userdata($sessiondata);
                   if($rurl == 1){
                  redirect('myprofile');
                }
                else{
                  redirect('checkout'); 
                }

                }
        }
    }

    public function accountinsert($headcode,$c_acc,$insert_ID){

                     
             
             $createdate=date('Y-m-d H:i:s');
              $postData1 = array(
               'HeadCode'         => $headcode,
               'HeadName'         => $c_acc,
               'PHeadName'        => 'Customer Receivable',
               'HeadLevel'        => '4',
               'IsActive'         => '1',
               'IsTransaction'    => '1',
               'IsGL'             => '0',
               'HeadType'         => 'A',
               'IsBudget'         => '0',
               'IsDepreciation'   => '0',
               'DepreciationRate' => '0',
               'CreateBy'         => $insert_ID,
               'CreateDate'       => $createdate,
            );
            $this->facebooklogin_model->insert_data('acc_coa', $postData1);
              $this->session->set_flashdata('message', display('save_successfully'));

              
    }



    
}