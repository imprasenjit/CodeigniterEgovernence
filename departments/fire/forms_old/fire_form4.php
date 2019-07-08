<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','4');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=4&dept=fire';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
	$get_file_name=basename(__FILE__);
	include "save_form2.php";
    $email=$formFunctions->get_usermail($swr_id);
	$rows=$row1=$formFunctions->fetch_swr($swr_id);	
	$key_person=$rows['Key_person'];$unit_name=$rows['Name'];$street_name1=$rows['Street_name1'];$street_name2=$rows['Street_name2'];$vill=$rows['Vill'];$dist=$rows['Dist'];$block=$rows['block'];$pincode=$rows['Pincode'];$mobile_no=$rows['Mobile_no'];$landline_std=$rows['Landline_std'];$landline_no=$rows['Landline_no'];$owner_name=$rows['Name_of_owner'];
	$b_street_name1=$rows['b_street_name1'];$b_street_name2=$rows['b_street_name2'];$b_vill=$rows['b_vill'];$b_dist=$rows['b_dist'];$b_block=$rows['b_block'];$b_pincode=$rows['b_pincode'];$b_mobile_no=$rows['b_mobile_no'];$b_landline_std=$rows['b_landline_std'];$b_landline_no=$rows['b_landline_no'];$b_email=$rows['b_email'];

	$from=strtoupper($key_person)." \n".strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill)."\nBlock : ".strtoupper($block)."\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$fire->query("select * from fire_form4 where user_id='$swr_id' and active='1'") or die($fire->error);
	$row=$q->fetch_assoc();
	$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";
	$p_o_name="";$p_o_addr_s1="";$p_o_addr_s2="";$p_o_addr_vt="";$p_o_addr_blk="";$p_o_addr_dist="";$p_o_addr_pin  ="";$tel_no_stc="";$tel_no_lno="";$cno_stc="";$cno_lno="";$lc_no="";$lc_date="";$file1="";$file2="";$file3=""  ;$file4="";$file5="";$t_s_area="";$t_b_area="";$p_accessibility="";$n_o_floors="";$occupancy="";$access=""; $w_premises="";$w_building="";$emergency="";$parking="";$two_wheeler="";$four_wheeler="";$n_fire_station=""; $details_f_f_system="";$details_w_s="";$details_p_t="";$other_info="";$sl_c_details_s="";$sl_c_details_c="";	
	if($q->num_rows>0){	
		$form_id=$row['form_id'];$lc_no=$row['lc_no'];$lc_date=$row['lc_date'];$p_o_name=$row['p_o_name'];$p_o_addr=json_decode($row['p_o_addr']);$p_o_addr_s1=$p_o_addr->s1;$p_o_addr_s2=$p_o_addr->s2;$p_o_addr_vt=$p_o_addr->vt;$p_o_addr_blk=$p_o_addr->blk;
		$p_o_addr_dist=$p_o_addr->dist;$p_o_addr_pin=$p_o_addr->pin;
		
		$q=$fire->query("select * from fire_form4_docs where form_id='$form_id' ") or die($fire->error);
	   $rest=$q->fetch_assoc();
		$file1=$rest['file1'];$file2=$rest['file2'];$file3=$rest['file3'];$file4=$rest['file4'];$file5=$rest['file5'];$file6=$rest['file6'];
		
		if(empty($row['s_properties']==false)){
		 $s_properties=json_decode($row['s_properties']);$s_properties_e=$s_properties->e;$s_properties_w=$s_properties->w;
		$s_properties_n=$s_properties->n;$s_properties_s=$s_properties->s;
	}
	if(empty($row['o_s_a_storage']==false)){
		$o_s_a_storage=json_decode($row['o_s_a_storage']);$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;
		$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
	}
	
		
	if(empty($row['sl_c_details']==false)){
		$sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;$sl_c_details_c=$sl_c_details->c;
	}
	if(!($row['tel_no']=="NULL")){
		$tel_no=json_decode($row['tel_no']);$tel_no_stc=$tel_no->stc;$tel_no_lno=$tel_no->lno;	}
	    $t_s_area=$row['t_s_area'];$t_b_area=$row['t_b_area'];$p_accessibility=$row['p_accessibility'];$n_o_floors=$row['n_o_floors'];
	    $occupancy=$row['occupancy'];$access=$row['access'];$w_premises=$row['w_premises'];$w_building=$row['w_building'];
	    $emergency=$row['emergency'];$parking=$row['parking'];$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
	    $parking=$row['parking'];$n_fire_station=$row['n_fire_station'];$details_f_f_system=$row['details_f_f_system'];
	    $details_w_s=$row['details_w_s'];$details_p_t=$row['details_p_t'];$other_info=$row['other_info'];
	if(!empty($sl_c_details)){
	    $sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;$sl_c_details_c=$sl_c_details->c;
	}
	   
}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";
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
			.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
			.form-control text-uppercase{
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
	  <div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
      <div class="wrapper">
  <?php require '../../../user_area/includes/header.php'; ?>
  <?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<section class="content-header"></section>
				<section class="content">
					<?php require '../includes/banner.php'; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 class="text-center" >
										<strong>FORM NO. 4 <br/><?php echo $form_name=$formFunctions->get_formName('fire','4');?> </strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART 2</a></li>
									  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">UPLOAD</a></li>
									 
									</ul>
									<br>
									<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">														
								<table id="" class="table table-responsive">
								<tr>
									<td colspan="4">1. Name and address of the Applicant</td>
								</tr>
								<tr>
									<td width="25%"> Applicant's Name</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"></td>
									<td width="25%"></td>
									<td width="25%"></td>
									</tr>
									<tr>
									<td width="25%"> Street1</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $street_name1;?>" disabled="disabled"></td>
								
									<td width="25%">Street2</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $street_name2;?>" disabled="disabled"></td>
									</tr>
								  <tr>
									<td> Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" value="<?php echo $vill;?>" disabled="disabled"></td>
								
									<td> District</td>
									<td><input type="text" class="form-control text-uppercase" value="<?php echo $dist;?>" disabled="disabled"></td>
									</tr>
									<tr>
									<td> State</td>
									<td><input type="text" class="form-control text-uppercase" value="<?php echo $block;?>" disabled="disabled"></td>
								
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" value="<?php echo $pincode;?>" disabled="disabled"></td>
								   <td></td>
								   <td></td>
								</tr>
								
								<tr>
									<td colspan="4">2. Name and Address of the owner of the premises</td>
								</tr>
								<tr>
									<td> Owner's Name</td>
									<td><input type="text" class="form-control text-uppercase"  name="p_o_name" id="oname"  value="<?php echo $p_o_name;?>" validate="letters" required="required"/></td>
								</tr>
								<tr>
									<td>Street 1</td>
									<td><input type="text" class="form-control text-uppercase"   name="p_o_addr[s1]" id="street3" value="<?php if(isset($p_o_addr_s1)){echo $p_o_addr_s1;}?>" required="required" /></td>
								<td>Street 2</td>
									<td><input type="text" class="form-control text-uppercase"    name="p_o_addr[s2]" id="street4"  value="<?php if(isset($p_o_addr_s2)){echo $p_o_addr_s2;} ?>" /></td>
									</tr>
									<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase"  name="p_o_addr[vt]" id="vill1"  value="<?php if(isset($p_o_addr_vt)){echo $p_o_addr_vt;} ?>" required="required"/></td>	
								<td>District</td>
									<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC") OR die("Error : ".$mysqli->error); ?>
										<select name="p_o_addr[dist]" class="form-control text-uppercase" id="dist1"  required="required">
											<option value="">Select District</option>
											<?php while($rows_dist2=$dstresult->fetch_object()) {
												if(isset($p_o_addr_dist) && ($p_o_addr_dist==$rows_dist2->district)){
													$s='selected'; 
												}else{
													$s='';
												}  ?>
												<option value="<?php echo $rows_dist2->district; ?>" <?php echo $s;?>><?php echo $rows_dist2->district; ?></option>
											<?php }		?>
										</select>										
										<font class="compulsory"> <?php if(isset($code) && $code == 9){echo $errorMsg ;}?></font>
									</td>
									</tr>
								<tr>
									<td> Block</td>
									<td id="blockdiv">
										<select name="p_o_addr[blk]" class="form-control text-uppercase" id="block1" >										
											<?php if(isset($p_o_addr_blk) && ($p_o_addr_blk!="")){ ?>
												<option value="<?php echo $p_o_addr_blk; ?>"><?php echo $p_o_addr_blk; ?></option>
											<?php }else{ ?>
											<option value="">Select Block</option>
											<?php } ?>
										</select>
									</td>
									
									<td>Pincode</td>
									<td><input type="text"  name="p_o_addr[pin]" class="form-control text-uppercase" validate="pincode" id="pin1"  maxlength="6" value="<?php if(isset($p_o_addr_pin)){echo $p_o_addr_pin;} ?>" required="required"/></td>
									
									
								</tr>
								<tr>
									<td>3. Address of the premises</td>
								</tr>
								<tr>
									<td>Street 1</td>
									<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_street_name1;?>" disabled="disabled"></td>
									<td>Street 2</td>
									<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_street_name2;?>" disabled="disabled"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_vill;?>" disabled="disabled"></td>
									<td>District</td>
									<td>
										<input type="text" class="form-control text-uppercase"   value="<?php echo $b_dist;?>" disabled="disabled">
									</td>
									
								</tr>
								<tr colspan="4">
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_pincode;?>" disabled="disabled"></td>
									<td> Block</td>
									<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_block;?>" disabled="disabled"></td>
									
								</tr>
								
								
								<tr>
									<td colspan="4">4. Telephone numbers of the applicant/occupier/owner  </td>
								</tr>
								<tr>
									<td>Mobile no: </td>
									
									<td> <input type="text" class="form-control text-uppercase"    value="+91-<?php echo $mobile_no;?>" disabled="disabled">
									</td>
									<td>Landline no:</td>
									<td><input type="text" class="form-control text-uppercase"     value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled">		
								</tr>
								<tr>	
									<td colspan="2">5. License Number and date of issue
									</td>			
								</tr>
								<tr>
									<td>License no</td>
									<td><input type="text"  placeholder="License Number" class="form-control text-uppercase" name="lc_no" id="lic_no"  value="<?php  echo $lc_no; ?>"  required="required" /></td>
								
									<td>Date of Issue</td>
									<td><input type="text" class="dob  form-control text-uppercase"  name="lc_date"   required="required"  placeholder="YYYY-MM-DD"  id="dob1" readonly="readonly" value="<?php  echo $lc_date; ?>"/></td>
									
								</tr>																		
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" style="font-weight:bold" name="save4a" class="btn btn-success submit1">Save and Next</button>
										</td>
										<td></td>
									</tr>
								</table>
								</form>
							</div>
							<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id=""  class="table table-responsive">
									<tr>
									    <td width="25%">6. Total site area</td>
									     <td width="25%"><input type="text"  class="form-control text-uppercase" jstag="validateNotSpecialChar" name="t_s_area" placeholder="" id="sitearea" required="required" value="<?php echo $t_s_area; ?>"  required="required"/></td>
									
										<td width="25%">7. Total built up area</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" jstag="validateNotSpecialChar" name="t_b_area" placeholder="" id="buildarea"  value="<?php echo $t_b_area; ?>" required="required"  required="required" /></td>
									</tr>
									
									<tr>
									<td>8. Accessibility to the premises</td>
									
									<td>
										<input type="text"  class="form-control text-uppercase" jstag="validateNotSpecialChar" name="p_accessibility" id="accessibility" placeholder="Accessibility to Premises"  value="<?php  echo $p_accessibility; ?>" required="required"  required="required"/></td>
										<td></td><td></td>
										
									</tr>
								   <tr>
									<td colspan="4">9. Surrounding properties:</td> 
									</tr>
											<tr>
												<td>East</td>
												<td><input type="text" class="form-control text-uppercase"  name="s_properties[e]" id="east"  value="<?php if(isset($s_properties_e)) echo $s_properties_e; ?>"  required="required" /></td>
											
												<td>West</td>
												<td><input type="text" class="form-control text-uppercase"   name="s_properties[w]" placeholder="" id="west"  value="<?php if(isset($s_properties_w)) echo $s_properties_w; ?>"  required="required" /></td>
											</tr>
											<tr>
												<td>North</td>
												<td><input type="text" class="form-control text-uppercase"  name="s_properties[n]" placeholder="" id="north"  value="<?php if(isset($s_properties_n)) echo $s_properties_n; ?>"  required="required"/></td>
											
												<td>South</td>
												<td><input type="text" class="form-control text-uppercase"   name="s_properties[s]" placeholder="" id="south"  value="<?php if(isset($s_properties_s)) echo $s_properties_s; ?>"  required="required" /></td>
											</tr>
										     
									<tr>
										<td>10. Number of floors</td>
										<td><input type="text" class="form-control text-uppercase"  validate="onlyNumbers" name="n_o_floors" onchange="onlyNumber(this.id)" placeholder="No Of Floors" id="floor_no"  value="<?php echo $n_o_floors; ?>" required="required"/></td>
									
										<td>11. Occupancy in each floor</td>
										<td><input type="text" class="form-control text-uppercase" name="occupancy" placeholder="Occupancy in Each Floor" id="occupancy"  value="<?php echo $occupancy; ?>" required="required"/></td>
									</tr>
									<tr>
										<td  colspan="4">12. Open Space available around the Structure</td></tr>
										
									<tr>
										<td>Eastern Side</td>
										<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[e]" placeholder="" id="eastern"  value="<?php if(isset($o_s_a_storage_e)) echo $o_s_a_storage_e; ?>"  required="required" /></td>
									
										<td>Western Side</td>
										<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[w]" placeholder="" id="western"  value="<?php if(isset($o_s_a_storage_w)) echo $o_s_a_storage_w; ?>"  required="required" /></td>
									</tr>
									<tr>
										<td>Northern Side</td>
										<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[n]" placeholder="" id="northern"  value="<?php if(isset($o_s_a_storage_n)) echo $o_s_a_storage_n; ?>"  required="required" /></td>
									
										<td>Southern Side</td>
										<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[s]" placeholder="" id="southern"  value="<?php if(isset($o_s_a_storage_s)) echo $o_s_a_storage_s; ?>"  required="required"/></td>
									</tr>
									
									<tr>
										<td>13. Access to the premises</td>
										<td><input type="text" class="form-control text-uppercase" name="access" id="access_prem" placeholder="Access to Premises"  value="<?php echo $access; ?>" required="required" /></td>
										
									</tr>
									<tr>
										<td  colspan="4">14. Width of entry/exit</td>
									</tr>
									<tr>
												<td>a. Premises</td>
												<td><input type="text" class="form-control text-uppercase"   name="w_premises" id="width_prem"  value="<?php echo $w_premises; ?>" required="required"/></td>
											
												<td>b. Building</td>
												<td><input type="text" class="form-control text-uppercase"   name="w_building" id="width_build"  value="<?php  echo $w_building; ?>" required="required"/></td>
									</tr>
									 <tr>									
										<td>15. Number of emergency exits</td>
									
										<td><input type="text" validate="onlyNumbers" name="emergency" id="exits"  class="form-control text-uppercase" value="<?php  echo $emergency; ?>" required="required"/></td>
										<td></td><td></td>
									</tr> 
									<tr> 
									    <td>16. Provision of parking 2 wheelers and 4 wheelers</td>
										<td>
											<label class="radio-inline"><input type="radio" name="parking" value="Y"  <?php if(isset($parking) && $parking=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="parking"  value="N"  <?php if(isset($parking) && $parking=='N') echo 'checked'; ?>/> No</label>
										</td>  
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  name="two_wheeler" id="two_wheeler"  placeholder="Total 2 Wheeler"  value="<?php  echo $two_wheeler; ?>"/>
										</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="four_wheeler" id="four_wheeler"  placeholder="Total 4 Wheeler"  value="<?php  echo $four_wheeler; ?>"/>
										</td>										
									</tr>
									<tr>
										<td colspan="4">17. Name of the nearest Fire Station and telephone number:</td>
									</tr>
									<tr>
											<td>Name</td>
											<td><input type="text" class="form-control text-uppercase" name="n_fire_station" placeholder="Name of Fire Station" id="fire_station" value="<?php echo $n_fire_station; ?>"/></td>
									</tr>
									<tr>

											<td>Telephone Number</td>
											<td>
											<input type="text"placeholder="std code" class="form-control" name="tel_no[stc]" validate="onlyNumbers" maxlength="5" value="<?php  echo $tel_no_stc; ?>"/> </td><td> <input type="text" name="tel_no[lno]"  maxlength="8" placeholder="landline no " validate="onlyNumbers"  id="fire_station_phone" class="form-control"  value="<?php echo $tel_no_lno; ?>"/></td>
									</tr>
									<tr>
											
											<td>
											
											</td>
											
										</tr>
									<tr>
									    <td>18. Details of the Fire Fighting <br/>System/Equipments available</td>
										<td><textarea  validate="textarea" name="details_f_f_system" class="form-control text-uppercase" id="equipment"  required="required"  placeholder="Details of Equipments" ><?php echo $details_f_f_system; ?></textarea></br><span>255</span> Characters Left</td>
										
										<td>19. Details of the water storages<br/> available in the premises</td>
										<td><textarea validate="textarea" name="details_w_s" class="form-control text-uppercase" id="water_storage"   required="required" placeholder="Details of Water Storage"> <?php echo $details_w_s; ?></textarea></br><span>255</span> Characters Left</td>
									</tr>
									<tr>
										<td colspan="4">20. Details of the personnel trained basic fire fighting (Sl. No of training certificates)</td>
									</tr>
									<tr><td></td>
										<td><textarea validate="textarea" name="details_p_t" class="form-control text-uppercase" id="pl_details" placeholder="Details of Trained Personnel"><?php echo $details_p_t; ?></textarea></br><span>255</span> Characters Left
										</td>
										<td><input type="text" class="form-control text-uppercase" name="sl_c_details[s]" placeholder="SL No" id="pl_id"  value="<?php if(isset($sl_c_details_s)) echo $sl_c_details_s; ?>"/></td>
										<td>
										<input type="text" class="form-control text-uppercase"  name="sl_c_details[c]" placeholder="Certificate Details" id="pl_certificate"  value="<?php if(isset($sl_c_details_c))  echo $sl_c_details_c; ?>"/>
										</td>
									</tr>
									<tr>
                                     <td>21. Any other information that<br/> the applicant desire to provide</td>
										<td>
										<textarea validate="textarea" name="other_info" class="form-control text-uppercase" id="other_info"><?php echo $other_info; ?></textarea></br><span>255</span> Characters Left</br>
										</td>
										<td></td>
									</tr>
									
								</table>
								<div align="center">
								<a href="fire_form4.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
											<button type="submit"  style="font-weight:bold" name="save4b" class="btn btn-success submit1">Save and Next</button>
									</div>	
							</form>
							</div>
							
							
			<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
			<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  id=""  class="table table-responsive" >										
								<tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mandatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
								<tr>
					<td width="50%"> Site Plan showing all the legends</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file1" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Available</option>
                                            </select>
                                            <input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile1">
                                            <?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
			     <tr>
					<td>Lay Out Plan</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file2" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Available</option>
                                            </select>
                                            <input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile2">
                                            <?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td> Service Plan</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file3" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file3); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Available</option>
                                            </select>
                                            <input type="hidden" name="mfile3" id="mfile3" value="<?php echo $file3 !== '' ? $file3 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile3">
                                            <?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>Section Plan.</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file4" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file4); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Available</option>
                                            </select>
                                            <input type="hidden" name="mfile4" id="mfile4" value="<?php echo $file4 !== '' ? $file4 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile4">
                                            <?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>Elevation Plan</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file5" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file5); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Available</option>
                                            </select>
                                            <input type="hidden" name="mfile5" id="mfile5" value="<?php echo $file5 !== '' ? $file5 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile5">
                                            <?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>Licence/Permission etc..</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file6" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file6); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Available</option>
                                            </select>
                                            <input type="hidden" name="mfile6" id="mfile6" value="<?php echo $file6 !== '' ? $file6 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile6">
                                            <?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				
				<tr>
					<td class="text-center" colspan="5">
						<a href="fire_form4.php?tab=2" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit4" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">SUBMIT</button>
					</td>
					</tr>
					        </table>
			             </form>
		               </div>
					</div>
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
<?php require '../../../user_area/includes/js.php'; ?>
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
$('#dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
$('#dist1').change(function(){
	var city=$(this).val();
	$('#block1').empty();
	$.ajax({ 
		type: 'GET',
		url: '../../../ajax/district_blocks.php', 
		data: { city: city },
		beforeSend:function(){
			$("#block1").html("Loading..");
		},
		success:function(data){
			$("#block1").html(data);
		},
		error:function(){ }
	}); //ajax end
});
$('#offlinePayDetials').hide();
$(document).ready(function(){
	$('input[name="payment_mode"]').on('change', function(){
		if($(this).val() == 0){						
			$('#offlinePayDetials').show("fast");						
		}else{
			$('#offlinePayDetials').hide("slow");
		}	
		
	});
});
/*----------------------------------------------*/
	<?php if($parking=="N"){ ?>
		$('#two_wheeler').attr('disabled', 'disabled');
		$('#four_wheeler').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="parking"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#two_wheeler').removeAttr('disabled', 'disabled');
			$('#four_wheeler').removeAttr('disabled', 'disabled');			
		}else{
			$('#two_wheeler').attr('disabled', 'disabled');
			$('#four_wheeler').attr('disabled', 'disabled');			
		}
	});
/*----------------------------------------------*/
</script>
        </body>
</html>