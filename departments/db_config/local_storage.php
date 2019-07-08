<?php 

?>
<script type="text/javascript">

if (localStorage) {

	if(!localStorage.office_address || !localStorage.jurisdiction_parameter || !localStorage.area_rights || !localStorage.office_name){
		<?php 
		$form_names=$admin_fetch_functions->get_formNames($dept_id);

		$office_details=$admin_fetch_functions->getOfficeDetails($dept,$office_id);
		$office_name=$office_details->office_name;
		$office_street1=$office_details->street1;$office_street2=$office_details->street2;$office_city=$office_details->city;$office_district=$office_details->district;$office_pin=$office_details->pin;$office_mobile_no=$office_details->mobile_no;
		$office_address=$office_street1 ." ". $office_street2 . ", " .$office_city . ", " .$office_district . "-" . $office_pin . ", ASSAM" .", Contact - ".$office_mobile_no;

		switch($dept){
			case "gmc": $jurisdiction_parameter="ward";
						$area_rights=$office_details->jurisdiction;
			break;
			case "revenue": $jurisdiction_parameter="pincode";
							$area_rights=$office_details->jurisdiction;
			break;
			case "fcs": $jurisdiction_parameter="subdivision";
						$area_rights=$office_details->jurisdiction;
			break;
			/* case "fire": $jurisdiction_parameter="nearest_station";
						 $area_rights=$office_details->fire_station;
			break;
			case "power":   $jurisdiction_parameter="exist_con_no";
							$area_rights=$office_details->sub_division_id;
			break; */
			default :   $jurisdiction_parameter="dist";
						$area_rights=$office_details->jurisdiction;
			break;
		}	
			$form_names=json_encode($form_names,true);
			$store_area_rights=json_encode($area_rights,true);
		?>
		//localStorage.setItem('form_names', ''); 
		localStorage.setItem('jurisdiction_parameter', '<?php echo $jurisdiction_parameter;?>'); 
		localStorage.setItem('area_rights', '<?php echo $store_area_rights;?>'); 
		localStorage.setItem('office_name', '<?php echo $office_name;?>'); 
		localStorage.setItem('office_address', '<?php echo $office_address;?>'); 
		/* FETCH STORAGE DATA */
		
		//var form_names = localStorage.form_names;
		var jurisdiction_parameter = localStorage.jurisdiction_parameter;
		var area_rights = localStorage.area_rights;
		var office_name = localStorage.office_name;
		var office_address = localStorage.office_address;
		//alert(area_rights);
	}else{
		//var form_names = localStorage.form_names;
		var jurisdiction_parameter = localStorage.jurisdiction_parameter;
		var area_rights = localStorage.area_rights;
		var office_name = localStorage.office_name;
		var office_address = localStorage.office_address;
		//alert(area_rights);
	} 
}else{
	<?php 
	$form_names=$admin_fetch_functions->get_formNames($dept_id);

	$office_details=$admin_fetch_functions->getOfficeDetails($dept,$office_id);
	$office_name=$office_details->office_name;
	$office_street1=$office_details->street1;$office_street2=$office_details->street2;$office_city=$office_details->city;$office_district=$office_details->district;$office_pin=$office_details->pin;$office_mobile_no=$office_details->mobile_no;
	$office_address=$office_street1 ." ". $office_street2 . ", " .$office_city . ", " .$office_district . "-" . $office_pin . ", ASSAM" .", Contact - ".$office_mobile_no;

	switch($dept){
		case "gmc": $jurisdiction_parameter="ward";
					$area_rights=$office_details->jurisdiction;
		break;
		case "revenue": $jurisdiction_parameter="pincode";
						$area_rights=$office_details->jurisdiction;
		break;
		case "fcs": $jurisdiction_parameter="subdivision";
					$area_rights=$office_details->jurisdiction;
		break;
		/* case "fire": $jurisdiction_parameter="nearest_station";
					 $area_rights=$office_details->fire_station;
		break;
		case "power":   $jurisdiction_parameter="exist_con_no";
						$area_rights=$office_details->sub_division_id;
		break; */
		default :   $jurisdiction_parameter="dist";
					$area_rights=$office_details->jurisdiction;
		break;
	}	
		$form_names=json_encode($form_names,true);
		$store_area_rights=json_encode($area_rights,true);
	?>
	//var form_names = '';
	var jurisdiction_parameter = '<?=$jurisdiction_parameter;?>';
	var area_rights = '<?=$store_area_rights;?>';
	var office_name = '<?=$office_name;?>';
	var office_address = '<?=$office_address;?>';
}
</script>
<?php 
?>