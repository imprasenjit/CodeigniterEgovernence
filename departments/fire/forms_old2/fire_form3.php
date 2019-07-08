<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','3');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=3&dept=fire';
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
	$q=$fire->query("select * from fire_form3 where user_id='$swr_id' and active='1'") or die($fire->error);
	$row=$q->fetch_assoc();
	$file1="";$file2="";$file3="";$file4="";
	$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width_e="";$os_width_w="";$os_width_n="";$os_width_s="";$site_area="";$total_area="";$premise_access="";$no_of_floor="";$floor_details="";$access_premises="";$width_entry="";$no_of_entrance="";$parking="";$fire_name="";$fire_std="";$fire_land="";$system_details="";$water_details="";$personnel_details="";$license_authority="";$other_info="";$two_wheeler="";$four_wheeler="";$owner_name="";$owner_address_s1= "";$owner_address_s2= "";$owner_address_vill= ""; $owner_address_district= "";$owner_address_block= "";$owner_address_pin="";$isComplete="";$lic_date="";$license_no="";$p_o_name="";	
	if($q->num_rows>0){	
	$form_id=$row['form_id'];$isComplete=$row["save_mode"];$owner_name=$row["owner_name"];
	$file1=$row['file1'];$file2=$row['file2'];$file3=$row['file3'];$file4=$row['file4'];
	$license_no=$row["license_no"];$lic_date=$row["lic_date"];$owner_address=json_decode($row["owner_address"]);$owner_address_s1= $owner_address->s1;
	$owner_address_s2= $owner_address->s2;$owner_address_vt= $owner_address->vt;
	$owner_address_dist= $owner_address->dist;$owner_address_blk= $owner_address->blk;
	$owner_address_pin=$owner_address->pin;
    $site_area=$row["site_area"];
	$total_area=$row["total_area"];$premise_access=$row["premise_access"];
	$no_of_floor=$row["no_of_floor"];$floor_details=$row["floor_details"];
	$access_premises=$row["access_premises"];$width_entry=$row["width_entry"];
	$no_of_entrance=$row["no_of_entrance"];$parking=$row["parking"];$fire_name=$row["fire_name"];$fire_std=$row["fire_std"];$fire_land=$row["fire_land"];
	$system_details=$row["system_details"];$water_details=$row["water_details"];
	$personnel_details=$row["personnel_details"];$license_authority=$row["license_authority"];$other_info=$row["other_info"];$submited=$row["sub_date"];
	$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
	
	
	   if(!empty($row["surround_prop"])){	
				 $surround_prop=json_decode($row["surround_prop"]);
				 $surround_prop_e=$surround_prop->e;
				 $surround_prop_w=$surround_prop->w;
				 $surround_prop_n=$surround_prop->n;
				 $surround_prop_s=$surround_prop->s;
				}
				if(!empty($row["os_width"])){	
				 $os_width=json_decode($row["os_width"]);
				 $os_width_e=$os_width->e;
				 $os_width_w=$os_width->w;
				 $os_width_n=$os_width->n;
				 $os_width_s=$os_width->s;	
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
										<strong>FORM NO. 3 <br/><?php echo $form_name=$formFunctions->get_formName('fire','3');?> </strong>
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
									<td colspan="3">1. Name and Address of the Applicant</td>
									<td></td>
								</tr>
								<tr>
									<td> Applicant's Name</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $key_person;?>" disabled="disabled"></td>
									</tr>
									<tr>
									<td width="25%"> Street Name 1</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name1;?>" disabled="disabled"></td>
								
									<td width="25%">Street Name 2</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name2;?>" disabled="disabled"></td>
									</tr>
								  <tr>
									<td> Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $vill;?>" disabled="disabled"></td>
								
									<td> District</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $dist;?>" disabled="disabled"></td>
									</tr>
									<tr>
									<td> State </td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $block;?>" disabled="disabled"></td>
								
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $pincode;?>" disabled="disabled"></td>
								   <td></td>
								   <td></td>
								</tr>
								
								<tr>
									<td colspan="4">2. Name and Address of the owner of the premises</td>
								</tr>
								<tr>
									<td> Owner's Name</td>
									<td><input type="text" class="form-control text-uppercase" validate="letters"  name="owner_name" id="oname"  value="<?php echo $owner_name;?>" required="required"/></td>
								</tr>
								<tr>
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase"  validate="jsonObj" name="owner_address[s1]" id="street3" value="<?php if(isset($owner_address_s1)){echo $owner_address_s1;}?>" required="required" /></td>
								<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="owner_address[s2]" id="street4"  value="<?php if(isset($owner_address_s2)){echo $owner_address_s2;} ?>" /></td>
									</tr>
									<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="owner_address[vt]" id="vill1"  value="<?php if(isset($owner_address_vt)){echo $owner_address_vt;} ?>" required="required"/></td>
									
									
								
								<td>District</td>
									<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC") OR die("Error : ".$mysqli->error); ?>
										<select name="owner_address[dist]" class="form-control text-uppercase" id="dist1"  required="required">
											<option value="">Select District</option>
											<?php while($rows_dist2=$dstresult->fetch_object()) {
												if(isset($owner_address_dist) && ($owner_address_dist==$rows_dist2->district)){
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
										<select name="owner_address[blk]" class="form-control text-uppercase" id="block1" >										
											<?php if(isset($owner_address_blk) && ($owner_address_blk!="")){ ?>
												<option value="<?php echo $owner_address_blk; ?>"><?php echo $owner_address_blk; ?></option>
											<?php }else{ ?>
											<option value="">Select Block</option>
											<?php } ?>
										</select>
									</td>
									
									<td>Pincode</td>
									<td><input type="text"  name="owner_address[pin]" class="form-control text-uppercase" validate="pincode" id="pin1"  maxlength="6" value="<?php if(isset($owner_address_pin)){echo $owner_address_pin;} ?>" required="required"/></td>
									
									
								</tr>
								<tr>
									<td>3. Address of the premises</td>
								</tr>
								<tr>
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_street_name1;?>" disabled="disabled"></td>
									<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_street_name2;?>" disabled="disabled"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_vill;?>" disabled="disabled"></td>
									<td>District</td>
									<td>
										<input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_dist;?>" disabled="disabled">
									</td>
									
								</tr>
								<tr colspan="4">
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_pincode;?>" disabled="disabled"></td>
									<td> Block</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_block;?>" disabled="disabled"></td>
									
								</tr>
								
								
								<tr>
									<td colspan="4">4. Contact numbers of the applicant/occupier/owner  </td>
								</tr>
								<tr>
									<td>Mobile no: </td>
									
									<td> <input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="+91 -<?php echo $mobile_no;?>" disabled="disabled">
									</td>
									<td>Landline no:</td>
									<td><input type="text" class="form-control text-uppercase"   name="onbehalf" id="onbehalf"  value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled">
								</tr>
								<tr>
									
									
								</tr>
								<tr>
									
									<td colspan="2">5. License Number and date of issue
									</td>
									
								</tr>
								<tr>
									<td>License no</td>
									<td><input type="text"  placeholder="License Number" class="form-control text-uppercase" name="license_no" id="lic_no"  value="<?php  echo $license_no; ?>"  required="required" /></td>
								
									<td>Date of Issue</td>
									<td><input type="text" class="dob form-control text-uppercase"  name="lic_date" readonly="readonly"  placeholder="YYYY-MM-DD"  id="dob"  required="required" value="<?php  echo $lic_date; ?>"/></td>
									
								</tr>
									
									
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" style="font-weight:bold" name="save3a" class="btn btn-success submit1">Save and Next</button>
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
    <td width="25%"><input type="text"  class="form-control text-uppercase" name="site_area" placeholder="" id="site_area" value="<?php echo $site_area; ?>" required="required" /></td>
 
    <td width="25%">7. Total built up area</td>
    <td width="25%"><input type="text" class="form-control text-uppercase" name="total_area" id="total_area" value="<?php echo $total_area; ?>" required="required"/></td>
  </tr>
<tr>
    <td>8. Accessibility to the premises</td>
    <td><input type="text" class="form-control text-uppercase" name="premise_access" id="premise_access" value="<?php echo $premise_access; ?>" required="required" /></td>
  </tr>
<tr>
    <td>9. Surrounding properties:</td>
    </tr>
      <tr>
        <td>East</td>
        <td><input type="text" validate="jsonObj"class="form-control text-uppercase"  name="surround_prop[e]" id="surround_prop[e]" value="<?php echo $surround_prop_e; ?>" required="required" /></td>
      
        <td>West</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[w]"  id="surround_prop[w]" value="<?php echo $surround_prop_w; ?>" required="required" /></td>
      </tr>
      <tr>
        <td>North</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj"name="surround_prop[n]" id="surround_prop[n]" value="<?php echo $surround_prop_n; ?>" required="required"/></td>
     
        <td>South</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[s]"  id="surround_prop[s]" value="<?php echo $surround_prop_s; ?>" required="required"/></td>
      </tr>
    
<tr>
    <td>10. Number of floors</td>
    <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_floor"  id="no_of_floor" value="<?php echo $no_of_floor; ?>" required="required"/></td>
  
    <td>11. Occupancy in each floor</td>
    <td><input type="text" class="form-control text-uppercase"  name="floor_details"  id="floor_details" value="<?php echo $floor_details; ?>" required="required"/></td>
  </tr>
  <tr>
    <td>12. Open Space available around the Structure</td>
    </tr>
      <tr>
        <td>Eastern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[e]"  id="os_width[e]" value="<?php echo $os_width_e; ?>" required="required"/></td>
      
        <td>Western Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[w]" id="os_width[w]" value="<?php echo $os_width_w; ?>" required="required"/></td>
      </tr>
      <tr>
        <td>Northern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="os_width[n]"  id="os_width[n]" value="<?php echo $os_width_n; ?>" required="required"/></td>
      

        <td>Southern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="os_width[s]"  id="os_width[s]" value="<?php echo $os_width_s; ?>" required="required"/></td>
      
  </tr>
<tr>
    <td>13. Access to the premises</td>
    <td><input type="text" class="form-control text-uppercase"  name="access_premises" id="access_premises" value="<?php echo $access_premises; ?>" required="required" /></td>
  
    <td>14. Width of entry/exits</td>
    <td><input type="text" class="form-control text-uppercase"  name="width_entry"  id="width_entry" value="<?php echo $width_entry; ?>" required="required"/></td>
  </tr>
<tr>
    <td>15. Number of emergency exits, sizes etc</td>
    <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_entrance"  id="no_of_entrance" value="<?php echo $no_of_entrance; ?>" required="required"/></td>
 </tr>
<tr>
    <td>16. Provision of parking 2 wheelers and 4 wheelers</td>
    <td>
		<label class="radio-inline"><input type="radio" name="parking" value="Y"  <?php if(isset($parking) && $parking=='Y') echo 'checked'; ?> /> Yes</label>&emsp;&emsp;&emsp;
		<label class="radio-inline"><input type="radio" name="parking"  value="N"  <?php if(isset($parking) && $parking=='N') echo 'checked'; ?>/> No</label>
      <td><input type="text" class="form-control text-uppercase"  name="two_wheeler" id="two_wheeler" validate="onlyNumbers" placeholder="Total 2 Wheeler"  value="<?php  echo $two_wheeler; ?>"/></td><td>
      <input type="text" class="form-control text-uppercase"  name="four_wheeler" id="four_wheeler" validate="onlyNumbers" placeholder="Total 4 Wheeler"  value="<?php echo $four_wheeler; ?>"/>
	</td>
	<td></td>
  </tr>
<tr>
    <td>17. Name of the nearest Fire Station and telephone Number</td>
    </tr>
    <tr>
    <td>Name:</td>
    <td><input type="text" class="form-control text-uppercase" name="fire_name" id="fire_name"  placeholder="" value="<?php echo $fire_name; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
    <tr>

    <td>Contact:</td>
		<td> <input type="text" placeholder="STD" class="form-control text-uppercase" maxlength="5" validate="onlyNumbers" name="fire_std" id="fire_std"  value="<?php echo $fire_std; ?>"/></td>
		<td><input type="text" placeholder="NUMBER" class="form-control text-uppercase" validate="onlyNumbers" maxlength="8" name="fire_land" id="fire_land"  value="<?php echo $fire_land; ?>" />
	</td>
	<td></td>

  </tr>

 <tr>
    <td valign="top">18. Details of the Fire Fighting System/ Equipments available</td>
    <td>
      <textarea name="system_details" validate="textarea" class="form-control text-uppercase" id="system_details"  required="required" placeholder="Details of Equipments"><?php echo $system_details; ?></textarea>
    </td>
  
    <td valign="top">19. Details of water storages available in the premises</td>
    <td>
      <textarea name="water_details" validate="textarea"class="form-control text-uppercase" id="water_details"  required="required" placeholder="Details of Water Storage"><?php echo $water_details; ?></textarea>
    </td>
  </tr>
  <tr>
    <td valign="top">20. Details of the personnel trained basic fire fighting</td>
    <td><textarea name="personnel_details" validate="textarea" class="form-control text-uppercase" id="personnel_details" placeholder="Details of Trained Personnel"><?php echo $personnel_details; ?></textarea><br>
    </td>
 
    <td valign="top">21. License Number/ permission from the concerned land owner/ authority</td>
    <td>
      <textarea name="license_authority" validate="textarea" class="form-control text-uppercase" id="license_authority" required="required"  placeholder="Details of License/permission"><?php echo $license_authority; ?></textarea>
    </td>
  </tr> 
  <tr>
    <td valign="top">22. Any other information that the applicant desires to provide</td>
    <td>
      <textarea name="other_info" validate="textarea" class="form-control text-uppercase" id="other_info" ><?php echo $other_info; ?></textarea>
    </td>
    <td></td>
    <td></td>
  </tr>  
									
	</table>
	<div align="center">
		<a href="fire_form3.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
					<button type="submit"  style="font-weight:bold" name="save3b" class="btn btn-success submit1">Save and Next</button>
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
					<td width="50%"> Site Plan</td>
					<td width="10%">
					<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
					</td>
					<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
				</tr>
			     <tr>
					<td>Lay Out Plan</td>
					<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
					<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="B1"  class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td> Service Plan</td>
					<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
					<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="C1" class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>Licence/ Permission etc.</td>
					<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
					<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
				</tr>
				
				
				<tr>
					<td class="text-center" colspan="4">
						<a href="fire_form3.php?tab=2" class="btn btn-primary">Go Back &amp; Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit3" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">SUBMIT</button>
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
$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
</script>
        </body>
</html>