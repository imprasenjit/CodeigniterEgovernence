<?php 
require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('rfs','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=rfs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=rfs';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}

	$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$certificate_affidafit="";$photo_sign1="";
	 	    $photo_sign2="";$photo_sign3="";$photo_presid="";$photo_secret="";$gm_meeting_dh="";$gm_meeting_pm="";$gm_meeting_np="";
	$memberCount=0;
	
	
		$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ";
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
include("save_form.php");	
$get_file_name=basename(__FILE__);
   $soc=$rfs->query("select * from rfs_form2 where user_id='$swr_id' and active='1'");
	if(mysqli_num_rows($soc)>0){
 
	    $row1=$soc->fetch_array();
       $form_id=$row1["form_id"];$soc_name=$row1["soc_name"];$obj_rural=$row1["obj_rural"];$obj_health=$row1["obj_health"];
		$obj_woman=$row1["obj_woman"];$obj_education=$row1["obj_education"];$obj_science=$row1["obj_science"];$obj_arts=$row1["obj_arts"];
		$obj_sports=$row1["obj_sports"];$obj_agri=$row1["obj_agri"];$obj_env=$row1["obj_env"];$obj_other=$row1["obj_other"];
		
			
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
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";
	}
if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";
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
										<strong>FORM NO. 2 APPLICATION FOR MEMORANDUM OF ASSOCIATION
(Sec 58 & Rules 4(3))
 </strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">DETAILS OF THE SOCIETY</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PARTNER'S DETAILS</a></li>
									   <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">RULES AND REGULATION</a></li> 
									 <li class="<?php echo $tabbtn4; ?>"><a data-toggle="tab" href="#table4">OTHER DETAILS</a></li>
									 
									 <li class="<?php echo $tabbtn5; ?>"><a data-toggle="tab" href="#table5">UPLOAD</a></li>
									</ul>
									<br>
									<div class="tab-content">
			<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							
							
								<table class="table table-responsive">

								 <tr>
                    <td>1. Name of the Society :</td>
                    <td><input type="text" id="soc_name" name="soc_name" class="form-control text-uppercase"   value="<?php echo $unit_name;?>" pattern="[a-zA-Z0-9\s]{1,}" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>2. Address of the Society: </td>
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
					<tr>
						<td colspan="4"><b>   3. The Objects for which the Society is established are (The object must be Art & Culture, Environment, Science and Technology, Rural Development, Health, Women & Child Welfare, Agriculture etc.)</b></td>
					</tr>
					<tr>
						 <td> 1) Rural Development :</td>
						 <td><input type="text" id="rural_dev" class="form-control text-uppercase" name="rural_dev" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_rural)){echo $obj_rural;} ?>" required /></td>
					    
						 <td>2) Health :</td>
						 <td><input type="text" id="health" name="health" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_health)){echo $obj_health;} ?>" required /></td>
					</tr>
					<tr>
						 <td> 3) Women & Child Welfare  :</td>
						 <td><input type="text" id="w_c_welfare" name="w_c_welfare" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_woman)){echo $obj_woman;} ?>" required /></td>
					
						 <td> 4) Education :</td>
						 <td><input type="text" id="education" name="education" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_education)){echo $obj_education;} ?>" required /></td>
				
					</tr>
					<tr>
						 <td>5) Science & Technology : </td>
						 <td><input type="text" id="s_techno" name="s_techno" class="form-control text-uppercase"  pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_science)){echo $obj_science;} ?>" required/></td>
				
					
						 <td>6) Art & Culture : </td>
						 <td><input type="text" id="art_cul" name="art_cul" class="form-control text-uppercase"  pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_arts)){echo $obj_arts;} ?>" required/></td>
				
					</tr>
					<tr>
						 <td> 7) Sports:</td>
						 <td><input type="text" id="sports" name="sports" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_sports)){echo $obj_sports;} ?>" required/></td>
				
					
						 <td>8) Agriculture:</td>
						 <td><input type="text" id="agriculture" name="agriculture" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_agri)){echo $obj_agri;} ?>" required /></td>
				
					</tr>
					<tr>
						 <td>9) Environment:</td>
						 <td><input type="text" id="environment" name="environment" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_env)){echo $obj_env;} ?>" required /></td>
				
					
						 <td>10) others: </td>
						 <td><input type="text" id="others" name="others" class="form-control text-uppercase" pattern="^[A-Za-z|^\s]+$" title="Only Characters Allowed" value="<?php if(isset($obj_other)){echo $obj_other;} ?>" required /></td>
				
					</tr>
								</table>
								 	<div align="center">
								
								<button type="submit"  style="font-weight:bold" name="save2a" class="btn btn-success">Save and Next</button>
									</div>	    
								</form>
							</div>
    
	
			    
