<?php  require_once "../../requires/login_session.php";
$dept="doa";
//$form="22";
//include "doa_form22.php";
//$table_name=$formFunctions->getTableName($dept,$form);
//include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
//include "save_hw_form.php";

$q=$doa->query("select * from fertilizer_type where user_id='$swr_id' and active='1'") or die($doa->error);
if($q->num_rows<1){	 
	$p=$doa->query("select * from fertilizer_type where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or die($doa->error);
	if($p->num_rows>0){
		$results=$p->fetch_assoc();	
		$form_id=$results['form_id'];
		$is_type_fertilizer=$results['is_type_fertilizer'];
		
	}else{		
		$form_id=""; 
		$is_type_fertilizer="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$is_type_fertilizer=$results['is_type_fertilizer'];
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
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
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
		.popover{
		max-width: 100%; /* Max Width of the popover (depending on the container!) */
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
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
					<div class="panel-body">
					<br>
					<div id="table1" class="tab-pane " role="tabpanel">
						<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
						
								<tr>
									<td colspan="2">Type of fertilizer :</td>
									<td><label class="radio-inline"><input type="radio" value="G" onClick="displayForm(this)" <?php if($is_type_fertilizer != 'G' && $is_type_fertilizer != '') echo 'checked'; ?> id="general_fertilizer" name="is_type_fertilizer"> General Fertilizer </label>
									<label class="radio-inline"><input type="radio" value="O" onClick="displayForm(this)" <?php if($is_type_fertilizer == 'O' || $is_type_fertilizer == '') echo 'checked'; ?> id="other_fertilizer" name="is_type_fertilizer"> Other Fertilizer </label></td>
									<td></td>
								</tr>
								
								<!--<tr>										
									<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>										
								</tr>-->
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
<?php require '../../../user_area/includes/js.php' ?>		
						
<script> 

        function displayForm(myform1){ 
            if(myform1.value == "G"){ 

				document.getElementById("general_fertilizer").style.visibility='visible'; 
				document.getElementById("other_fertilizer").style.visibility='hidden'; 
            } 
            else if(myform1.value =="O"){ 
                document.getElementById("general_fertilizer").style.visibility='hidden'; 
				document.getElementById("other_fertilizer").style.visibility='visible'; 
            } 
            else{ 
            } 
         }          
	
	
</script>
</body>
</html>