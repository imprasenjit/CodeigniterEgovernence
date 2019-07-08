<?php  require_once "../../requires/login_session.php"; 
$dept="doa";
$form="26";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form1.php";
$row1=$formFunctions->fetch_swr($swr_id);
	
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		##### part 1 ######		
	    $name_concern=$results["name_concern"];
		$relevant_detail=$results["relevant_detail"];
		$is_renewal=$results["is_renewal"];
				
		if(!empty($results["sale"])){
			$sale=json_decode($results["sale"]);
			$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_d=$sale->d;$sale_p=$sale->p;$sale_mno=$sale->mno;
		}else{
			$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		}
		if(!empty($results["storage"])){
			$storage=json_decode($results["storage"]);
			$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_d=$storage->d;$storage_p=$storage->p;$storage_mno=$storage->mno;
		}else{
			$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
		}		
		if(!empty($results["manufac_importer"])){
			$manufac_importer=json_decode($results["manufac_importer"]);
			if(isset($manufac_importer->a)) $manufac_importer_a=$manufac_importer->a; else $manufac_importer_a="";
			if(isset($manufac_importer->b)) $manufac_importer_b=$manufac_importer->b; else $manufac_importer_b="";
			if(isset($manufac_importer->c)) $manufac_importer_c=$manufac_importer->c; else $manufac_importer_c="";
			if(isset($manufac_importer->d)) $manufac_importer_d=$manufac_importer->d; else $manufac_importer_d="";
			if(isset($manufac_importer->e)) $manufac_importer_e=$manufac_importer->e; else $manufac_importer_e="";
		}else{
			$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";		 
		}		
	}else{		 
		$form_id="";
		##### part 1 ######
		$name_concern="";
		$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
		$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";$relevant_detail="";$is_renewal="";$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";
	}		
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	##### part 1 ######	
	$name_concern=$results["name_concern"];
	$relevant_detail=$results["relevant_detail"];
	$is_renewal=$results["is_renewal"];
				
	if(!empty($results["sale"])){
		$sale=json_decode($results["sale"]);
		$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_d=$sale->d;$sale_p=$sale->p;$sale_p=$sale->p;$sale_mno=$sale->mno;
	}else{
		$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
	}
	if(!empty($results["storage"])){
		$storage=json_decode($results["storage"]);
		$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_d=$storage->d;$storage_p=$storage->p;$storage_mno=$storage->mno;
	}else{
		$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
	}	
	if(!empty($results["manufac_importer"])){
		$manufac_importer=json_decode($results["manufac_importer"]);
		if(isset($manufac_importer->a)) $manufac_importer_a=$manufac_importer->a; else $manufac_importer_a="";
		if(isset($manufac_importer->b)) $manufac_importer_b=$manufac_importer->b; else $manufac_importer_b="";
		if(isset($manufac_importer->c)) $manufac_importer_c=$manufac_importer->c; else $manufac_importer_c="";
		if(isset($manufac_importer->d)) $manufac_importer_d=$manufac_importer->d; else $manufac_importer_d="";
		if(isset($manufac_importer->e)) $manufac_importer_e=$manufac_importer->e; else $manufac_importer_e="";
	}else{
		$manufac_importer_a="";$manufac_importer_b="";$manufac_importer_c="";$manufac_importer_d="";$manufac_importer_e="";		 
	}		
}

    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends

