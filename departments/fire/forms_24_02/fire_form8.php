<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','8');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=8&dept=fire';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
	$get_file_name=basename(__FILE__);

	include "save_form2.php";
    $email=$formFunctions->get_usermail($swr_id);
	$rows=$formFunctions->fetch_swr($swr_id);

	$key_person=$rows['Key_person'];$unit_name=$rows['Name'];$street_name1=$rows['Street_name1'];$street_name2=$rows['Street_name2'];$vill=$rows['Vill'];$dist=$rows['Dist'];$block=$rows['block'];$pincode=$rows['Pincode'];$mobile_no=$rows['Mobile_no'];$landline_std=$rows['Landline_std'];$landline_no=$rows['Landline_no'];$ownername=$rows['Name_of_owner'];
	$b_street_name1=$rows['b_street_name1'];$b_street_name2=$rows['b_street_name2'];$b_vill=$rows['b_vill'];$b_dist=$rows['b_dist'];$b_block=$rows['b_block'];$b_pincode=$rows['b_pincode'];$b_mobile_no=$rows['b_mobile_no'];$b_landline_std=$rows['b_landline_std'];$b_landline_no=$rows['b_landline_no'];$b_email=$rows['b_email'];

	$from=strtoupper($key_person)." \n".strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill)."\nBlock : ".strtoupper($block)."\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;

	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

	$q=$fire->query("select * from fire_form8 where user_id='$swr_id' and active='1'") or die($fire->error);
	$row=$q->fetch_assoc();
	$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width_e="";$os_width_w="";$os_width_n="";$os_width_s="";$chemical_stored="";$quantity_stored="";$type_storage="";$flash_stored="";$details_electric="";$total_area="";
	$access_premises="";$provision_segregate="";$size_exit="";$nearest_station="";$fire_details="";$water_details="";$personnel_details="";
	$s_no="";$license_no="";$other_info="";$submited_on="";$file1="";$file2="";$file3="";$file4="";$owner_name="";	
	if($q->num_rows>0){   
	    $form_id=$row['form_id'];$owner_name=$row['owner_name'];
	    if(empty($row['owner_address']==false))
	    	{   $owner_address=json_decode($row['owner_address']);$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_blk=$owner_address->blk;$owner_address_dist=$owner_address->dist;$owner_address_pin=$owner_address->pin;
			}
			$file1=$row['file1'];$file2=$row['file2'];$file3=$row['file3'];$file4=$row['file4'];
			
			if(empty($row['surround_prop']==false)){
			$surround_prop=json_decode($row['surround_prop']);$surround_prop_e=$surround_prop->e;
			$surround_prop_w=$surround_prop->w;$surround_prop_n=$surround_prop->n;$surround_prop_s=$surround_prop->s;
		}
		if(empty($row['os_width']==false)){
			$os_width=json_decode($row['os_width']);$os_width_e=$os_width->e;$os_width_w=$os_width->w;$os_width_n=$os_width->n;
			$os_width_s=$os_width->s;
		}
		    $chemical_stored=$row["chemical_stored"];$quantity_stored=$row["quantity_stored"];$type_storage=$row["type_storage"];
				$flash_stored=$row["flash_stored"];$details_electric=$row["details_electric"];$total_area=$row["total_area"];
				$access_premises=$row["access_premises"];$provision_segregate=$row["provision_segregate"];$size_exit=$row["size_exit"];
				$nearest_station=$row["nearest_station"];$fire_details=$row["fire_details"];$water_details=$row["water_details"];$personnel_details=$row["personnel_details"];$s_no=$row["s_no"];$license_no=$row["license_no"];
				$other_info=$row["other_info"];$submited_on=$row["sub_date"];       
}





