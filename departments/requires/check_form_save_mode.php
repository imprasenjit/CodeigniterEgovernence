<?php 
$get_file_name=basename($_SERVER["PHP_SELF"]);

$check=$ci->Form_details_model->get_save_mode($dept,$form,$unit_id);

if($check==1){
	//27,13,14,11,3,7,25,6,8,10,12,26,15,16
	
	if(($dept=="cei" && ($form==3 || $form==6 || $form==7 || $form==8 || $form==10 || $form==11 || $form==12 || $form==13 || $form==14 || $form==15 || $form==16 || $form==25 || $form==26 || $form==27 || $form==28)) || ($dept=="sdc" && ($form==20 || $form==54 || $form==58)) || ($dept=="boiler" && ($form==1 || $form==2))){
		$show_edit="";
		$showtab="";
	}else{
		if($get_file_name!="acknowledgement.php"){
			echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept."';
		</script>";
		}		
	}		
}else if($check==2){
	if($get_file_name!="courier_details_new.php" && $get_file_name!="preview.php"){
			echo "<script>				
					window.location.href = '".$server_url."departments/requires/courier_details_new.php?form=".$form."&dept=".$dept."';
			</script>";
	}	
	
}else if($check==3){
	if($get_file_name!="payment_section.php" && $get_file_name!="preview.php"){
		echo "<script>				
				window.location.href = '".$server_url."departments/requires/payment_section.php?form=".$form."&dept=".$dept."';
		</script>";
	}	
}else{
	if($get_file_name=="payment_section.php" || $get_file_name=="courier_details_new.php" || $get_file_name=="courier_details.php"){
		echo "<script>				
				window.location.href = '".$server_url."user_area/incomplete_applications.php';
		</script>";
	}else{
		$show_edit="";
		$showtab="";
	}	
}
?>