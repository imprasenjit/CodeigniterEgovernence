<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=fire';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
	$get_file_name=basename(__FILE__);
	include "save_form2.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);			
	$name_of_owner=$row1['Name_of_owner'];$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];		
	$from=strtoupper($key_person)." \n".strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill)."\nBlock : ".strtoupper($block)."\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;	
	$q=$fire->query("select * from fire_form2 where user_id='$swr_id' and active='1'") or die($fire->error);
	$results=$q->fetch_assoc();
	$other_info="";$license_no="";$nearest_station="";$segregate="";$premise_access="";$surround_prop="";$space_storage="";$details=""; $surround_prop_e= ""; $surround_prop_w= "";$surround_prop_n=""; $surround_prop_s="";$space_storage_e=""; $space_storage_w= "";$space_storage_n=""; $space_storage_s= ""; $details_fire= "";$details_water= "";$details_trained= "";$details_slno= "";$file1="";$file2="";$file3="";$file5="";$p_o_name="";$stored="";$stored_chemical="";$stored_flash_point="";$stored_qnt="";$stored_type="";$clr_details="";$t_s_area="";		
	if($q->num_rows>0){	 
		$form_id=$results['form_id'];
		$p_o_name=$results['p_o_name'];$t_s_area=$results['t_s_area'];$clr_details=$results['clr_details'];
		$other_info=$results['other_info'];$nearest_station=$results['nearest_station'];$license_no=$results['license_no'];$segregate=$results['segregate'];$premise_access=$results['premise_access'];$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file5=$results['file5'];					

		if(!empty($results["stored"])){
			$stored=json_decode($results["stored"]);
			$stored_chemical=$stored->chemical;	$stored_flash_point= $stored->flash_point;	$stored_qnt= $stored->qnt;$stored_type= $stored->type;	
		}

		if(!empty($results["p_o_addr"])){
			$p_o_addr=json_decode($results["p_o_addr"]);
			$p_o_addr_s1= $p_o_addr->s1; $p_o_addr_s2= $p_o_addr->s2;$p_o_addr_vt= $p_o_addr->vt; $p_o_addr_dist= $p_o_addr->dist;
			$p_o_addr_blk= $p_o_addr->blk;	$p_o_addr_pin=$p_o_addr->pin;
		}
		if(!empty($results["surround_prop"])){
			$surround_prop=json_decode($results["surround_prop"]);
			
			$surround_prop_e= $surround_prop->e; $surround_prop_w= $surround_prop->w;$surround_prop_n= $surround_prop->n; $surround_prop_s= $surround_prop->s; 
		}
		if(!empty($results["space_storage"])){
			$space_storage=json_decode($results["space_storage"]);
			
			$space_storage_e= $space_storage->e; $space_storage_w= $space_storage->w;$space_storage_n= $space_storage->n; $space_storage_s= $space_storage->s; 
			}
		if(!empty($results["details"])){
			$details=json_decode($results["details"]);				
			if(isset($details->fire)) $details_fire= $details->fire; else $details_fire="";
			if(isset($details->water)) $details_water= $details->water; else $details_water="";
			if(isset($details->trained)) $details_trained= $details->trained; else $details_trained="";
			if(isset($details->slno)) $details_slno= $details->slno; else $details_slno="";		
		}else{
			$details_fire="";$details_water="";$details_trained="";$details_slno="";
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
										<strong>FORM NO. 2 <br/><?php echo $form_name=$formFunctions->get_formName('fire','2');?> </strong>
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
						<td colspan="3">1. Name and address of the Applicant</td>
						<td></td>
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
						   <td></td>
						   <td></td>
					</tr>
							
		<tr>
				<td colspan="4">2. Name and Address of the owner of the premises</td>
			</tr>
			<tr>
				<td> Owner's Name</td>
				<td><input type="text" class="form-control text-uppercase"  validate="letters"  name="p_o_name" id="oname"  value="<?php echo $p_o_name;?>" required="required"/></td>
			</tr>
			<tr>
				<td>Street Name 1</td>
				<td><input type="text" class="form-control text-uppercase" name="p_o_addr[s1]" id="street3" value="<?php if(isset($p_o_addr_s1)){echo $p_o_addr_s1;}?>" required="required" /></td>
				<td>Street Name 2</td>
				<td><input type="text" class="form-control text-uppercase" name="p_o_addr[s2]" id="street4"  value="<?php if(isset($p_o_addr_s2)){echo $p_o_addr_s2;} ?>" /></td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td><input type="text" class="form-control text-uppercase" name="p_o_addr[vt]" id="vill1"  value="<?php if(isset($p_o_addr_vt)){echo $p_o_addr_vt;} ?>" required="required"/></td>
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
					<td>
						<select name="p_o_addr[blk]" class="form-control text-uppercase" required="required" id="block1" >										
							<?php if(isset($p_o_addr_blk) && ($p_o_addr_blk!="")){ ?>
								<option value="<?php echo $p_o_addr_blk; ?>"><?php echo $p_o_addr_blk; ?></option>
							<?php }else{ ?>
							<option value="">Select Block</option>
							<?php } ?>
						</select>
					</td>
					
					<td>Pincode</td>
					<td><input type="text" class="form-control text-uppercase" validate="pincode"  name="p_o_addr[pin]" onblur="checkPin(this.id)" id="pin1"  maxlength="6" value="<?php if(isset($p_o_addr_pin)){echo $p_o_addr_pin;} ?>" required="required"/></td>					
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
				<td>5. Chemical name/s of the gas/gases proposed to be stored : </td>
				<td><input type="text" class="form-control text-uppercase"   name="stored[chemical]" placeholder="" id="chemical_name" required="required"  value="<?php echo $stored_chemical;?>"/></td>

				 <td>6. Quantity proposed to be stored:</td>
				<td><input type="text" class="form-control text-uppercase" name="stored[qnt]" placeholder="" required value="<?php echo $stored_qnt;?>"/></td>
			 </tr>
			<tr>
				<td>7. Type of the Storage:</td>
				<td><input type="text" class="form-control text-uppercase"  name="stored[type]" id="storage_type" required="required" value="<?php echo $stored_type;?>"/></td>
			
				<td>8. Flash Point/s of the product proposed to be Stored:</td>
				<td><input type="text" class="form-control text-uppercase"  name="stored[flash_point]"  id="flash_storage" required="required" value="<?php echo $stored_flash_point;?>"/></td>
			</tr>
			<tr>
				<td>9. Details of the electrification in the proposed area:</td>
				<td><input type="text" class="form-control text-uppercase"  name="clr_details"  id="clerification_area" required="required" value="<?php echo $clr_details;?>"/></td>
			
				<td>10. Total Storage Area/ Total area of the installation :&emsp;&emsp;&emsp;</td>
				<td><input type="text" class="form-control text-uppercase" name="t_s_area" placeholder="" id="installation_area" required="required" value="<?php echo $t_s_area;?>"/></td>
			</tr>
		</table>
		<div align="center">
			<button type="submit" style="font-weight:bold" name="save2a" class="btn btn-success submit1">Save and Next</button>
		</div>	
	</form>
	</div>
    <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<table id=""  class="table table-responsive">
				<tr>
					<td colspan="4">11. Surrounding properties:</td>
				 </tr>
				 <tr>
						<td width="25%">East</td>
						<td width="25%"><input type="text" class="form-control text-uppercase"  required="required" name="surround_prop[e]" id="surround_prop[e]" value="<?php echo $surround_prop_e;?>"/></td>
				
						<td width="25%">West</td>
						<td width="25%"><input type="text" class="form-control text-uppercase"   name="surround_prop[w]" required="required"  id="surround_prop[w]" value="<?php echo $surround_prop_w;?>"/></td>
				</tr>
				<tr>
						<td>North</td>
						<td><input type="text" class="form-control text-uppercase"  name="surround_prop[n]" required="required"  id="surround_prop[n]" value="<?php echo $surround_prop_n;?>"/></td>
					 
						<td>South</td>
						<td><input type="text" class="form-control text-uppercase"  name="surround_prop[s]" required="required" id="surround_prop[s]" value="<?php echo $surround_prop_s;?>"/></td>
				</tr>							
				<tr>
					<td>12. Accessibility to the premises:</td>
					<td><input type="text" class="form-control text-uppercase"  required="required" name="premise_access" id="premise_access" placeholder="Accessibility to Premises" value="<?php echo $premise_access;?>"/></td>
				</tr>
				<tr>
					<td>13. Open Space available around the Storage:</td>
				</tr>
					  <tr>
						<td>Eastern Side:</td>
						<td><input type="text" class="form-control text-uppercase"  required="required" name="space_storage[e]" id="space_storage[e]" value="<?php echo $space_storage_e;?>"/></td>
					 
						<td>Western Side:</td>
						<td><input type="text" class="form-control text-uppercase"  name="space_storage[w]" required="required"  id="space_storage[w]" value="<?php echo $space_storage_w;?>"/></td>
					  </tr>
					  <tr>
						<td>Northern Side:</td>
						<td><input type="text" class="form-control text-uppercase"  name="space_storage[n]" required="required"  id="space_storage[n]" value="<?php echo $space_storage_n;?>"/></td>
					  
						<td>Southern Side:</td>
						<td><input type="text" class="form-control text-uppercase"  name="space_storage[s]" required="required"  id="space_storage[s]" value="<?php echo $space_storage_s;?>"/></td>
				</tr>							
				<tr>
					<td>14. Provision made of segregate the premises :</td>
					<td><input type="text" class="form-control text-uppercase" name="segregate" required="required"  id="segregate" value="<?php echo $segregate;?>"/></td>
				
					<td>15. Name of the nearest Fire Station  :</td>
					<td><?php 
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
					</select> </td>
				</tr>						
				<tr>			
					<td>16. Details of the Fire Fighting Equipments available in the premises:</td>
					<td>
					<input type="text" class="form-control text-uppercase"  required="required" name="details[fire]"  id="no_of_entrance" value="<?php echo $details_fire;?>"/></td>
				
					<td>17. Details of the water storages available in the premises :</td>
					<td><input type="text" class="form-control text-uppercase"  name="details[water]" required="required" id="projection_height" value="<?php echo $details_water;?>"/></td>
				</tr>
				<tr>
					<td>18. Details of the personnel trained in basic fire fighting :</td>
					<td><input type="text" class="form-control text-uppercase"  name="details[trained]" required="required" id="details_trained" value="<?php echo $details_trained;?>"/></td>
				
					<td>19. Sl No. of the training certificate:</td>
					<td><input type="text" class="form-control text-uppercase"  name="details[slno]" id="no_of_rams" value="<?php echo $details_slno;?>"/></td>
				</tr>
				<tr>
					<td>20. License number ( not applicable for new applicants) :</td>
					<td><input type="text" class="form-control text-uppercase"  name="license_no" id="license" value="<?php echo $license_no;?>"/></td>
				
					<td>21. Any other information that the applicant desires to provide :</td>
					<td><textarea class="form-control text-uppercase" name="other_info" id="other_info" validate="textarea" ><?php echo $other_info;?></textarea></td>
					
				</tr>									
			</table>
			<div align="center">
			<a href="fire_form2.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
				<button type="submit" style="font-weight:bold" name="save2b" class="btn btn-success submit1">Save and Next</button>
			</div>	
		</form>
		</div>							
		<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
			<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table  id=""  class="table table-responsive" >										
				<tr>
					<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mandatory. Please upload all proper documents before proceeding further).</td>
				</tr>
				<tr>
					<td width="50%"> Site Plan</td>
					 <td width="30%">
                                            <select trigger="FileModal" id="file1" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
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
                                                <option value="3">Not Applicable</option>
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
                                                <option value="3">Not Applicable</option>
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
                                            <select trigger="FileModal" id="file5" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file5); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile5" id="mfile5" value="<?php echo $file5 !== '' ? $file5 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile5">
                                            <?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td class="text-center" colspan="4">
						<a href="fire_form2.php?tab=2"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>										
						<button type="submit" class="btn btn-success submit1" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">FINAL SUBMIT</button>
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
</script>
        </body>
</html>