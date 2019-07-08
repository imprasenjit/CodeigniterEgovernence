<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','11');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=11&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=11&dept=fire';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
    $ua=$fire->query("select * from fire_form11 where user_id='$swr_id'");
   $uai=$ua->fetch_array();
   $uain=$uai['uain'];
   if(isset($uain))
   {$dept="fire";
	 $form=$formFunctions->get_uainForm($uain);
	
	 $table=$formFunctions->getTableName($dept,$form);
     
	 $file_path=$fire->query("select * from ".$table."_certificates where user_id='$swr_id'");
	  $noc=$file_path->fetch_array();
	$previous_noc=$noc['file_path'];
	
	}
	$get_file_name=basename(__FILE__);

	include "save_form2.php";
    $email=$formFunctions->get_usermail($swr_id);
	$rows=$formFunctions->fetch_swr($swr_id);
	$key_person=$rows['Key_person'];$unit_name=$rows['Name'];$street_name1=$rows['Street_name1'];$street_name2=$rows['Street_name2'];$vill=$rows['Vill'];$dist=$rows['Dist'];$block=$rows['block'];$pincode=$rows['Pincode'];$mobile_no=$rows['Mobile_no'];$landline_std=$rows['Landline_std'];$landline_no=$rows['Landline_no'];$owner_name=$rows['Name_of_owner'];
	$b_street_name1=$rows['b_street_name1'];$b_street_name2=$rows['b_street_name2'];$b_vill=$rows['b_vill'];$b_dist=$rows['b_dist'];$b_block=$rows['b_block'];$b_pincode=$rows['b_pincode'];$b_mobile_no=$rows['b_mobile_no'];$b_landline_std=$rows['b_landline_std'];$b_landline_no=$rows['b_landline_no'];$b_email=$rows['b_email'];

	$from= strtoupper($b_street_name1)."&nbsp; ,".strtoupper($b_street_name2)."&nbsp; ,".strtoupper($b_vill);

	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	 $q=$fire->query("select * from fire_form11 where user_id='$swr_id' and active='1'") or die($fire->error);
	    $row=$q->fetch_assoc();
		$file2="";$holding_no="";$letter_no="";$renewal_year1="";$renewal_year2="";$letter_valid_date="";$letter_date="";$nearest_station="";
		if($q->num_rows>0){  
		$holding_no=$row['holding_no'];$letter_no=$row['letter_no'];$renewal_year1=$row['renewal_year1'];$renewal_year2=$row['renewal_year2'];$letter_valid_date=$row['letter_valid_date'];$letter_date=$row['letter_date'];$file2=$row['file2'];  $file2=$row['file2'];  $nearest_station=$row['nearest_station'];  
		
	   
		if(empty($row['cno'])==false){
			$cno=json_decode($row['cno']);$cno_stc=$cno->stc;$cno_lno=$cno->lno;$cno_cc=$cno->cc;$cno_mno=$cno->mno;	
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
				display: inline;
				font-size: 15px;
				height: 34px;
				line-height: 1.42857;
				padding: 6px 11px;
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
				width: 100%;
			}
			.fo{
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				
				color: #555;
				
				font-size: 14px;
				height: 28px;
				line-height: 1.9;
				
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
				width: 15%;
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
									<strong>FORM- XII <br/><?php echo $form_name=$formFunctions->get_formName('fire','11'); ?> </strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									  
									  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">UPLOAD</a></li>
									 
									</ul>
									<br>
									<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="form-inline submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"><table id="" class="table table-responsive">
									<table>
										<tr>
											<td colspan="4">
												<p style="line-height:20px">&emsp;&emsp;I/We &nbsp;<strong><?php echo strtoupper($owner_name); ?></strong> &nbsp;on behalf of&nbsp; <strong><?php echo strtoupper($unit_name); ?></strong>&nbsp; located at &nbsp;<strong><?php  echo $from; ?></strong> &nbsp;holding No.&nbsp;  <input type="text" class="form-control" name="holding_no" id="textfield3" required="required" placeholder="Holding No" value="<?php  echo $holding_no; ?>"/>&nbsp; District &nbsp; <strong><?php  echo strtoupper($b_dist); ?></strong>,&nbsp;  State &nbsp; <strong>Assam</strong> &nbsp; do hereby inform you  that No Objection Certificate (N.O.C.) issued vide your Letter No./UAIN &nbsp; <input type="text" name="letter_no" id="textfield6" style="width:200px;" class="form-control" required="required" placeholder="Letter No" value="<?php if($uain!="" && $previous_noc!="") {echo $uain; } else {echo $letter_no;}?>"/><font color="red">*</font>&nbsp; Dated &nbsp;<input type="text"  name="letter_date" class="dob form-control" readonly="readonly"  placeholder="YYYY/MM/DD" value="<?php  echo $letter_date;?>"/><font color="red">*</font> &nbsp;valid up to &nbsp; <input type="text" name="letter_valid_date" id="textfield8" readonly="readonly" placeholder="YYYY/MM/DD"  class="dob form-control" value="<?php echo $letter_valid_date;?>"/><font color="red">*</font> &nbsp;(Copy of N.O.C. is Enclosed) and is due for renewal for a period of another 1(One) Year with effect from 1<sup>st</sup> of April  &nbsp;<input type="text" class="form-control"  required="required" id="textfield9" name="renewal_year1" readonly="readonly" value="<?php if(empty($renewal_year1)==false)  echo $renewal_year1; else echo date('Y');?>"/> to 31<sup>st</sup>  of March &nbsp; <input class="form-control"  type="text" id="textfield10" required="required" name="renewal_year2" readonly="readonly"  value="<?php if(empty($renewal_year2)==false)  echo $renewal_year2; else echo date('Y',strtotime('+1 year')); ?>" />.</p>
											</td>
										</tr>
										<tr>			
											<td> Nearest fire &amp; Emergency Service Station :</td>
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
											</select></td>										
											<td></td>
											<td></td>
										</tr>
									
									</table><br/>
							    <table id="" class="table table-responsive table-striped">
									<tr>
										<th>In this application it is submitted that-</th>
									</tr>
									<tr>
										<td>&#42; There is no change in trade for which license has been issued.</td>
									</tr>
									<tr>
										<td>&#42; There is no any structural change of the Building either horizontally or vertically affecting means of escapes/ Exits.</td>
									</tr>
									<tr>
										<td>&#42; There is no any change in existing Fire Fighting arrangement.</td>
									</tr>
									<tr>
										<td>&#42; Fire prevention &amp; Fire Safety Measures/ Arrangements have been tested and are in Good Working condition.</td>
									</tr>
									<tr>
										<td>&#42; You are requested kindly to take necessary action for grant of Renewal of N.O.C. for the above premises/building.</td>
									</tr>
								</table>
	

	<table id=""  class="table table-responsive">
	       <tr>
		        <td colspan="4"><u>Contact Details</u></td>
		   </tr>
		
			<tr>
				<td> 1. Name in Full  :- &emsp;<strong><?php  echo strtoupper($key_person); ?></strong>
				</td>
				
			</tr>
			<tr>
				<td>2. Telephone No. :- &emsp;<strong><?php  echo $landline_std; ?>-<?php  echo $landline_no; ?></strong> 
			   
				</td>
			
			</tr>
			<tr>
				<td>3. Mobile No. :- &emsp;<strong>+91-<?php  echo $mobile_no; ?> </strong></td>		
		          <td></td>
				<td></td>
			 </tr>
			<tr>
				<td></td><td></td><td></td>
				<td></td>
				<td align="right"><strong><?php echo strtoupper($key_person); ?></strong></td>
			</tr>
			<tr>
				<td></td><td></td><td></td>
				<td></td>
				<td align="right">Signature of the Applicant</td>
				</tr>
				<tr>
			<td class="text-center" colspan="5">
				<button type="submit" style="font-weight:bold" name="save11" class="btn btn-success submit1">Save &amp; Next</button>
			</td>
		  </tr>
	       </table> 
  </form>
</div>
<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<table  id=""  class="table table-responsive" >										
								<tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mandatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
			     
				<tr>
					<td width="50%"> Copy of N.O.C.*</td>
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
					<td class="text-center" colspan="4">
						<a href="fire_form11.php?tab=1" class="btn btn-primary">Go Back &amp; Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit11" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">SUBMIT</button>
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
</div>
</section>
</div>
  <!-- /.content-wrapper -->
  <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>

<script>
$('#tab2').css('display', 'none');
$('a[href="#tab1"]').on('click', function(){
	$('#tab1').css('display', 'table');
	$('#tab2').css('display', 'none');
});
$('a[href="#tab2"]').on('click', function(){
	$('#tab2').css('display', 'table');
	$('#tab1').css('display', 'none');
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


</script>
</body>
</html>
                            							   
		