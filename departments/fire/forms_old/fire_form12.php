<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','12');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=12&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=12&dept=fire';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
	$get_file_name=basename(__FILE__);

	include "save_form2.php";
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
		
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		
		$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
		$q=$fire->query("select * from fire_form12 where user_id='$swr_id' and active='1'") or die($fire->error);
	    $results=$q->fetch_assoc();
		$file1="";$file2="";$file3="";$caller_name="";$caller_no="";$occured_date="";$ocured_time="";$fire_station="";$distance_fire="";$descript_property="";$property_insured="";$property_uninsured="";$human_life="";$place_occurrence_vt="";$place_occurrence_w="";$place_occurrence_h="";$place_occurrence_p="";$place_occurrence_d="";$description="";$owner_address_name="";$owner_address_vt="";$owner_address_w="";$owner_address_h="";$owner_address_p="";$owner_address_d="";$occupant_address_name="";$occupant_address_vt="";$occupant_address_w="";$occupant_address_h="";$occupant_address_p="";$occupant_address_d="";$fire_desc_a="";$fire_desc_b="";$fire_desc_c="";$fire_desc_d="";$fire_desc_e="";
		$holding_no="";$insurance="";$noc="";
	
	     if($q->num_rows>0){
			$form_id=$results['form_id'];	
			$caller_name=$results["caller_name"];  $description=$results["description"]; $caller_no=$results["caller_no"];
			$occured_date=$results["occured_date"]; $ocured_time=$results["ocured_time"];$fire_station =$results["fire_station"];$distance_fire =$results["distance_fire"];
			$descript_property =$results["descript_property"];$property_insured =$results["property_insured"];$property_uninsured =$results["property_uninsured"];$human_life =$results["human_life"];	$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];	
			$holding_no=$results['holding_no'];$insurance=$results['insurance'];$noc=$results['noc'];	
				  
			if(!empty($results["place_occurrence"]))
			{
				$place_occurrence=json_decode($results["place_occurrence"]);
				$place_occurrence_vt=$place_occurrence->vt;$place_occurrence_w=$place_occurrence->w;$place_occurrence_h=$place_occurrence->h;
				$place_occurrence_p=$place_occurrence->p;$place_occurrence_d=$place_occurrence->d;
				
			}
			else
			{
				$place_occurrence_vt="";$place_occurrence_w="";$place_occurrence_h="";$place_occurrence_p="";$place_occurrence_d="";
			}
			if(!empty($results["owner_address"]))
			{
				$owner_address=json_decode($results["owner_address"]);
				$owner_address_name=$owner_address->name;$owner_address_vt=$owner_address->vt;$owner_address_w=$owner_address->w;$owner_address_h=$owner_address->h;$owner_address_p=$owner_address->p;$owner_address_d=$owner_address->d;
			}
			else
			{
				$owner_address_name="";$owner_address_vt="";$owner_address_w="";$owner_address_h="";$owner_address_p="";$owner_address_d="";
			}
			if(!empty($results["occupant_address"]))
			{
				$occupant_address=json_decode($results["occupant_address"]);
				$occupant_address_name=$occupant_address->name;$occupant_address_vt=$occupant_address->vt;$occupant_address_w=$occupant_address->w;$occupant_address_h=$occupant_address->h;$occupant_address_p=$occupant_address->p;$occupant_address_d=$occupant_address->d;
			}
			else
			{
				$occupant_address_name="";$occupant_address_vt="";$occupant_address_w="";$occupant_address_h="";$occupant_address_p="";$occupant_address_d="";
			}
			if(!empty($results["fire_desc"]))
			{
				$fire_desc=json_decode($results["fire_desc"]);
				$fire_desc_a=$fire_desc->a;$fire_desc_b=$fire_desc->b;$fire_desc_c=$fire_desc->c;$fire_desc_d=$fire_desc->d;
			}
			else
			{
				$fire_desc_a="";$fire_desc_b="";$fire_desc_c="";$fire_desc_d="";
				$fire_desc_e="";	
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
										<strong>FORM NO. XIII <br/><?php echo $form_name=$formFunctions->get_formName('fire','12');?> </strong>
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
								<td colspan="4">1. Name of caller with Telephone Number:</td>
                    </tr>
                    <tr>
							<td width="25%">Name</td>
							<td width="25%">
				   		       <input type="text" name="caller_name" validate="letters" class="form-control text-uppercase" required="required" value="<?php echo $caller_name; ?>" /></td>
							<td width="25%">Mobile No.</td>
							<td width="25%">
							<input type="text" id="textfield3_phone" class="form-control text-uppercase" required="required" maxlength="10" name="caller_no" value="<?php echo $caller_no; ?>" validate="mobileNumber" placeholder="Mobile Number" /></td>
								   
					</tr>
								     
					<tr>
							<td>2. Date of Occurence:</td>
							<td><input type="text" class="dob form-control text-uppercase" name="occured_date" id="date_occurrence" value="<?php echo date('Y-m-d',strtotime($occured_date)); ?>" required="required" readonly="readonly" />
							</td>
							<td> Time of Occurence:</td>
							<td>
							<input type="" class="form-control text-uppercase mytime" id="time_occurrence" name="ocured_time" value="<?php if(empty($ocured_time)){echo date('H:m');} else {echo $ocured_time;} ?>" /></td>
					</tr>
					<tr>
						<td>3. Name of nearest Fire &amp; Emergency Services Station :</td>
						<td><input type="text" class="form-control text-uppercase" name="fire_station" value="<?php echo $fire_station; ?>" /></td>

						<td>4. Distance from the Fire &amp; E.S. Station to the place of occurence in KM: 
						</td>
						<td>
						<input type="text" class="form-control text-uppercase" validate="decimal" name="distance_fire" required="required" placeholder="Distance (Km)"  value="<?php echo $distance_fire; ?>"/>
						</td>
					</tr>
					<tr>
						<td colspan="3">5. Place of Occurrence:<font color="red">*</font></td>
					</tr>	
				     <tr>
						  <td>Village/Town</td>
						  <td><input type="text" class="form-control text-uppercase" name="place_occurrence[vt]" required="required" id="place_occurrence[vt]" value="<?php echo $place_occurrence_vt;?>" /></td>
						
							<td>Ward No</td>
							<td><input type="text" class="form-control text-uppercase"  value="<?php echo $place_occurrence_w;?>" required="required" name="place_occurrence[w]" id="place_occurrence[w]" /></td>
				      </tr>
				      <tr>
							 <td>Holding No</td>
							 <td><input type="text" class="form-control text-uppercase" required="required"  name="place_occurrence[h]" value="<?php echo $place_occurrence_h;?>" id="place_occurrence[h]"/></td>
							<td>Police Station</td>
							<td><input type="text" class="form-control text-uppercase"  required="required" name="place_occurrence[p]" value="<?php echo $place_occurrence_p;?>"/></td>
					 </tr>
					 <tr>
							<td>District</td>
							<td>
								<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
									<select class="form-control text-uppercase" name="place_occurrence[d]" id="textfield47"><?php
									while($dstrows=$dstresult->fetch_object()) { 
										  if(isset($place_occurrence_d) && ($place_occurrence_d==$dstrows->district)) $s='selected'; else $s=''; ?>
											<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
										<?php } ?>					
									</select>				
							</td>
						</tr>
					<tr>
						<td colspan="3" >6. Name &amp; Address of Owner of the Property:<font color="red">*</font>
						</td>
					</tr>
					<tr>
						<td>Owner Name</td>
						<td><input type="text" class="form-control text-uppercase" validate="letters" required="required" placeholder="Owner's Name"  name="owner_address[name]" id="owner_name" value="<?php echo $owner_address_name;?>" /></td>
					 
						<td> Village/Town</td>
						<td><input type="text" class="form-control text-uppercase"  name="owner_address[vt]" id="owner_address[vt]" required="required" value="<?php echo $owner_address_vt;?>"/></td>
					 </tr>
					<tr>
						<td>Ward No</td>
						<td><input type="text" class="form-control text-uppercase" name="owner_address[w]" id="owner_address[w]" required="required" value="<?php echo $owner_address_w;?>" /></td>
					 
						<td>Holding No</td>
						<td><input type="text" class="form-control text-uppercase"  name="owner_address[h]" id="owner_address[h]" required="required" value="<?php echo $owner_address_h;?>"/></td>
					 </tr>
					 <tr>
						<td>Police Station</td>
						<td><input type="text" class="form-control text-uppercase" name="owner_address[p]" required="required" value="<?php echo $owner_address_p;?>" /></td>
						<td>District</td>
						<td>
							<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
								<select name="owner_address[d]" class="form-control text-uppercase" id="textfield47"><?php
								while($dstrows=$dstresult->fetch_object()) { 
									  if(isset($owner_address_d) && ($owner_address_d==$dstrows->district)) $s='selected'; else $s=''; ?>
										<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
									<?php } ?>					
								</select>
						</td>	
					</tr>
					<tr>						
						<td class="text-center" colspan="4">
							<button type="submit" style="font-weight:bold" name="save12a" class="btn btn-success submit1">Save and Next</button>
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
			<td colspan="4">7. Name &amp; Address of the occupants:<span style="color:#ff0000;">*</span></td>
		</tr>
	    <tr>
			<td width="25%">Name:</td>
			<td width="25%"><input type="text" name="occupant_address[name];" class="form-control text-uppercase" validate="letters" id="textfield43" value="<?php  echo $occupant_address_name;; ?>" required="required"  />
             
			</td>
	
			<td width="25%">Village/Town:</td>
			<td width="25%"><input type="text" name="occupant_address[vt]" class="form-control text-uppercase" id="textfield44" required="required" value="<?php echo $occupant_address_vt; ?>" /></td>
	    </tr>
	     <tr>
			<td>Ward No:</td>
			<td><input type="text" name="occupant_address[w]" class="form-control text-uppercase" id="textfield45" value="<?php echo $occupant_address_w; ?>" /></td>
	
			<td>Holding No:</td>
			<td><input type="text" name="occupant_address[h]" class="form-control text-uppercase"id="textfield46" required="required" value="<?php echo $occupant_address_h; ?>" /></td>
	    </tr>
	
	     <tr>
			<td>Police Station:</td>
			<td><input ype="text"  class="form-control text-uppercase" name="occupant_address[p]" required="required" value="<?php echo $occupant_address_p; ?>" /></td>
	
			<td>District:</td>
			<td>
			<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
	         <select name="occupant_address[d]" class="form-control text-uppercase"><?php
		     while($dstrows=$dstresult->fetch_object()) { 
			 if(isset($occupant_address_d) && ($occupant_address_d==$dstrows->district)) $s='selected'; else $s=''; ?>
			<option value="<?php echo $dstrows->district; ?>"<?php echo $s;?>><?php echo $dstrows->district; ?></option>
		    <?php } ?>					
	       </select>	
			</td>
        </tr>
		<tr>
			<td colspan="2">8. Brief Description of Property involved and gutted in fire:	</td>			
		</tr>
				  
		<tr>
				<td>a. Nature of construction of the building:</td>
				<td><input type="text" name="fire_desc[a];" class="form-control text-uppercase" value="<?php  echo $fire_desc_a; ?>" required="required"  />
				</td>
				<td>b. Height of the building:</td>
				<td><input type="text" name="fire_desc[b]"  class="form-control text-uppercase"id="textfield44" required="required" value="<?php echo $fire_desc_b; ?>" /></td>
		</tr>
		<tr>
				<td>c. Number of Floors:</td>
				<td><input type="text" name="fire_desc[c]"  class="form-control text-uppercase" id="textfield45" validate="onlyNumbers" pattern="[0-9]{1,5}" title="Only Numbers are allowed"value="<?php echo $fire_desc_c; ?>" /></td>
				<td>d. Covered Floor Area:</td>
				<td><input type="text" name="fire_desc[d]" class="form-control text-uppercase"id="textfield46" required="required" value="<?php echo $fire_desc_d; ?>" /></td>
		</tr>
		<tr>
				<td>e. Description of internal contents:</td>
				<td><textarea type="text" name="description" class="form-control text-uppercase" id="description" required="required" /><?php echo $description; ?></textarea></td>
		<tr>
			<td colspan="2">9. Documentary/ Evidential proof of Property gutted / involved in Fire:	</td>			
		</tr>
		<tr>
				<td>a. Holding No. of the building :</td>
				<td><input type="text" name="holding_no" class="form-control text-uppercase" id="holding_no" value="<?php  echo $holding_no; ?>" required="required"  />
				</td>
				<td>b. Insurance policy :</td>
				<td><input type="text" name="insurance" class="form-control text-uppercase" id="insurance" required="required" value="<?php echo $insurance; ?>" /></td>
		</tr>
		<tr>
				<td>c. Fire Safety N.O.C./ Trade License/ any other License or Permission etc. from concerned authority :</td>
				<td><input type="text" name="noc" class="form-control text-uppercase" id="noc" required="required" value="<?php echo $noc; ?>" /></td>
		</tr>
			<td >10. Description of internal Content/ Property: </td>
			<td  ><textarea type="text" required="required" class="form-control text-uppercase" name="descript_property" id="descript_property"><?php echo $descript_property;?></textarea></td>
		</tr>
		<tr>
			<td >11. a. Property Insured:</td>
			<td align="left"><textarea type="text" class="form-control text-uppercase"  required="required" name="property_insured" id="property_insured"><?php echo $property_insured;?></textarea></td></td>
		
			<td >&nbsp;&nbsp;&nbsp;&nbsp; b. Property uninsured:</td>
			<td align="left"><textarea type="text"  required="required" class="form-control text-uppercase" name="property_uninsured" id="property_uninsured"><?php echo $property_uninsured;?></textarea></td></td>
		</tr>
		<tr>
			<td >12. If Human Life or Animal Life injured/lost if any, give details:</td>
			<td align="left"><textarea type="text"  name="human_life" class="form-control text-uppercase" id="human_life"><?php echo $human_life;?></textarea></td></td>
		</tr>
         <tr>
	
	         <td class="text-center" colspan="4">
	         <a href="fire_form12.php?tab=1" class="btn btn-primary">Go Back & Edit</button></a>
		    <button type="submit" style="font-weight:bold" name="save12b" class="btn btn-success sumbit1">Save and Next</button>
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
					<td width="50%"> Holding No of the building</td>
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
					<td>Insurance Policy</td>
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
					<td> Fire Safety N.O.C./Trade License/any other License or Permission etc. from concerned authority.</td>
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
					<td class="text-center" colspan="5">
						<a href="fire_form12.php?tab=2" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit12" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
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

/* ----------------------------------------------------- */
$('#date_occurrence').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});

    $('.time_occurrence').timepicker({ timeFormat: 'h:mm:ss p' });

	
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


</script>
        </body>
</html>