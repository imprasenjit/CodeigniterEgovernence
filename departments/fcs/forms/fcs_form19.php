<?php  require_once "../../requires/login_session.php";
$dept="fcs";
$form="19";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
		
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];			
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_s1=$address->s1;$address_s2=$address->s2;$address_d=$address->d;$address_p=$address->p;
			}else{				
				$address_s1="";$address_s2="";$address_d="";$address_p="";
			}
		}else{	   
			$form_id="";$auth_address="";$license_no="";$expiry_date="";$license_stands="";$renewal_desired="";$details_action="";$address_s1="";$address_s2="";$address_d="";$address_p="";
        }		
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];			
		if(!empty($results["address"])){
			$address=json_decode($results["address"]);
			$address_s1=$address->s1;$address_s2=$address->s2;$address_d=$address->d;$address_p=$address->p;
		}else{				
			$address_s1="";$address_s2="";$address_d="";$address_p="";
		}
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td colspan="4" class="form-inline">To,<br/>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Licensing Authority<br/></td>									
								</tr>
								<tr>
									<td colspan="4" class="form-inline">Sir,<br/>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, <?php echo strtoupper($key_person); ?> hereby apply for renewal of my license no. &nbsp; <input type="text" name="license_no" value="<?php echo $license_no; ?>" class="form-control text-uppercase">&nbsp; issued under the Assam Trade Article (Licensing &amp; Control) Order, 1982. The required particulars are given hereunder -</td>
								</tr>
								<tr>
									<td width="25%">1. Date on which the license expired</td>
									<td width="25%"><input type="text" name="expiry_date" value="<?php echo $expiry_date; ?>" class="dob form-control text-uppercase" readonly="readonly"></td>
									<td width="25%">2. Name in which license stands</td>
									<td width="25%"><input type="text" name="license_stands"  value="<?php echo $license_stands; ?>" class="form-control text-uppercase"></td>		
								</tr>
								<tr>
									<td width="25%">3. For how many years the renewal is desired</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="renewal_desired" value="<?php echo $renewal_desired;?>"/></td>
									<td width="25%">4. Details of the action, if any taken against the last three years for contravention of an order issued under Essential Commodities Act 1955</td>
									<td width="25%"><input type="text" name="details_action" value="<?php echo $details_action; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
								   <td colspan="4">5. Particulars of trade articles in which the applicant wants to carry on business as a :
                                    <table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
                                        <tr>
                                            <th width="5%">Slno</th>
                                            <th width="25%">As a wholesaler</th>
                                            <th width="20%">As a Importer</th>
                                            <th width="25%">As a Retailer</th>
                                        </tr>
                                        <?php
                                            $part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
                                            $num = $part1->num_rows;
                                            if($num>0){
                                                $count=1;
                                                while($row_1=$part1->fetch_array()){	?>
                                                <tr>
                                                    <td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
                                                    <td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["wholesaler"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
                                                    <td><input type="text" value="<?php echo $row_1["impoter"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
                                                    <td><input type="text" value="<?php echo $row_1["retailer"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
                                                </tr>	
                                            <?php $count++; } 
                                            }else{	?>
                                            <tr>
                                                <td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
                                                <td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
                                                <td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
                                                <td><input type="text" id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>
                                            </tr>
                                            <?php } ?>														
                                        </table>
                                        <div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
                                        <button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
                                        <input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
                                    </td>
                                </tr>	
                                <tr>									
									<td colspan="4">6. Complete address (with House no. market etc.) of godowns or place where trade articles for which licence has been applied will be stored :</td>
								</tr>
								<tr>									
									<td>a) Village/ Town :</td>
									<td><input type="text" name="address[s1]" value="<?php echo $address_s1; ?>" class="form-control text-uppercase"></td>
									<td> b) P.S:</td>
									<td><input type="text" name="address[s2]" value="<?php echo $address_s2; ?>" class="text-uppercase form-control"></td>
								</tr>
								<tr>									
									<td>c) District : </td>
                                    <td><input type="text" name="address[d]" id="dist"  value="<?php echo $address_d; ?>" class="text-uppercase form-control"></td>
									
									<td>d) Pincode </td>
									<td><input type="text" name="address[p]" validate="pincode" maxlength="6" value="<?php echo $address_p; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I <input type="text" class="form-control" disabled value="<?php echo strtoupper($key_person); ?>" > hereby declare that the particulars mentioned are correct to the best of my knowledge and nothing has been cancelled there in.</td>
								</tr>
								<tr>
								   <td>Date:</td>
									<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
									<td>Signature of the Authorised Signatory</td>
									<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
								</tr>
								<tr>									
									<td class="text-center" colspan="4">
										<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1">Save & Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>