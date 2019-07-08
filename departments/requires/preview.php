<?php require_once "login_session.php";
$get_file_name=basename(__FILE__);
$css="";	
$applicant_id=$user_id;
$ci->load->helper('get_uain_details');
if(isset($_POST["proceed"])){
	if(isset($_SESSION["dept"]) || isset($_SESSION["form"]) || $_SESSION["dept"]!="" || $_SESSION["form"]!=""){
		$dept=$_SESSION["dept"];
		$form=$_SESSION["form"];
		$table_name=getTableName($dept,$form);
		$_SESSION["sub_dept_id"]=$sub_dept_id=$formFunctions->get_sub_dept_id($dept);
		echo "<script>window.location.href = '".$server_url."departments/requires/final_submit.php';</script>";
	}else{
		echo "<script>
				alert('Something went wrong !!! Please try again');
				window.location.href = 'preview.php?form=". $form ."&dept=" .$dept. "';
		</script>";	
	}	
}


if(isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"]>0 && isset($_GET["dept"]) && strlen($_GET["dept"])>0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])){
	$_SESSION["dept"]=$dept=$_GET["dept"];	
	$_SESSION["form"]=$form=$_GET["form"];		
	
	$table_name=getTableName($dept,$form);
	
	require_once "check_form_save_mode.php";
	
	if(($dept=="cei" && ($form==3 || $form==6 || $form==7 || $form==8 || $form==10 || $form==11 || $form==12 || $form==13 || $form==14 || $form==15 || $form==16 || $form==25 || $form==26 || $form==27 || $form==28)) || ($dept=="sdc" && ($form==20 || $form==54 || $form==58)) || ($dept=="boiler" && ($form==1 || $form==2))){
		$check_query="select uain,form_id from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1";
	}else{
		 $check_query="select uain,form_id from ".$table_name." where user_id='$swr_id' and active='1'";
	}
	
	
	$query=$formFunctions->executeQuery($dept,$check_query);
	if($query->num_rows==0){
		echo "<script>
			alert('Something went wrong !!!.');
			window.location.href = 'payment_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}
	
	$row=$query->fetch_array();	
	$_SESSION["form_id"]=$form_id=$row["form_id"];				
	$uain=$row["uain"];	

	require_once "../../".$formFunctions->get_preview_path($dept,$form); 
	//include "".$dept."_form".$form."_print.php";
}else{
	echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '".$server_url."user_area/';
	</script>";
} ?>
<?php require_once "header.php"; ?>
<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<nav style="height:80px" class="bg-aqua-active navbar navbar-default navbar-fixed-top">
  <div class="container-fluid avoid_me">
    <!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header col-md-12 text-center">	
		<a href="<?php echo $server_url."user_area/"; ?>" class="btn btn-app bg-default"><i class="fa fa-home"></i>Dashboard</a>
	  <?php if(isset($show_edit)){ 
			
			?>
				<a type="button" href="<?php echo $server_url.$formFunctions->get_form_path($dept,$form); ?>" class="btn btn-app bg-light-blue"><i class="fa fa-edit"></i>Edit</a>
				<button type="submit" name="<?php echo "proceed"; ?>" onclick="return confirm('Do you really want to Submit the form ? Once submitted, You will not be allowed to modify any information provided in the form.')" class="btn btn-app bg-green-active"><i class="fa fa-save"></i>Submit</button>
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
<?php require 'js.php'; ?>
<script type="text/javascript">
    
    //Printing function
    function printcontent() {
        $("#printcontent").print({
            globalStyles : false,
            mediaPrint : false,
            stylesheet : "../../dist/css/skins/AdminLTE.css",
            iframe : false,
            noPrintSelector : ".avoid_me",
            //append : printcontent1,
            prepend : null
	});
    } //End of printcontent()
</script>
</body>
</html>