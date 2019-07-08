<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="21";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form2.php";



$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$lic_no=$results["lic_no"];$year=$results["year"];$tonns=$results["tonns"];$mineral=$results["mineral"];$quantity=$results["quantity"];$mineral_name=$results["mineral_name"];$date=$results["date"];
	}else{
		$form_id="";
		$lic_no="";$year="";$tonns="";$mineral="";$quantity="";$mineral_name="";$date="";
	} 
}else{	    
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$lic_no=$results["lic_no"];$year=$results["year"];$tonns=$results["tonns"];$mineral=$results["mineral"];$quantity=$results["quantity"];$mineral_name=$results["mineral_name"];$date=$results["date"];
}
?>

<?php require_once "../../requires/header.php";   ?>
  	<?php include ("".$table_name."_addmore.php"); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Director,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Directorate of Geology & Mining, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kahilipara, Guwahati - 781019.</td>
										</tr>
										<tr>
											<td colspan="4">Subject :  Issue of Transport Challan</td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">Sir/Madam, <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											I/We hold a Mineral Dealer License Number &nbsp;<input type="text"  class="form-control text-uppercase" name="lic_no" value="<?php echo $lic_no;?>" >&nbsp;(Year)&nbsp;<input type="text"  class="form-control text-uppercase" name="year" value="<?php echo $year;?>" maxlength="4" validate="onlyNumbers">.&nbsp;I/ we have procured/ received &nbsp;<input type="text"  class="form-control text-uppercase" name="tonns" value="<?php echo $tonns;?>">&nbsp; tonns of &nbsp;<input type="text"  class="form-control text-uppercase" name="mineral" value="<?php echo $mineral;?>">&nbsp; (names of minerals) from Bonafide Leases (List of the lessees and quantities attached). <br/><br/>
											I/We have &nbsp;<input type="text"  class="form-control text-uppercase" name="quantity" value="<?php echo $quantity;?>">&nbsp; (quantity) of &nbsp;<input type="text"  class="form-control text-uppercase" name="mineral_name" value="<?php echo $mineral_name;?>">&nbsp; (Name of mineral) on &nbsp;<input type="text"  class="dob form-control" name="date" value="<?php echo $date;?>">&nbsp; (date).<br/><br/>
											I/ we therefore request you to kindly issue a transporting Challan book containing nos. of Challans.
											</td>
										</tr>										
										<tr>
											<td colspan="4">Details of payment made :</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Amount (Rs.)</th>
													<th>Treasury Challan Number</th>
													<th>Date</th>
												</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["amount"]; ?>" id="txtB<?php echo $count;?>" placeholder="Amount (Rs.)" class="form-control text-uppercase" name="txtB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["challan"]; ?>" id="txtC<?php echo $count;?>" placeholder="Treasury Challan Number" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["date"]; ?>" id="txtD<?php echo $count;?>" class="dob form-control" name="txtD<?php echo $count;?>" placeholder="Date" ></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" placeholder="Amount (Rs.)" name="txtB1"></td>					
														<td><input id="txtC1" class="form-control text-uppercase" placeholder="Treasury Challan Number" name="txtC1"></td>	
														<td><input id="txtD1" class="dob form-control" name="txtD1" placeholder="Date"></td>
													</tr>
												<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4" align="right">Yours faihfully, <br/><br/>
											<strong><?php echo strtoupper($key_person)?></strong><br/>
											<strong><?php echo strtoupper($lic_no)?></strong><br/>
											<strong><?php echo strtoupper($year)?></strong> </td>
										</tr>
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
  <!-- /.content-wrapper -->
 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>