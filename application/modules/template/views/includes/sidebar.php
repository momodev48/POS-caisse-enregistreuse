<div class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel text-center">
        <div class="image">
            <?php $image = $this->session->userdata('image') ?>
            <img src="<?php echo base_url((!empty($image)?$image:'assets/img/icons/default.jpg')) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="info">
            <p><?php echo $this->session->userdata('fullname') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('user_level') ?></a>
        </div>
    </div> 


    <!-- sidebar menu -->
    <ul class="sidebar-menu">

        <li class="treeview <?php echo (($this->uri->segment(2)=="home" || $this->uri->segment(2)=="")?"active":null) ?>">
            <a href="<?php echo base_url('dashboard/home') ?>"><i class="ti-home"></i> <span><?php echo display('dashboard')?></span> 
            </a>
        </li>



        <!-- *************************************
        **********STATS OF CUSTOM MODULES*********
        ************************************* -->
        <?php  
        $path = 'application/modules/';
        $map  = directory_map($path);
        $HmvcMenu2   = array();
		
        
		
		$HmvcMenu2["ordermanage"] = array(
    		"icon" => "<i class='fa fa-first-order' aria-hidden='true'></i>", 
			"pos_invoice" => array("controller" => "order","method"=> "pos_invoice","permission" => "read"),
			"order_list" => array("controller" => "order","method" => "orderlist","permission" => "read"),
			"pending_order" => array("controller" => "order","method" => "pendingorder","permission" => "read"),
			"complete_order" => array("controller" => "order","method"=> "completelist","permission" => "read"),
			"cancel_order" => array("controller" => "order","method" => "cancellist","permission" => "read"),
			"kitchen_dashboard" => array("controller" => "order","method"=> "allkitchen","permission" => "read"),
			"counter_dashboard" => array("controller" => "order","method"=> "counterboard","permission" => "read"),
			"counter_list" => array("controller" => "order","method"=> "counterlist","permission" => "read"),
			"pos_setting" => array("controller" => "order","method"=> "possetting","permission" => "read"),
			"sound_setting" => array("controller" => "order","method"=> "soundsetting","permission" => "read")
		);
		$HmvcMenu2["reservation"] = array(
    		"icon" => "<i class='fa fa-tags' aria-hidden='true'></i>", 
    		"reservation" => array("controller" => "reservation","method"     => "index","permission" => "read"), 
   			"reservation_table" => array("controller" => "reservation","method" => "tablebooking","permission" => "read"),
			"unavailable_day" => array("controller" => "reservation","method" => "unavailablelist","permission" => "read"), 
			"reservasetting" => array("controller" => "reservation","method" => "setting","permission" => "read"),   
		);
		$HmvcMenu2["purchase"] = array(
    		"icon"=> "<i class='fa fa-shopping-cart' aria-hidden='true'></i>", 

   			"purchase_item" => array("controller" => "purchase","method" => "index","permission" => "read"),
			"purchase_add" => array("controller" => "purchase","method"     => "create","permission" => "create"),
	        "purchase_return" => array("controller" => "purchase","method" => "return_form","permission" => "create"),
	        "return_invoice" => array("controller" => "purchase","method" => "return_invoice","permission" => "create"),
			"supplier_manage" => array("controller" => "supplierlist","method"     => "index","permission" => "read"), 
			"supplier_ledger" => array("controller" => "supplierlist","method" => "supplier_ledger_report","permission" => "read"),
			"stock_out_ingredients" => array("controller" => "purchase","method" => "stock_out_ingredients","permission" => "read"),
		); 
		$HmvcMenu2["report"] = array(
    		"icon" => "<i class='fa fa-line-chart' aria-hidden='true'></i>", 
    		"purchase_report" => array("controller" => "reports","method"  => "index","permission" => "read"), 
 			"stock_report_product_wise" => array("controller" => "reports","method"  => "productwise","permission" => "read"), 
			"purchase_report_ingredient" => array("controller" => "reports","method" => "ingredientwise","permission" => "read"), 
			"sell_report" => array("sell_report" => array("controller" => "reports","method"=> "sellrpt","permission" => "read"),
			"sell_report_items" => array("controller" => "reports","method"=> "sellrptItems","permission" => "read"),
			"scharge_report" => array("controller" => "reports","method"=> "servicerpt","permission" => "read"),
			"sell_report_waiters" => array("controller" => "reports","method"=> "sellrptwaiter","permission" => "read"),
			"kitchen_sell" => array("controller" => "reports","method"     => "kichansrpt","permission" => "read"),
			"sell_report_delvirytype" => array("controller" => "reports","method"=> "sellrptdelvirytype","permission" => "read"),
			"sell_report_casher" => array("controller" => "reports","method" => "sellrptCasher","permission" => "read")),
			
			"sell_report_cashregister" => array("controller" => "reports","method" => "cashregister","permission" => "read"),
			"sell_report_filter" => array("controller" => "reports","method"=> "sellrpt2","permission" => "read"),
			"sele_by_date" => array("controller" => "reports", "method" => "sellrptbydate", "permission" => "read"),
			"commission" => array("controller" => "reports","method"=> "payroll_commission","permission" => "read"), 
      		"sale_by_table" => array("controller" => "reports","method"=> "table_sale","permission" => "read")
		);
		$HmvcMenu2["itemmanage"] = array(
    		"icon"           => "<i class='fa fa-cube' aria-hidden='true'></i>", 
    		"manage_category" => array(
       			"add_category" => array("controller" => "item_category","method"=> "create","permission" => "create"), 
       			"category_list" => array("controller" => "item_category","method" => "index","permission" => "read")
				),  
           "manage_food" => array(
                "add_food" => array("controller" => "item_food","method" => "create","permission" => "create"), 
   				"food_list" => array("controller" => "item_food","method" => "index","permission" => "read"),
				"add_group_item" => array("controller" => "item_food","method" => "addgroupfood","permission" => "read"),
	            "food_varient" => array("controller" => "item_food", "method"  => "foodvarientlist","permission" => "read"), 
	            "food_availablity" => array("controller" => "item_food","method"     => "availablelist","permission" => "read"),
				"menu_type" => array("controller" => "item_food", "method"  => "todaymenutype","permission" => "read")
				),
  		  "manage_addons" => array(
    			"add_adons" => array("controller" => "menu_addons","method"     => "create","permission" => "create"), 
    			"addons_list" => array("controller" => "menu_addons","method"     => "index","permission" => "read"),
	            "assign_adons_list" => array("controller" => "menu_addons","method"     => "assignaddons","permission" => "read")   
   				)
		);
		$HmvcMenu2["production"] = array( 
    		"icon"           => "<i class='fa fa-product-hunt' aria-hidden='true'></i>", 
   			"set_productionunit" => array("controller" => "production","method"     => "productionunit","permission" => "create"),
   			"production_set_list" => array("controller" => "production","method"     => "index","permission" => "read"),
			"production_add" => array("controller" => "production","method"     => "create","permission" => "create"),
			"production_setting" => array("controller" => "production","method" => "possetting","permission" => "create")
			);
		$HmvcMenu2["setting"] = array(
    		"icon"           => "<i class='fa fa-gear' aria-hidden='true'></i>", 
            "payment_setting" => array(
				"paymentmethod_list" => array("controller" => "paymentmethod","method" => "index","permission" => "read"),
				"paymentmethod_setup" => array("controller" => "paymentmethod","method"=> "paymentsetup","permission" => "read"), 
				"shipping_setting" => array("controller" => "shippingmethod","method" => "index","permission" => "read")
			),
    		"table_manage" => array(
            	"table_list" => array("controller" => "restauranttable","method" => "index","permission" => "read"), 
				
	        	"table_setting" => array("controller" => "restauranttable","method" => "tablesetting","permission" => "read")
            ),   
    		"customer_type" => array(
				"customer_list" => array("controller" => "customerlist","method"  => "index","permission" => "read"), 
    			"customertype_list" => array("controller" => "customertype","method" => "index","permission" => "read"), 
				"thirdpartycustomer_list" => array("controller" => "thirdpratycustomer","method"=> "index","permission" => "read"),
				"list_of_card_terminal" => array("controller" => "card_terminal","method" => "index","permission" => "read"), 
    		),
			"kitchen_setting" => array(
    			"kitchen_list" => array("controller" => "kitchensetting","method" => "index","permission" => "read"), 
				"kitchen_assign" => array("controller" => "kitchensetting","method"  => "assignkitchen","permission" => "read")
				
   			), 
   			"manage_unitmeasurement" => array(
    			"unit_list" => array("controller" => "unitmeasurement","method"  => "index","permission" => "read"), 
				"ingradient_list" => array("controller" => "ingradient","method"  => "index","permission" => "read") 
   			),  
   			"sms_setting" => array(
    			"sms_configuration" => array("controller" => "smsetting","method" => "sms_configuration","permission" => "read"), 
				"sms_temp" => array("controller" => "smsetting","method"  => "sms_template","permission" => "read")
   			),
			"bank" => array(
   				"list_of_bank" => array("controller" => "bank_list",     "method"     => "index","permission" => "read"), 
	    		"bank_transaction" => array( "controller" => "bank_list","method"     => "bank_transaction","permission" => "read")
   			),
   			"language" => array("controller" => "language","method"     => "index","permission" => "read"),    
    		"application_setting" => array("controller" => "setting","method" => "index","permission" => "read"), 
    		"server_setting" => array("controller" => "serversetting","method"  => "index","permission" => "read"),
			"factory_reset" => array("controller" => "setting","method"  => "factoryreset","permission" => "read"), 
    		"currency" => array("controller" => "currency","method" => "index","permission" => "read"), 
    		"country" => array("controller" => "country_city_list","method"=> "index", "permission" => "read"),   
			"state" => array("controller" => "country_city_list","method" => "statelist","permission" => "read"),
			"city" => array("controller" => "country_city_list","method" => "citylist","permission" => "read"),
			"commission" => array("controller" => "Commissionsetting","method"=> "payroll_commission","permission" => "create")    
		); 
		$HmvcMenu2["accounts"] = array(
    		"icon"           => "<i class='ti-bag'></i>", 
   			"c_o_a" => array("controller" => "accounts","method"=> "show_tree","permission" => "read"), 
			"supplier_payment" => array("controller" => "accounts","method" => "supplier_payments","permission" => "create"), 
	        "cash_adjustment" => array("controller" => "accounts","method"     => "cash_adjustment","permission" => "create"), 
      		"debit_voucher" => array("controller" => "accounts","method" => "debit_voucher","permission" => "create"), 
            "credit_voucher" => array("controller" => "accounts","method"=> "credit_voucher","permission" => "read"), 
            "contra_voucher" => array("controller" => "accounts","method" => "contra_voucher","permission" => "read"),
     		"journal_voucher" => array("controller" => "accounts","method"=> "journal_voucher","permission" => "read"),  
            "voucher_approval" => array("controller" => "accounts","method" => "aprove_v","permission" => "create"), 
            "account_report" => array(
		     	"voucher_report" => array("controller" => "accounts", "method"     => "voucher_report","permission" => "read"), 
				"cash_book" => array("controller" => "accounts","method"=> "cash_book","permission" => "read"), 
				"bank_book" => array("controller" => "accounts","method"=> "bank_book","permission" => "read"), 
				"general_ledger" => array("controller" => "accounts","method" => "general_ledger","permission" => "read"), 
				"trial_balance" => array("controller" => "accounts","method" => "trial_balance","permission" => "read"),
				"profit_loss" => array("controller" => "accounts","method" => "profit_loss_report","permission" => "read"),
				"cash_flow" => array("controller" => "accounts","method" => "cash_flow_report","permission" => "read"),
				"coa_print" => array("controller" => "accounts","method" => "coa_print","permission" => "read"),
				"balance_sheet" => array("controller" => "accounts","method" => "balance_sheet","permission" => "read")  
    			), 
		);
		$HmvcMenu2["hrm"] = array(
			"icon"           => "<i class='fa fa-users'></i>", 
			"ehrm" => array(
			   "position" => array("controller" => "Employees","method" => "create_position","permission" => "create"), 
			   "add_employee" => array("controller" => "Employees","method" => "viewEmhistory","permission" => "create"), 
			   "manage_employee" => array("controller" => "Employees","method" => "manageemployee","permission" => "read"), 
			       
			   "emp_sal_payment" => array("controller" => "Employees","method" => "emp_payment_view","permission" => "view") 
		   ),
			"attendance" => array( 
				'atn_form'    => array("controller" => "Home","method" => "index","permission" => "read"), 
				'atn_report'  => array("controller" => "Home","method"     => "attenlist","permission" => "read") 
				),
			"expense" => array(
				'add_expense_item'=> array("controller" => "Cexpense","method"=> "add_expense_item","permission" => "read"), 
				'manage_expense_item'=> array("controller" => "Cexpense","method"=> "manage_expense_item","permission" => "read"), 
				'add_expense'=> array("controller" => "Cexpense","method"=> "add_expense","permission" => "read"), 
				'manage_expense'=> array("controller" => "Cexpense","method"=> "manage_expense","permission" => "read"),
				'expense_statement'=> array("controller" => "Cexpense","method"=> "expense_statement_form","permission" => "read")
				),
			"award" => array(
				"new_award" => array("controller" => "Award_controller","method" => "create_award","permission" => "create"),
			),
			"circularprocess" => array(
				'add_canbasic_info'  => array("controller" => "Candidate","method" => "caninfo_create","permission" => "create"), 
				'can_basicinfo_list' => array("controller" => "Candidate","method" => "candidateinfo_view","permission" => "read"),
				"candidate_shortlist" => array("controller" => "Candidate_select","method" => "create_shortlist","permission" => "create"), 
			"candidate_interview" => array("controller" => "Candidate_select","method"=> "create_interview","permission" => "create"),     
			"candidate_selection" => array("controller" => "Candidate_select","method"=> "create_selection","permission" => "create")
			),
			"department" => array(
				"department" => array("controller" => "Department_controller","method" => "create_dept","permission" => "create"), 
				"add_division" => array("controller" => "Division_controller","method" => "division_form","permission" => "create"), 
				"division_list" => array("controller" => "Division_controller","method"=> "index","permission" => "read") 
		   ),  
		   
		   "leave" => array(
			   "weekly_holiday" => array("controller" => "Leave","method" => "create_weekleave","permission" => "read"), 
			   "holiday" => array("controller" => "Leave","method" => "holiday_view", "permission" => "read"), 
			   "add_leave_type" => array("controller" => "Leave","method" => "add_leave_type","permission" => "read"),
			   "leave_application" => array("controller" => "Leave","method" => "others_leave","permission" => "read")
		   ),
		   "loan" => array(
			   "loan_grand" => array("controller" => "Loan","method" => "create_grandloan","permission" => "read"), 
			   "loan_installment" => array("controller" => "Loan","method"=> "create_installment","permission" => "read"), 
			   "loan_report" => array("controller" => "Loan","method" => "loan_report","permission" => "read") 
		   ),
		   "payroll" => array(
			   "salary_type_setup" => array("controller" => "Payroll","method" => "create_salary_setup","permission" => "read"), 
			   "salary_setup" => array("controller" => "Payroll","method" => "create_s_setup","permission" => "create"), 
			   "salary_generate" => array("controller" => "Payroll","method"=> "create_salary_generate","permission" => "create")			    
		   ),
		   
		);

        if(isset($HmvcMenu2) && $HmvcMenu2!=null && sizeof($HmvcMenu2) > 0)
        foreach ($HmvcMenu2 as $moduleName => $moduleData) {
          
            // check module permission 
            if (file_exists(APPPATH.'modules/'.$moduleName.'/assets/data/env'))
            if ($this->permission->module($moduleName)->access()) {
       
            $this->permission->module($moduleName)->access();
        ?>
                <li class="treeview ">
                    
                    <a href="javascript:void(0)">
                        <?php echo (($moduleData['icon']!=null)?$moduleData['icon']:null) ?> <span><?php echo display($moduleName) ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a> 

                    <ul class="treeview-menu">  
                        <?php foreach ($moduleData as $groupLabel => $label) {?>
                            <?php   
   
                            if ($groupLabel!='icon') 

                            if ((isset($label['controller']) && $label['controller']!=null) && ($label['method']!=null)) {

                               if($this->permission->check_label($groupLabel)->access()){
                               
								if($label['controller']=='dashboard'){
									$furl=base_url($label['controller']."/".$label['method']);
									}
								else{
									$furl=base_url($moduleName."/".$label['controller']."/".$label['method']);
									}
									
                            ?> 
                               
                                <li class="<?php echo (($this->uri->segment(1)==$moduleName && $label['controller']==$this->uri->segment(2) && $this->uri->segment(3)==$label['method'])?"active":null) ?>">
                                    <a href="<?php echo $furl;?>"><?php echo display($groupLabel) ?></a>
                                </li>

                            <?php 
                                } 

                            } else { 
                         
                            ?>

                            <!-- multilevel menu/link -->
                            <!-- extract $label to compare with segment -->
                            <?php 
                            if($this->permission->check_label($groupLabel)->access()){
                            foreach ($label as $url) 
                       ?>
                                <li class="">
                                    <a href="#"><?php echo display($groupLabel) ?>
                                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                                    </a>
                                    <ul class="treeview-menu"> 
                                        <?php 
                                        foreach ($label as $name => $value) {
                                            if($this->permission->check_label($name)->access()){
                                             
                                            ?>
                                            <li class=""><a href="<?php echo base_url($moduleName."/".$value['controller']."/".$value['method']) ?>"><?php echo display($name) ?></a></li>
                                            <?php 
                                            }
											//endif
                                        } //endforeach
                                        ?> 
                                    </ul>
                                </li> 
                            <?php } ?>    

                            <!-- endif -->
                            <?php } ?>
                        <!-- endforeach -->
                        <?php } ?>
                    </ul>
                </li> 
            <!-- end if -->
            <?php } ?>
        <!-- end foreach -->
        <?php } ?>  
        <?php  
        $path = 'application/modules/';
        $map  = directory_map($path);
        $HmvcMenu   = array();
        if (is_array($map) && sizeof($map) > 0)
        foreach ($map as $key => $value) {
            $menu = str_replace("\\", '/', $path.$key.'config/menu.php'); 
            if (file_exists($menu)) {

                if (file_exists(APPPATH.'modules/'.$key.'/assets/data/env')){
                   @include($menu);
                }
               
            }  
        }  
        ?> 

        <!-- *************************************
        **********ENDS OF CUSTOM MODULES*********
        ************************************* -->

        <li class="header">Default </li>

        <?php if($this->session->userdata('isAdmin')) { ?>
        <li class="treeview <?php echo (($this->uri->segment(2)=="user")?"active":null) ?>">
            <a href="#">
                <i class="ti-user"></i><span><?php echo display('user')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/user/form') ?>"><?php echo display('add_user')?></a></li>
                <li><a href="<?php echo base_url('dashboard/user/index') ?>"><?php echo display('user_list')?></a></li> 
            </ul>
        </li>
        
        <li class="treeview"><a href="<?php echo base_url('addon/module/index') ?>"><i class="fa fa-adn"></i><span><?php echo display('moduless')?></span> </a></li>
        <li class="treeview"><a href="<?php echo base_url('addon/theme/index') ?>"><i class="fa fa-adn"></i><span><?php echo display('themes')?></span> </a></li>
		<li class="treeview <?php echo (($this->uri->segment(2)=="role" ||$this->uri->segment(2)=="module_permission")?"active":null) ?>">
            <a href="#">

                <i class="ti-lock"></i><span><?php echo display('role_permission')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/permission_setup') ?>"><?php echo display('permission_setup')?></a></li> 
                <li><a href="<?php echo base_url('dashboard/role/create_system_role') ?>"><?php echo display('add_role')?></a></li>
                <li><a href="<?php echo base_url('dashboard/role/role_list') ?>"><?php echo display('role_list')?></a></li>
                <li><a href="<?php echo base_url('dashboard/role/user_access_role') ?>"><?php echo display('user_access_role')?></a></li>
           
            </ul>
        </li>
        
    

        
         <li class="treeview <?php echo (($this->uri->segment(2)=="setting")?"active":null) ?>">
            <a href="#">
                <i class="ti-settings"></i><span><?php echo display('web_setting')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/web_setting/') ?>"><?php echo display('common_setting')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/storetime') ?>"><?php echo display('storetime')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/bannersetting') ?>"><?php echo display('banner_setting')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/menusetting') ?>"><?php echo display('menu_setting')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/seosetting') ?>"><?php echo display('seo_setting')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/socialtting') ?>"><?php echo display('social_setting')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/widgetsetting') ?>"><?php echo display('widget_setting')?></a></li>
                <li><a href="<?php echo base_url('dashboard/web_setting/email_config_setup') ?>"><?php echo display('email_setting')?></a></li> 
                <li><a href="<?php echo base_url('dashboard/rating') ?>"><?php echo display('customer_rating')?></a></li>
                <li><a href="<?php echo base_url('dashboard/couponlist') ?>"><?php echo display('couponlist')?></a></li>
 			    <li><a href="<?php echo base_url('dashboard/web_setting/subscribeList') ?>"><?php echo display('subscribelist')?></a></li> 
            </ul>
        </li>
        <li class="treeview <?php echo (($this->uri->segment(2)=="autoupdate")?"active":null) ?>">
           <a href="<?php echo base_url('dashboard/autoupdate') ?>"><i class="ti-reload"></i> <span><?php echo display('autoupdate')?></span></a>
        </li>
        <?php } ?>
        <!-- ends of admin area -->

        <li class="treeview <?php echo (($this->uri->segment(2)=="message")?"active":null) ?>">
            <a href="#">
                <i class="ti-comments"></i><span><?php echo display('message')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/message/new_message') ?>"><?php echo display('new')?></a></li>
                <li><a href="<?php echo base_url('dashboard/message/index') ?>"><?php echo display('inbox')?></a></li>
                <li><a href="<?php echo base_url('dashboard/message/sent') ?>"><?php echo display('sent')?></a></li> 
            </ul>
        </li>       
    </ul> 
</div> <!-- /.sidebar -->