<?php require_once "../../requires/login_session.php";
$get_file_name=basename(__FILE__);
$css="";	
$applicant_id=$sid;
include "save_form.php";
include "save_form1.php";
include "save_form2.php";
include "save_form3.php";
include "save_form4.php";
include "save_form5.php";
if(isset($_GET["token"]) && is_numeric($_GET["token"]) && $_GET["token"]>0 && $_GET["token"]<60){
	$token=$_GET["token"];	
	$check=$formFunctions->is_already_registered('sdc',$token);
	if($check==1){
		echo "<script>
					alert('Already Registered');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$token."&dept=sdc';
			</script>";	
	}else if($check==0){
		echo "<script>
				alert('Something went wrong!!!');
				window.location.href = '".$server_url."user_area/';
		</script>";
	}else if($check==4){
		$show_edit="";
	}else{}
	include "sdc_form".$token."_print.php";
}else{
	echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '".$server_url."departments/sdc/';
	</script>";
} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of Doing Business | Govt. of Assam</title>
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
<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<nav style="height:80px;" class="bg-aqua-active navbar navbar-default navbar-fixed-top">
  <div class="container-fluid avoid_me">
    <!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header col-md-12 text-center">	
		<a href="<?php echo $server_url."user_area/"; ?>" class="btn btn-app bg-default"><i class="fa fa-home"></i>Dashboard</a>
	  <?php if(isset($show_edit)){ ?>
			<a type="button" href="sdc_form<?php echo $token; ?>.php" class="btn btn-app bg-light-blue"><i class="fa fa-edit"></i>Edit</a>
			<button type="submit" name="<?php echo "proceed".$token;?>" onclick="return confirm('Do you really want to Submit the form ? Once submitted, You will not be allowed to modify any information provided in the form.')" class="btn btn-app bg-green-active"><i class="fa fa-save"></i>Submit</button>
	  <?php }else{ ?>
		<a onclick="printcontent()" class="btn btn-app bg-navy"><i class="fa fa-file-pdf-o"></i>Save as PDF</a>
		<a onclick="window.print()" class="btn btn-app bg-blue-active"><i class="fa fa-file"></i>Print</a>
	  <?php } ?>
		
	</div>
  </div><!-- /.container-fluid -->
</nav>
</form>
<div class="container" style="margin-top:100px">
<div class="row">
<div  class="col-md-12" id="printcontent" style="width: 100%;">
<?php echo $printContents; ?>


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