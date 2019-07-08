<?php  require_once "../../requires/login_session.php";
$get_file_name=basename(__FILE__);
$css="";	
$applicant_id=$sid;
include "save_form3.php";
include "save_form4.php";
include "save_form.php";	
if(isset($_GET["token"])){
	$token=$_GET["token"];
	$check=$formFunctions->is_already_registered('health',$token);
	if($check==1){
		echo "<script>
					alert('Already Registered');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$token."&dept=health';
			</script>";	
	}else if($check==0){
		echo "<script>
				alert('Something went wrong!!!');
				window.location.href = '".$server_url."user_area/';
		</script>";
	}else if($check==4){
		echo "<script>
				window.location.href = '".$server_url."departments/health/forms/health_form".$token.".php';
		</script>";	
	}else{
		$submit_payment=$token;
		$reg_fees=$health->query("select reg_fees from health_form".$token." where user_id='$swr_id' and active='1'")->fetch_object()->reg_fees;
	}
}else{
	echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '".$server_url."departments/health/';
	</script>";
}
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
						<form name="myform1" id="" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table  id=""  class="table table-responsive" >
								<tr>
									<td>
										<!--<div class="row">
											<div class="col-md-6 col-md-offset-4">
												<div class="form-inline">
													<strong>Select your mode of payment &nbsp; &nbsp; &nbsp;</strong>
													<input type="radio" name="payment_mode" value="1"> Online Payment
													<input type="radio" name="payment_mode" value="0"> Offline Payment
												</div>
											</div>
										</div>-->
										<input type="hidden" name="payment_mode" value="0">
										<br>
										<div id="offlinePayDetials">
											<div class="row">
												<div class="col-md-4 col-md-offset-4 box box-shadow" style="width:30%;padding-bottom:30px">
													<p><b><u>Challan Head</u></b><br/>
																		<br/><br/>
													</p>
													<div class="row">
														<div class="col-md-6"><label>Amount (in Rs.): </label></div>
														<div class="col-md-6"><input type="text" name="reg_fees" class="form-control text-uppercase" readonly="readonly" value="<?php echo $reg_fees;?>"/></div>
													</div>
													<div class="row">
														<div class="col-md-6"><label>Date : </label></div>
														<div class="col-md-6"><input type="date" class="dob form-control" name="txn_date" /></div>
													</div>
													<div class="row">
														<div class="col-md-6"><label>Bank Name : </label></div>
														<div class="col-md-6"><input type="text" class="form-control text-uppercase" name="bank_name"/></div>
													</div>
													<div class="row">
														<div class="col-md-6"><label>Treasury/Ref. No. : </label></div>
														<div class="col-md-6"><input type="text" class="form-control" name="ref_no" validate="OnlyNumbers"/></div>
													</div>
													<div class="uploadfieldtrick">
														<b>Upload Treasury Challan :</b>
														<input type="button" upload="file" class="file btn bg-aqua" id="file" value="Browse">
														<input type="hidden" name="offline_challan" value="" id="mfile" readonly="readonly"/>
														<span id="tdfile">No File Selected</span>
													</div>	
												</div>
												<div class="col-md-3 col-md-offset-4 center" style="width:30%;">
													<button type="submit" style="font-weight:bold" name="payment<?php echo $submit_payment; ?>" class="btn btn-success btn-block submit1">Pay Now</button>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php require '../../../user_area/includes/footer.php'; ?>
<?php require '../../../user_area/includes/js.php'; ?>
<script type="text/javascript">    
    //Printing function
    function printcontent() {
        $("#printcontent").print({
            globalStyles : false,
            mediaPrint : false,
            stylesheet : "../../../dist/css/skins/AdminLTE.css",
            iframe : false,
            noPrintSelector : ".avoid_me",
            //append : printcontent1,
            prepend : null
	});
    } //End of printcontent()
</script>
</body>
</html>