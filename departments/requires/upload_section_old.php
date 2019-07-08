<?php  require_once "login_session.php";

	$courier_section=0;
	if(isset($_POST["submit"])){
		if(isset($_SESSION["dept"]) || isset($_SESSION["form"]) || $_SESSION["dept"]!="" || $_SESSION["form"]!=""){
			$dept=$_SESSION["dept"];
			$form=$_SESSION["form"];
			$form_id=$_SESSION["form_id"];
			$table_name=$_SESSION["table_name"];
			$sub_dept_id=$_SESSION["sub_dept_id"];
			$payment_required=$_SESSION["payment_required"];
			

		}else{
			echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '".$server_url."user_area/';
			</script>";	
		}
		$check_upload_section_query="select uploaded_documents from ". $table_name ." where user_id='$swr_id' and form_id='$form_id' and active='1'";
		$check_upload_section_results=$formFunctions->executeQuery($dept,$check_upload_section_query);
		
		if($check_upload_section_results->num_rows>0){
			$documents=array_slice($_POST,0,-1);
			// Check whether SC resides in the POST
			foreach($documents as $key=>$values){
				if (in_array("SC", $values)) {
					$courier_section=1;
				}
			}
			$uploaded_documents=json_encode(array("documents" =>($documents)));
			
			$update_query="update ". $table_name ." set uploaded_documents='$uploaded_documents' where form_id='$form_id' and user_id='$swr_id'";
			$update_results=$formFunctions->executeQuery($dept,$update_query);
			if($update_results){
				if($courier_section==1){ //Go to courier section
					echo "<script>
						alert('Successfully uploaded.');
						window.location.href = '".$server_url."departments/requires/courier_details.php?dept=".$dept."&form=".$form."';
				</script>";
				}else if($payment_required==1){ //Go to payment section
					echo "<script>
						alert('Successfully uploaded.');
						window.location.href = '".$server_url."departments/requires/payment_section.php?dept=".$dept."&form=".$form."';
				</script>";
				}else{ //Go to final submit
					echo "<script>
						alert('Successfully uploaded.');
						window.location.href = '".$server_url."departments/requires/final_submit.php';
				</script>";
				}
					
			}else{
				echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '".$server_url."user_area/';
			</script>";	
			}
		}else{
			echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '".$server_url."user_area/';
			</script>";	
		} 
		
		/* $return_value=json_decode($total_docs,true);
		foreach($return_value["x"] as $key=>$values){
			echo $values[0] . "<br/>";
			echo $values[1] . "<br/>";
		} */
		
		/* $query="update ". $table_name ." set uploaded_documents='$uploaded_documents' where ";
		
		die(); */
	}


	if(isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"]>0 && isset($_GET["dept"]) && strlen($_GET["dept"])>0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])){
		$_SESSION["dept"]=$dept=$_GET["dept"];
		$_SESSION["form"]=$form=$_GET["form"];
		
		$_SESSION["table_name"]=$table_name=$formFunctions->getTableName($dept,$form);
		$_SESSION["sub_dept_id"]=$sub_dept_id=$formFunctions->get_sub_dept_id($dept);
		
		
		
		$documentslist_values_query="select documentslist,payment_required from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id'";
		$documentslist_values_results=$formFunctions->executeQuery("cms",$documentslist_values_query);
		if($documentslist_values_results->num_rows>0){
			$documentslist_values_row=$documentslist_values_results->fetch_object();
			$documentslist_values=$documentslist_values_row->documentslist;
			$_SESSION["payment_required"]=$payment_required=$documentslist_values_row->payment_required;
		}else{
			$documentslist_values="";
		}
		
	}else{
		echo "<script>
					alert('Invalid Page Access !!!');
					window.location.href = '".$server_url."user_area/';
			</script>";	
	}

	$check=$formFunctions->is_already_registered($dept,$form);
	if($check==1){
		echo "<script>
					alert('Already Registered');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=". $form ."&dept=" .$dept. "';
			</script>";	
	}else if($check==2){
		echo "<script>				
					window.location.href = '".$server_url."departments/requires/courier_details.php?form=". $form ."&dept=" .$dept. "';
			</script>";
	}else if($check==3){
		echo "<script>window.location.href = 'payment_section.php?token=". $form ."';</script>";
	}else{
		$showtab="";
	}
	$get_file_name=basename(__FILE__);

	$check_upload_section_query="select form_id,uploaded_documents from ". $table_name ." where user_id='$swr_id' and active='1'";
	$check_upload_section_results=$formFunctions->executeQuery($dept,$check_upload_section_query);

	if($check_upload_section_results->num_rows>0){
		$row=$check_upload_section_results->fetch_object();
		$uploaded_documents_json=$row->uploaded_documents;
		$_SESSION["form_id"]=$form_id=$row->form_id;
	}else{
		echo "<script>
				alert('Something went wrong !!! Please try again');
				window.location.href = '".$server_url."user_area/';
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
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
</script>
	<?php require '../../user_area/includes/css.php';?>
	
	
	
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
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
<div class="wrapper">
  <?php require '../../user_area/includes/header.php'; ?>
  <?php require '../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require 'banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
							</h4>	
						</div>
						<div class="panel-body">
							<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">	
									<tr>
										<td colspan="5">Checklist of Documents to be enclosed 
										<p class="text-success">(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</p></td>
									</tr>
									
									<?php 
									if($uploaded_documents_json!=""){ 
										$uploaded_documents=json_decode($uploaded_documents_json,true);
										$sl=1;
										foreach ($uploaded_documents["documents"] as $key=>$values) {
										
									?>
										<tr>
											<td width="40%"><input type="hidden" value="<?php echo $values[0]; ?>" name="doc<?php echo $sl; ?>[]"><?php echo $values[0]; ?></td>
											<td width="30%">
												<select trigger="FileModal" id="file<?php echo $sl; ?>" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($values[1]); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
												<input type="hidden" name="doc<?php echo $sl; ?>[]" id="mfile<?php echo $sl; ?>" value="<?php echo $values[1] !== '' ? $values[1] : ''; ?>" />
											</td>
											<td width="30%" id="tdfile<?php echo $sl; ?>">
												<?php if($values[1]!="" && $values[1]!="SC" && $values[1]!="NA"){ echo '<a href="'.$upload.$values[1].'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
											</td>
										</tr>
										
									<?php 
										$sl++;
										}
									}else{ 
										//$documentslist_values='{"obj":["doc-1","doc-2","doc-3","Doc-4"]}';
										$documentslist = json_decode($documentslist_values, true);
										$sl=1;
										foreach ($documentslist["obj"] as $key=>$values) { ?>
									
											<tr>
												<td width="40%"><input type="hidden" value="<?php echo $values; ?>" name="doc<?php echo $sl; ?>[]"><?php echo $values; ?></td>
												<td width="30%">
													<select trigger="FileModal" id="file<?php echo $sl; ?>" class="form-control">
														<option value="0" selected="selected">Please Select</option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
												<input type="hidden" name="doc<?php echo $sl; ?>[]" id="mfile<?php echo $sl; ?>" value="" />
												</td>
												<td width="30%" id="tdfile<?php echo $sl; ?>">No File Selected</td>
											</tr>
									
								<?php 	$sl++;
										} ?>  
										
								<?php	} ?>									
									<tr>
										<td class="text-center" colspan="4">
											<a href="boiler_form1.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success submit1" name="submit" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
  <?php require '../../user_area/includes/footer.php'; ?>
</div>
	<!-- ./wrapper -->
<?php require '../../user_area/includes/js.php' ?>
<script>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	/* ----------------------------------------------------- */
</script>



</body>
</html>