<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
						<form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<b>4. 4. We the undersigned are desirous of forming a society in pursuance of this Memorandum of Association</b>
			<table id=""  class="table table-responsive">
				<thead>
						<td>S.NO</td>
						<td>Name</td>
						  <td>Scanned copy of signatures of the member of  the society <br/>in full</td>
						  <td>Address</td>
							<td>Occupation</td>
							<td>Designation</td>
					</thead>
					<tbody>
					
							<?php
				if($memberCount>0){
					$upload1="upload/";
                   
					$moreindex1=count($partner); 
					for($m=1;$m<=count($partner);$m++){					
	                    $p="p$m";
						
						?>
						
						<tr id="<?php echo ($m);?>">
						<td width="5%"><?php echo ($m); ?></td>
						<td>
						<input type="hidden" name="" value="<?php  ?>"/>
						<input type="text" validate="specialChar" class="form-control text-uppercase"name="partner[<?php echo $m; ?>][pname]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pname']; ?>" required/>
						</td>

						<td>
							 <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="<?php echo "s".$p;?>"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="<?php echo "e".$p;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('<?php echo $p ?>')">Edit</span>
							</div><span id="<?php echo"v".$p; ?>" style="float: left;"><a href="<?php echo $upload1.$partner[$m]['photo'];?>" target="_blank" ><i class="fa fa-file-text" aria-hidden="true"></i> View</a></span>
						      </span>
							<input type="hidden" id="<?php echo "f".$p;?>" name="partner[<?php echo $m;?>][photo]" value="<?php echo $partner[$m]['photo'];?>">
						</td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][paddr]" value="<?php echo $partner[$m]['paddr']; ?>" required/></td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][poccupation]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['poccupation'];  ?>" required/></td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][pdesig]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pdesig']; ?>" required/></td>
						}
						
					</tr>
						
				<?php
					
					}
				}else{ 
                  $moreindex1=1;
						
				echo ""
				?>
					<tr>
						<td width="5%">1</td>
						<td>
						
						<input type="text" class="form-control text-uppercase" name="partner[1][pname]" pattern="[a-zA-Z_/.\s]+$" required/>
						</td>
						<td><span id="photo50"><div class="cropme" style="width: 70px; height: 30px;" id="sp1" >
									  <input type="button" onclick="crop_test('p1')"  name="upload1" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep1" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p1')">Edit</span>
									  
									  </div>
									  <span id="vp1" style="float: left;" ></span>
									  <input type="hidden"  id="fp1"  required="required" name="partner[1][photo]" />
						            	</span>
							
						</td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[1][paddr]" required/></td>
						<td ><input type="text" class="form-control text-uppercase" name="partner[1][poccupation]" pattern="[a-zA-Z_/.\s]+$" required/></td>
						<td ><input type="text" class="form-control text-uppercase"name="partner[1][pdesig]" pattern="[a-zA-Z_/.\s]+$" id=""required /></td>
						</tr>
						
				<?php  } ?>
				 <?php ?>
				         <tr id="sunil" colspan="6">&nbsp;</tr>
					</tbody>
				</table>	
				<table>
					<tr>
						<td><a class="memberBtn" jsTag="more1">Add More</a></td>
						
						<td>
						<input id="indexval_validation1" type="hidden" name="indexval_validation1" value="<?php echo $moreindex1; ?>">
						&nbsp;&nbsp;<td style="display:none;" id="del_last1"><a   class="memberBtn"  jsTag="deleteLast1">Delete</a></td>
                    </tr>
									
					</table>
				<tr>
				<td colspan="6">
				 <p> * The witness will be a person not member of this Society. He must be either a Local D.C., Addl. D.C., S.D.O. (sadar) or Circle Officer, BDO, Executive Magistrate,<br>* Atleast seven signatures are required</p>	
				</td>
				</tr>		
				</td></tr></table>
				<table>
                <tr>
                    <td>Date of Establishment:-</td>
                    <td><input type="text" class="date_picker form-control" name="est_date" readonly="readonly" value="<?php if(isset($est_date)){echo $est_date;} ?>" required /></td>
                    
                </tr>
                
                </table>
               	<div align="center">
								<a type="button" href="form2.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2b" class="btn btn-success">Save and Next</button>
									</div>	    
				</form>
			</div>
			    				