?>
<?php require_once "../../requires/header.php";   ?>
    <?php include ("".$table_name."_Addmore.php"); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">										
										<tr>
											<td colspan="4">To<br/>
											&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
											 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
											<br/></td>
										</tr>
										<tr>
											<td colspan="4">1.  Details of the application :</td>
										</tr>
										<tr>
										   <td width="25%">(a)  Name of the applicant :</td>
										   <td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										   <td width="25%">(b)  Name of the concern :</td>
										   <td width="25%"><input type="text" name="name_concern" value="<?php echo $name_concern; ?>" class="form-control text-uppercase"></td>		
										</tr>
										<tr>
											<td colspan="4">(c)  Postal address with telephone number :</td>				 
										</tr>
										<tr>
											<td>Street name 1 :</td>
											<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
											<td>Street name 2 :</td>
											<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
										</tr>								
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
											<td>District :</td>
											<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Pincode :</td>
											<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
											<td>Mobile No. :</td>
											<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>E-mail id :</td>
											<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
											<td colspan="2"></td>					
										</tr>
										<tr>
											<td colspan="4">2.  Place of business (Please give full address ) : </td>
										</tr>
										<tr>
											<td colspan="4"> (i) For sale  : </td>
										</tr>
										<tr>
											<td> Street Name 1  :</td>
											<td><input type="text" class="form-control text-uppercase" name="sale[sn1]" value="<?php echo $sale_sn1;?>" /></td>
											<td> Street Name 2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="sale[sn2]" value="<?php echo $sale_sn2;?>" /></td>
										</tr>
										<tr>
											<td> Village/ Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="sale[v]" value="<?php echo $sale_v;?>"/></td>
											<td>District :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase" name="sale[d]" id="sale_d" value="<?php echo $sale_d;?>"/></td>
											
										</tr>
										<tr>
											<td>Pincode :</td>
											<td><input type="text" class="form-control text-uppercase"  name="sale[p]" validate="pincode" maxlength="6" value="<?php echo $sale_p;?>"></td>
											<td>Mobile No. :</td>
											<td><input type="text" name="sale[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $sale_mno; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td colspan="4">(ii) For Storage : </td>
										</tr>
										<tr>
											<td> Street Name 1  :</td>
											<td><input type="text" class="form-control text-uppercase" name="storage[sn1]" value="<?php echo $storage_sn1;?>" /></td>
											<td> Street Name 2 :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $storage_sn2;?>" name="storage[sn2]" /></td>
										</tr>
										<tr>
											<td> Village/ Town :</td>
											<td><input type="text" class="form-control text-uppercase"  name="storage[v]" value="<?php echo $storage_v;?>" /></td>
											<td>District :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase"  name="storage[d]" id="storage_d" value="<?php echo $storage_d;?>" /></td>
											
										</tr>
										<tr>
											<td>Pincode :</td>
											<td><input type="text" validate="pincode" maxlength="6" value="<?php echo $storage_p; ?>" class="form-control text-uppercase" name="storage[p]"></td>
											<td>Mobile No. :</td>
											<td><input validate="mobileNumber" maxlength="10"   type="text" name="storage[mno]" value="<?php echo $storage_mno; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>3. Whether the application is for  </td>
											<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_a=="M") echo "checked"; ?> name="manufac_importer[a]" value="M">Manufacturer&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_b=="I") echo "checked"; ?> name="manufac_importer[b]" value="I">Importer&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_c=="P") echo "checked"; ?> name="manufac_importer[c]" value="P">Pool Handling Agency  &nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_d=="W") echo "checked"; ?> name="manufac_importer[d]" value="W">Wholesale Dealer&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($manufac_importer_e=="R") echo "checked"; ?> name="manufac_importer[e]" value="R">Retail Dealer&nbsp;&nbsp; </label></br>
											</td>
										</tr>
										<tr>
											<td colspan="4">4. Details of fertilizer and their source in Form "O" 
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
													<tr>
														<th width="20%">Sl. No.</th>
														<th width="40%">Name of fertilizers</th>
														<th width="40%">Whether certificate of source in Form 'O' is attached</th>													
													</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["fertilizer"]; ?>" name="txtB<?php echo $count;?>"  size="10"></td>
														<td><input id="txtC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["is_certificate"]; ?>" name="txtC<?php echo $count;?>"  placeholder="YES/NO"></td>
													</tr>	
												<?php $count++; } 
												}else{	
													$i=1; ?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10" class="form-control text-uppercase" name="txtC1" placeholder="YES/NO"></td>
													</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px">
												<button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
											</div>
											</td>
										</tr>
										<tr>
											<td colspan="3">5. Whether the intimation is for an authorization letter or a renewal thereof. <br/>  (Note: In case the intimation is for renewal of authorization letter, the acknowledgement in Form A2 should be submitted for necessary endorsement thereon.) </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_renewal" required="required" class="is_renewal" value="Y"  <?php if(isset($is_renewal) && $is_renewal=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" class="is_renewal"  value="N"  name="is_renewal" <?php if(isset($is_renewal) && ($is_renewal=='N' || $is_renewal=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="2">6. Any other relevant information :</td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="relevant_detail"><?php echo $relevant_detail;?></textarea></td>
										</tr>
										<tr>
											<td colspan="4"><br/>I have read the terms and conditions of eligibility for submission of Memorandum of intimation and undertake that the same will be complied by me and in token of the same. I have signed the same and is enclosed herewith.</td>
										</tr>										
										<tr>
											<td colspan="2">
												Date :&nbsp;<b><?php echo date('d-m-Y',strtotime($today)); ?></b><br/>
												Place :&nbsp;<b><?php echo strtoupper($dist); ?></b>
											</td>									
											<td colspan="2" align="right"> Signature of the Applicant : <strong><?php echo strtoupper($key_person);?></strong></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save and Go to the Next Part" onclick="return confirm('Do you want to save the form ?')">Save and Next</button>
											</td>
										</tr>
									</table>
								</form>
								</div>
								
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">
										<tr>
											<td colspan="4" align="center"><b><u>TERMS AND CONDITIONS OF AUTHORISATION</u></b></td>
										</tr>
										<tr>
											<td  colspan="4">
											<ol>
												<li>  I shall comply with the provisions of Fertilizer(Control) Order, 1985 and the notification issued there under for the time being in force.</li>
												<li>  I shall from time to time report to the Notified Authority and inform about change in the premises of the sale depot and godowns attached to sale depot.</li>
												<li>  I shall also submit in time all the returns as may be prescribed by the State Government.</li>
												<li>  I shall not sell fertilizers for Industrial use.</li>
												<li>  I shall file a separate Memorandum of Intimation for, where the storage point is located outside the area jurisdiction of the Notified Authority where the sale depot is located.</li>
												<li>  I shall file a separate Memorandum of Intimation for each place when the business of selling fertilisers is intended to be carried on at more than one place.</li>
												<li>  I shall file separate Memorandum of Intimation If I carry on the business of fertilisers both as retail and wholesale dealer.</li>
												<li>  I confirm that my previous Certificate of Registration or Authorisation is not under suspension or cancellation or debarred from selling of fertilisers.</li>
											</ol>
											</td>
										</tr>
										<tr>
											<td colspan="4" align="center"><b><u>DECLARATION</u></b></td>
										</tr>
										<tr>
											<td colspan="4">I/We declare that the information given above is true to the best of my/our knowledge and belief and no part thereof is false or no material information has been concealed.</td>
										</tr>
										<tr>
											<td colspan="2">
												Date :&nbsp;<b><?php echo date('d-m-Y',strtotime($today)); ?></b></br> 
												Place :&nbsp;<b><?php echo strtoupper($dist); ?></b>
											</td>									
											<td colspan="2" align="right"> Signature of the Applicant(s) : <strong><?php echo strtoupper($key_person);?></strong></td>
										</tr>
										<tr>										
											<td class="text-center" colspan="4">
												<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" class="btn btn-success submit1" name="submit<?php echo $form; ?>" title="Save and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save and Next</button>
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
	<?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>