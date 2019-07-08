<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','10');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=10&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=10&dept=fire';
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
	$key_person=$rows['Key_person'];$unit_name=$rows['Name'];$street_name1=$rows['Street_name1'];$street_name2=$rows['Street_name2'];$vill=$rows['Vill'];$dist=$rows['Dist'];$block=$rows['block'];$pincode=$rows['Pincode'];$mobile_no=$rows['Mobile_no'];$landline_std=$rows['Landline_std'];$landline_no=$rows['Landline_no'];$owner_name=$rows['Name_of_owner'];
	$b_street_name1=$rows['b_street_name1'];$b_street_name2=$rows['b_street_name2'];$b_vill=$rows['b_vill'];$b_dist=$rows['b_dist'];$b_block=$rows['b_block'];$b_pincode=$rows['b_pincode'];$b_mobile_no=$rows['b_mobile_no'];$b_landline_std=$rows['b_landline_std'];$b_landline_no=$rows['b_landline_no'];$b_email=$rows['b_email'];
	$from=strtoupper($key_person)." \n".strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill)."\nBlock : ".strtoupper($block)."\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$fire->query("select * from fire_form10 where user_id='$swr_id' and active='1'") or die($fire->error);
	$row=$q->fetch_assoc();
		$file1="";$file2="";$file3="";$file4="";$ms="";$hsd="";$sk="";$fo="";$p_o_name="";$p_o_addr="";
	if($q->num_rows>0){  
	        $form_id=$row["form_id"];$p_o_name=$row["p_o_name"];$p_o_addr=json_decode($row['p_o_addr']);$p_o_addr_s1=$p_o_addr->s1;$p_o_addr_s2=$p_o_addr->s2;$p_o_addr_vt=$p_o_addr->vt;$p_o_addr_blk=$p_o_addr->blk;$p_o_addr_dist=$p_o_addr->dist;$p_o_addr_pin=$p_o_addr->pin;
	        $q=$fire->query("select * from fire_form10_docs where form_id='$form_id' ") or die($fire->error);
	      $rest=$q->fetch_assoc();
		   $file1=$rest['file1'];$file2=$rest['file2'];$file3=$rest['file3'];$file4=$rest['file4'];
		  
	        if(empty($row['s_properties'])==false){
			$s_properties=json_decode($row['s_properties']);
			$s_properties_e=$s_properties->e;$s_properties_w=$s_properties->w;$s_properties_n=$s_properties->n;$s_properties_s=$s_properties->s;
			}
			if(empty($row['o_s_a_storage'])==false){
			$o_s_a_storage=json_decode($row['o_s_a_storage']);
			$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
			}
			if(empty($row['sl_c_details'])==false){
			$sl_c_details=json_decode($row['sl_c_details']);
			$sl_c_details_s=$sl_c_details->s;
			}

			if(empty($row['quantity_stored'])==false){
			$quantity_stored=explode(',',$row['quantity_stored']);
			foreach($quantity_stored as $k){
			if($k=="M.S"){
				$ms="checked";
			}
			if($k=="HSD"){
				$hsd="checked";
			}
			if($k=="SK"){
				$sk="checked";
			}
			if($k=="FO"){
				$fo="checked";
			}
		}
	}
	
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
										<strong>FORM - X <br/><?php echo $form_name=$formFunctions->get_formName('fire','10');?> </strong>
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
									<td colspan="4">1. Name and address of the applicant</td>
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
									<td><input type="text" class="form-control text-uppercase" validate="letters" name="p_o_name" id="oname"  value="<?php echo $p_o_name;?>" required="required"/></td>
								</tr>
								<tr>	
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="p_o_addr[s1]" id="street3" value="<?php if(isset($p_o_addr_s1)){echo $p_o_addr_s1;}?>" required="required" /></td>
								<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="p_o_addr[s2]" id="street4"  value="<?php if(isset($p_o_addr_s2)){echo $p_o_addr_s2;} ?>" /></td>
								</tr>
								<tr>	
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="p_o_addr[vt]" id="vill1"  value="<?php if(isset($p_o_addr_vt)){echo $p_o_addr_vt;} ?>" required="required"/></td>
									
									
								
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
									<td><input type="text" class="form-control text-uppercase" name="p_o_addr[pin]" validate="pincode" id="pin1"  maxlength="6" value="<?php if(isset($p_o_addr_pin)){echo $p_o_addr_pin;} ?>" required="required"/></td>
									
									
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
											<button type="submit" style="font-weight:bold" name="save10a" class="btn btn-success submit1">Save and Next</button>
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
        <td width="25%">5. Chemicals (Raw material) proposed to be stored</td>
        <td width="25%"><input type="text" value="<?php echo $row['chemicals'];?>" class="form-control text-uppercase"  name="chemicals" id="chemicals" required="true" /></td>
 
       <td width="25%">6. Quantity proposed to be Stored</td>
       <td width="25%">
      
        <input  type="checkbox" value="M.S" name="quantity_stored[]" id="chk1" <?php echo $ms; ?> />
        M.S
        &nbsp;&nbsp;&nbsp;
       
		<input  type="checkbox" value="HSD" name="quantity_stored[]" id="chk2" <?php echo $hsd; ?> />
		HSD
        &nbsp;&nbsp;&nbsp;
        
        <input type="checkbox" value="SK" name="quantity_stored[]" id="chk3" <?php echo $sk; ?> />
        SK
        &nbsp;&nbsp;&nbsp;
        
        <input type="checkbox" value="FO" name="quantity_stored[]" id="chk4" <?php echo $fo; ?> />
        FO
      </td>
  </tr>
  <tr>
    <td>7. Type of the Storage</td>
    <td>
        
          <input type="radio" name="type_of_storage" required value="Under Ground" id="RadioGroup1_0" <?php if($row['type_of_storage']=='Under Ground') echo "checked"; ?> />
          Under Ground
        &emsp;&emsp;
       
          <input type="radio" name="type_of_storage" value="Above the ground" id="RadioGroup1_1" <?php if($row['type_of_storage']=='Above the ground' || $row['type_of_storage']!='') echo "checked"; ?> />
          Above the ground
        </td>
  
    <td>8. Flash point/s of the product proposed to be Stored</td>
    <td><input type="text" class="form-control text-uppercase"  name="flash_point" id="textfield22" value="<?php echo $row['flash_point']; ?>"  required="required" /></td>
 </tr>
  <tr>
    <td>9. Details of the electrification in the proposed area</td>
    <td><input type="text" class="form-control text-uppercase" placeholder="electrification details"  name="electrification_details" id="textfield23" value="<?php echo $row['electrification_details'];?>" />
    </td>
  
    <td>10. Total Storage Area/ Total area of the installation</td>
    <td><input type="text" class="form-control text-uppercase" name="t_s_area" id="sitearea"   value="<?php echo $row['t_s_area']; ?>"  required="required"/></td>
  </tr>
  <tr>
    <td>11. Surrounding properties:</td>
    </tr>
  <tr>
    
        <td>East</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="s_properties[e]" id="east"   value="<?php if(isset($s_properties_e)) echo $s_properties_e; ?>"  required="required"/></td>
      
        <td>West</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="s_properties[w]" id="west"   value="<?php if(isset($s_properties_w)) echo $s_properties_w; ?>"  required="required"/></td>
      </tr>
      <tr>
        <td>North</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="s_properties[n]" id="north"   value="<?php if(isset($s_properties_n)) echo $s_properties_n; ?>"  required="required"/></td>
      
        <td>South</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="s_properties[s]" id="south"   value="<?php if(isset($s_properties_s)) echo $s_properties_s; ?>"  required="required"/></td>
      </tr>
    
  <tr>
    <td>12. Accessibility to the premises</td>
    <td><input type="text" class="form-control text-uppercase" placeholder="Accessibility to premises" name="p_accessibility" id="textfield29"  value="<?php echo $row['p_accessibility'];?>"  required="required"/></td>
  </tr>
  <tr>
    <td>13. Open Space available around the Structure</td>
    </tr>
      <tr>
        <td>Eastern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="o_s_a_storage[e]"  id="eastern"  value="<?php if(isset($o_s_a_storage_e)) echo $o_s_a_storage_e; ?>"  required="required"/></td>
      
        <td>Western Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="o_s_a_storage[w]" id="western"   value="<?php if(isset($o_s_a_storage_w)) echo $o_s_a_storage_w; ?>"  required="required"/></td>
      </tr>
      <tr>
        <td>Northern Side</td>
        <td><input type="text"class="form-control text-uppercase" validate="jsonObj" name="o_s_a_storage[n]" id="northern"   value="<?php if(isset($o_s_a_storage_n)) echo $o_s_a_storage_n; ?>"  required="required"/></td>
      

        <td>Southern Side</td>
        <td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="o_s_a_storage[s]" id="southern"   value="<?php if(isset($o_s_a_storage_s)) echo $o_s_a_storage_s; ?>"  required="required"/></td>
      
  </tr>
 <tr>
    <td>14. Provision made of segregate the premises</td>
    <td><input type="text" class="form-control text-uppercase"  name="segregate" id="textfield34" value="<?php echo $row['segregate'];?>"  required="required" /></td>
 
    <td>15. Name of the nearest Fire Station</td>
    <td>
	<?php 
	$nearest_station=$row['nearest_station'];
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
  </tr>
  <tr>
    <td>16. Details of the Fire Fighting Equipments available</td>
    <td>
      <textarea name="details_f_f_system" validate="textarea" id="equipment" class="form-control text-uppercase" required="required" cols="45" placeholder="Details of Equipments" rows="5"><?php echo $row['details_f_f_system']; ?></textarea></br><span>255</span> Characters Only</td>
  
    <td>17. Details of the water storages available in the premises</td>
    <td><textarea name="details_w_s" validate="textarea" class="form-control text-uppercase" id="water_storage" cols="45"  required="required" rows="5" placeholder="Details of Water Storage"> <?php echo $row['details_w_s']; ?></textarea></br><span>255</span> Characters Only</td>
 </tr>
  <tr>
    <td>18. Details of the personnel trained basic fire fighting (training certificates)</td>
	
    <td><textarea name="details_p_t"  validate="textarea" id="pl_details" cols="45" rows="5" class="form-control text-uppercase" placeholder="Details of Trained Personnel" ><?php echo $row['details_p_t']; ?></textarea></br><span>255</span> Characters Only<br/></td>
	<td>Sl.no</td>
	<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="sl_c_details[s]" placeholder="SL No" id="pl_id" onchange="onlyNumber(this.id)" value="<?php if(isset($sl_c_details_s)) echo $sl_c_details_s; ?>"/></td>
	
  </tr>
  <tr>
    <td>19. License number (not applicable for new applicants)</td>
    <td><input type="text" class="form-control text-uppercase" name="lc_no" placeholder="license number" id="textfield41" value="<?php echo $row['lc_no'];?>" /></td>
    <td>20. Any other information that the applicant desires to provide</td>
    <td >
      <textarea name="other_info" id="textfield42" cols="45" rows="5" validate="textarea" class="form-control text-uppercase" ><?php echo $row['other_info'];?></textarea></br><span>255</span> Characters Only
    </td>
  </tr>
  
   <tr>
	
	<td class="text-center" colspan="4">
	<a href="fire_form10.php?tab=1"><button type="submit" class="btn btn-primary">Go Back &amp; Edit</button></a>
		<button type="submit" style="font-weight:bold" name="save10b" class="btn btn-success submit1">Save and Next</button>
	</td>
	<td></td>
    </tr>
	</table>
</form>
</div>
							
							
<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
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
					<td>Licence/ Permission etc.</td>
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
						<a href="fire_form10.php?tab=2" class="btn btn-primary">Go Back &amp; Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit10" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">SUBMIT</button>
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