<?php 
require_once "../../requires/login_session.php";
$get_file_name=basename(__FILE__);
if(isset($_POST["comply"])){
	$token=$_POST["token"];
	$reply_date=date("Y-m-d H:i:s");
	$comply_report=$fire->query("update compliance_report set active='0',reply_date='$reply_date' where uain='$token'") or die($fire->error);
	if($comply_report){
		echo "<script>
				alert('Successfully Submitted ');
				window.location.href = '../index.php';
			</script>";
			exit();
	}else{
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'compliance_report.php?token=".$token."';
			</script>";
			exit();
	}
}
if(isset($_POST["noc_form_no"])){
	$form_no=$_POST["form_no"];
	//$reply_date=date("Y-m-d H:i:s");
	$comply_report_forms=$fire->query("select uain,form_id from fire_form".$form_no." where user_id='$swr_id' and active='1' and save_mode='C'") or die($fire->error);
	if($comply_report_forms->num_rows>0){
		$comply_report_forms_row=$comply_report_forms->fetch_object();
		$form_id=$comply_report_forms_row->form_id;
		$uain=$comply_report_forms_row->uain;
		$fire_process_results=$fire->query("select form_id from fire_form".$form_no."_process where process_type='V' and status='1'");
		if($fire_process_results->num_rows>0){
			echo "<script>
				window.location.href = 'compliance_report.php?token=".$uain."';
			</script>";
			exit();
		}else{
			echo "<script>
				alert('Your application form is in underprocess. However the recommendations are not given from the department yet. Thank You !!!');
				window.location.href = '../../../user_area/';
			</script>";
			exit();
		}		
	}else{
		echo "<script>
				alert('Please fill up the application for NOC along with recommendations and letter no. which was provided to you followed by the compliance report.');
				window.location.href = 'fire_form".$form_no.".php';
			</script>";
			exit();
	}
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
								<h4 class="text-center"> COMPLIANCE REPORT OF FIRE SAFETY MEASURES SUGGESTIONS</h4>	
						</div>
				<?php 
					if(isset($_GET["token"])){
						$uain=$_GET["token"];
						$dept=$formFunctions->get_uainDept($uain);
						$form=$formFunctions->get_uainForm($uain);
						$table_name=$formFunctions->getTableName($dept,$form);
						$q=$fire->query("select letter_no,letter_date from compliance_report where uain='$uain' and active='1'") or die($fire->error);
						if($q->num_rows>0){
							$rows=$q->fetch_object();
							$letter_no=$rows->letter_no;
							$letter_date=$rows->letter_date;
						}else{
							echo "<script>
									alert('Invalid Page Access');
									window.location.href = '../index.php';
								</script>";	
						}
					
				?>
					
						<div class="panel-body">
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<input type="hidden" name="token" value="<?php echo $uain; ?>" />
									<p>To,<br/>
									&emsp;The Director,<br/>&emsp;Fire & Emergency Services, Assam.<br/><br/>
									Sir,<br/>
									&emsp;I/We, <?php echo strtoupper($key_person); ?> on behalf of <?php echo strtoupper($unit_name); ?> located at <?php echo $from; ?> , Block/ward no. <?php echo $b_block; ?> , District - <?php echo $b_dist;?> , do hereby inform you that Fire prevention &amp; Fire Safety Measures have been provided in the Building/ Premises as per recommendation by you vide your letter no. &nbsp;<?php echo $letter_no;?> dated &nbsp;<?php echo $letter_date;?> and Para wise compliance report is enclosed.<br/><br/>&emsp;You are requested kindly to take necessary action for grant of N.O.C. for the above premises/ building.
									</p>

									<br/>

									<table class="table table-responsive">
										<tr>
										<td align="right"><?php echo strtoupper($key_person);?><br/>
												Signature of the Applicant 
											</td>
										</tr>
									</table>
										<div align="center"><button type="submit" style="font-weight:bold" name="comply" class="btn btn-success">Submit</button></div>
									</form>
								</div>
							</div>
						</div>
					
					<?php }else{ ?>
						<div class="panel-body">
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<div class="col-md-6">
											<h4>Please select the application for NOC for which you want to file the compliance report .</h4>
										</div>
										<div class="col-md-3">
										<select name="form_no" required="required" class="form-control text-uppercase">
											<option value="">Please select a form name</option>
											<?php 
											$query=$cms->query("select form_no,form_name from fire_form_names where form_no < 11");
											while($rows=$query->fetch_object()){
												?>
											<option value="<?php echo $rows->form_no; ?>" ><?php echo $rows->form_name; ?></option>
											
											<?php } ?>
										</select>
										</div>
										<div align="center"><button type="submit" style="font-weight:bold" name="noc_form_no" class="btn btn-success">Submit</button></div>
									</form>
								</div>
							</div>
						</div>
						
					<?php } 	?>
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
</script>
        
   </body>
</html>