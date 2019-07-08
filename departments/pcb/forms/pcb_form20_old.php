<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('pcb','20');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=20&dept=pcb';
		</script>";	
}
$get_file_name=basename(__FILE__);
include "save_sw_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

    $q=$formFunctions->executeQuery($dept,"select * from pcb_form20 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();
		if($q->num_rows<1) #################################Empty Form Details ################################	
		{	
			 ###########################PART A ###########################
			$population="";$area="";$loc_name="";$is_source="";$is_source_detail="";
			$name_city="";$name_state="";
			$local_sn1="";$local_sn2="";$local_v="";$local_d="";$local_p="";$local_m="";$local_pn="";$local_email="";
			$office_name="";$office_m_no="";$office_l_no="";$office_l_std="";$office_email="";
			$city_a="";$city_b="";$city_c="";
			$quantity_a="";$quantity_b="";$quantity_c="";$quantity_d="";$quantity_e="";$quantity_f="";
			$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";$solid_waste_d="";$solid_waste_e="";$solid_waste_f="";
			$is_stored_a="";$is_stored_b="";
			$is_door_a="";$is_door_b="";
			$waste_a="";$waste_b="";$waste_c="";$waste_d="";$waste_e="";$waste_f="";$waste_g="";$waste_h="";
			 ###########################END PART A ###########################
		}
		else #################################Not Empty Form Details ################################	
		{

			
			$form_id=$results['form_id'];
			 ###########################PART A ###########################
			$population=$results['population'];$loc_name=$results['loc_name'];$area=$results['area'];$is_source=$results['is_source'];$is_source_detail=$results['is_source_detail'];
			if(!empty($results["name"]))
			{
				$name=json_decode($results["name"]);
				$name_city=$name->city;$name_state=$name->state;
			}else{
				$name_city="";$name_state="";
			}
			if(!empty($results["local"]))
			{
				$local=json_decode($results["local"]);				
				$local_sn1=$local->sn1;$local_sn2=$local->sn2;$local_v=$local->v;$local_d=$local->d;$local_p=$local->p;$local_m=$local->m;$local_pn=$local->pn;$local_email=$local->email;
			}else{
				$local_sn1="";$local_sn2="";$local_v="";$local_d="";$local_p="";$local_m="";$local_pn="";$local_email="";
			}
			if(!empty($results["office"]))
			{
				$office=json_decode($results["office"]);
				$office_name=$office->name;$office_m_no=$office->m_no;$office_l_no=$office->l_no;$office_l_std=$office->l_std;$office_email=$office->email;
			}else{
				$office_name="";$office_m_no="";$office_l_no="";$office_l_std="";$office_email="";
			}
			if(!empty($results["city"]))
			{
				$city=json_decode($results["city"]);
				$city_a=$city->a;$city_b=$city->b;$city_c=$city->c;
			}else{
				$city_a="";$city_b="";$city_c="";
			}
			if(!empty($results["quantity"]))
			{
				$quantity=json_decode($results["quantity"]);	
				$quantity_a=$quantity->a;$quantity_b=$quantity->b;$quantity_c=$quantity->c;$quantity_d=$quantity->d;$quantity_e=$quantity->e;$quantity_f=$quantity->f;
			}else{
				$quantity_a="";$quantity_b="";$quantity_c="";$quantity_d="";$quantity_e="";$quantity_f="";
			}
			if(!empty($results["solid_waste"]))
			{
				$solid_waste=json_decode($results["solid_waste"]);	
				$solid_waste_a=$solid_waste->a;$solid_waste_b=$solid_waste->b;$solid_waste_c=$solid_waste->c;$solid_waste_d=$solid_waste->d;$solid_waste_e=$solid_waste->e;$solid_waste_f=$solid_waste->f;
			}else{
				$solid_waste_a="";$solid_waste_b="";$solid_waste_c="";$solid_waste_d="";$solid_waste_e="";$solid_waste_f="";
			}
			if(!empty($results["is_stored"]))
			{
				$is_stored=json_decode($results["is_stored"]);	
				$is_stored_a=$is_stored->a;$is_stored_b=$is_stored->b;
			}else{
				$is_stored_a="";$is_stored_b="";
			}
			if(!empty($results["is_door"]))
			{
				$is_door=json_decode($results["is_door"]);	
				$is_door_a=$is_door->a;$is_door_b=$is_door->b;
			}else{
				$is_door_a="";$is_door_b="";
			}
			if(!empty($results["waste"]))
			{
				$waste=json_decode($results["waste"]);	
				$waste_a=$waste->a;$waste_b=$waste->b;$waste_c=$waste->c;$waste_d=$waste->d;$waste_e=$waste->e;$waste_f=$waste->f;$waste_g=$waste->g;$waste_h=$waste->h;
			}else{
				$waste_a="";$waste_b="";$waste_c="";$waste_d="";$waste_e="";$waste_f="";$waste_g="";$waste_h="";
			}
			###########################END PART A ###########################
		}
		if(!empty($results["courier_details"])){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	}else{
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";
	}
	##PHP TAB management ends
?>
<!DOCTYPE html>
<html>  
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<strong><?php echo $form_name=$cms->query("select form_name from pcb_form_names where form_no='20'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								   <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PART II</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">PART III</a></li>
								  <li class="<?php echo $tabbtn4; ?>"><a data-toggle="tab" href="#table4">PART IV</a></li>
								  <li class="<?php echo $tabbtn5; ?>"><a data-toggle="tab" href="#table5">Upload Section</a></li>
								</ul>
								<br>
							<div class="tab-content">
                            <div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
                            <form name="myform1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td colspan="4">1. Name of the City/Town and State </td> 
									</tr>
									<tr>
										<td width="25%" >City/Town:  </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name[city]" value="<?php echo $name_city;?>"></td>
										<td width="25%">State:</td>										
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name[state]" value="<?php echo $name_state;?>"></td>										
									</tr>
									<tr>
										<td >2. Population </td> 
										<td><input type="text" class="form-control text-uppercase" name="population" value="<?php echo $population;?>"></td> 
										<td >3. Area in sq. kilomete </td> 
										<td><input type="text" class="form-control text-uppercase" name="area" value="<?php echo $area;?>"></td> 
									</tr>
									<tr>
										<td colspan="4">4. Name & Address of local body</td> 
									</tr>
									<tr>
										<td> Name </td> 
										<td><input type="text" class="form-control text-uppercase" name="loc_name" value="<?php echo $loc_name;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="local[sn1]" value="<?php echo $local_sn1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="local[sn2]"  value="<?php echo $local_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="local[v]" value="<?php echo $local_v;?>"></td>
										<td>District</td>
		                             <td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="local[d]" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($local_d) && ($local_d==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
		                            <td><input type="text" class="form-control text-uppercase" name="local[p]" value="<?php echo $local_p;?>" validate="pincode"></td>
										<td>Mobile</td>
		                            <td><input type="text" class="form-control text-uppercase" name="local[m]" value="<?php echo $local_m;?>" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td>Phone Number</td>
		                             <td><input type="text" class="form-control text-uppercase" name="local[pn]"value="<?php echo $local_pn;?>"></td>
										<td>Email-id</td>
		                             <td><input type="text" class="form-control text-uppercase" name="local[email]"value="<?php echo $local_email;?>"></td>
									</tr>
									<tr>
										<td colspan="4" >5. Name and address of operator of the facility:  </td>
									</tr>
									<tr>
										<td> Name </td> 
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php $unit_name?>" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php $b_street_name1?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php $b_street_name2?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php $b_vill?>"></td>
										<td>District</td>
		                             <td>
									 <input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php $b_dist?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
										<td>Mobile</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td>Phone Number</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_landline_std.'-'.$b_landline_no;?>"></td>
										<td>Email-id</td>
		                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Name of officer in-charge of the facility  </td>
									</tr>
									<tr>
										<td>Name:</td>
		                            <td><input type="text" class="form-control text-uppercase" name="office[name]" value="<?php echo $office_name;?>"></td>
										<td >Mobile No.:</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber"  name="office[m_no]"value="<?php echo $office_m_no;?>"></td>
									</tr>
									<tr>
										<td>Landline No.:  </td>
		                            <td class="form-inline"><input type="text" class="form-control text-uppercase" name="office[l_std]" validate="onlyNumbers" style="width:60px;" value="<?php  echo $office_l_std;?>">-<input type="text" class="form-control text-uppercase" style="width:180px;" name="office[l_no]" value="<?php  echo $office_l_no;?>"></td>
										<td >E-mail:</td>
										<td><input type="text" class="form-control text-uppercase" name="office[email]" value="<?php echo $office_email;?>"></td>
									</tr>
									<tr>
										<td>7. Number of households in the city/town:  </td>
		                            <td><input type="text" class="form-control text-uppercase" name="city[a]" value="<?php echo $city_a;?>"></td>
										<td >Number of non-residential premises in the city : </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="city[b]" value="<?php echo $city_b;?>">/tpd</td>
									</tr>
									<tr>
										<td >Number of election/ administrative wards in the city/town  </td>
										<td><input type="text" class="form-control text-uppercase" name="city[c]" value="<?php echo $city_c;?>"></td>
										<td> </td>
										<td></td>
									</tr>
									<tr>
										<td >8. Quantity of Solid waste : </td> 
										<td><input type="text" class="form-control text-uppercase" name="quantity[a]"value="<?php echo $quantity_a;?>"></td>
										<td >Estimated Quantity of solid waste generated in the local body area per day in metric tones </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="quantity[b]" value="<?php echo $quantity_b;?>">/tpd</td>
									</tr>
									<tr>
										<td >Quantity of solid waste collected per day  </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="quantity[c]" value="<?php echo $quantity_c;?>">/tpd</td>
										<td>Per capita waste collected per day</td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="quantity[d]">gm/day</td>
									</tr>
									<tr>
										<td >Quantity of solid waste processed   </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="quantity[e]" value="<?php echo $quantity_e;?>">/tpd</td>
										<td>Quantity of solid waste disposed at landfill </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="quantity[f]" value="<?php echo $quantity_f;?>">/tpd</td>
									</tr>
									<tr>
										<td >9. Status of Solid Waste Management (SWM) service  : </td> 
										<td><input type="text" class="form-control text-uppercase" name="solid_waste[a]" value="<?php echo $solid_waste_a;?>"></td>
										<td >Segregation and storage of waste at source: </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="solid_waste[b]" value="<?php echo $solid_waste_b;?>">/tpd</td>
									</tr>
									<tr>
										<td colspan="3">Whether  solid  waste  is  stored  at  source  in  domestic/commercial/institutional bins If yes,   </td>
										<td class="text-center">
										<label class="radio-inline"><input type="radio" name="is_source" value="Y"  <?php if(isset($is_source) && $is_source=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_source"  value="N"  <?php if(isset($is_source) && $is_source=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td ><textarea name="is_source_detail" class="form-control text-uppercase" validate="textarea" ><?php if(isset($is_source_detail)) echo $is_source_detail; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="3">Percentage  of  households  practice  storage  of  waste at  source  in domestic bins (%)  </td>
										<td ><input type="text" class="form-control text-uppercase" name="solid_waste[c]" value="<?php echo $solid_waste_c;?>"></td>
									</tr>
									<tr>
										<td colspan="3">Percentage  of  non-residential  premises  practice  storage  of  waste at source in commercial /institutional bins(%) </td>
										<td ><input type="text" class="form-control text-uppercase" name="solid_waste[d]" value="<?php echo $solid_waste_d;?>"></td>
									</tr>
									<tr>
										<td colspan="3">Percentage  of  households  dispose  of  throw  solid  waste  on  the streets (%)  </td>
										<td ><input type="text" class="form-control text-uppercase" name="solid_waste[e]" value="<?php echo $solid_waste_e;?>"></td>
									</tr>
									<tr>
										<td colspan="3">Percentage  of  non-residential  premises    dispose  of throw  solid waste on the streets  (%) </td>
										<td ><input type="text" class="form-control text-uppercase" name="solid_waste[f]" value="<?php echo $solid_waste_f;?>"></td>
									</tr>
									<tr>
										<td> Whether solid waste is stored at source in a segregated form   </td>
										<td class="text-center"><label class="radio-inline"><input type="radio" name="is_stored[a]" value="Y"  <?php if(isset($is_stored_a) && $is_stored_a=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_stored[a]"  value="N"  <?php if(isset($is_stored_a) && $is_stored_a=='N') echo 'checked'; ?>/> No</label></td>
										<td>If yes, Percentage of premises segregating the waste at source (%) </td>
										<td ><textarea name="is_stored[b]" class="form-control text-uppercase" validate="textarea" ><?php if(isset($is_stored_b)) echo $is_stored_b; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="4">10. Door to Door Collection of solid waste   </td>
									</tr>
									<tr>
										<td> Whether  door  to  door  collection  (D2D)  of  solid  waste  is  being done in the city/town      </td>
										<td class="text-center"><label class="radio-inline"><input type="radio" name="is_door[a]" value="Y"  <?php if(isset($is_door_a) && $is_door_a=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_door[a]"  value="N"  <?php if(isset($is_door_a) && $is_door_a=='N') echo 'checked'; ?>/> No</label></td>
										<td>If yes </td>
										<td ><textarea name="is_door[b]"  class="form-control text-uppercase" validate="textarea" ><?php if(isset($is_door_a)) echo $is_door_b; ?></textarea></td>
									</tr>
									<tr>
										<td> Number of wards covered in D2D collection of waste</td>
										<td ><input type="text" class="form-control text-uppercase" name="waste[a]"value="<?php echo $waste_a;?>"></td>
										<td>No. of households covered</td>
										<td ><input type="text" class="form-control text-uppercase" name="waste[b]"value="<?php echo $waste_b;?>" ></td>
									</tr>
									<tr>
										<td colspan="3"> No. of non-residential premises including commercial establishments   ,hotels,   restaurants      educational   institutions/offices etc covered </td>
										<td ><input type="text" class="form-control text-uppercase" name="waste[c]"value="<?php echo $waste_c;?>"></td>
									</tr>
									<tr>
										<td colspan="3">Percentage  of residential  and  non-residential  premises covered in door to door collection through(%) : </td>
										<td ><input type="text" class="form-control text-uppercase" name="waste[d]"value="<?php echo $waste_d;?>"></td>
									</tr>
									<tr>
										<td> Motorized vehicle (%):</td>
										<td ><input type="text" class="form-control text-uppercase" name="waste[e]"value="<?php echo $waste_e;?>"></td>
										<td>Containerized tricycle/handcart (%) : </td>
										<td ><input type="text" class="form-control text-uppercase" name="waste[f]"value="<?php echo $waste_f;?>"></td>
									</tr>
									<tr>
										<td> Other device  :</td>
										<td ><input type="text" class="form-control text-uppercase"name="waste[g]" value="<?php echo $waste_g;?>"></td>
										<td> If not, method of primary collection adopte:</td>
										<td ><input type="text" class="form-control text-uppercase"name="waste[h]" value="<?php echo $waste_h;?>"></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success"  name="save20a" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button> 
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
                            <form name="myform2"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td colspan="4">Sweeping of streets </td> 
									</tr>
									<tr>
										<td colspan="3">Length  of  roads,  streets,  lanes,  bye-lanes  in  the  city  that  need  to be cleaned (km) :  </td> 
										<td ><input type="text" class="dob form-control text-uppercase" name="streets[a]" ></td>									
									</tr>
									<tr>
										<td colspan="4">Frequency   of   street   sweepings   and   percentage   of   population covere 
										<table class="table table-responsive">
											<tr>
												<td></td>
												<td>Frequency </td>
												<td> % of population covered </td>
											</tr>
											<tr>
												<td> Daily</td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[a]"></td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[b]"></td>
											</tr>
											<tr>
												<td>Alternate day</td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[c]" > </td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[d]"></td>
											</tr>
											<tr>
												<td>Twice  a week</td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[e]"></td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[f]"></td>
											</tr>
											<tr>
												<td>Occasionally</td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[g]"></td>
												<td><input type="text" class="form-control text-uppercase" name="sweeping[h]"></td>
											</tr>
										</table></td> 
									</tr>
									<tr>
										<td width="25%">Tools used  </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="streets[b]" ></td> 
										<td width="25%">Manual sweeping (%) </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="streets[c]" ></td> 
									</tr>
									<tr>
										<td> Mechanical sweeping (%) </td> 
										<td><input type="text" class="form-control text-uppercase" name="streets[d]" ></td>
										<td>Whether long handle broom used by sanitation worker</td>
										<td><label class="radio-inline"><input type="radio" name="is_handle[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_handle[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>Whether  each  sanitation  worker  is  given  handcart/tricycle  for collection of waste </td>
										<td><label class="radio-inline"><input type="radio" name="is_handle[b]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_handle[b]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td>Whether handcart / tricycle is containerized  </td>
										<td><label class="radio-inline"><input type="radio" name="is_handle[c]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_handle[c]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>Whether  the  collection  tool  synchronizes  with  collection/waste storage containers utilized </td>
										<td><label class="radio-inline"><input type="radio" name="is_handle[d]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_handle[d]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td></td>
		                             <td></td>
									</tr>
									<tr>
										<td colspan="4"> Secondary Waste Storage facilities </td>
									</tr>
									<tr>
										<td colspan="4">No. and type of waste storage depots in the city/town
										<table class="table table-responsive" style="text-align:center;">
											<tr>
												<td> </td>
												<td>No.</td>
												<td>Capacity in m<sup>3</sup></td>
											</tr>
											<tr>
												<td>Open waste storage sites </td>
												<td><input type="text" class="form-control text-uppercase" name="waste_storage[a]"></td>
												<td><input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
											</tr>
											<tr>
												<td>Masonry bins </td>
												<td><input type="text" class="form-control text-uppercase"  name="waste_storage[a]"> </td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
											</tr>
											<tr>
												<td>Cement concrete cylinder bins </td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
											</tr>
											<tr>
												<td>Dhalao/covered rooms/space </td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
											</tr>
											<tr>
												<td>Covered metal/plastic containers  </td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
											</tr>
											<tr>
												<td>Upto 1.1 m<sup>3</sup> bins    </td>
												<td> <input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
												<td><input type="text" class="form-control text-uppercase"  name="waste_storage[a]"></td>
											</tr>
											<tr>
												<td>2 to 5 m<sup>3</sup> bins    </td>
												<td><input type="text" class="form-control text-uppercase" name="waste_storage[a]"> </td>
												<td><input type="text" class="form-control text-uppercase" name="waste_storage[a]"> </td>
											</tr>
											<tr>
												<td>Above 5m<sup>3</sup> containers   </td>
												<td> <input type="text" class="form-control text-uppercase" name="waste_storage[a]"></td>
												<td><input type="text" class="form-control text-uppercase" name="waste_storage[a]"> </td>
											</tr>
											<tr>
												<td>Bin-less city   </td>
												<td><input type="text" class="form-control text-uppercase" name="waste_storage[a]"> </td>
												<td><input type="text" class="form-control text-uppercase" name="waste_storage[a]"> </td>
											</tr>
										</table></td> 			
									</tr>
									<tr>
										<td>Bin/ population ratio </td>
		                            <td><input type="text" class="form-control text-uppercase" name="street[e]"></td>
										<td></td>
		                            <td></td>
									</tr>
									<tr>
										<td colspan="4" > Ward wise details of waste storage depots (attach) :  </td>
									</tr>
									<tr>
										<td>Ward No:  </td> 
										<td><input type="text" class="form-control text-uppercase" name="depots[ward_no]" ></td>
										<td>Area :</td>
										<td><input type="text" class="form-control text-uppercase" name="depots[area]" ></td>
									</tr>
									<tr>
										<td>Population : </td>
										<td><input type="text" class="form-control text-uppercase" name="depots[population]" ></td>
										<td>No. of bins placed  :</td>
										<td><input type="text" class="form-control text-uppercase" name="depots[no_bins]" ></td>
									</tr>
									<tr>
										<td>Total volume of bins placed :</td>
										<td><input type="text" class="form-control text-uppercase" name="depots[bins]" ></td>
										<td></td>
		                             <td></td>
									</tr>
									<tr>
										<td>Total storage capacity of waste storage facilities in cubic meters </td>
		                            <td><input type="text" class="form-control text-uppercase" name="depots[waste]"></td>
										<td>Total waste actually stored at the waste storage depots daily </td>
		                            <td><input type="text" class="form-control text-uppercase" name="depots[dalily]"></td>
									</tr>
									<tr>
										<td colspan="4">Give frequency of collection of waste from the depo Number of bins cleared 
										<table class="table table-responsive">
											<tr>
												<td></td>
												<td>Frequency </td>
												<td> % of population covered </td>
											</tr>
											<tr>
												<td> Daily</td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[a]"></td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[b]"></td>
											</tr>
											<tr>
												<td>Alternate day</td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[c]"></td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[d]"></td>
											</tr>
											<tr>
												<td>Twice  a week</td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[e]"></td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[f]"></td>
											</tr>
											<tr>
												<td>Occasionally</td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[g]"></td>
												<td><input type="text" class="form-control text-uppercase" name="num_bins[h]"></td>
											</tr>
										</table></td> 
									</tr>
									<tr>
										<td colspan="3"> Whether  storage  depots  have  facility  for  storage  of segregated waste in green, blue and black bin (if yes, add details)</td>
										<td><label class="radio-inline"><input type="radio" name="is_bin[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_bin[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label>
										</td>
									</tr>
									<tr>
										<td colspan="4">
										<div id="add_details">
										<table class="table table-responsive">
											<tr>
												<td>No. of green bins:</td>
												<td><input type="text" class="form-control text-uppercase" name="is_bin[b]"></td>
												<td >No. of blue bins:</td>
												<td><input type="text" class="form-control text-uppercase" name="is_bin[c]"></td>
											</tr>
											<tr>
												<td>No. of black bins:  </td>
												<td><input type="text" class="form-control text-uppercase" name="is_bin[d]"></td>
												<td >&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>
										</div></td>
									</tr>
									<tr>
										<td colspan="4">Whether  lifting  of  solid  waste  from  storage  depots is  manual  or mechanical. Give percentage </td>
									</tr>
									<tr>
										<td >(%)  of  Manual  Lifting of SOLID WASTE  : </td> 
										<td><input type="text" class="form-control text-uppercase" name="percentage[a]"></td>
										<td >(%) of Mechanical lifting  </td>
										<td ><input type="text" class="form-control text-uppercase" name="percentage[b]"></td>
									</tr>
									<tr>
										<td >If mechanical – specify the method used   </td>
										<td ><input type="text" class="form-control text-uppercase" name="percentage[c]"></td>
										<td>front-end loaders/ Top loaders </td>
										<td ><input type="text" class="form-control text-uppercase" name="percentage[d]"></td>
									</tr>
									<tr>
										<td colspan="3"> Whether solid waste is lifted from door to door and transported to treatment plant directly in a segregated form    </td>
										<td ><label class="radio-inline"><input type="radio" name="is_treatment[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="treatment[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td ><textarea name="treatment[c]" id="adq_system" class="form-control text-uppercase" validate="textarea" ><?php //if(isset($adq_system)) echo $adq_system; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="4">Waste Transportation per day : 
										<table class="table tabl-responsive">
											<tr>
												<td></td>
												<td>No.</td>
												<td>Trips made</td>
											</tr>
											<tr>
												<td>waste </td>
												<td><input type="text" class="form-control text-uppercase" name="per_day[a]"></td>
												<td><input type="text" class="form-control text-uppercase" name="per_day[b]"></td>
											</tr>
											<tr>
												<td>transported  </td>
												<td><input type="text" class="form-control text-uppercase" name="per_day[c]"></td>
												<td><input type="text" class="form-control text-uppercase" name="per_day[d]"></td>
											</tr>
										</table></td> 
									</tr>
									<tr>
										<td colspan="4">Type and Number of vehicles  </td>
									</tr>
									<tr>
										<td ><label class="checkbox-inline"><input type="checkbox"   name="vehicles[a]" value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />  Animal cart</label > </td>
										<td ><label class="checkbox-inline"><input type="checkbox"   name="vehicles[b]" value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Tractors</label> </td>
										<td> <label class="checkbox-inline"><input type="checkbox"   name="vehicles[c]" value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Non tipping Truck</label></td>
										<td ><label class="checkbox-inline"><input type="checkbox"  name="vehicles[d]" value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Tipping Truck </label></td>
									</tr>
									<tr>
										<td ><label class="checkbox-inline"><input type="checkbox"   name="vehicles[e]"value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Dumper Placers</label> </td>
										<td ><label class="checkbox-inline"><input type="checkbox"   name="vehicles[f]"value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Refuse collectors </label></td>
										<td><label class="checkbox-inline"><input type="checkbox"   name="vehicles[g]"value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Compactors </label> </td>
										<td ><label class="checkbox-inline"><input type="checkbox"  name="vehicles[h]" value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />JCB/loader  </label></td>
									</tr>
									<tr>
										<td><label class="checkbox-inline"><input type="checkbox"   name="vehicles[i]"value="A" <?php //if($org_type=="A") echo 'checked="checked"'; ?> />Other </label> </td>
										<td ><input type="text" class="form-control text-uppercase" name="vehicles[j]"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">Frequency of transportation of waste 
										<table class="table table-responsive">
											<tr>
												<td></td>
												<td>Frequency </td>
												<td> % of population covered </td>
											</tr>
											<tr>
												<td> Daily</td>
												<td><input type="text" class="form-control text-uppercase" name="transport[a]"></td>
												<td><input type="text" class="form-control text-uppercase" name="transport[b]"></td>
											</tr>
											<tr>
												<td>Alternate day</td>
												<td><input type="text" class="form-control text-uppercase" name="transport[c]" > </td>
												<td><input type="text" class="form-control text-uppercase" name="transport[d]"></td>
											</tr>
											<tr>
												<td>Twice  a week</td>
												<td><input type="text" class="form-control text-uppercase" name="transport[e]"></td>
												<td><input type="text" class="form-control text-uppercase" name="transport[f]"></td>
											</tr>
											<tr>
												<td>Occasionally</td>
												<td><input type="text" class="form-control text-uppercase" name="transport[g]"></td>
												<td><input type="text" class="form-control text-uppercase" name="transport[h]"></td>
											</tr>
										</table></td> 
									</tr>
									<tr>
										<td colspan="4" class="text-center">
										<a href="pcb_form20.php?tab=1"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>
										<button type="submit" name="save20b" class="btn btn-success text-bold">Save and Next</button></td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
                            <form name="myform3"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%"> Quantity of waste transported each day      </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="trans_waste[a]"></td>
										<td width="25%"> Percentage of total waste transported daily (%) </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="trans_waste[a]"></td>
									</tr>
									<tr>
										<td> Waste Treatment Technologies used</td>
										<td ><input type="text" class="form-control text-uppercase" name="trans_waste[a]"></td>
									</tr>
									<tr>
										<td>Whether solid waste is processed  </td>
										<td ><label class="radio-inline"><input type="radio" name="is_processed[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_processed[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td>If yes, Quantity of waste processed daily</td>
										<td class="form-inline"><textarea name="is_processed[b]" class="form-control text-uppercase" validate="textarea" ><?php //if(isset($adq_system)) echo $adq_system; ?></textarea>/tpd</td>
									</tr>
									<tr>
										<td> Land(s)  available  with  the  local  body  for  waste  processing (in Hectares) </td>
										<td ><input type="text" class="form-control text-uppercase" name="land[a]"></td>
										<td>Land currently utilized for waste processing </td>
										<td ><input type="text" class="form-control text-uppercase" name="land[b]"></td>
									</tr>
									<tr>
										<td> Solid waste processing facilities in operation  </td>
										<td ><input type="text" class="form-control text-uppercase" name="land[c]"></td>
										<td>Solid waste processing facilities under construction </td>
										<td ><input type="text" class="form-control text-uppercase" name="land[d]"></td>
									</tr>
									<tr>
										<td> Distance of processing facilities from city/town  boundary</td>
										<td ><input type="text" class="form-control text-uppercase" name="land[e]"></td>
										<td>Details of technologies adopt</td>
										<td ><input type="text" class="form-control text-uppercase" name="land[f]"></td>
									</tr>
									<tr>
										<td colspan="4"> Composting</td>
									</tr>
									<tr>
										<td> Qty. raw material processed</td>
										<td >Qty. final product produced </td>
										<td>Qty. sold </td>
										<td >Qty. of residual waste landfilled</td>
									</tr>
									<tr>
										<td colspan="4"> vermi composting  </td>
									</tr>
									<tr>
										<td> Qty. raw material processed</td>
										<td >Qty. final product produced </td>
										<td>Qty. sold </td>
										<td >Qty. of residual waste landfilled</td>
									</tr>
									<tr>
										<td colspan="4"> Bio-methanation  </td>
									</tr>
									<tr>
										<td> Qty. raw material processed</td>
										<td >Qty. final product produced </td>
										<td>Qty. sold </td>
										<td >Qty. of residual waste landfilled</td>
									</tr>
									<tr>
										<td colspan="4"> Refuse Derived Fuel   </td>
									</tr>
									<tr>
										<td> Qty. raw material processed</td>
										<td >Qty. final product produced </td>
										<td>Qty. sold </td>
										<td >Qty. of residual waste landfilled</td>
									</tr>
									<tr>
										<td colspan="4"> Waste to Energy technology<br/>such   as   incineration,   gasification,   pyrolysis    or   any   other technology ( give detail)   </td>
									</tr>
									<tr>
										<td> Qty. raw material processed</td>
										<td >Qty. final product produced </td>
										<td>Qty. sold </td>
										<td >Qty. of residual waste landfilled</td>
									</tr>
									<tr>
										<td >Co-processing    </td>
										<td> Qty. raw material processed</td>
										<td >&nbsp;  </td>
										<td>&nbsp; </td> 
									</tr>
									<tr>
										<td >Combustible waste supplied to cement plant    </td>
										<td> <input type="text" class="form-control text-uppercase" name="combustible[a]"></td>
										<td >Combustible waste supplied to solid waste based power plants </td>
										<td><input type="text" class="form-control text-uppercase" name="combustible[b]"> </td>
									</tr>
									<tr>
										<td >Others   </td>
										<td> Qty</td>
										<td > </td>
										<td> </td>
									</tr>
									<tr>
										<td >Solid waste disposal facilities</td>
										<td> <input type="text" class="form-control text-uppercase" name="combustible[c]"></td>
										<td >No. of dumpsites sites available with the local body </td>
										<td><input type="text" class="form-control text-uppercase" name="combustible[d]"> </td>
									</tr>
									<tr>
										<td >No. of sanitary landfill  sites available with the local body </td>
										<td> <input type="text" class="form-control text-uppercase" name="combustible[e]"></td>
										<td >Area of each such sites available for waste disposal</td>
										<td><input type="text" class="form-control text-uppercase" name="combustible[f]"> </td>
									</tr>
									<tr>
										<td >Area of land currently used for waste disposal </td>
										<td> <input type="text" class="form-control text-uppercase" name="combustible[g]"></td>
										<td >Distance of dumpsite/landfill facility from city/town</td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="combustible[h]"> kms </td>
									</tr>
									<tr>
										<td >Distance from the nearest habitation  </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="combustible[i]"> kms </td>
										<td >Distance from water body</td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="combustible[j]"> kms </td>
									</tr>
									<tr>
										<td >Distance from state/national highway  </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="combustible[k]"> kms </td>
										<td >Distance from Airport</td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="combustible[l]"> kms </td>
									</tr>
									<tr>
										<td >Distance from important religious places or historical monument  </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase"name="combustible[m]"> kms </td>
										<td >Whether it falls in flood prone area</td>
										<td ><label class="radio-inline"><input type="radio" name="is_combustible" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_combustible"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td colspan="4" class="text-center">
										<a href="pcb_form20.php?tab=2"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>
										<button type="submit" name="save20c" class="btn btn-success text-bold">Save and Next</button></td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
                            <form name="myform3"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%"> Whether it falls in earthquake fault line area      </td>
										<td width="25%"><label class="radio-inline"><input type="radio" name="is_earthquake" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_indus_provided"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td width="25%"> Quantity of waste landfilled each day </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="quant_waste">/tpd</td>
									</tr>
									<tr>
										<td> Whether landfill site is fenced </td>
										<td ><label class="radio-inline"><input type="radio" name="is_fenced" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_fenced"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td> Whether Lighting facility is available on site </td>
										<td ><label class="radio-inline"><input type="radio" name="is_lighting" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_lighting"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>Whether Weigh bridge facility available   </td>
										<td ><label class="radio-inline"><input type="radio" name="is_bridge[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_bridge[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td>Vehicles and equipments used at landfill  (specify)</td>
										<td ><input type="text" class="form-control text-uppercase" placeholder="Bulldozer, Compacters etc. available" name="is_bridge[b]"></td>
									</tr>
									<tr>
										<td> Manpower deployed at landfill site  </td>
										<td ><label class="radio-inline"><input type="radio" name="is_manpower[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_manpower[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td>if yes, attach details</td>
										<td ><textarea name="is_manpower[b]" id="adq_system" class="form-control text-uppercase" validate="textarea" ><?php //if(isset($adq_system)) echo $adq_system; ?></textarea></td>
									</tr>
									<tr>
										<td> Whether covering is done on daily basis   </td>
										<td ><label class="radio-inline"><input type="radio" name="is_covered[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_covered[a]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td>If not, Frequency of covering the waste deposited at the landfill </td>
										<td ><input type="text" class="form-control text-uppercase" name="is_covered[b]"></td>
									</tr>
									<tr>
										<td> Cover material used </td>
										<td ><input type="text" class="form-control text-uppercase" name="material[a]" ></td>
										<td>Whether adequate covering material is available</td>
										<td ><label class="radio-inline"><input type="radio" name="material[b]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="material[b]"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td >Provisions for gas venting provided (if yes, attach technical data sheet)    </td>
										<td ><label class="radio-inline"><input type="radio" name="is_venting" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_venting"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td >Provision for leachate collection </td>
										<td ><label class="radio-inline"><input type="radio" name="is_leachate" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_leachate"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td colspan="3">10. Whether  an  Action  Plan  has  been  prepared  for  improving  solid waste management practices in the city (if Yes attach Action Plan details)  </td>
										<td ><label class="radio-inline"><input type="radio" name="is_plan" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_plan"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td >11. What separate provisions are made for (Attach details on Proposals,):</td>
										<td> Steps taken</td>
										<td >Dairy related activities : </td>
										<td ><label class="radio-inline"><input type="radio" name="is_dairy" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_dairy"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td >Slaughter houses waste :  </td>
										<td ><label class="radio-inline"><input type="radio" name="is_house" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_house"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
										<td >C&D waste (construction debris)  : </td>
										<td ><label class="radio-inline"><input type="radio" name="is_debris" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_debris"  value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td >12. Details of Post Closure Plan </td>
										<td>Attach Plan</td>
										<td ></td>
										<td ></td>
									</tr>
									<tr>
										<td colspan="3">13. How  many  slums  are  identified  and  whether  these  are provided with Solid Waste Management facilities  (if Yes, attach details) </td>
										<td ><label class="radio-inline"><input type="radio" name="is_slums[a]" value="Y"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_slums[a]"   value="N"  <?php //if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td >if yes, attach details</td>
										<td ><textarea name="is_slums[b]"  id="adq_system" class="form-control text-uppercase" validate="textarea" ><?php //if(isset($adq_system)) echo $adq_system; ?></textarea></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">Give details of manpower deployed for collection including street sweeping,   secondary   storage,   transportation,   processing   and disposal of waste  </td>
										<td ><input type="text" class="form-control text-uppercase" name="details[a]">  </td>
									</tr>
									<tr>
										<td colspan="3">Mention  briefly,  the  difficulties  being  experienced by  the  local body in complying with provisions of these rule  </td>
										<td ><input type="text" class="form-control text-uppercase" name="details[b]">  </td>
									</tr>
									<tr>
										<td colspan="3">Mention briefly, if any innovative idea  is implemented to tackle a problem related to solid waste, which could be replicated by other local bodie  </td>
										<td ><input type="text" class="form-control text-uppercase" name="details[b]">  </td>
									</tr>
									<tr>
										<td>Dated:</td>
										<td><label><?php echo $today; ?></label></td>
										<td>Signature of Operator :</td>
										<td></td>
									</tr>
									<tr>
										<td>Place:</td>
										<td><label class="text-uppercase"><?php echo $dist; ?></label></td>
										<td> </td>
										<td></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success"  name="save21d" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button> 
										</td>
									</tr>
								</table>
								</form>
								</div>
							<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
								<form name="fileUpload"  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive table-bordered">	
				                   <tr>
					                    <td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</font></td>
				                    </tr>
									<tr>
										<td>Ward wise details of waste storage depots </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td>Manpower deployed at landfill site(if yes, attach details) </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file2" class="file1 form-control" <?php if($file2!="" || $file2=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td>Provisions for gas venting provided (if yes, attach technical data sheet) </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td>Provision for leachate collection (if yes, attach technical data sheet)</td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td>Whether  an  Action  Plan  has  been  prepared  for  improving  solid waste management practices in the city(if Yes attach Action Plan details)  </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td>What separate provisions are made for :</td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td >Details of Post Closure Plan</td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td >How  many  slums  are  identified  and  whether  these  are  provided with Solid Waste Management facilities : </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td >Details on solid waste processing/recycling/ treatment/disposal facility </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr>
										<td >Details of methodology or criteria followed for site selection </td>
										<td width="10%">
					                    <select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							               <option value="0" selected="selected">Select</option>
							               <option value="1">From E-Locker</option>
							               <option value="2">From PC</option>
						                </select>
					                    <input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/> </td>
					                    <td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					                    <td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					                    <td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
									</tr>
									<tr id="courierd">
			                            <td colspan="5">
				                        <table width="100%">
				                           <tr>
					                           <td colspan="6">Courier Details : </td>
				                            </tr>
				                            <tr>
					                            <td>Name of Courier Service <input type="text" required="required" name="courier_details[cn]" value="<?php echo $courier_details_cn; ?>" placeholder="Name" size="35" class="text-uppercase" ></td>
					                            <td>Ref. No. / Consignment No. <input type="text" required="required" name="courier_details[rn]" value="<?php echo $courier_details_rn; ?>" size="20" placeholder="Ref. Number" class="text-uppercase" ></td>
					                            <td>Dispatch Date <input type="datetime" required="required" value="<?php echo $courier_details_dt; ?>" name="courier_details[dt]" size="20" placeholder="DD/MM/YYYY" class="dob" ></td>
				                            </tr>
				                        </table>
			                        </td>
		                         </tr>
				                 <tr>
					                <td class="text-center" colspan="4">
					                   <a href="pcb_form4.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>		
					                   <button type="submit" class="btn btn-success" name="submit1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button></td>
				                  </tr>
								</table>
							</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	<?php if($is_source=="N"){ ?>
		$('#is_source_detail').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="is_source"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_source_detail').removeAttr('disabled', 'disabled');			
		}else{
			$('#is_source_detail').attr('disabled', 'disabled');			
		}
	});
	/* ------------------------------------------------------ */
	/* ------------------------------------------------------ */
	<?php if($is_door_a=="N"){ ?>
		$('#is_door_b').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="is_door_a"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_door_b').removeAttr('disabled', 'disabled');			
		}else{
			$('#is_door_b').attr('disabled', 'disabled');			
		}
	});
	/* ------------------------------------------------------ */
	<?php if($is_stored_a=="N"){ ?>
		$('#is_stored_b').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="is_stored_a"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_stored_b').removeAttr('disabled', 'disabled');			
		}else{
			$('#is_stored_b').attr('disabled', 'disabled');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>