<?php 
require_once "../../requires/login_session.php";

if(isset($_POST["submit"])){
	$received_fire_safety=$_POST["received_fire_safety"];
	$form_no=$_POST["form_no"];
	if($received_fire_safety=="Y"){
		$letter_no=$_POST["letter_no"];  
		$letter_date=$_POST["letter_date"];
		//$letter_file=$_POST["letter_file"];
		$letter_file="asd.pdf";
		if($letter_no=="" && $letter_date=="" && $letter_file==""){
			echo "<script>
				alert('Please fill up the details below.');
				window.location.href = 'compliance_report_details.php?token=".$form_no."';
			</script>";
		}else{
			
			$sql=$fire->query("select form_id,save_mode,courier_details from fire_form".$form_no." where user_id='$swr_id' and active='1'");		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'fire_form".$form_no.".php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];	
				$uain=$formFunctions->create_uain($form_id,'fire',$form_no);
			
			
			
				$formFunctions->file_update($letter_file);
				$letter_date=date("Y-m-d",strtotime($letter_date));
				$submit=$fire->query("insert into compliance_report(uain,letter_no,letter_date,reply_date,letter_file,active) values ('$uain','$letter_no','$letter_date','$today','$letter_file','0')") OR die("Error : ".$fire->error);
				if($submit){
					
					if($save_mode=="D" && $courier_details==1){
						$save_query=$fire->query("update fire_form".$form_no." set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($fire->error);
						if($save_query){
							echo "<script>
								alert('Successfully Saved.');
								window.location.href = '../../requires/courier_details.php?dept=fire&form=".$form_no."';
							</script>";
						}else{
							echo "<script>
								alert('Something went wrong !!!');
								window.location.href = 'preview.php?token=".$form_no."';
							</script>";
						}
					}else if($save_mode=="D" && $courier_details==""){
						$save_query=$formFunctions->updateSubmit($uain,$form_id);	
						$formFunctions->insert_applications($uain);
						$str=$formFunctions->getEmail_str($uain);
						/*----------------SEND MAIL-----------------*/
						$user_email=$formFunctions->get_usermail($swr_id);
						$dept_email="esgoa.fire@gmail.com";
						
						require_once "fire_form".$form_no."_print.php"; 
						$mypdf=uniqid(rand()).".pdf";
						/*---------mpdf logic-----------*/
						require_once "../../../mpdf60/mpdf.php"; 
						$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
						$mpdf->SetDisplayMode('fullpage');
						// 1 or 0 - whether to indent the first level of a list 
						$mpdf->list_indent_first_level = 0;
						$mpdf->WriteHTML($printContents);         
						$mpdf->Output($mypdf,'F');
						require_once "../../../mailsending/sendAttachment.php";		
						$emal=$dept_email.",".$user_email;
						send_attachment($emal,$str,$mypdf);
						unlink($mypdf);
						if($save_query){
							echo "<script>
							alert('Successfully Submitted....');
							window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form_no."&dept=fire';
							</script>";
						}else{
							echo "<script>
								alert('Something went wrong !!!');
								window.location.href = 'fire_form".$form_no.".php';
							</script>";
						}
					}else{
						echo "<script>
								alert('Something went wrong !!!');
								window.location.href = 'preview.php?token=".$form_no."';
							</script>";
					}
					
					
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'preview.php?token=".$form_no."';
					</script>";
				}
			}
		}		
	}else{
		$sql=$fire->query("select form_id,save_mode,courier_details from fire_form".$form_no." where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'fire_form".$form_no.".php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];	
			$uain=$formFunctions->create_uain($form_id,'fire','1');
			if($save_mode=="D" && $courier_details==1){
				$save_query=$fire->query("update fire_form".$form_no." set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($fire->error);
				if($save_query){
					echo "<script>
						alert('Successfully Saved.');
						window.location.href = '../../requires/courier_details.php?dept=fire&form=".$form_no."';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'preview.php?token=".$form_no."';
					</script>";
				}
			}else if($save_mode=="D" && $courier_details==""){
				$save_query=$formFunctions->updateSubmit($uain,$form_id);	
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.fire@gmail.com";
				
				require_once "fire_form".$form_no."_print.php"; 
				$mypdf=uniqid(rand()).".pdf";
				/*---------mpdf logic-----------*/
				require_once "../../../mpdf60/mpdf.php"; 
				$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
				$mpdf->SetDisplayMode('fullpage');
				// 1 or 0 - whether to indent the first level of a list 
				$mpdf->list_indent_first_level = 0;
				$mpdf->WriteHTML($printContents);         
				$mpdf->Output($mypdf,'F');
				require_once "../../../mailsending/sendAttachment.php";		
				$emal=$dept_email.",".$user_email;
				send_attachment($emal,$str,$mypdf);
				unlink($mypdf);
				if($save_query){
					echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form_no."&dept=fire';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fire_form".$form_no.".php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'preview.php?token=".$form_no."';
					</script>";
			}
		}
	}		
}

if(isset($_GET["token"]) && is_numeric($_GET["token"])){
	$form_no=$_GET["token"];
	$check=$formFunctions->is_already_registered('fire',$form_no);
	if($check==1){
		echo "<script>
					alert('Already Registered');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form_no."&dept=fire';
			</script>";	
	}else if($check==2){
		echo "<script>				
					window.location.href = '".$server_url."departments/requires/courier_details.php?form=".$form_no."&dept=fire';
			</script>";
	}else if($check==3){
		$showtab=10;
	}else{
		$showtab="";
	}

	
	$sql=$fire->query("select form_id,save_mode,courier_details from fire_form". $form_no . " where user_id='$swr_id' and active='1'");		
	if($sql->num_rows>0){	
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		
	}else{
		echo "<script>
			alert('Invalid page access !!!');
			window.location.href = '../../../user_area/';
		</script>";
	}
	
}else{
	echo "<script>
		alert('Invalid page access !!!');
		window.location.href = '../../../user_area/';
	</script>";
	
}


$email=$formFunctions->get_usermail($swr_id);
$rows=$formFunctions->fetch_swr($swr_id);

$key_person=$rows['Key_person'];$unit_name=$rows['Name'];$street_name1=$rows['Street_name1'];$street_name2=$rows['Street_name2'];$vill=$rows['Vill'];$dist=$rows['Dist'];$block=$rows['block'];$pincode=$rows['Pincode'];$mobile_no=$rows['Mobile_no'];$landline_std=$rows['Landline_std'];$landline_no=$rows['Landline_no'];$owner_name=$rows['Name_of_owner'];
$b_street_name1=$rows['b_street_name1'];$b_street_name2=$rows['b_street_name2'];$b_vill=$rows['b_vill'];$b_dist=$rows['b_dist'];$b_block=$rows['b_block'];$b_pincode=$rows['b_pincode'];$b_mobile_no=$rows['b_mobile_no'];$b_landline_std=$rows['b_landline_std'];$b_landline_no=$rows['b_landline_no'];$b_email=$rows['b_email'];

$from= strtoupper($b_street_name1)." ,".strtoupper($b_street_name2)." ".strtoupper($b_vill);






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
			<script>
			$('.received_fire_safety_class').hide();
			</script>
          <style>
			/* Over writes AdminLTE form styles */
			p{text-align: justify;
			display: block;
				}
			.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 10px rgba(102, 175, 233, 0.6)}
			.form-control text-uppercase{
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
				color: #555;
				
				font-size: 14px;
				height: 34px;
				line-height: 1.42857;
				padding: 6px 12px;
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
				width: 100%;
			}
			.fo{
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
				color: #555;
				
				font-size: 14px;
				height: 34px;
				line-height: 1.42857;
				padding: 3px 8px;
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
				width: 15%;
				
			
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
							<h4 class="text-center"> <?php echo $form_name=$formFunctions->get_formName('fire',$form_no);?> </h4>	
						</div>	
						<div class="panel-body">
							<div class="col-md-12">
								<form name="myform1" id="myform1" class="submit1 form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">			
								<input type="hidden" name="form_no" value="<?php echo $form_no; ?>"/>
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="2">Have you received fire safety recommendations from the concerned authority ? </td>
										<td width="25%">
											<input type="radio" name="received_fire_safety" value="Y"/> Yes&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="radio" name="received_fire_safety" checked value="N"/> No
										</td>
										<td width="25%"></td>
									</tr>
									<tr class="received_fire_safety_class">
										<td colspan="4" class="text-danger">Please fill up the details below and also upload the recommendations letter here.</td>
									</tr>
									
									
									<tr class="received_fire_safety_class">
										<td colspan="4" class="success text-center">Compliance Report</td>
									</tr>
									<tr class="received_fire_safety_class">
										<td colspan="4">
										<p>To,<br/>
											&emsp;The Director,<br/>&emsp;Fire & Emergency Services, Assam.<br/>&emsp;Panbazar, Guwahati-1.<br/><br/>
											Sir,<br/>
											&emsp;I/We, <?php echo strtoupper($key_person); ?> on behalf of <?php echo strtoupper($unit_name); ?> located at <?php echo $from; ?> , Block/ward no. <?php echo $b_block; ?> , District - <?php echo $b_dist;?> , do hereby inform you that Fire prevention &amp; Fire Safety Measures have been provided in the Building/ Premises as per recommendation by you vide your letter no. &nbsp;<input type="text" class="form-control" style="width:200px" required="required"  name="letter_no"/> dated &nbsp;<input type="text" class="dob2 form-control" style="width:100px" required="required" name="letter_date"/> and Para wise compliance report is enclosed.<br/><br/>&emsp;You are requested kindly to take necessary action for grant of N.O.C. for the above premises/ building.
											</p>
										</td>
									</tr>
									<tr class="received_fire_safety_class">
										<td width="25%">Upload the Letter :<font style="color:#F00;font-size:18px">*</font></td>
										<td width="25%">
										<input type="button" upload="file" required="required" class="file btn bg-aqua" id="file" value="Browse">
										<input type="hidden" name="letter_file" value="" id="mfile" readonly="readonly"/>
										<!--<span id="tdfile">No File Selected</span>-->
										<span id="mfile-chiranjit">No File Selected</span>
										</td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">
										<div align="center"><button type="submit" style="font-weight:bold" name="submit" class="btn btn-success">Submit</button></div>
										</td>
									</tr>
								</table>
								</form>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
  <!-- /.content-wrapper -->
  <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>
<script>
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

$(document).ready(function(){
	$('.received_fire_safety_class').hide();
	$('input[name="received_fire_safety"]').on('change', function(){
		if($(this).val() == "Y"){						
			$('.received_fire_safety_class').show("fast");						
		}else{
			$('.received_fire_safety_class').hide("slow");
		}	
		
	});
});
</script>
        
   </body>
</html>