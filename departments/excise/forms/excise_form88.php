<?php  require_once "../../requires/login_session.php";
$dept="excise";
$form="88";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form1.php";
		
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	    if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();			
				$form_id=$results["form_id"];
				$name_father=$results["name_father"];$applicant_age=$results["applicant_age"];$sex_applicant=$results["sex_applicant"];$details_of_site=$results["details_of_site"];$trade_license_no=$results["trade_license_no"];$sales_tax_reg_no=$results["sales_tax_reg_no"];$details_of_license=$results["details_of_license"];
					
				if(!empty($results["present_address"])){
					$present_address=json_decode($results["present_address"]);
					$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vill;$present_address_dist=$present_address->dist;$present_address_pin=$present_address->pin;$present_address_mobile_no=$present_address->mobile_no;$present_address_email=$present_address->email;
				}else{				
					$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pin="";$present_address_mobile_no="";$present_address_email="";
				}
				 
			}else{
				$form_id="";
				$name_father="";$applicant_age="";$sex_applicant="";$details_of_site="";$trade_license_no="";$sales_tax_reg_no="";
				$details_of_license="";
				$present_address_sn1=$street_name1;$present_address_sn2=$street_name2;$present_address_vil=$vill;$present_address_dist=$dist;$present_address_pin=$pincode;$present_address_mobile_no=$mobile_no;$present_address_email=$email;
			}
		}else{	
            $results=$q->fetch_array();			
			$form_id=$results["form_id"];
			$name_father=$results["name_father"];$applicant_age=$results["applicant_age"];$sex_applicant=$results["sex_applicant"];$details_of_site=$results["details_of_site"];$trade_license_no=$results["trade_license_no"];$sales_tax_reg_no=$results["sales_tax_reg_no"];$details_of_license=$results["details_of_license"];
				
			if(!empty($results["present_address"])){
				$present_address=json_decode($results["present_address"]);
				$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vill;$present_address_dist=$present_address->dist;$present_address_pin=$present_address->pin;$present_address_mobile_no=$present_address->mobile_no;$present_address_email=$present_address->email;
			}else{				
				$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pin="";$present_address_mobile_no="";$present_address_email="";
			}
    	
        }
	
?>

<?php require_once "../../requires/header.php";   ?>
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
				<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
					<table id="" class="table table-responsive">
						<tr>
							<td width="25%">1. Name of Applicant :</td>
							<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
							<td width="25%">2. Name of Father/Husband :</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" name="name_father" value="<?php echo $name_father; ?>"></td>
						</tr>
						<tr>
							<td colspan="4">3. Address of the person applying :</td>
						</tr>
						<tr>
							<td colspan="4"> Present address :</td>
						</tr>
						
						<tr>
							<td>Street Name1 :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[sn1]"  value="<?php echo $present_address_sn1; ?>"></td>
							<td>Street Name2 :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[sn2]"  value="<?php echo $present_address_sn2; ?>" ></td>
						</tr>
						<tr>
							<td>Village/Town :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[vill]"   value="<?php echo $present_address_vil; ?>"></td>
							<td>District :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[dist]"  value="<?php echo $present_address_dist; ?>"></td>
						</tr>
						<tr>
							<td>Pin Code :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[pin]" value="<?php echo $present_address_pin; ?>" maxlength="6"></td>
							<td>Mobile No :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[mobile_no]" maxlength="10" value="<?php echo $present_address_mobile_no; ?>"></td>
						</tr>
						<tr>
							<td>Email-id. :</td>
							<td><input type="email" class="form-control " name="present_address[email]"  value="<?php echo $present_address_email; ?>"></td>
							
						</tr>
						<tr>
							<td colspan="4">Permanent address :</td>
						</tr>
						<tr>
							<td width="25%">Street Name 1</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
							<td width="25%">Street Name 2</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
							<td>District</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
							<td>Mobile No.</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
						</tr>
						<tr>
						    <td>Email-id.</td>
							<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
						</tr>
						
						<tr>
							<td>4. Age of the applicant :</td>
							<td><input type="text" value="<?php echo $applicant_age; ?>" class="form-control text-uppercase"  name="applicant_age"></td>
							<td >5. Sex of Applicant :</td>
							<td ><input type="text" class="form-control text-uppercase" name="sex_applicant" value="<?php echo $sex_applicant; ?>"></td>
						</tr>
						<tr>
							<td>6. Details of site in which the premise is to be opened :</td>
							<td><textarea name="details_of_site" class="form-control text-uppercase"><?php echo $details_of_site; ?></textarea></td>
							<td>7. Trade license No. :</td>
							<td><input type="text" class="form-control text-uppercase" name="trade_license_no"  value="<?php echo $trade_license_no;?>"/></td>
						</tr>
						<tr>
							<td>8. Sales Tax registration No./VAT registration No. :</td>
							<td><input type="text" class="form-control text-uppercase" name="sales_tax_reg_no" value="<?php echo $sales_tax_reg_no;?>"/></td>
							<td>9. Details of any other license granted by authorities other than department of :</td>
							<td><textarea name="details_of_license" class="form-control text-uppercase"><?php echo $details_of_license; ?></textarea></td>
						</tr>
						
					  
						
					<tr>
						<td colspan="4"><b>Declaration</b><span class="mandatory_field">*</span><br/></td>
					</tr>
					<tr class="form-inline">
						<td colspan="4">&nbsp;&nbsp;I/We here by declare that the particulars furnished above are true and correct to me/our belief/knowledge. I/We further accept that if any particular furnished in the application is subsiquently found to be false,inaccurate or imcomplete,the license,if any granted to me/as on the basis of application will be liable for inatant cancellation without prejudice to other action may be taken against me/us under the law. </td>
					</tr>
					<tr>
						<td>Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b> 
						<td></td><td></td>
						<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>	
					</tr>
						<tr>
							<td class="text-center" colspan="4">
								<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save and Next</button>
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

	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });

	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>

</script>