##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3="";
	if($showtab=="" || $showtab<2 || $showtab>3 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";
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
										<strong>FORM NO. 8 <br/><?php echo $form_name=$formFunctions->get_formName('fire','8');?> </strong>
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
									<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $key_person;?>" disabled="disabled"></td>
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
									<td> State</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $block;?>" disabled="disabled"></td>
								
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $pincode;?>" disabled="disabled"></td>
								   
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
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="owner_address[s1]" id="street3" value="<?php if(isset($owner_address_s1)){echo $owner_address_s1;}?>" required="required" /></td>
								<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="owner_address[s2]" id="street4"  value="<?php if(isset($owner_address_s2)){echo $owner_address_s2;} ?>"/></td>
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
										<select name="owner_address[blk]" class="form-control text-uppercase" id="block1">										
											<?php if(isset($owner_address_blk) && ($owner_address_blk!="")){ ?>
												<option value="<?php echo $owner_address_blk; ?>"><?php echo $owner_address_blk; ?></option>
											<?php }else{ ?>
											<option value="">Select Block</option>
											<?php } ?>
										</select>
									</td>
									
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" name="owner_address[pin]" validate="pincode" id="pin1"  maxlength="6" value="<?php if(isset($owner_address_pin)){echo $owner_address_pin;} ?>" required="required"/></td>
									
									
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
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" style="font-weight:bold" name="save8a" class="btn btn-success submit1">Save and Next</button>
										</td>
										<td></td>
									</tr>
								</table>
								</form>
							</div>
	<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
	<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<table id="" class="table table-responsive">
		 <tr>
    <td width="25%">5. Chemicals proposed to be stored</td>
    <td width="25%"><input type="text"  class="form-control text-uppercase"  name="chemical_stored" id="chemical_stored" value="<?php echo $chemical_stored;?>"  required="required" /></td>
  
    <td width="25%">6. Quantity proposed to be Stored</td>
    <td width="25%"><input type="text"  class="form-control text-uppercase"  name="quantity_stored" id="quantity_stored" value="<?php echo $quantity_stored;?>"  required="required" /></td>
  </tr>
  <tr>
    <td>7. Type of the Storage</td>
    <td><input type="text" class="form-control text-uppercase"  name="type_storage" id="type_storage"  value="<?php echo $type_storage;?>"  required="required"/></td>
  
    <td>8. Flash point/s of the product proposed to be Stored</td>
    <td><input type="text"  class="form-control text-uppercase"  name="flash_stored" id="flash_stored" value="<?php echo $flash_stored;?>"  required="required"/></td>
  </tr>
  <tr>
    <td>9. Details of the electrification in the proposed area</td>
    <td><input type="text"  class="form-control text-uppercase"  name="details_electric" id="details_electric" value="<?php echo $details_electric;?>" /></td>
 
    <td>10. Total Storage Area/ Total area of the installation</td>
    <td><input type="text"  class="form-control text-uppercase" name="total_area" id="total_area" value="<?php echo $total_area;?>"  required="required" /></td>
  </tr>
  <tr>
    <td>11. Surrounding properties:</td>
    </tr>
      <tr>
        <td>East</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[e]" id="surround_prop[e]" value="<?php echo $surround_prop_e;?>"  required="required"/></td>
      
        <td>West</td>
        <td><input type="text"  class="form-control text-uppercase" validate="jsonObj" name="surround_prop[w]" id="surround_prop[w]" value="<?php echo $surround_prop_w;?>"  required="required"/></td>
        </tr>
      <tr>
        <td>North</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[n]"  id="surround_prop[n]" value="<?php echo $surround_prop_n;?>"  required="required" />
     
        <td>South</td>
        <td><input type="text"  class="form-control text-uppercase" validate="jsonObj" name="surround_prop[s]"  id="surround_prop[s]" value="<?php echo $surround_prop_s;?>"  required="required"/></td>
       
  </tr>
  <tr>
    <td>12. Accessibility to the premises</td>
    <td><input type="text" class="form-control text-uppercase"  name="access_premises" id="access_premises"  value="<?php echo $access_premises;?>"  required="required"/></td>
  </tr>
  <tr>
    <td colspan="3">13. Open Space available around the Storage:</td>
    </tr>
      <tr>
        <td>Eastern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[e]"  id="os_width[e]" value="<?php echo $os_width_e;?>"  required="required"/></td>
       
        <td>Western Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="os_width[w]"  id="os_width[w]" value="<?php echo $os_width_w;?>"  required="required"/></td>
        </tr>
      <tr>
        <td>Northern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[n]"  id="os_width[n]" value="<?php echo $os_width_n;?>"  required="required"/></td>
       
        
        <td>Southern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[s]"  id="os_width[s]" value="<?php echo $os_width_s;?>"  required="required"/></td>
        </tr>
      
  <tr>
    <td>14. Provision made of segregate the premises</td>
    <td><input type="text" class="form-control text-uppercase"  name="provision_segregate"  id="provision_segregate" value="<?php echo $provision_segregate;?>"  required="required"/></td>
  
    <td>15. Name, Type and size of the exits</td>
    <td><input type="text1" class="form-control text-uppercase"  name="size_exit"  id="size_exit" value="<?php echo $size_exit;?>"  required="required"/></td>
  </tr>
  <tr>
    <td>16. Name of the nearest fire Station</td>
    <td>
	
	<?php 
	$nearest_station=$nearest_station;
	$b_dist_id=$formFunctions->get_district_id($b_dist);	
	$fire_stations=$fire->query("select * from nearest_fire_stations where district_id='$b_dist_id'") or die($fire->error); ?>
	<select name="nearest_station" class="form-control text-uppercase" required="required">
		<option value="">Please Select Nearest Fire Station</option>
		<?php while($rows=$fire_stations->fetch_object()) {
			if(isset($nearest_station) && ($nearest_station==$rows->id)){
				$s='selected'; 
			}else{
				$s='';
			}  ?>
			<option value="<?php echo $rows->id; ?>" <?php echo $s;?>><?php echo $rows->nearest_fire_station; ?></option>
		<?php }		?>
	</select>
	</td>
  
    <td>17. Details of the Fire Fighting Equipments available</td>
    <td>
      <textarea name="fire_details" validate="textarea" class="form-control text-uppercase" id="fire_details" cols="45"  required="required" placeholder="Details of fire fight Equipments" rows="5"><?php echo $fire_details;?></textarea>
    </td>
  </tr>
  <tr>
    <td>18. Details of the water storages available in the premises</td>
    <td><textarea name="water_details" validate="textarea" class="form-control text-uppercase" id="water_details"  required="required" cols="45" rows="5" placeholder="Details of Water Storage"><?php echo $water_details;?></textarea></td>
 </tr><tr>
    <td>19. Details of the personnel trained basic fire fighting (Sl No. of the training certificate)</td>
    <td><textarea name="personnel_details" validate="textarea" class="form-control text-uppercase" id="personnel_details" placeholder="Details of Trained Personnel" cols="45" rows="5"><?php echo $personnel_details;?></textarea></td>
	
	<td>Sl.no</td>
	<td>
    <input type="text" class="form-control text-uppercase"  name="s_no" placeholder="Sl no" id="s_no" value="<?php echo $s_no;?>"/></td>
  </tr>
  <tr>
    <td>20. License number (not applicable for new applicants)</td>
    <td><input type="text" class="form-control text-uppercase" name="license_no" id="license_no" value="<?php echo $license_no;?>"/></td>
    <td>21. Any other information that the applicant desires to provide</td>
    <td>
      <textarea name="other_info" validate="textarea" class="form-control text-uppercase" id="other_info" cols="45" rows="5"><?php echo $other_info; ?></textarea>
    </td>
  </tr>
  
   <tr>
	
	<td class="text-center" colspan="4">
	<a href="fire_form8.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
		<button type="submit" style="font-weight:bold" name="save8b" class="btn btn-success submit1">Save and Next</button>
	</td>
	<td></td>
    </tr>
	</table>
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
					<td>Licence/Permission etc.</td>
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
					<td class="text-center" colspan="4">
						<a href="fire_form8.php?tab=2" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit8" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
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
$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
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

</script>
        </body>
</html>