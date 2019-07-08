
<?php 
require_once "../includes/login-session.php"; 
$check=$formFunctions->is_already_registered('rfs','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=rfs';
		</script>";	
}
            $file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$certificate_affidafit="";$photo_sign1="";
	 	    $photo_sign2="";$photo_sign3="";$photo_presid="";$photo_secret="";$gm_meeting_dh="";$gm_meeting_pm="";$gm_meeting_np="";
	        $memberCount=0;
include("save_form.php");	
$get_file_name=basename(__FILE__);
   $soc=$rfs->query("select * from rfs_form2 where user_id='$swr_id' and active='1'");
	if(mysqli_num_rows($soc)>0){
 
	    $row1=$soc->fetch_array();
       $form_id=$row1["form_id"];$soc_name=$row1["soc_name"];$obj_rural=$row1["obj_rural"];$obj_health=$row1["obj_health"];
		$obj_woman=$row1["obj_woman"];$obj_education=$row1["obj_education"];$obj_science=$row1["obj_science"];$obj_arts=$row1["obj_arts"];
		$obj_sports=$row1["obj_sports"];$obj_agri=$row1["obj_agri"];$obj_env=$row1["obj_env"];$obj_other=$row1["obj_other"];
		
		 if(!empty($row1["courier_details"])){
				$courier_details=json_decode($row1["courier_details"]);
				$courier_details_cn=$courier_details->cn;	$courier_details_rn= $courier_details->rn;	$courier_details_dt= $courier_details->dt;
			}	
		if(!empty($row1['soc_address']))
		{
			$soc_address=json_decode($row1['soc_address']);
			$soc_address_mouza=$soc_address->mouza;$soc_address_circle=$soc_address->circle;$soc_address_patta=$soc_address->patta;
			$soc_address_dag=$soc_address->dag;$soc_address_area=$soc_address->area;$soc_address_locality=$soc_address->locality;
			$soc_address_village=$soc_address->village;$soc_address_dist=$soc_address->dist;$soc_address_pin=$soc_address->pin;
			$soc_address_ps=$soc_address->ps;$soc_address_po=$soc_address->po;
			
		}
		$soc_reg_members=$rfs->query("select * from rfs_form2_members where form_id='$form_id'");
		$memberCount=mysqli_num_rows($soc_reg_members);
      $row4=$soc_reg_members->fetch_array();

  $partner=json_decode($row4['partner'],true);

      $est_date=$row4["est_date"];

	$soc1=$rfs->query("select * from rfs_form2_rules where form_id='$form_id'");	
	$row=$soc1->fetch_array();

    
	 $mem_qualification=$row["mem_qualification"]; $mem_donation=$row["mem_donation"];  $mem_fund=$row["mem_fund"];  $mem_fund_control=$row["mem_fund_control"];  $meeting_proc=$row["meeting_proc"];  $meeting_quorum=$row["meeting_quorum"];  $election_proc=$row["election_proc"];  $eb_desc=$row["eb_desc"];  $eb_term=$row["eb_term"];  $reelect_proc=$row["reelect_proc"];  $eb_meeting=$row["eb_meeting"];  $eb_quorum=$row["eb_quorum"];  $mem_expulsion=$row["mem_expulsion"];  $auditor=$row["auditor"];  $legal_proc=$row["legal_proc"];  $dissolution=$row["dissolution"];
	if(!empty($row["photo"])) {
	 	$photo=json_decode($row["photo"]);
	 	$photo_presid=$photo->presid;$photo_secret=$photo->secret;$photo_sign1=$photo->sign1;$photo_sign2=$photo->sign2;
	 	$photo_sign3=$photo->sign3;
	 	
	 }
if(!empty($row["gm_meeting"])) {
	 	$gm_meeting=json_decode($row["gm_meeting"]);
	 	$gm_meeting_dh=$gm_meeting->dh;$gm_meeting_pm=$gm_meeting->pm;$gm_meeting_np=$gm_meeting->np;
	 }else{
	 	
	 }
	 if(!empty($row['bank_details'])) {
	 	$bank_details=json_decode($row['bank_details']);
	 }
	 if(!empty($row['treasury_challan'])) {
	 	$treasury_challan=json_decode($row['treasury_challan']);
	 }
	
$docs=$rfs->query("select * from rfs_form2_docs where form_id='$form_id'") or die("Error :". $rfs->error);
$doc=$docs->fetch_array();
$file1=$doc["file1"];$file2=$doc["file2"];$file3=$doc["file3"];$file4=$doc["file4"];$file5=$doc["file5"];$file6=$doc["file6"];	
	}else{
		$form_id="";$soc_name="";$obj_rural="";$obj_health="";$obj_woman="";$obj_education="";$obj_science="";$obj_arts="";$obj_sports="";$obj_agri="";$obj_env="";$obj_other="";$soc_address_mouza="";$soc_address_circle="";$soc_address_patta="";
			$soc_address_dag="";$soc_address_area="";$soc_address_locality="";$soc_address_village="";$soc_address_dist="";
			$soc_address_pin="";$soc_address_ps="";$soc_address_po="";$photo_presid="";$photo_secret="";$photo_sign1="";
	 	    $photo_sign2="";$photo_sign3="";			
	}
	 


