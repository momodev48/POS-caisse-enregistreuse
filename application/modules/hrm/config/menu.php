<?php

// module name
$HmvcMenu["hrm"] = array(
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
       "salary_generate" => array("controller" => "Payroll","method"=> "create_salary_generate","permission" => "create"), 
   ),
);
   

 