<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
	<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table class="table-responsive">		
					<tr>
                    <td colspan="3">5. MEMBERSHIP: </td>
                     </tr>

                     <tr>
                      <td>(a) Qualification to become Members:- </td>
                       <td>
                          <textarea id="memb_qualifiction" name="memb_qualification" rows="5" cols="100" class="form-control text-uppercase" required><?php if(isset($mem_qualification)){echo $mem_qualification;} ?> </textarea></br>
                          </td>
                           
                         <td>(b) Subscription,Donation etc.:- </td>
                           <td>
                           <textarea id="sub_donation" name="sub_donation" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($mem_donation)){echo $mem_donation;} ?></textarea>
                                    </br>
                            </td>
                         </tr>
                          <tr>
                           <td>(c) Collection of Fund:- </td>
                            <td>
                                    <textarea id="fund_collection" name="fund_collection" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($mem_fund)){echo $mem_fund;} ?></textarea></br>
                           </td>
                           
                            <td>(d) Control of Fund:- </td>
                             <td>
                                    <textarea id="fund_control" name="fund_control" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($mem_fund_control)){echo $mem_fund_control;} ?></textarea></br>
                             </td>
                          </tr>
                       
                <tr>
                    <td>6. Procedure of the General Meeting: (How many times in a year the General Meeting will be held) </td>
                       <td> <textarea id="meeting_proc" name="meeting_proc" rows="5" cols="100" class="form-control text-uppercase" required="required"><?php if(isset($meeting_proc)){echo $meeting_proc;} ?></textarea></br>
                    </td>
               
                    <td>7. Quorum of the General Meeting:-</td><td>
                        <textarea id="meeting_quorum" name="meeting_quorum" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($meeting_quorum)){echo $meeting_quorum;} ?></textarea></br>
                    </td>
                </tr>
                <tr>
                    <td>8. Election procedure of the Executive Committee/ Governing body/Managing Committee:-</td><td>
                        <textarea id="election_proc" name="election_proc" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($election_proc)){echo $election_proc;} ?></textarea></br></br>                    
                    </td>
                
                    <td>9. Short description of the Executive body:-(This <br/>description must tally with the list given in the item 4 of Memorandum copy)</td><td>
                        <textarea id="executive_body" name="executive_body" rows="5" cols="100" class="form-control text-uppercase" required><?php if(isset($eb_desc)){echo $eb_desc;} ?></textarea></br></br>                  
                    </td>
                </tr>
                <tr>
                    <td>10. The term of the Executive body:</td><td>
                        <textarea id="executive_body_term" name="executive_body_term" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($eb_term)){echo $eb_term;} ?></textarea> </br></br>                  
                    </td>
                
                    <td>11. Procedure of Re-election of the members of the Executive body:-</td><td>
                        <textarea id="executive_body_reelection" name="executive_body_reelection" rows="5" cols="100" class="form-control text-uppercase"  required="required" ><?php if(isset($reelect_proc)){echo $reelect_proc;} ?></textarea></br></br>                  
                    </td>
                </tr>
                <tr>
                    <td>12. Procedure of the meeting of the Executive body:-(How many times <br/>in a year or month the meeting of the Executive body will be held)
                    </td>
                    <td>
                        <textarea id="executive_body_proc" name="executive_body_proc" rows="5" cols="100" class="form-control text-uppercase"  required="required"><?php if(isset($eb_meeting)){echo $eb_meeting;} ?></textarea></br></br>
                    </td>
                
                    <td>13. Quorum of the meeting of the Executive body:- (How many of the members of the executive body requires to be present to form quorum of the meeting of the executive body)</td><td>
                        <input type="text" id="executive_body_quorum"  class="form-control text-uppercase"  name="executive_body_quorum" value="<?php if(isset($eb_quorum)){echo $eb_quorum;} ?>"  required="required"/>
                    </td>
                </tr>
                <tr>
                    <td>14. Expulsion of undesirable member:- Any member who goes against<br/> the Rules and Regulation of the organization may be expelled from the organization.</td>
					<td><input type="text" id="Expulsion_u_member"  class="form-control text-uppercase" name="Expulsion_u_member" value="<?php if(isset($mem_expulsion)){echo $mem_expulsion;} ?>"  required="required"/></td>
              
                    <td>15. Auditor: A qualified Auditor will be appointed by the Executive body who shall audit the accounts of the society at least once in a year and Annual Audit Report will be submitted to the Registrar of Societies Regulatory.</td>
					<td><input type="text" id="auditor_name" class="form-control text-uppercase" name="auditor_name" value="<?php if(isset($auditor)){echo $auditor;} ?>"  required="required"/></td>
                </tr>
                <tr>
                    <td>16. Legal Procedure:- According to the provision laid down <br/>in the section 6 of the societies Registration Act-XXI of 1980, the Society may sue or <br/>may be used in the name of the President and Secretary of the Society.</td>
					<td><input type="text" id="legel_procedure" class="form-control text-uppercase" name="legel_procedure" value="<?php if(isset($legal_proc)){echo $legal_proc;} ?>"  required="required"/></td>
					
               
                    <td>17. Dissolution:- If necessary, the Society may be dissolved<br/> and the properties remained after dissolution may be handed over according to the <br/>provision laid down in the Section 13 and 14 of the Societies Registration Act-XXI of 1860.</td>
                    <td>
					<input type="text" id="dissolution"  class="form-control text-uppercase" name="dissolution" value="<?php if(isset($dissolution)){echo $dissolution;} ?>"  required="required"/></td>
                </tr>
				
				
			<tr><td>	18. General Meeting </td></tr>

                <tr><td>Date of holding the meeting :</td>
                <td><input type="text" name="gm_meeting[dh]" class="date_picker form-control text-uppercase" value="<?php echo $gm_meeting_dh; ?>"  required /></td>
                <td>Place of meeting :</td>
                <td><input type="text" class="form-control text-uppercase"  name="gm_meeting[pm]" value="<?php echo $gm_meeting_pm; ?> " required /></td>
                </tr>
                <tr>
                <td>Number of public present:</td>
                <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="gm_meeting[np]" value="<?php echo $gm_meeting_np; ?>" required />
                </td>
                </tr>
               
                </table>		 
               	<div align="center">
								<a type="button" href="form2.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2c" class="btn btn-success">Save and Next</button>
									</div>	    
				</form>
			</div>
			   <div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
	<form name="myform1" id="myform22" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										
					
					  <table  width="100%" class="table table-responsive">
                                    <tr>
                                    <td colspan="4">19. Scanned Photographs of the President and Secretary of the society </td></tr>                
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
                    				
                    				
                                    <tr>
                                        <td colspan="4">22. Certified to be the true copy of the Rules & Regulation of (NAME OF THE SAMITY)Signature of the three Executive Members:-
                                        </td
                                    </tr>
                                    </table>
                                    <table  width="100%" class="table table-responsive">
                                      <tr>
                                      <td>1 Executive.</td>
                                          <td>
                                    <?php if(!$photo_sign1==""){ echo"" ?>
                                   <span id="photo51"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="sp23"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="ep23">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p23')">Edit</span>
							</div><span id="vp23" style="float: left;"><a href="<?php echo $upload1.$photo->sign1;?>" target="_blank" ><i class="fa fa-file-text" aria-hidden="true" ></i> View</a></span>
						      </span>
							<input type="hidden" id="fp23" name="photo[sign1]" value="<?php echo $photo->sign1;?>">
							<?php ;} else { echo "" ?> 
                                           <span id="photo5"><div class="cropme" style="width: 70px; height: 30px;" id="sp23" >
									  <input type="button" onclick="crop_test('p23')"  name="upload23" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep23" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p23')">Edit</span>
									  
									  </div>
									  <span id="vp23" style="float: left;" ></span>
									  <input type="hidden"  id="fp23" name="photo[sign1]" required  />
						            	</span>
                    		                     <?php ;} ?>
						             </td>
                                          <td>2 Executive.</td>           
                                                     <td>
                                    <?php if(!$photo_sign2==""){ echo"" ?>
                                   <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="sp24"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="ep24">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p24')">Edit</span>
							</div><span id="vp24" style="float: left;"><a href="<?php echo $upload1.$photo->sign2;?>"  target="_blank"><i class="fa fa-file-text" aria-hidden="true" ></i> View</a></span>
						      </span>
							<input type="hidden" id="fp24" name="photo[sign2]" value="<?php echo $photo->sign2;?>">
							<?php ;} else { echo "" ?> 
                                           <span id="photo51"><div class="cropme" style="width: 70px; height: 30px;" id="sp24" >
									  <input type="button" onclick="crop_test('p24')"  name="upload24" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep24" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p24')">Edit</span>
									  
									  </div>
									  <span id="vp24" style="float: left;" ></span>
									  <input type="hidden"  id="fp24" name="photo[sign2]" required="required"  />
						            	</span>
                    		                     <?php ;} ?>
						             </td>
                                          <td>3 Executive.</td> <td>
                                    <?php if(!$photo_sign3==""){ echo"" ?>
                                   <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="sp25"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="ep25">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p25')">Edit</span>
							</div><span id="vp25" style="float: left;"><a href="<?php echo $upload1.$photo->sign3;?>" target="_blank" ><i class="fa fa-file-text" aria-hidden="true" ></i> View</a></span>
						      </span>
							<input type="hidden" id="fp25" name="photo[sign3]" value="<?php echo $photo->sign3;?>">
							<?php ;} else { echo "" ?> 
                                           <span id="photo53"><div class="cropme" style="width: 70px; height: 30px;" id="sp25" >
									  <input type="button" onclick="crop_test('p25')"  name="upload25" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep25" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p25')">Edit</span>
									  
									  </div>
									  <span id="vp25" style="float: left;" ></span>
									  <input type="hidden" required="required" id="fp25" name="photo[sign3]" />
						            	</span>
                    		                     <?php ;} ?>
						             </td>
                                                </tr>
					
                 	</table>
											<div align="center">
								<a type="button" href="form2.php?tab=3" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save2d" class="btn btn-success">Save and Next</button>
									</div>
											</form>
										</div> 				

			<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table  id=""  class="table table-responsive" >										
								<tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
								<tr>
					<td width="50%"> 1. Scanned copy of Witness paper in Memorandum of Association at item no. 5:</td>
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
					<td>2. Copies of Resolutions regarding registration of the Society and election of the
Members of the Executive body with the list of signatures of members present
in the General Meeting</td>
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
					<td>3. Land document (Jamabandi / Mutation Order / Registered Sale deed / Govt.
						allotment order) of the office of the society :
						Land Lease / Rent Agreement / Affidavit from the house owner if does not
						have own land</td>
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
					<td>4.  Activity Report/Certificate from the DC/SDO of the concerned district/Sub
						Division if the organisation proposed to be registered as a society has been
						undertaking any activities during the preceding 12 months from the date of its application for
						registration.</td>
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
					<td>5. Declaration from the President or the Secretary regarding the receipt of fund, if any from the Government or other agencies. There should be a categorical declaration in this respect.</td>
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
					<td>6. Treasury Challan</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					
				</tr>
				
				
				<tr>
					<td class="text-center" colspan="4">
						<a href="form2.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
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

	
</script>

        </body>
</html>