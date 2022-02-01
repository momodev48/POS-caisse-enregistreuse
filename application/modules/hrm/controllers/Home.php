 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->model(array(
            'Csv_model'
        )); 
         $this->load->library('excel');      
    }


    function index() {
        $data['title']            = display('attendance_list');  ;
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['dropdownatn']      =$this->Csv_model->Employeename();
        $data['module']           = "hrm";
        $data['page']             = "atnview";   
        echo Modules::run('template/layout', $data); 
    }


    function manageatn() {
        $data['title']            = display('attendance_list'); 
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['module']           = "hrm";
        $data['page']             = "manage_attendance";   
        echo Modules::run('template/layout', $data); 
    }
    function importcsv() {
         
           if(isset($_FILES["userfile"]["name"])){
           $_FILES["userfile"]["name"];
            $path = $_FILES["userfile"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
           
            foreach($object->getWorksheetIterator() as $sale)
            {
                
                $highestRow = $sale->getHighestRow();
                $highestColumn = $sale->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {
                $employee_id = $sale->getCellByColumnAndRow(0, $row)->getValue();  
                $date = $sale->getCellByColumnAndRow(1, $row)->getValue();
                $in = $sale->getCellByColumnAndRow(2, $row)->getValue();
                $out = $sale->getCellByColumnAndRow(3, $row)->getValue();
				$tsayed = $sale->getCellByColumnAndRow(4, $row)->getValue();

                $attdate = date('Y-m-d', strtotime($date));
                $in_time = date('H:i:s ', strtotime($in));
                $out_time = date('H:i:s', strtotime($out));
				$staytime = date('H:i:s', strtotime($staytime));
               
              	$insert_data = array(
                       'employee_id'=>$employee_id,
                       'date'      =>$attdate,
                       'sign_in'   => $in_time,
                       'sign_out'  =>$out_time,
                       'staytime'  =>$staytime,
                   );
				  print_r($insert_data);
                   $this->Csv_model->insert_csv($insert_data);
   
		}
}
          
    $this->session->set_flashdata('message', display('successfully_uploaded'));
            redirect('hrm/Home/index');}
    } 
   
    public function create_atten()
    { 
        $data['title'] = display('employee');
  
        #-------------------------------#
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
         $timezone = $this->db->select('timezone')->from('setting')->get()->row();
   date_default_timezone_set($timezone->timezone);
        $date=date('Y-m-d');

        $signin=date("h:i:s a", time());
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $postData = [
                'employee_id'    => $this->input->post('employee_id',true),
                'date'           => $date,
                'sign_in'        => $signin,
                
            ];   

            if ($this->Csv_model->atten_create($postData)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }

            echo '<script>window.location.href = "'.base_url().'hrm/Home/index"</script>';


        } else {
            $data['title']  = display('create');
            $data['module'] = "hrm";
            $data['page']   = "attendance_form";
            $data['dropdownatn'] =$this->Csv_model->Employeename();
            echo Modules::run('template/layout', $data);   
            
        }   
    }



    public function delete_atn($id = null) 
    { 
        $this->permission->method('hrm','delete')->redirect();

        if ($this->Csv_model->delete_attn($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }


        echo '<script>window.location.href = "'.base_url().'hrm/Home/manageatn"</script>';
    }

    public function update_atn_form($id = null){
        $this->permission->method('hrm','delete')->redirect();
        $this->form_validation->set_rules('att_id',null,'required|max_length[11]');
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
        $this->form_validation->set_rules('date',display('date')  ,'required');
        $this->form_validation->set_rules('sign_in',display('sign_in')  ,'required');
        $this->form_validation->set_rules('sign_out',display('sign_out'));
        $this->form_validation->set_rules('staytime',display('staytime'));



        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $postData = [
                'att_id'               => $this->input->post('att_id',true),
                'employee_id'              => $this->input->post('employee_id',true),
                'date'                 => $this->input->post('date',true),
                'sign_in'              => $this->input->post('sign_in',true),
                'sign_out'             => $this->input->post('sign_out',true),
                'staytime'             => $this->input->post('staytime',true),
                
            ]; 
            
            if ($this->Csv_model->update_attn($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            echo '<script>window.location.href = "'.base_url().'hrm/Home/index"</script>';

        } else {
         $data['data']=$this->Csv_model->attn_updateForm($id);
         $data['module']      = "hrm";
         $data['dropdownatn'] =$this->Csv_model->Employeename();
         $data['query']       = $this->Csv_model->get_atn_dropdown($id);
         $data['page']        = "update_atn";   
         echo Modules::run('template/layout',$data); 
     }

 }
    //// checkout atn ///
 public function checkout(){
    $timezone = $this->db->select('timezone')->from('setting')->get()->row();
   date_default_timezone_set($timezone->timezone);

   $sign_out =  date("h:i:s a", time());
   $sign_in  =  $this->input->post('sign_in',true);
   $in=new DateTime($sign_in);
   $Out=new DateTime($sign_out);
   $interval=$in->diff($Out);
   $stay =  $interval->format('%H:%I:%S');
   $postData = [
    'att_id'               => $this->input->post('att_id',true),
    'sign_out'             =>  $sign_out,
    'staytime'             => $stay,
]; 
$update = $this->db->where('att_id',$this->input->post('att_id',true))
            ->update("emp_attendance", $postData);
            if ($update) { 
                $this->session->set_flashdata('message', display('successfully_checkout'));
                  echo '<script>window.location.href = "'.base_url().'hrm/Home/index"</script>';
            }

}

/* ########## Report Start ####################*/
public function report_user(){

    $data['title']            = display('attendance_list');
    $data['module']           = "hrm";
    $data['page']             = "user_views_report";   
    echo Modules::run('template/layout', $data); 
    }//

    public function report_byId(){

        $data['title']            = display('attendance_list');
        $data['module']           = "hrm";
        $data['page']             = "attn_Id_report";   
        echo Modules::run('template/layout', $data); 
    }//

    public function report_view(){

        $this->permission->module('hrm','read')->redirect();
        $format_start_date = $this->input->post('start_date');
        $format_end_date   = $this->input->post('end_date');
        $data['date']      = $format_start_date;
        $data['date']      = $format_end_date;
        $data['query']     = $this->Csv_model->userReport($format_start_date,$format_end_date);
        $data['module']    = "hrm";
        $data['page']      = "user_views_report";   
        echo Modules::run('template/layout', $data); 
    }
    public function AtnReport_view(){

        $this->permission->module('hrm','read')->redirect();
        $data['title']    = display('attendance_repor');
        $id            = $this->input->post('employee_id');
        $start_date    = $this->input->post('s_date');
        $end_date      = $this->input->post('e_date');
        $data['employee_id']  = $id;
        $data['date']  = $start_date;
        $data['date']  = $end_date;
        $data['ab']   = $this->Csv_model->atnrp($id);
        $data['query'] = $this->Csv_model->search($id,$start_date,$end_date);

        $data['module']= "hrm";
        $data['page']  = "att_reportview";   
        echo Modules::run('template/layout', $data); 
    }
    public function atntime_report(){

        $data['title']            = display('attendance_list');
        $data['module']           = "hrm";
        $data['page']             = "Date_time_report";   
        echo Modules::run('template/layout', $data); 
    }//

    public function AtnTimeReport_view(){

        $this->permission->module('hrm','read')->redirect();
        $data['title']           = display('attendance_repor');
        $date                 = $this->input->post('date');
        $start_time           = $this->input->post('s_time');
        $end_time             = $this->input->post('e_time');
        $data['date']         = $date;
        $data['sign_in']      = $start_time;
        $data['sign_in']      = $end_time;
        $data['query']        = $this->Csv_model->search_intime($date,$start_time,$end_time);
        $data['module']       = "hrm";
        $data['page']         = "Date_time_report";   
        echo Modules::run('template/layout', $data); 
    }

    /**** ###### Id checking ######### */


    function attenlist() {
        $data['title']            = display('attendance_list');  ;
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['module']           = "hrm";
        $data['page']             = "attendance_list";   
        echo Modules::run('template/layout', $data); 
    } 

    /*  atn edit */
    public function edit_atn_form($id = null){
        $this->permission->method('hrm','delete')->redirect();
        $this->form_validation->set_rules('att_id',null,'required|max_length[11]');
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
        $this->form_validation->set_rules('date',display('date')  ,'required');
        $this->form_validation->set_rules('sign_in',display('sign_in')  ,'required');
        $this->form_validation->set_rules('sign_out',display('sign_out'));
        $this->form_validation->set_rules('staytime',display('staytime'));
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $postData = [
                'att_id'               => $this->input->post('att_id',true),
                'employee_id'          => $this->input->post('employee_id',true),
                'date'                 => $this->input->post('date',true),
                'sign_in'              => $this->input->post('sign_in',true),
                'sign_out'             => $this->input->post('sign_out',true),
                'staytime'             => $this->input->post('staytime',true),
                
            ]; 
            
            if ($this->Csv_model->update_attn($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            echo '<script>window.location.href = "'.base_url().'hrm/Home/index"</script>';

        } else {
         $data['data']=$this->Csv_model->attn_updateForm($id);
         $data['module']      = "hrm";
         $data['dropdownatn'] =$this->Csv_model->Employeename();
         $data['query']       = $this->Csv_model->get_atn_dropdown($id);
         $data['page']        = "edit_attendance";   
         echo Modules::run('template/layout',$data); 
     }

 }

}
/*END OF FILE*/
