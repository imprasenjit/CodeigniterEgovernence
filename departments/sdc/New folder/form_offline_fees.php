<?php
require_once "../../requires/login_session.php"; 
$get_file_name=basename(__FILE__);
include "form_offline_payment_save.php";
if(isset($_GET["token"]) && $_GET["token"]=="trade"){
	$check=$gmc->query("select process_type from gmc_form1 a,gmc_form1_process b,gmc_form1_certificates c where a.user_id='$swr_id' and b.form_id=a.form_id and b.process_type='A' and c.is_paid!='Y'") or die($gmc->error);
	if($check->num_rows>0)
	{
		$form_id=$gmc->query("select form_id from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1 ")->fetch_object()->form_id;
		$fees=$gmc->query("select total_fees from gmc_form1_certificates where form_id='$form_id' and is_paid!='Y'")->fetch_object()->total_fees;		
		$prev="../index.php";
	}

?>
<!-- gmc trade license -->
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$cms->query("select form_name from gmc_form_names where form_no='1'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
					<form name="fileUpload" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
						<table class="table table-bordered table-responsive" id="">
							<tbody>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-8 col-md-offset-3">
												<div class="form-inline">
													<strong>Select your mode of payment &nbsp; &nbsp; &nbsp;</strong>
													<input type="hidden" name="form_id" value="<?php echo $form_id;?>" readonly=readonly/>
													<input type="radio" value="1" name="payment_mode"> Online Payment &nbsp;&nbsp;
													<input type="radio" value="0" name="payment_mode"> Offline Payment
												</div>
											</div>
										</div>
										<br>
										<div id="offlinePayDetials" style="display: block;">
											<div class="row">
												<div class="col-md-6 col-md-offset-4">
													<strong>Application Fee Payment Reciept ( <i class="fa fa-1x fa-inr"></i> <?php echo "Rs. ".$fees.".00"; ?> )</strong>
													<p>Bank Name : ICICI Bank Limited , fancy Bazaar, Ghy<br>
														Bank Account No. : 054305001649<br>
														Entity Name : Guwahati Municipal Corporation<br>
														RTGS IFSC Code : ICIC0000543<br>
														NEFT IFSC Code : ICIC0000543
													</p>
													<div class="uploadfieldtrick">
														<b>Upload Pay-Challan :</b>
														<input type="button" value="Browse" id="file" class="file" upload="file">
														
														<input type="hidden" name="offline_challan" value="" id="mfile" readonly="readonly"/>
														<span id="mfile-chiranjit">No File Selected</span>
													</div>
												</div>
											</div>
										</div>
										<br><br>
									</td>
								</tr>
								<tr>
								<td class="text-center">
									<button class="btn btn-success" name="submit_fees" style="font-weight:bold" type="submit">Save and Next</button>
								</td>
								</tr>
							</tbody>
						</table>
					</form>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
		<script>
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
<?php
}else{
	echo "<script>
				alert('Something goes wrong');
				window.location.href = 'index.php';
		</script>";	
}
if(isset($gmc))
{
	$gmc->close();
}
if(isset($mysqli))
{
	$mysqli->close();
}
?>
