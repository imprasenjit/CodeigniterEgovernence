<?php
if(isset($_POST["save5a"])){
	$hidden_value=clean($_POST["hidden_value"]);$post_office=clean($_POST["post_office"]);$is_implementaion=clean($_POST["is_implementaion"]);$is_owned=clean($_POST["is_owned"]);$area_sq_mtr=clean($_POST["area_sq_mtr"]);$area_project=clean($_POST["area_project"]);$location=clean($_POST["location"]);
	
	if(!empty($_POST["act"])) $act=json_encode($_POST["act"]);else $act=NULL;		
	if(!empty($_POST["provisional"])) $provisional=json_encode($_POST["provisional"]);else $provisional=NULL;
	if(!empty($_POST["permanent"])) $permanent=json_encode($_POST["permanent"]);else $permanent=NULL;
	if(!empty($_POST["indus"])) $indus=json_encode($_POST["indus"]);else $indus=NULL;
	if(!empty($_POST["consultant"])) $consultant=json_encode($_POST["consultant"]);else $consultant=NULL;
	if(!empty($_POST["organization"])) $organization=json_encode($_POST["organization"]);else $organization=NULL;
	if(!empty($_POST["detail_l"])) $detail_l=json_encode($_POST["detail_l"]);else $organization=NULL;
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form5(user_id,post_office,act,provisional,permanent,indus,consultant,organization,is_implementaion,is_owned,area_sq_mtr,area_project,location,detail_l) values('$swr_id','$post_office','$act','$provisional','$permanent','$indus','$consultant','$organization','$is_implementaion','$is_owned','$area_sq_mtr','$area_project','$location','$detail_l')")OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
		//$k=$dic->query("delete from dic_form5_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$dic->query("INSERT INTO dic_form5_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin,pan) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin','$pan')") or die("Error".$dic->error);
			}
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5 SET  sub_date='$today', post_office='$post_office',act='$act',provisional='$provisional',permanent='$permanent',indus='$indus',consultant='$consultant',organization='$organization',is_implementaion='$is_implementaion',is_owned='$is_owned',area_sq_mtr='$area_sq_mtr',area_project='$area_project',location='$location',detail_l='$detail_l' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
		for($i=1;$i<=$hidden_value;$i++){ 
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$dic->query("update dic_form5_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin',pan='$pan' where form_id='$form_id' and sl_no='$i'") or die("Error".$dic->error);
		}
	}	
	if($query)
		{
			$formFunctions->insert_incomplete_forms('dic','5'); //dic-- dept name and 5 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form5.php?tab=2';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form5.php';
			</script>";
		}
}
if(isset($_POST["save5b"])){
	$no_purchase_deed=clean($_POST["no_purchase_deed"]);$reg_purchase_deed=clean($_POST["reg_purchase_deed"]);$premium=clean($_POST["premium"]);$date_possesion=clean($_POST["date_possesion"]);$lease_duration=clean($_POST["lease_duration"]);$start_date_civconstruct=clean($_POST["start_date_civconstruct"]);$end_date_civconstruct=clean($_POST["end_date_civconstruct"]);$tot_area_underconstruct=clean($_POST["tot_area_underconstruct"]);$tot_cost_construct=clean($_POST["tot_cost_construct"]);$cost_manufacturing=clean($_POST["cost_manufacturing"]);$agency_area_covered=clean($_POST["agency_area_covered"]);$agency_annual_rent=clean($_POST["agency_annual_rent"]);$agency_regnum=clean($_POST["agency_regnum"]);$agency_regdate=clean($_POST["agency_regdate"]);$agency_loc=clean($_POST["agency_loc"]);$agency_lease_period=clean($_POST["agency_lease_period"]);$capital_invest_total=clean($_POST["capital_invest_total"]);
	
	if(!empty($_POST["reg_auth"])) $reg_auth=json_encode($_POST["reg_auth"]);else $reg_auth=NULL;
	if(!empty($_POST["owner"])) $owner=json_encode($_POST["owner"]);else $owner=NULL;		
	if(!empty($_POST["rent_auth"])) $rent_auth=json_encode($_POST["rent_auth"]);else $rent_auth=NULL;		
	if(!empty($_POST["agency"])) $agency=json_encode($_POST["agency"]);else $agency=NULL;		
	if(!empty($_POST["capital_invest"])) $capital_invest=json_encode($_POST["capital_invest"]);else $capital_invest=NULL;		
	
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form5(user_id,owner,no_purchase_deed,reg_purchase_deed,reg_auth,premium,date_possesion,lease_duration,start_date_civconstruct,end_date_civconstruct,tot_area_underconstruct,tot_cost_construct,cost_manufacturing,agency,agency_area_covered,agency_annual_rent,agency_regnum,agency_regdate,rent_auth,agency_loc,agency_lease_period,capital_invest,capital_invest_total) values('$swr_id','$owner','$no_purchase_deed','$reg_purchase_deed','$reg_auth','$premium','$date_possesion','$lease_duration','$start_date_civconstruct','$end_date_civconstruct','$tot_area_underconstruct','$tot_cost_construct','$cost_manufacturing','$agency','$agency_area_covered','$agency_annual_rent','$agency_regnum','$agency_regdate','$rent_auth','$agency_loc','$agency_lease_period','$capital_invest','$capital_invest_total')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5 SET  sub_date='$today', owner='$owner',no_purchase_deed='$no_purchase_deed',reg_purchase_deed='$reg_purchase_deed',reg_auth='$reg_auth',premium='$premium',date_possesion='$date_possesion',lease_duration='$lease_duration',start_date_civconstruct='$start_date_civconstruct',end_date_civconstruct='$end_date_civconstruct',tot_area_underconstruct='$tot_area_underconstruct',tot_cost_construct='$tot_cost_construct',cost_manufacturing='$cost_manufacturing',agency='$agency',agency_area_covered='$agency_area_covered',agency_annual_rent='$agency_annual_rent',agency_regnum='$agency_regnum',agency_regdate='$agency_regdate',rent_auth='$rent_auth',agency_loc='$agency_loc',agency_lease_period='$agency_lease_period',capital_invest='$capital_invest',capital_invest_total='$capital_invest_total' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
		{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form5.php?tab=3';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form5.php?tab=2';
			</script>";
		}
}
if(isset($_POST["save5c"])){
	$sources_f_finance_total=clean($_POST["sources_f_finance_total"]);$pow_line_expen=clean($_POST["pow_line_expen"]);$dg_details=clean($_POST["dg_details"]);$dg_make=clean($_POST["dg_make"]);$dg_rating=clean($_POST["dg_rating"]);$cost_of_dgset=clean($_POST["cost_of_dgset"]);$installation_date=clean($_POST["installation_date"]);$date_comm_prod=clean($_POST["date_comm_prod"]);
	
	if(!empty($_POST["sources_f_finance"])) $sources_f_finance=json_encode($_POST["sources_f_finance"]);else $sources_f_finance=NULL;		
	if(!empty($_POST["financial_details"])) $financial_details=json_encode($_POST["financial_details"]);else $financial_details=NULL;
	if(!empty($_POST["details_f_power"])) $details_f_power=json_encode($_POST["details_f_power"]);else $details_f_power=NULL;
	if(!empty($_POST["aseb"])) $aseb=json_encode($_POST["aseb"]);else $aseb=NULL;
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form5(user_id,sources_f_finance,sources_f_finance_total,financial_details,details_f_power,aseb,pow_line_expen,dg_details,dg_make,dg_rating,cost_of_dgset,installation_date,date_comm_prod) values('$swr_id','$sources_f_finance','$sources_f_finance_total','$financial_details','$details_f_power','$aseb','$pow_line_expen','$dg_details','$dg_make','$dg_rating','$cost_of_dgset','$installation_date','$date_comm_prod')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5 SET  sub_date='$today', sources_f_finance='$sources_f_finance',sources_f_finance_total='$sources_f_finance_total',financial_details='$financial_details',details_f_power='$details_f_power',aseb='$aseb',pow_line_expen='$pow_line_expen',dg_details='$dg_details',dg_make='$dg_make',dg_rating='$dg_rating',cost_of_dgset='$cost_of_dgset',installation_date='$installation_date',date_comm_prod='$date_comm_prod' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query)
		{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form5.php?tab=3';
			</script>";
		}
}
if(isset($_POST["save5d"])){ 
	$details_prod=clean($_POST["details_prod"]);$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$total_assam=clean($_POST["total_assam"]);$total_outsiders=clean($_POST["total_outsiders"]);$gross_total=clean($_POST["gross_total"]);$gross_remarks=clean($_POST["gross_remarks"]);$utilized_mandays=clean($_POST["utilized_mandays"]);
	
	if(!empty($_POST["managerial"])) $managerial=json_encode($_POST["managerial"]);else $managerial=NULL;		
	if(!empty($_POST["supervisory"])) $supervisory=json_encode($_POST["supervisory"]);else $supervisory=NULL;
	if(!empty($_POST["skilled"])) $skilled=json_encode($_POST["skilled"]);else $skilled=NULL;
	if(!empty($_POST["semi_skilled"])) $semi_skilled=json_encode($_POST["semi_skilled"]);else $semi_skilled=NULL;
	if(!empty($_POST["unskilled"])) $unskilled=json_encode($_POST["unskilled"]);else $unskilled=NULL;
	
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form5(user_id,details_prod,managerial,supervisory,skilled,semi_skilled,unskilled,total_assam,total_outsiders,gross_total,gross_remarks,utilized_mandays) values('$swr_id','$details_prod','$managerial','$supervisory','$skilled','$semi_skilled','$unskilled','$total_assam','$total_outsiders','$gross_total','$gross_remarks','$utilized_mandays')")OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5 SET  sub_date='$today', details_prod='$details_prod',managerial='$managerial',supervisory='$supervisory',skilled='$skilled',semi_skilled='$semi_skilled',unskilled='$unskilled',total_assam='$total_assam',total_outsiders='$total_outsiders',gross_total='$gross_total',gross_remarks='$gross_remarks',utilized_mandays='$utilized_mandays' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query){
		if($input_size1!=0){					
		$k=$dic->query("delete from dic_form5_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$dic->query("INSERT INTO dic_form5_t1(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size2!=0){					
		$k=$dic->query("delete from dic_form5_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$part2=$dic->query("INSERT INTO dic_form5_t2(id,form_id,slno,items,annual_quantity,annual_rupees,utlised_quantity,utlised_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
		$k=$dic->query("delete from dic_form5_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$dic->query("INSERT INTO dic_form5_t3(id,form_id,slno,item,source,name,address) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
		$k=$dic->query("delete from dic_form5_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];			
				$valf=$_POST["txttF".$i];				
				$valg=$_POST["txttG".$i];				
				$part4=$dic->query("INSERT INTO dic_form5_t4(id,form_id,slno,item,within_assam_quantity,within_assam_rupees,outside_assam_quantity,outside_assam_rupees,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size5!=0){					
		$k=$dic->query("delete from dic_form5_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];				
				$part4=$dic->query("INSERT INTO dic_form5_t5(id,form_id,slno,name,quantity) VALUES ('','$form_id','$i','$valb','$valc')") or die($dic->error);
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form4.php?tab=4';
			</script>";
		}else if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=5';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form5.php?tab=3';
		   </script>";
	   }	
}
if(isset($_POST["proceed5"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form5_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form5.php?tab=4';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
		}
	}
}
if(isset($_POST["save7a"])){
	$manufac_service=clean($_POST["manufac_service"]);$post_office=clean($_POST["post_office"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	if(!empty($_POST["partner_address"])) $partner_address=json_encode($_POST["partner_address"]);else $partner_address=NULL;
	$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form7(user_id,post_office,office_address,partner_address,manufac_service) values('$swr_id','$post_office','$office_address','$partner_address','$manufac_service')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form7 SET  sub_date='$today', post_office='$post_office',office_address='$office_address',partner_address='$partner_address',manufac_service='$manufac_service' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
			{
				$formFunctions->insert_incomplete_forms('dic','7'); //dic-- dept name and 1 -- form no
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'dic_form7.php?tab=2';
				</script>";
			}
			else
			{
				echo "<script>
					alert('Invalid Entry');
					window.location.href = 'dic_form7.php';
				</script>";
			}
}
if(isset($_POST["save7b"])){
	$mandtory_cert=clean($_POST["mandtory_cert"]);$registration_no=clean($_POST["registration_no"]);$total=clean($_POST["total"]);
		
	if(!empty($_POST["new_unit"])) $new_unit=json_encode($_POST["new_unit"]);else $new_unit=NULL;
	if(!empty($_POST["exist_unit"])) $exist_unit=json_encode($_POST["exist_unit"]);else $exist_unit=NULL;		
	if(!empty($_POST["Land"])) $Land=json_encode($_POST["Land"]);else $Land=NULL	;
	if(!empty($_POST["site"])) $site=json_encode($_POST["site"]);else $site=NULL	;
	if(!empty($_POST["off_building"])) $off_building=json_encode($_POST["off_building"]);else $off_building=NULL	;
	if(!empty($_POST["fac_building"])) $fac_building=json_encode($_POST["fac_building"]);else $fac_building=NULL	;
	if(!empty($_POST["plant_item"])) $plant_item=json_encode($_POST["plant_item"]);else $plant_item=NULL	;
	if(!empty($_POST["elec_ins"])) $elec_ins=json_encode($_POST["elec_ins"]);else $elec_ins=NULL	;
	if(!empty($_POST["operative"])) $operative=json_encode($_POST["operative"]);else $operative=NULL	;
	if(!empty($_POST["fixed_asset"])) $fixed_asset=json_encode($_POST["fixed_asset"]);else $fixed_asset=NULL	;
	if(!empty($_POST["total_invest"])) $total_invest=json_encode($_POST["total_invest"]);else $total_invest=NULL	;
	if(!empty($_POST["soruces"])) $soruces=json_encode($_POST["soruces"]);else $soruces=NULL	;
	
	$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form7(user_id,new_unit,exist_unit,mandtory_cert,registration_no,Land,site,off_building,fac_building,plant_item,elec_ins,operative,fixed_asset,total_invest,soruces,total) values('$swr_id','$new_unit','$exist_unit','$mandtory_cert','$registration_no','$Land','$site','$off_building','$fac_building','$plant_item','$elec_ins','$operative','$fixed_asset','$total_invest','$soruces','$total')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form7 SET  sub_date='$today',new_unit='$new_unit', exist_unit='$exist_unit',mandtory_cert='$mandtory_cert',Land='$Land',registration_no='$registration_no',site='$site',off_building='$off_building',fac_building='$fac_building',plant_item='$plant_item',elec_ins='$elec_ins',operative='$operative',fixed_asset='$fixed_asset',total_invest='$total_invest',soruces='$soruces',total='$total' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
		{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form7.php?tab=3';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form3.php?tab=2';
			</script>";
		}
}
if(isset($_POST["save7c"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
	$ownland_area=clean($_POST["ownland_area"]);$purchase_dt=clean($_POST["purchase_dt"]);$dt_of_reg=clean($_POST["dt_of_reg"]);$is_building=clean($_POST["is_building"]);$built_up_area=clean($_POST["built_up_area"]);$statement=clean($_POST["statement"]);
		
	if(!empty($_POST["power_a"])) $power_a=json_encode($_POST["power_a"]);else $power_a=NULL;
	if(!empty($_POST["under_expan"])) $under_expan=json_encode($_POST["under_expan"]);else $under_expan=NULL;		
	if(!empty($_POST["land_alloted"])) $land_alloted=json_encode($_POST["land_alloted"]);else $land_alloted=NULL	;
	if(!empty($_POST["lease_land"])) $lease_land=json_encode($_POST["lease_land"]);else $lease_land=NULL	;
	
	
	$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form7(user_id,power_a,under_expan,ownland_area,purchase_dt,dt_of_reg,land_alloted,lease_land,is_building,built_up_area,statement,operative,fixed_asset,total_invest,soruces,total) values('$swr_id','$power_a','$under_expan','$ownland_area','$purchase_dt','$dt_of_reg','$land_alloted','$lease_land','$is_building','$built_up_area','$statement','$operative','$fixed_asset','$total_invest','$soruces','$total')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form7 SET  sub_date='$today',power_a='$power_a', under_expan='$under_expan',ownland_area='$ownland_area',purchase_dt='$purchase_dt',dt_of_reg='$dt_of_reg',land_alloted='$land_alloted',lease_land='$lease_land',is_building='$is_building',built_up_area='$built_up_area',statement='$statement' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size1!=0){					
		$k=$dic->query("delete from dic_form7_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$dic->query("INSERT INTO dic_form7_t1(id,form_id,bank_name,amount_of_term,letter_no,loan_disbursed) VALUES ('','$form_id','$vala','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if($input_size2!=0){					
		$k=$dic->query("delete from dic_form7_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$part2=$dic->query("INSERT INTO dic_form7_t2(id,form_id,name,amount,pan_no,payment_mode) VALUES ('','$form_id','$vala','$valb','$valc','$vald')") or die($dic->error);
				//$part4=$dic->query("INSERT INTO dic_form7_t2 VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
		$k=$dic->query("delete from dic_form7_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$part3=$dic->query("INSERT INTO dic_form7_t3(id,form_id,name,amount,pan_no,payment_mode) VALUES ('','$form_id','$vala','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form7.php?tab=3';
		   </script>";
	   }	
}
if(isset($_POST["submit7"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) ||  (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') ||  (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3')){
		echo "<script>
					alert('Error in file / You didnot select any option.');
					window.location.href = 'dic_form7.php?tab=4';
				</script>";
	}else {
		 $file1=clean($_POST["mfile1"]);
		
		$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'dic_form7.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$dic->query("update dic_form7 set file1='$file1' where form_id='$form_id'") or die($dic->error);
		}		
		if($savequery){
			$formFunctions->file_update($file1);
			
			if($file1=="SC"){
				$save_query=$dic->query("update dic_form7 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}else{
				$save_query=$dic->query("update dic_form7 set sub_date='$today', courier_details='' where form_id='$form_id'") or die($dic->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form7.php?tab=4';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='dic_form7.php?tab=4';
			</script>";
		}
	}
}
if(isset($_POST["proceed7"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','7');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form7 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form7_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form7.php?tab=4';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
		}
	}
}
if(isset($_POST["save8a"])){
	$claim_period_form=clean($_POST["claim_period_form"]);$claim_period_to=clean($_POST["claim_period_to"]);$promoters_name=clean($_POST["promoters_name"]);$item_of_product=clean($_POST["item_of_product"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	if(!empty($_POST["promoters_address"])) $promoters_address=json_encode($_POST["promoters_address"]);else $promoters_address=NULL;
	$sql=$dic->query("select form_id from dic_form8 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form8(user_id,office_address,claim_period_form,claim_period_to,promoters_name,promoters_address,item_of_product) values('$swr_id','$office_address','$claim_period_form','$claim_period_to','$promoters_name','$promoters_address','$item_of_product')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form8 SET  sub_date='$today', office_address='$office_address',claim_period_form='$claim_period_form',claim_period_to='$claim_period_to',promoters_name='$promoters_name',promoters_address='$promoters_address',item_of_product='$item_of_product' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
			{
				$formFunctions->insert_incomplete_forms('dic','8'); //dic-- dept name and 8 -- form no
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'dic_form8.php?tab=2';
				</script>";
			}
			else
			{
				echo "<script>
					alert('Invalid Entry');
					window.location.href = 'dic_form8.php';
				</script>";
			}
}
if(isset($_POST["save8b"])){
	$date_of_comm=clean($_POST["date_of_comm"]);$date_of_service=clean($_POST["date_of_service"]);$cert_no=clean($_POST["cert_no"]);$cert_date=clean($_POST["cert_date"]);$period_from=clean($_POST["period_from"]);$period_to=clean($_POST["period_to"]);$period_to=clean($_POST["period_to"]);$mothly_statement=clean($_POST["mothly_statement"]);$percentage_of_increase=clean($_POST["percentage_of_increase"]);
	if(!empty($_POST["new_unit"])) $new_unit=json_encode($_POST["new_unit"]);else $new_unit=NULL;		
	if(!empty($_POST["exist_unit"])) $exist_unit=json_encode($_POST["exist_unit"]);else $exist_unit=NULL;
	$sql=$dic->query("select form_id from dic_form8 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		if($mothly_statement=="SC"){
			$query=$dic->query("insert into dic_form8(user_id,sub_date,courier_details,date_of_comm,date_of_service,cert_no,cert_date,period_from,period_to,new_unit,exist_unit,mothly_statement,percentage_of_increase) values('$swr_id','$today','1','$date_of_comm','$date_of_service','$cert_no','$cert_date','$period_from','$period_to','$new_unit','$exist_unit','$mothly_statement','$percentage_of_increase')")OR die("Error: ".$dic->error);
		}else{
			$query=$dic->query("insert into dic_form8(user_id,sub_date,received_date,date_of_comm,date_of_service,cert_no,cert_date,period_from,period_to,new_unit,exist_unit,mothly_statement,percentage_of_increase) values('$swr_id','$today','$today','$date_of_comm','$date_of_service','$cert_no','$cert_date','$period_from','$period_to','$new_unit','$exist_unit','$mothly_statement','$percentage_of_increase')")OR die("Error: ".$dic->error);
		}
		$form_id=$dic->insert_id;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		if($mothly_statement=="SC"){
			$query=$dic->query("UPDATE dic_form8 SET  sub_date='$today',courier_details='1',date_of_comm='$date_of_comm',date_of_service='$date_of_service',cert_no='$cert_no',cert_date='$cert_date',period_from='$period_from',period_to='$period_to',new_unit='$new_unit',exist_unit='$exist_unit',mothly_statement='$mothly_statement',percentage_of_increase='$percentage_of_increase' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
		}else{
			$query=$dic->query("UPDATE dic_form8 SET  sub_date='$today',received_date='$today' , date_of_comm='$date_of_comm',date_of_service='$date_of_service',cert_no='$cert_no',cert_date='$cert_date',period_from='$period_from',period_to='$period_to',new_unit='$new_unit',exist_unit='$exist_unit',mothly_statement='$mothly_statement',percentage_of_increase='$percentage_of_increase' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);
		}
	}
	if($query)
		{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=8';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form8.php?tab=2';
			</script>";
		}
}
if(isset($_POST["proceed8"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form8 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form8.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','8');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form8 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=8';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form8_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form8.php?tab=2';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
				</script>";
		}
	}
}
if(isset($_POST["save9a"])){
	$hidden_value=clean($_POST["hidden_value"]);$input_size1=clean($_POST["hiddenval"]);$post_office=clean($_POST["post_office"]);$reg_no=clean($_POST["reg_no"]);$reg_date=clean($_POST["reg_date"]);$investment=clean($_POST["investment"]);$total_invest=clean($_POST["total_invest"]);$plant_machinery=clean($_POST["plant_machinery"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form9(user_id,post_office,office_address,reg_no,reg_date,investment,total_invest,plant_machinery) values('$swr_id','$post_office','$office_address','$reg_no','$reg_date','$investment','$total_invest','$plant_machinery')")OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
		for($i=1;$i<=$hidden_value;$i++){
			$partner_name=$_POST["partner_name".$i.""];$partner_address=$_POST["partner_address".$i.""];$partner_pan_no=$_POST["partner_pan_no".$i.""];
			$query1=$dic->query("INSERT INTO dic_form9_partners(id,form_id,sl_no,partner_name,partner_address,partner_pan_no) VALUES ('','$form_id','$i','$partner_name','$partner_address','$partner_pan_no')") or die("error in insertion dic_form9_partners".$dic->error);
		}
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', post_office='$post_office',office_address='$office_address',reg_no='$reg_no',reg_date='$reg_date',investment='$investment',total_invest='$total_invest',plant_machinery='$plant_machinery' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);
		for($i=1;$i<=$hidden_value;$i++){
			$partner_name=$_POST["partner_name".$i.""];$partner_address=$_POST["partner_address".$i.""];$partner_pan_no=$_POST["partner_pan_no".$i.""];
			$query1=$dic->query("update dic_form9_partners set partner_name='$partner_name',partner_address='$partner_address',partner_pan_no='$partner_pan_no' where form_id='$form_id' and sl_no='$i'") or die("error in insertion dic_form9_partners".$dic->error);
		}
	}
	if($query){
		$formFunctions->insert_incomplete_forms('dic','9'); //dic-- dept name and 8 -- form no
		if($input_size1!=0){					
			$k=$dic->query("delete from dic_form9_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$dic->query("INSERT INTO dic_form9_t1(id,form_id,sl_no,bank_name,amount_of_term,working_capital,working_capital_limit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}		
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=1';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=1';
		   </script>";
	   }	
}
if(isset($_POST["save9b"])){
	$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$s1=clean($_POST["s1"]);$reg_details=clean($_POST["reg_details"]);$date_of_production=clean($_POST["date_of_production"]);$other_incentives=clean($_POST["other_incentives"]);$total_amount=clean($_POST["total_amount"]);$transport_regno=clean($_POST["transport_regno"]);$period_of_val=clean($_POST["period_of_val"]);
	if(!empty($_POST["pmt_reg"])) $pmt_reg=json_encode($_POST["pmt_reg"]);else $pmt_reg=NULL;		
	if(!empty($_POST["under_neipp"])) $under_neipp=json_encode($_POST["under_neipp"]);else $under_neipp=NULL;
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form9(user_id,s1,reg_details,pmt_reg,date_of_production,other_incentives,under_neipp,total_amount,total_year,transport_regno,period_of_val) values('$swr_id','$s1','$reg_details','$pmt_reg','$date_of_production','$other_incentives','$under_neipp','$total_amount','$total_year','$transport_regno','$period_of_val')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', s1='$s1',reg_details='$reg_details',pmt_reg='$pmt_reg',date_of_production='$date_of_production',other_incentives='$other_incentives',under_neipp='$under_neipp',total_amount='$total_amount',total_year='$total_year',transport_regno='$transport_regno',period_of_val='$period_of_val' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size2!=0){					
			$k=$dic->query("delete from dic_form9_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$part2=$dic->query("INSERT INTO dic_form9_t2(id,form_id,sl_no,incentive_name,amount,year) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
			$k=$dic->query("delete from dic_form9_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$dic->query("INSERT INTO dic_form9_t3(id,form_id,sl_no,item_name,ins_cap,value,capacity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
			$k=$dic->query("delete from dic_form9_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];				
				$part4=$dic->query("INSERT INTO dic_form9_t4(id,form_id,sl_no,raw_material,annual_req,value,joint_capacity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
		
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
		
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=2';
		   </script>";
	   }	
}
if(isset($_POST["save9c"])){
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$no_of_employee=clean($_POST["no_of_employee"]);$emp_under_contractor=clean($_POST["emp_under_contractor"]);$tan_n_unit=clean($_POST["tan_n_unit"]);$central_excise=clean($_POST["central_excise"]);$vat_reg=clean($_POST["vat_reg"]);$dist_f_focal=clean($_POST["dist_f_focal"]);$dist_f_rstation=clean($_POST["dist_f_rstation"]);$product_ext_from=clean($_POST["product_ext_from"]);
	if(!empty($_POST["power"])) $power=json_encode($_POST["power"]);else $power=NULL;		
	if(!empty($_POST["claim"])) $claim=json_encode($_POST["claim"]);else $claim=NULL;
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form8(user_id,no_of_employee,emp_under_contractor,tan_n_unit,central_excise,vat_reg,power,claim,dist_f_focal,dist_f_rstation,product_ext_from) values('$swr_id','$no_of_employee','$emp_under_contractor','$tan_n_unit','$central_excise','$vat_reg','$power','$claim','$dist_f_focal','$dist_f_rstation','$product_ext_from')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', no_of_employee='$no_of_employee',emp_under_contractor='$emp_under_contractor',tan_n_unit='$tan_n_unit',central_excise='$central_excise',vat_reg='$vat_reg',power='$power',claim='$claim',dist_f_focal='$dist_f_focal',dist_f_rstation='$dist_f_rstation',product_ext_from='$product_ext_from' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size5!=0){					
			$k=$dic->query("delete from dic_form9_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$part5=$dic->query("INSERT INTO dic_form9_t5(id,form_id,sl_no,item,date,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if($input_size6!=0){					
			$k=$dic->query("delete from dic_form9_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$valf=$_POST["txxtF".$i];				
				$part6=$dic->query("INSERT INTO dic_form9_t6(id,form_id,sl_no,raw_mat,qty,value,transport_charge,transport_charge_paid) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		if($input_size7!=0){					
			$k=$dic->query("delete from dic_form9_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$part7=$dic->query("INSERT INTO dic_form9_t7(id,form_id,sl_no,product_name,quantity,value,transport_charge,transport_charge_paid) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part6) && $part6==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part7) && $part7==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form9.php?tab=4';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=3';
		   </script>";
	   }	
			
}
if(isset($_POST["save9d"])){
	$input_size8=clean($_POST["hiddenval8"]);$input_size9=clean($_POST["hiddenval9"]);$input_size10=clean($_POST["hiddenval10"]);$input_size11=clean($_POST["hiddenval11"]);$unit_consumed=clean($_POST["unit_consumed"]);$dg_set_rating=clean($_POST["dg_set_rating"]);$diesel_consumed=clean($_POST["diesel_consumed"]);$dg_unit_consumed=clean($_POST["dg_unit_consumed"]);$total_elec_unit=clean($_POST["total_elec_unit"]);
	if(!empty($_POST["bank_details"])) $bank_details=json_encode($_POST["bank_details"]);else $bank_details=NULL;		
	
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form8(user_id,unit_consumed,dg_set_rating,diesel_consumed,dg_unit_consumed,total_elec_unit,bank_details) values('$swr_id','$unit_consumed','$dg_set_rating','$diesel_consumed','$dg_unit_consumed','$total_elec_unit','$bank_details')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', unit_consumed='$unit_consumed',dg_set_rating='$dg_set_rating',diesel_consumed='$diesel_consumed',promoters_address='$promoters_address',total_elec_unit='$total_elec_unit',bank_details='$bank_details' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size8!=0){					
			$k=$dic->query("delete from dic_form9_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];
				$part8=$dic->query("INSERT INTO dic_form9_t8(id,form_id,sl_no,raw_mat,outside_qty,utilized_qty,subsidy_amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size9!=0){					
			$k=$dic->query("delete from dic_form9_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];								
				$part9=$dic->query("INSERT INTO dic_form9_t9(id,form_id,sl_no,product_name,sold_qty,sold_during,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size10!=0){					
			$k=$dic->query("delete from dic_form9_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];				
				$part10=$dic->query("INSERT INTO dic_form9_t10(id,form_id,sl_no,raw_mat,within_ner_qty,utilized_qty,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size11!=0){					
			$k=$dic->query("delete from dic_form9_t11 where form_id='$form_id'");
			for($i=1;$i<$input_size11;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$dic->query("INSERT INTO dic_form9_t11(id,form_id,sl_no,product_name,sold_ner_qty,sold_during,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}	
		if(isset($part8) && $part8==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part9) && $part9==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part10) && $part10==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part11) && $part11==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else{
				echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.phh?token=9';
			</script>";
			}	
	}else{
			echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=4';
		   </script>";
	   }			
	
}
if(isset($_POST["proceed9"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form9_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form9.php?tab=2';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
				</script>";
		}
	}
}
if(isset($_POST["save10"])){
	$indus_land=clean($_POST["indus_land"]);$actual_area=clean($_POST["actual_area"]);$lic_no=clean($_POST["lic_no"]);	$lic_date=clean($_POST["lic_date"]);$item_name=clean($_POST["item_name"]);$production_capacity=clean($_POST["production_capacity"]);$prod_export=clean($_POST["prod_export"]);$civil_works=clean($_POST["civil_works"]);$plant_n_machinery=clean($_POST["plant_n_machinery"]);$other_fixed_assets=clean($_POST["other_fixed_assets"]);$actual_prod_area=clean($_POST["actual_prod_area"]);$godown=clean($_POST["godown"]);$other_services=clean($_POST["other_services"]);$power_req=clean($_POST["power_req"]);$water_req=clean($_POST["water_req"]);$if_any=clean($_POST["if_any"]);
	
	if($if_any=="Y") $PI_indicate=clean($_POST["PI_indicate"]);
			else $PI_indicate="";
	
	
	$sql=$dic->query("select form_id from dic_form10 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$dic->query("insert into dic_form10(user_id,indus_land,actual_area,lic_no,lic_date,item_name,production_capacity,prod_export,civil_works,plant_n_machinery,other_fixed_assets,actual_prod_area,godown,other_services,power_req,water_req,if_any,PI_indicate) values('$swr_id','$indus_land','$actual_area','$lic_no','$lic_date','$item_name','$production_capacity','$prod_export','$civil_works','$plant_n_machinery','$other_fixed_assets','$actual_prod_area','$godown','$other_services','$power_req','$water_req','$if_any','$PI_indicate')")OR die("Error: ".$dic->error);
		}else{
			$form_id=$row["form_id"];
			$query=$dic->query("UPDATE dic_form10 SET  sub_date='$today', indus_land='$indus_land',actual_area='$actual_area',lic_no='$lic_no',lic_date='$lic_date',item_name='$item_name',production_capacity='$production_capacity',prod_export='$prod_export',civil_works='$civil_works',plant_n_machinery='$plant_n_machinery',other_fixed_assets='$other_fixed_assets',actual_prod_area='$actual_prod_area',godown='$godown',other_services='$other_services',power_req='$power_req',water_req='$water_req',if_any='$if_any',PI_indicate='$PI_indicate' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
		}
		if($query)
				{
					$formFunctions->insert_incomplete_forms('dic','10'); //dic-- dept name and 1 -- form no
					echo "<script>
						alert('Successfully Saved..');
						window.location.href = 'dic_form10.php?tab=2';
					</script>";
				}
				else
				{
					echo "<script>
						alert('Invalid Entry');
						window.location.href = 'dic_form10.php';
					</script>";
				}
}
if(isset($_POST["submit10"])){
	if (empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile1"])=='2' || empty($_POST["mfile2"])=='2' || empty($_POST["mfile3"])=='2' || empty($_POST["mfile4"])=='2' || empty($_POST["mfile5"])=='2' || empty($_POST["mfile1"])=='3' || empty($_POST["mfile2"])=='3' || empty($_POST["mfile3"])=='3' || empty($_POST["mfile4"])=='3' || empty($_POST["mfile5"])=='3'){
		echo "<script>
					alert('Error in file / You didnot select any option.');
					window.location.href = 'dic_form10.php?tab=2';
				</script>";
	}else {
		 $file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		
		$sql=$dic->query("select form_id from dic_form10 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'dic_form10.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$dic->query("update dic_form10 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($dic->error);
		}		
		if($savequery){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
			
			if($file1=="SC" ||  $file2=="SC" ||  $file3=="SC" || $file4=="SC" ||  $file5=="SC"){
				$save_query=$dic->query("update dic_form10 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}else{
				$save_query=$dic->query("update dic_form10 set sub_date='$today', courier_details='' where form_id='$form_id'") or die($dic->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form10.php?tab=2';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='dic_form10.php?tab=2';
			</script>";
		}
	}
}
if(isset($_POST["proceed10"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form10 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form10.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form10 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form10_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form10.php?tab=2';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
		}
	}
}

?>