##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>4|| is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";
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
									
								<strong>Form No 2<br/><?php echo $form_name=$cms-> query("select form_name from rfs_form_names  where  form_no='10'")->fetch_object()->form_name; ?></strong>
                                
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">DETAILS OF THE SOCIETY</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PARTNER'S DETAILS</a></li>
									   <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">OTHER DETAILS </a></li> 
									 <li class="<?php echo $tabbtn4; ?>"><a data-toggle="tab" href="#table4">UPLOAD</a></li>
								
									 
		
									</ul>
									<br>
									<div class="tab-content">
			<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo    htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			 		      
                         <table class="table table-responsive">
						      <tr>
                              <td>1. Name of the Society :</td>
                              <td><input type="text" id="soc_name" name="soc_name" class="form-control text-uppercase"   value="<?php if(isset($soc_name))echo $soc_name;?>" pattern="[a-zA-Z0-9\s]{1,}" required="required"/></td>
							     <td>2.Registration:</td>
								  <td><input type="text" id="soc_name" name="soc_name" class="form-control text-uppercase"  value="<?php if(isset($soc_name))echo $soc_name;?>" pattern="[a-zA-Z0-9\s]{1,}" required="required"/></td>
							  </tr>
							  <tr>
							    
								    <td class="half-width">3. Date of Registration :</td>
									<td class="half-width"><input type="text" id="dob" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($est_date)) echo $est_date; ?>" required>
									</td>
									<td class="half-width">4.Date of Establishment: 
									<td class="half-width"><input type="text" id="dob" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($est_date)) echo $est_date; ?>" required>
									</td>
							 </tr>
							 <tr>
							    <td>5. Address of the Society: </td>
					           <td> <span class="soc_alert"></span> </td>
				            </tr>
						    <tr>
						      <td> Mouza :</td><td><input type="text" class="form-control text-uppercase" id="mouza" name="soc_address[mouza]" value="<?php  echo $soc_address_mouza; ?>"/></td>
					   
						      <td>Circle :</td><td><input type="text" class="form-control text-uppercase" id="circle" name="soc_address[circle]" value="<?php  echo $soc_address_circle; ?>"/></td>
					      </tr>
					     <tr>
						    <td> Patta no :</td><td><input type="text" class="form-control text-uppercase" id="patta" name="soc_address[patta]" value="<?php  echo $soc_address_patta; ?>"/></td>
					
						    <td> Dag no :</td><td><input type="text" class="form-control text-uppercase" id="dag" name="soc_address[dag]"  value="<?php  echo $soc_address_dag; ?>"/></td>
				
					    </tr>
					    <tr>
						   <td> Area : </td><td><input type="text" class="form-control text-uppercase" id="area" name="soc_address[area]" value="<?php  echo $soc_address_area; ?>"/></td>
				
					
						   <td> locality : </td><td><input type="text" class="form-control text-uppercase" id="locality" name="soc_address[locality]" value="<?php  echo $soc_address_locality; ?>"/></td>
				
					   </tr>
					   <tr>
						 <td> Village/town/city :</td><td><input type="text" class="form-control text-uppercase" id="village" name="soc_address[village]" value="<?php  echo $soc_address_village; ?>"/></td>
				
					
						 <td> Post Office :</td><td><input type="text"  class="form-control text-uppercase" id="post_office" name="soc_address[po]" value="<?php  echo $soc_address_po; ?>"/></td>
				
					</tr>
					<tr>
						 <td> Police Station :</td><td><input type="text" class="form-control text-uppercase" id="police_station" name="soc_address[ps]" value="<?php  echo $soc_address_ps; ?>"/></td>
				
					    <td>District</td>
						 <td>
								<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC") OR die("Error : ".$mysqli->error); ?>
									<select name="soc_address[dist]" class="form-control text-uppercase" id="dist1" required="required">
										<option value="">Select District</option>
										<?php while($rows_dist=$dstresult->fetch_object()) {
											if(isset($soc_address_dist) && ($soc_address_dist==$rows_dist->district)){
												$s='selected'; 
											}else{
												$s='';
											}  ?>
											<option value="<?php echo $rows_dist->district; ?>" <?php echo $s;?>><?php echo $rows_dist->district; ?></option>
										<?php }		?>
									</select>										
									<font class="compulsory"> <?php if(isset($code) && $code == 4){echo $errorMsg ;}?></font>
								</td>
				
					</tr>
					<tr>
						 <td>Pin code :</td><td><input type="text" class="form-control text-uppercase" validate="pincode" id="pin" name="soc_address[pin]" maxlength="6" value="<?php  echo $soc_address_pin; ?>"/></td>
				
					</tr>
					

				 	      </table>
						  <div align="center">
								
								<button type="submit"  style="font-weight:bold" name="save2a" class="btn btn-success">Save and Next</button>
						  </div>	    
			 </form>
			 </div>
		
		<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		   <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
             <tr>
			    <td colspan="4">6. A list of members of the Executive Committee with their full name(in block letter),address and occupation:</td>
			   </tr>
            <tr>
			 <table class="table table-responsive"> 
			    <thead>
				   <tr>
							<th width="5%" align="center">Sl. No.</th>
							<th width="20%" align="center">Name of the Members</th>
							<th width="20%" align="center">Address</th>
							<th width="20%" align="center">Occupation</th>
							<th width="20%" align="center">Designation</th>
				   </tr>
			    </thead>
				   <?php
						 $part1=$forest->query("SELECT * FROM forest_form1_t1 WHERE form_id='$form_id'");
						 $num = $part1->num_rows;
						 if($num>0){
						 $count=1;
														while($row_1=$part1->fetch_array())
													   {	?>
												<tbody>
												<tr>								
													<td  align="center"><input type=  "text" class="form-control text-uppercase" readonly="readonly" id="txtA<?php echo $count;?>" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1" >
													</td>
													<td  align="center"><input type="text" class="form-control text-uppercase" size="20"value="<?php echo $row_1["species"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txtB <?php echo $count;?>" name="txtB<?php echo $count;?>">
													</td>
													<td  align="center"><input type="text" class="form-control text-uppercase" size="15" value="<?php echo $row_1["spacing"]; ?>" id="txtC<?php echo $count;?>" name="txtC<?php echo $count;?>">
													</td>
													<td  align="center"><input type="number" min="1" class="form-control text-uppercase" size="15" value="<?php echo $row_1["trees"]; ?>" id="txtD<?php echo $count;?>" name="txtD<?php echo $count;?>" >
													</td>
													<td  align="center"><input type="text" class="form-control text-uppercase" size="20"value="<?php echo $row_1["species"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txt <?php echo $count;?>" name="txtB<?php echo $count;?>">
													</td>
												</tr>
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" class="form-control text-uppercase" readonly="readonly" id="txtA1"  name="txtA1"></td>
													<td><input id="txtB1" class="form-control text-uppercase" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+"  name="txtB1"></td>	
													<td><input  id="txtC1"class="form-control text-uppercase" name="txtC1"></td>
													<td><input type="text" min="1"validate="onlyNumbers"  class="form-control text-uppercase" id="txtD1" name="txtD1"></td>
												</tr>
												<?php } ?>
												<tbody>
											</table>
								
									</tr>
                                <tr>
									   <td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#" onclick="mydelfunction4()" value="">Delete</button>
											 <button type="button"  class="btn btn-default pull-right" onclick="addmore()" value="">Add More</button>	
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>									
		
			<tr>
			<td>
			<b>7.A statement showing the details of grant receipt from Central Government and other agencies during the preceding 3 years from the date of renewal application.</b></td></tr>
			<tr>
				<td colspan="3">
				<table id="" class="text-center table table-responsive table-bordered">
		
			      <thead>
						<tr>
							<td>Sanction letter no. and date</td>
							<td> Name of the Scheme</td>
							<td> Objectives of the Scheme</td>
							<td>Fund realising authority</td>
							<td>Opening Balance</td>
							<td>Amount sanctioned during the year</td>
							<td>Amount released during the preceding 3 years</td>
							<td>Total available fund</td>
							<td>Total expenditure incurred during the preceding 3 years</td>
							<td>Remarks</td>
							
					   </tr>
				 </thead>
				 <tbody>
				  <?php 
					$member_results=$society->query("select * from society_form1_members where form_id='$form_id'") or die("Error : ".$society->error);
						if($member_results->num_rows==0){
					    for($i=1;$i<=count($owners);$i++){ ?>
						<tr>
							                 <td><?php echo $i; ?></td>
												<td><input type="text" name="member_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="member_address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_address; ?>" /></td>
												<td><input type="text" name="member_age<?php echo $i;?>" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $member_age; ?>" /></td>
												<td><input type="text" name="member_phone<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_phone; ?>" maxlength="10" validate="mobileNumber" ></td>
												<td><input type="text" name="member_signature<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $member_signature; ?>" /></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="member_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->member_name; ?>" /></td>
												<td><input type="text" name="member_address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->member_address; ?>" /></td>
												<td><input type="text" name="member_age<?php echo $i;?>" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $rows->member_age; ?>" /></td>
												<td><input type="text" name="member_phone<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->member_phone; ?>" maxlength="10" validate="mobileNumber" ></td>
												<td><input type="text" name="member_signature<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->member_signature; ?>" /></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>
 										
										</tbody>
										</table>
										</td>
		                            </tr>
           
  
        <div align="center">
								<a type="button" href="form2.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2b" class="btn btn-success">Save and Next</button>
	     </div>	  	
		 </form>
		 </div>
		 <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
	     <form name="myform1" id="myform22" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
         
            <table  width="100%" class="table table-responsive">
                    <tr>
                       <td colspan="4">19. Scanned Photographs of the President and Secretary of the society </td>
					   </tr>                
                     <tr>
                        <td>President</td>
                        <td>
                         <?php if(!$photo_presid==""){ echo"" ?>
                          <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="sp21"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="ep21">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p21')">Edit</span>
							</div><span id="vp21" style="float: left;"><a href="<?php echo $upload1.$photo->presid;?>" target="_blank" ><i class="fa fa-file-text" aria-hidden="true" ></i> View</a></span>
						      </span>
							<input type="hidden" id="fp21" name="photo[presid]" value="<?php echo $photo->presid;?>">
							<?php ;} else { echo "" ?> 
                                          <span id="photo50"><div class="cropme" style="width: 70px; height: 30px;" id="sp21" >
									  <input type="button" onclick="crop_test('p21')"  name="upload1" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep21" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p21')">Edit</span>
									  
									  </div>
									  <span id="vp21" style="float: left;" ></span>
									  <input type="hidden"  id="fp21"  required="required"name="photo[presid]" />
						            	</span>
                    		                     <?php ;} ?>
						             </td>
                                       <td>Secretary</td>
                                         <td>
                                    <?php if(!$photo_secret==""){ echo"" ?>
                                   <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="sp22"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="ep22">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p22')" target="_blank">Edit</span>
							</div><span id="vp22" style="float: left;"><a href="<?php echo $upload1.$photo->secret;?>" ><i class="fa fa-file-text" aria-hidden="true" ></i> View</a></span>
						      </span>
							<input type="hidden" id="fp22" name="photo[secret]" value="<?php echo $photo->secret;?>">
							<?php ;} else { echo "" ?> 
                                           <span id="photo50"><div class="cropme" style="width: 70px; height: 30px;" id="sp22" >
									  <input type="button" onclick="crop_test('p22')"  name="upload22" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep22" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p22')">Edit</span>
									  
									  </div>
									  <span id="vp22" style="float: left;" ></span>
									  <input type="hidden"  required="required" id="fp22" name="photo[secret]" />
						            	</span>
                    		                     <?php ;} ?>
						             </td>
                                       
                                        
                                    </tr>
                                     <tr>
                                     <td>       
                    				20. Bank Account </td>
                    				</tr>

                                    <tr><td>No :</td>
                                    <td><input type="text" name="bank[no]" class="form-control text-uppercase" value="<?php if(isset($bank_details)){echo $bank_details->no; } ?>"  required/></td>
                                    <td>Bank :</td>
                                    <td><input type="text" name="bank[na]" class="form-control text-uppercase" value="<?php if(isset($bank_details)){echo $bank_details->na; } ?>" required/></td>
                                    </tr>
                                    <tr>
                                    <td>branch:</td>
                                    <td><input type="text" name="bank[br]" class="form-control text-uppercase" value="<?php if(isset($bank_details)){echo $bank_details->br; } ?>" required /></td>
                                    <td>Type of Account:</td>
                    				<td><input type="text" name="bank[ta]" class="form-control text-uppercase" value="<?php if(isset($bank_details)){echo $bank_details->ta; } ?>" required /></td>
                    				</tr>
                    				<tr>
                    				<td>Holding Account:</td>
                    				<td><input type="text" name="bank[ah]" class="form-control text-uppercase" value="<?php if(isset($bank_details)){echo $bank_details->ah; } ?>" required /></td></tr>
                    				
                    				<tr>
                    				<td>21. Treasury Challan</td>
                    				</tr>

                                    <tr><td>No :</td>
                                    <td><input type="text" class="form-control text-uppercase" name="treasury[n]" value="<?php if(isset($treasury_challan)){echo $treasury_challan->n; } ?>" required/></td>
                                   
                                    <td>Date:</td>
                                    <td><input type="text" class="date_picker form-control text-uppercase" name="treasury[d]" value="<?php if(isset($treasury_challan)){echo $treasury_challan->d; } ?>" required 	/></td></tr>
                    				<tr><td>Branch:</td>
                    				<td><input type="text" class="form-control text-uppercase" name="treasury[b]" value="<?php if(isset($treasury_challan)){echo $treasury_challan->b; } ?>"required/></td>
                    				
                    				<td>Amount:</td>
                    				<td><input type="text" class="form-control text-uppercase" name="treasury[a]" id="treasury_amount" value="<?php if(isset($treasury_challan)){echo $treasury_challan->a; } ?>" required /></td></tr>
                    				
                    				
                                   
                 	</table>
				     <div align="center">
						 <a type="button" href="form2.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
						 <button type="submit"  style="font-weight:bold" name="save2d" class="btn btn-success">Save and Next</button>
					 </div>
				    </form>
					 </div> 
          <div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			            <table  id=""  class="table table-responsive" >
				             <tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
					
			
		     <tr>
					<td width="50%"> 1. Registration Certificate:</td>
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
		    <td>2. Copy of the Resolution of the General Body meeting for renewal of the society and signature of all the members present in the meeting
		    </td>
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
				 <td>3. Certificate of authentication signed by three members  of the outgoing executive members
						
				  </td>
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
					<td>4.Copy of resolution of the AGM for the above mentioned information at Item No. 1,10 & 11 is submitted within 14 days from the date of Annual General Meeting (AGM)of the society.</td>
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
					<td>5. Latest Annual Balance Sheet from C.A. </td>
					<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
					<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>6. Latest Audit Report from C.A.</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>7.Utilisation Certificate of fund from Govt./Semi Govt./any institution :</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>8.Utilisation Certificate of fund (with proof)Proof certificate of the amount apend from total amount: </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>9.All the new executive members in the presence of DC/ADC/SDO/RCO/Executive Magistrate/BDO of the concerned district/Sub-division/Revenue Circle who has signed on the paper with full name in Block letter,date and designation in token of his/her having witnessed the same. : </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>10.Activity Report of the society for the last three year from the date of renewal obtain from the DC/SDO of the concerned district/Sub Division : </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
					<td>11.Bank Pass Book : </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
				<td>12.Land document of the office of the society.If not Land Agreement/Affidavit from the house owner  : </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
		      <tr>
				<td>13.Treasury Challan  : </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				<tr>
				<td>14.An affidavit regarding non-violation of section 4 and 4(A)(1),4(A)2 4(B)(1) under S.R. Act XXI of 1860  : </td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
					
				</tr>
				

		     <tr>
					<td class="text-center" colspan="4">
						<a href="form2.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
					</td>
					</tr>
		  </form>
		  </div>
     </div>
					   
			
   <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>
<?php require 'rfs_js.php'; ?>

<link rel="stylesheet" type="text/css" href="../crop_image/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/style-example.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/jquery.Jcrop.css" />

    <!-- Js files-->
    <script type="text/javascript" src="../crop_image/scripts/jquery-1.10.2.11min.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.SimpleCropper.js"></script>
<script>
$('#tab2, #tab3, #tab4').css('display', 'none');
$('a[href="#tab1"]').on('click', function(){
	$('#tab1').css('display', 'table');
	$('#tab2, #tab3, #tab4').css('display', 'none');
});
$('a[href="#tab2"]').on('click', function(){
	$('#tab2').css('display', 'table');
	$('#tab1, #tab3, #tab4').css('display', 'none');
});
$('a[href="#tab3"]').on('click', function(){
	$('#tab3').css('display', 'table');
	$('#tab1, #tab2, #tab4').css('display', 'none');
});
$('a[href="#tab4"]').on('click', function(){
	$('#tab4').css('display', 'table');
	$('#tab1, #tab2, #tab3').css('display', 'none');
});

/* ----------------------------------------------------- */
$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' || $file5=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>	
	
</script>

        </body>
</html>
			
		 
		                        
								   
								   