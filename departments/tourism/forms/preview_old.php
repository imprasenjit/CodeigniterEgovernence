<?php require_once "../../requires/login_session.php";
$get_file_name=basename(__FILE__);
$css="";	
$applicant_id=$sid;
include "save_form.php";	
if(isset($_GET["token"])){
	$token=$_GET["token"];
	$check=$formFunctions->is_already_registered('tourism',$token);
	if($check==1){
		 echo "<script>
					alert('Already Registered');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?".$token."&dept=tourism';
			</script>";	
	}
	include "tourism_form".$token."_print.php";
}else{
	echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '".$server_url."departments/tourism/';
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
<body>
<div class="container">
<div class="row">
<div  class="col-md-12">
<br>
<p  class="pull-right"><input type="button" value="Print Application Form" onclick="printcontent()" class="btn btn-info avoid_me" /></p>	
</div>
</div>
<div class="row">
<div  class="col-md-12" id="printcontent" style="width: 100%;">
<?php echo $printContents; ?>
</div>
</div>
<br/><br/>
<div class="row">
<br>
<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<div class="col-md-12 text-center">
<input type="button" value="Print Application Form" onclick="printcontent()" class="btn btn-info text-bold avoid_me" />
<a type="button" href="<?php echo "tourism_form".$token; ?>.php" class="btn btn-primary text-bold avoid_me">Go Back & Edit</a>
<button type="submit" name="<?php echo "proceed".$token;?>" onclick="return confirm('Do you really want to Submit the form ?')" class="btn btn-success text-bold">Proceed to Final Submit</button>
</form>
</div>
</div>
<br/>
</div>
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