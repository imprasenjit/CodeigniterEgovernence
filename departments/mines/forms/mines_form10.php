<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="10";
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
		$form_id=$results["form_id"];$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];
		$firstshri=$results["firstshri"];$son_shri=$results["son_shri"];$resi_dent=$results["resi_dent"];$dist_rict=$results["dist_rict"];$adminis_trators=$results["adminis_trators"];$second_part=$results["second_part"];$resident_of=$results["resident_of"];$dist_second=$results["dist_second"];$permit_h=$results["permit_h"];$hol_words=$results["hol_words"];$cubic_metre=$results["cubic_metre"];
		$divi_sion=$results["divi_sion"];$district_second=$results["district_second"];$holder_rs=$results["holder_rs"];$hold_rupees=$results["hold_rupees"];
		$instal_lment=$results["instal_lment"];$installment_rs=$results["installment_rs"];$install_rupees=$results["install_rupees"];
		  
		if(!empty($results["permit_holder"])){
			$permit_holder=json_decode($results["permit_holder"]);
			$permit_holder_a=$permit_holder->a;$permit_holder_b=$permit_holder->b;$permit_holder_c=$permit_holder->c;$permit_holder_d=$permit_holder->d;
		}else{				
			$permit_holder_a="";$permit_holder_b="";$permit_holder_c="";$permit_holder_d="";
		}				
		if(!empty($results["suretyaddres"])){
			$suretyaddres=json_decode($results["suretyaddres"]);
			$suretyaddres_a=$suretyaddres->a;$suretyaddres_b=$suretyaddres->b;$suretyaddres_c=$suretyaddres->c;$suretyaddres_d=$suretyaddres->d;
		}else{				
			$suretyaddres_a="";$suretyaddres_b="";$suretyaddres_c="";$suretyaddres_d="";
		}
	}else{	
		$form_id="";$indenture_dt="";$acting_through=""; 
		$firstshri="";$son_shri="";
		$resi_dent="";$dist_rict=""; $adminis_trators=""; $second_part="";$resident_of=""; $dist_second="";$permit_h="";$hol_words="";$cubic_metre="";$divi_sion="";$district_second="";
		$holder_rs=""; $hold_rupees="";
		$instal_lment="";$installment_rs="";  $install_rupees="";
		$permit_holder_a="";$permit_holder_b="";$permit_holder_c="";$permit_holder_d="";
		$suretyaddres_a="";$suretyaddres_b="";$suretyaddres_c="";$suretyaddres_d="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];
	$firstshri=$results["firstshri"];$son_shri=$results["son_shri"];$resi_dent=$results["resi_dent"];$dist_rict=$results["dist_rict"];$adminis_trators=$results["adminis_trators"];$second_part=$results["second_part"];$resident_of=$results["resident_of"];$dist_second=$results["dist_second"];$permit_h=$results["permit_h"];$hol_words=$results["hol_words"];$cubic_metre=$results["cubic_metre"];
	$divi_sion=$results["divi_sion"];$district_second=$results["district_second"];$holder_rs=$results["holder_rs"];$hold_rupees=$results["hold_rupees"];
	$instal_lment=$results["instal_lment"];$installment_rs=$results["installment_rs"];$install_rupees=$results["install_rupees"];
	  
	if(!empty($results["permit_holder"])){
		$permit_holder=json_decode($results["permit_holder"]);
		$permit_holder_a=$permit_holder->a;$permit_holder_b=$permit_holder->b;$permit_holder_c=$permit_holder->c;$permit_holder_d=$permit_holder->d;
	}else{				
		$permit_holder_a="";$permit_holder_b="";$permit_holder_c="";$permit_holder_d="";
	}				
	if(!empty($results["suretyaddres"])){
		$suretyaddres=json_decode($results["suretyaddres"]);
		$suretyaddres_a=$suretyaddres->a;$suretyaddres_b=$suretyaddres->b;$suretyaddres_c=$suretyaddres->c;$suretyaddres_d=$suretyaddres->d;
	}else{				
		$suretyaddres_a="";$suretyaddres_b="";$suretyaddres_c="";$suretyaddres_d="";
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
								    <strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4"> Name and address of the Permit Holder.</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" name="permit_holder[a]" validate="letters" value="<?php echo $permit_holder_a;?>" ></td>
										<td width="25%">Address 1 :</td>
										<td><textarea class="form-control text-uppercase"  name="permit_holder[b]" ><?php echo $permit_holder_b; ?></textarea></td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" name="permit_holder[c]" validate="letters" value="<?php echo $permit_holder_c;?>" ></td>
										<td width="25%">Address 2 :</td>
										<td><textarea class="form-control text-uppercase" name="permit_holder[d]" ><?php echo $permit_holder_d; ?></textarea></td>
									</tr>
								   <tr>
										<td colspan="4"> Name and address of the Surety.</td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" validate="letters" name="suretyaddres[a]"  value="<?php echo $suretyaddres_a;?>" ></td>
										<td width="25%">Address 1 :</td>
										<td><textarea class="form-control text-uppercase" name="suretyaddres[b]" ><?php echo $suretyaddres_b; ?></textarea></td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" validate="letters" name="suretyaddres[c]"  value="<?php echo $suretyaddres_c;?>" ></td>
										<td width="25%">Address 2 :</td>
										<td><textarea class="form-control text-uppercase" name="suretyaddres[d]" ><?php echo $suretyaddres_d; ?></textarea></td>
									</tr>
									<tr class="form-inline">
										<td colspan="4">This indenture made on this day&nbsp;<input type="text" name="indenture_dt" class="dob form-control text-uppercase" value="<?php echo $indenture_dt; ?>">&nbsp;&nbsp;between the Governor of Assam acting through<input type="text" name="acting_through" class="form-control text-uppercase" value="<?php echo $acting_through; ?>">(hereinafter called the "Government" which expression shall where the context so admits be deemed to include his successors in office and assigns of the first part, and Shri <input type="text" name="firstshri" class="form-control text-uppercase" value="<?php echo $firstshri; ?>">son of shri <input type="text" name="son_shri" class="form-control text-uppercase" value="<?php echo $son_shri; ?>">resident of<input type="text" name="resi_dent" class="form-control text-uppercase" value="<?php echo $resi_dent; ?>">District<input type="text" name="dist_rict" class="form-control text-uppercase" value="<?php echo $dist_rict; ?>">(hereinafter referred to as "Permit Holder" which expression shall, where the context so admits include his heirs, executors, administrators, representatives and permitted assigns) of the second part and Shri <input type="text" name="adminis_trators" class="form-control text-uppercase" value="<?php echo $adminis_trators; ?>">son of shri<input type="text" name="second_part" class="form-control text-uppercase" value="<?php echo $second_part; ?>">resident of<input type="text" name="resident_of" class="form-control text-uppercase" value="<?php echo $resident_of; ?>">District<input type="text" name="dist_second" class="form-control text-uppercase" value="<?php echo $dist_second; ?>">( herein afterreferred to as " the surety ", which expression shall , where the context so admits , include his heirs ,executors, administrators , representatives and permitted assigns) of the third part;</td>
									</tr>
									<tr class="form-inline">
										<td colspan="4">And whereas the permit holder has offered the highest bid for the permit of<input type="text" name="permit_h" class="form-control text-uppercase" value="<?php echo $permit_h; ?>"> cu.m ( in words<input type="text" name="hol_words" class="form-control text-uppercase" value="<?php echo $hol_words; ?>"> cubic metre<input type="text" name="cubic_metre" class="form-control text-uppercase" value="<?php echo $cubic_metre; ?>">(name of the quarry ) (hereinafter referred to as the "said lands") in Sub-divisions<input type="text" name="divi_sion" class="form-control text-uppercase" value="<?php echo $divi_sion; ?>">district<input type="text" name="district_second" class="form-control text-uppercase" value="<?php echo $district_second; ?>">and whereas the permit holder has paid Rs<input type="text" name="holder_rs" class="form-control text-uppercase" value="<?php echo $holder_rs; ?>">(Rupees<input type="text" name="hold_rupees" class="form-control text-uppercase" value="<?php echo $hold_rupees; ?>">) only first installment/ permit money in full for the first year<input type="text" name="instal_lment" class="form-control text-uppercase" value="<?php echo $instal_lment; ?>"> and Rs <input type="text" name="installment_rs" class="form-control text-uppercase" value="<?php echo $installment_rs; ?>">(Rupees<input type="text" name="install_rupees" class="form-control text-uppercase" value="<?php echo $install_rupees; ?>">) only as security (equal to 25% of the Bid amount)for the due fulfillment of the terms and covenants hereinafter mentioned and the Government hasagreed to grant him the aforesaid permit.</td>
									</tr>								
									<tr>									
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save & Next</button>
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
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>