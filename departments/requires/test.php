<?php 
//die("Please remove die() first.");
require_once($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/db_config/DbConnect.php');
$dbconnect = new DbConnect();

/* $query = $dbconnect->executeQuery("select * from applications");

die(); */
class Migration extends DbConnect{
	public function users(){
		$result = $this->executeQuery("test","select a.id,a.name,a.email,a.active,a.phone,a.email_verify_link,b.password,a.password_reset,a.user_ip,a.registered_on from users as a LEFT JOIN user_passwords as b ON a.id=b.uid ORDER BY a.id ASC LIMIT 10");
		$insert_query = "insert into users_ci(name,email,phone,password,password_reset,user_ip,registered_on) values";
		$values = "";
		$i=1;
		$num_rows = $result->num_rows;
		while($rows = $result->fetch_assoc()){
			//echo $i."##".$num_rows;echo "<br/><br/>";
			if($i!=$num_rows){
				$values = $values."('".$rows["name"]."','".$rows["email"]."','".$rows["phone"]."','".$rows["password"]."','".$rows["password_reset"]."','".$rows["user_ip"]."','".$rows["registered_on"]."'),";
			}else{
				$values = $values."('".$rows["name"]."','".$rows["email"]."','".$rows["phone"]."','".$rows["password"]."','".$rows["password_reset"]."','".$rows["user_ip"]."','".$rows["registered_on"]."')";
			}
			$this->emails($rows["email"],$rows["email_verify_link"],$rows["registered_on"],$rows["active"]);
			$i++;
		}
		echo $insert_query = $insert_query.$values;
		$result2 = $this->executeQuery("test",$insert_query);
		if($result2) echo "Users Table Migrated Successfully. <br/><br/>";
		else echo "Error in Users function query.<br/><br/>";
	}
	public function emails($email,$email_verify_code,$entry_time,$verification_status){
		$insert_query = "insert into emails(email,email_verify_code,entry_time,verification_status) values('".$email."','".$email_verify_code."','".$entry_time."','".$verification_status."')";
	
		$result = $this->executeQuery("test",$insert_query);
		if($result) echo "Emails Table Migrated Successfully. <br/><br/>";
		else echo "Error in Emails function query.<br/><br/>";
	}
	public function get_entity_id($entity_name){
		switch($entity_name){
			
			case "PR": $entity_id=1;
			break;
			case "PARTNERSHIP FIRM": $entity_id=2;
			break;
			case "LLP": $entity_id=3;
			break;
			case "PRLC": $entity_id=4;
			break;
			case "PBLC": $entity_id=5;
			break;
			case "CS": $entity_id=6;
			break;
			case "AP": $entity_id=7;
			break;
			case "T": $entity_id=8;
			break;
			case "C": $entity_id=9;
			break;
			case "HUF": $entity_id=10;
			break;
			case "PSU": $entity_id=11;
			break;
			case "SOC": $entity_id=12;
			break;
			case "SG": $entity_id=13;
			break;
			case "CG": $entity_id=14;
			break;
			default: $entity_id=0;
			break;
		}
		return $entity_id;
	}
	public function get_owner_names_json($owner_names){
		$owner_names = explode(",",$owner_names);
		$owner_names_json = json_encode($owner_names);
		//print_r($owner_names);
		return $owner_names_json;
	}
	
	public function insert_registered_office_address($row){
		$query="";
		$inserted_id = $this->executeQueryInsertID("test","insert into address(type_of_address,house_no,street,village,pin,dist,state,entrydate) values('registered_office','".$row["b_street_name3"]."','".$row["b_street_name4"]."','".$row["b_vill2"]."','".$row["b_pincode2"]."','".$row["b_dist2"]."','".$row["b_block2"]."','".$row["Time_of_registration"]."')");
		return $inserted_id;
	}
	public function insert_app_address($row){
		$query="";
		$inserted_id = $this->executeQueryInsertID("test","insert into address(type_of_address,house_no,street,village,pin,dist,state,entrydate) values('applicant_address','".$row["Street_name1"]."','".$row["Street_name2"]."','".$row["Vill"]."','".$row["Pincode"]."','".$row["Dist"]."','".$row["block"]."','".$row["Time_of_registration"]."')");
		return $inserted_id;
	}
	public function insert_unit_address($row){
		$query="";
		//print_r($rows);die();
		$inserted_id = $this->executeQueryInsertID("test","insert into address(type_of_address,house_no,street,village,block,revenue_circle,subdivision,pin,dist,state,entrydate) values('unit_office','".$row["b_street_name1"]."','".$row["b_street_name2"]."','".$row["b_vill"]."','".$row["b_block"]."','".$row["revenue"]."','".$row["subdivision"]."','".$row["b_pincode"]."','".$row["b_dist"]."','Assam (AS)','".$row["Time_of_registration"]."')");
		return $inserted_id;
	}
	public function insert_unit($row,$unit_address_id,$caf_id){

		$inserted_id = $this->executeQueryInsertID("test","insert into unit(unit_id,ubin,caf_id,unit_name,unit_type,dateofcommencement,address,block,revenue_circle,landline_std,landline_no,mobile_no,email_id,documents,document_submit_time,submitstatus,submittedtime,approvalstatus,approvetime,entrytime) values('".$row["id"]."','".$row["ubin"]."','".$caf_id."','".$row["Name"]."','".$row["unit_type"]."','".$row["date_of_commencement"]."','".$unit_address_id."','".$row["b_block"]."','".$row["revenue"]."','".$row["b_landline_std"]."','".$row["b_landline_no"]."','".$row["b_mobile_no"]."','".$row["b_email"]."','".$row["auth_letter_doc"]."','".$row["Time_of_registration"]."','1','".$row["Time_of_registration"]."','".$row["active"]."','".$row["approved_date"]."','".$row["Time_of_registration"]."')");
		return $inserted_id;
	}
	public function unit_landdetails($row,$inserted_unit_id){
		
		$Type_of_area = $row["Type_of_area"];
		if($Type_of_area=="R") $area_type="Rural";
		else $area_type="Urban";				
		
		$w_l = $row["w_l"];
		if($w_l=="R") $land_status="Rented";
		else if($w_l=="O") $land_status="Own";
		else $land_status="Leased";
		
		$Type_of_land = $row["Type_of_land"];
		if($Type_of_land=="G") $land_type="Government";
		else $land_type="Private";
		
		$inserted = $this->executeQuery("test","insert into unit_landdetails(unit_id,area_type,land_status,land_type,dag_no,patta_no,mouza,entrytime) values('".$inserted_unit_id."','".$area_type."','".$land_status."','".$land_type."','".$row["dagno"]."','".$row["pattano"]."','".$row["mouza"]."','".$row["Time_of_registration"]."')");
		return $inserted;
	}
	public function unit_otherdetails($row,$inserted_unit_id){
		
		$Size_of_Investment = $row["Size_of_Investment"];
		if($Size_of_Investment==10) $investment_size="1";
		else if($Size_of_Investment==25) $investment_size="2";
		else if($Size_of_Investment==200) $investment_size="3";
		else if($Size_of_Investment==500) $investment_size="4";
		else if($Size_of_Investment==1000) $investment_size="5";
		else $investment_size="6";	
		
		$e_n_employee = $row["Estimated_n_employee"];
		if($e_n_employee=="L10") $no_of_employee="10";
		else if($e_n_employee=="L20") $no_of_employee="20";
		else if($e_n_employee=="L50") $no_of_employee="50";
		else if($e_n_employee=="G50") $no_of_employee="100";
		else $no_of_employee="5";				
		
		$c_o_Enterprise = $row["Category_o_Enterprise"];
		if($c_o_Enterprise=="G") $entp_category="1";
		else if($c_o_Enterprise=="O") $entp_category="2";
		else if($c_o_Enterprise=="R") $entp_category="3";
		else $entp_category="4";
		
		$inserted = $this->executeQuery("test","insert into unit_otherdetails(unit_id,investment_size,no_of_employee,operation_sector,business_type,entp_category,entrytime) values('".$inserted_unit_id."','".$investment_size."','".$no_of_employee."','".$row["sector_classes_a"]."','".$row["sector_classes_b"]."','".$entp_category."','".$row["Time_of_registration"]."')");
		return $inserted;
	}
	public function unit_master_record($row,$inserted_unit_id,$caf_id,$unit_address_id,$app_addressid){
		
		$Type_of_area = $row["Type_of_area"];
		if($Type_of_area=="R") $area_type="Rural";
		else $area_type="Urban";
		
		$w_l = $row["w_l"];
		if($w_l=="R") $land_status="Rented";
		else if($w_l=="O") $land_status="Own";
		else $land_status="Leased";
		
		$Type_of_land = $row["Type_of_land"];
		if($Type_of_land=="G") $land_type="Government";
		else $land_type="Private";
		
		$Size_of_Investment = $row["Size_of_Investment"];
		if($Size_of_Investment==10) $investment_size="1";
		else if($Size_of_Investment==25) $investment_size="2";
		else if($Size_of_Investment==200) $investment_size="3";
		else if($Size_of_Investment==500) $investment_size="4";
		else if($Size_of_Investment==1000) $investment_size="5";
		else $investment_size="6";	
		
		$e_n_employee = $row["Estimated_n_employee"];
		if($e_n_employee=="L10") $no_of_employee="10";
		else if($e_n_employee=="L20") $no_of_employee="20";
		else if($e_n_employee=="L50") $no_of_employee="50";
		else if($e_n_employee=="G50") $no_of_employee="100";
		else $no_of_employee="5";				
		
		$c_o_Enterprise = $row["Category_o_Enterprise"];
		if($c_o_Enterprise=="G") $entp_category="1";
		else if($c_o_Enterprise=="O") $entp_category="2";
		else if($c_o_Enterprise=="R") $entp_category="3";
		else $entp_category="4";
		
		$inserted = $this->executeQuery("test","insert into unit_master_record(unit_id,caf_id,ubin,unit_name,unit_type,dateofcommencement,	address,revenue_circle,block,landline_std,landline_no,mobile_no,email_id,documents,app_name,app_designation,app_addressid,app_mobile_no,app_email,app_username,app_password,area_type,land_status,land_type,dag_no,patta_no,mouza,investment_size,no_of_employee,operation_sector,business_type,entp_category,entry_time) values('".$inserted_unit_id."','".$caf_id."','".$row["ubin"]."','".$row["Name"]."','".$row["unit_type"]."','".$row["date_of_commencement"]."','".$unit_address_id."','".$row["revenue"]."','".$row["b_block"]."','".$row["b_landline_std"]."','".$row["b_landline_no"]."','".$row["b_mobile_no"]."','".$row["b_email"]."','".$row["auth_letter_doc"]."','".$row["Key_person"]."','".$row["status_applicant"]."','".$row["app_addressid"]."','".$row["Mobile_no"]."','".$row["email"]."','".$row["username"]."','".$row["password"]."','".$area_type."','".$land_status."','".$land_type."','".$row["dagno"]."','".$row["pattano"]."','".$row["mouza"]."','".$investment_size."','".$no_of_employee."','".$row["sector_classes_a"]."','".$row["sector_classes_b"]."','".$entp_category."','".$row["Time_of_registration"]."')");
		return $inserted;
	}
	public function caf(){
		$query = "select a.id,a.user_id,a.ubin,a.save_mode,a.Name,a.unit_type,a.Type_of_ownership,a.Name_of_owner,a.b_street_name1,a.b_street_name2,a.b_vill,a.b_dist,a.b_block,a.b_pincode,a.subdivision,a.b_landline_std,a.b_landline_no,a.b_mobile_no,a.b_email,a.Street_name1,a.Street_name2,a.Vill,a.block,a.Dist,a.Pincode,a.Landline_std,a.Landline_no,a.Mobile_no,a.Key_person,a.status_applicant,a.pan_no,a.pan_name,a.Time_of_registration,a.id_proof,a.id_proof_doc,a.address_proof,a.address_proof_doc,a.auth_letter_doc,a.pan_doc,a.active,a.approved_by,a.approved_date,b.sector_classes_a,b.sector_classes_b,b.b_street_name3,b.b_street_name4,b.b_vill2,b.b_dist2,b.b_block2,b.b_pincode2,b.Size_of_Investment,b.Category_o_Enterprise,b.Type_of_area,b.Type_of_land,b.w_l,b.Estimated_n_employee,b.dagno,b.pattano,b.mouza,b.revenue,b.sale_nature,b.have_pan,b.cin_llpin,b.declare_a,b.declare_b,b.declare_c,b.date_of_commencement,b.is_business_started,c.email from singe_window_registration as a LEFT JOIN singe_window_registration_part1 as b ON a.id=b.swr_id LEFT JOIN users as c ON c.id=a.user_id ORDER BY a.id ASC LIMIT 10";
		
		//die();
		$result = $this->executeQuery("test",$query);
		$i=1;
		$num_rows = $result->num_rows;
		while($rows = $result->fetch_assoc()){
			//echo $i."##".$num_rows;echo "<br/><br/>";
			$entity_id = $this->get_entity_id($rows["Type_of_ownership"]);
			$owner_names = $this->get_owner_names_json($rows["Name_of_owner"]);
			
			$address = $this->insert_registered_office_address($rows);
			$app_address_id = $this->insert_app_address($rows);
			
			echo $insert_query = "insert into caf(user_id,entp_name,entity_id,owner_names,cin_llpin,date_of_commencement,pan,pan_name,address,app_name,app_email,app_mobile,app_designation,app_address,app_authorisation_letter,app_id_proof,pan_card,status,who_approved,approve_time,entrytime) values";
			$values = "('".$rows["user_id"]."','".$rows["Name"]."','".$entity_id."','".$owner_names."','".$rows["cin_llpin"]."','".$rows["date_of_commencement"]."','".$rows["pan"]."','".$rows["pan_name"]."','".$address."','".$rows["Key_person"]."','".$rows["email"]."','".$rows["Mobile_no"]."','".$rows["status_applicant"]."','".$app_address_id."','".$rows["auth_letter_doc"]."','".$rows["id_proof_doc"]."','".$rows["pan_doc"]."','".$rows["active"]."','".$rows["approved_by"]."','".$rows["approved_date"]."','".$rows["Time_of_registration"]."')";
			
			$insert_query = $insert_query.$values;			
			$caf_id = $this->executeQueryInsertID("test",$insert_query);
			
			// CHECK APPROVED STATUS
			//if($rows["active"]==1){
				
				$unit_address_id 		= $this->insert_unit_address($rows);echo " unit_address_id";
				$inserted_unit_id 		= $this->insert_unit($rows,$unit_address_id,$caf_id);echo "inserted_unit_id";
				$unit_applicant_details = $this->insert_app_address($rows,$inserted_unit_id);echo "unit_applicant_details";
				$unit_landdetails		= $this->unit_landdetails($rows,$inserted_unit_id);echo "unit_landdetails";
				$unit_master_record 	= $this->unit_master_record($rows,$inserted_unit_id,$caf_id,$unit_address_id,$app_address_id);echo "unit_master_record";
				$unit_otherdetails 		= $this->unit_otherdetails($rows,$inserted_unit_id);echo "unit_otherdetails ";				
			//}
			$i++;
		}
		/* echo $insert_query = $insert_query.$values;
		$result = $this->executeQuery("test",$insert_query);
		if($result) echo "Users Table Migrated Successfully. <br/><br/>";
		else echo "Error in Users function query.<br/><br/>"; */
	}
	
	public function caf_query(){
		$result = $this->executeQuery("test","select * from caf_edit_message ORDER BY id ASC LIMIT 10");
		$insert_query = "insert into caf_query(query,caf_id,cms_user_id,querytime) values";
		$values = "";
		$i=1;
		$num_rows = $result->num_rows;
		while($rows = $result->fetch_assoc()){
			//echo $i."##".$num_rows;echo "<br/><br/>";
			if($i!=$num_rows){
				$values = $values."('".$rows["msg"]."','".$rows["swr_id"]."','".$rows["cms_user_id"]."','".$rows["query_date"]."'),";
			}else{
				$values = $values."('".$rows["msg"]."','".$rows["swr_id"]."','".$rows["cms_user_id"]."','".$rows["query_date"]."')";
			}
			$i++;
		}
		echo $insert_query = $insert_query.$values;
		$result = $this->executeQuery("test",$insert_query);
		if($result) echo "CAF QUERY Table Migrated Successfully. <br/><br/>";
		else echo "Error in caf_query function query.<br/><br/>";
	}
	public function applications_up(){
		
		$result = $this->executeQuery("test","select a.dept_id,a.swr_id,b.Name,a.uain,a.process_date,a.forwarded_by,a.current_status,a.process_user_id,a.prev_status from applications_up as a LEFT JOIN singe_window_registration as b ON a.swr_id=b.id ORDER BY a.id DESC LIMIT 10000");
		
		$insert_query = "insert into applications_up_new(unit_id,unit_name,uain,process_date,processed_by,office_id,current_userid,other_status) values";
		$values = "";
		$i=1;
		$num_rows = $result->num_rows;
		while($rows = $result->fetch_assoc()){
			$dept_id = $rows["dept_id"];
			$dept = $this->executeQuery("test","select dept_code from SubDepartment where id='$dept_id'")->fetch_object()->dept_code;
	
				$unit_id = $rows["swr_id"];
				$unit_name = $rows["Name"];
				$uain = $rows["uain"];
				$process_date = $rows["process_date"];	
				$processed_by = $rows["forwarded_by"];
				$process = $rows["current_status"];
				$current_userid = $rows["process_user_id"];
				$other_status = $rows["prev_status"];
				
				if($current_userid!=""){
					$office_id = $this->executeQuery($dept,"select office_id from users where user_id='$current_userid'")->fetch_object()->office_id;					
					
				}else{
					$office_details = $this->executeQuery($dept, "select id from offices where id!='1' AND (jurisdiction LIKE '%$b_dist%' OR jurisdiction LIKE '%$b_block%')");
					if ($office_details->num_rows > 0) {
						$office_row = $office_details->fetch_object();
						$office_id = $office_row->id;
						$user_details = $this->executeQuery($dept, "select user_id from users where utype='2' and office_id='$office_id' and status='1' ORDER BY user_id DESC ");
						if ($office_details->num_rows > 0) {
							$current_userid = $user_details->fetch_object()->user_id;
						} else {
							return false;
							exit();
						}
					} else {
						return false;
						exit();
					}
				}
				if($i!=$num_rows){
					$values = $values."('".$unit_id."','".$unit_name."','".$uain."','".$process_date."','".$processed_by."','".$office_id."','".$current_userid."','".$other_status."'),";
				}else{
					$values = $values."('".$unit_id."','".$unit_name."','".$uain."','".$process_date."','".$processed_by."','".$office_id."','".$current_userid."','".$other_status."')";
				}
			
			
			
			$i++;
		}
		echo $insert_query = $insert_query.$values;
		//$result = $this->executeQuery($dept,$insert_query);
		//if($result) echo "CAF QUERY Table Migrated Successfully. <br/><br/>";
		//else echo "Error in caf_query function query.<br/><br/>";
	}
}
$migration = new Migration();
$migration->users();
$migration->caf();
$migration->caf_query();
$migration->applications_up();

die();
?>