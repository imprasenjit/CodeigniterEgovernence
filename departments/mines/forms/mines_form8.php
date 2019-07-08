<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="8";
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
			$form_id=$results["form_id"];
			$land_measure=$results["land_measure"];$details_of_dag=$results["details_of_dag"];$revenue_estate=$results["revenue_estate"];$permission_from=$results["permission_from"];$permission_to=$results["permission_to"];$permission_year=$results["permission_year"];
		}else{	
			$form_id="";
			$land_measure="";$details_of_dag="";$revenue_estate="";$permission_from="";$permission_to="";$permission_year="";
		}
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];
			$land_measure=$results["land_measure"];$details_of_dag=$results["details_of_dag"];$revenue_estate=$results["revenue_estate"];$permission_from=$results["permission_from"];$permission_to=$results["permission_to"];$permission_year=$results["permission_year"];
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
											<td colspan="4">Dear Sir,</td>
										</tr>
										<tr>
											<td colspan="4" class="form-inline">&emsp;Whereas Shri/Messers <input type="text" class="form-control text-uppercase" value="<?php echo $key_person; ?>" disabled> Owner (s) of Brick Kiln falling in category <input type="text" class="form-control text-uppercase" value="<?php echo $owner_names; ?>" disabled> has/has applied for quarrying permit for removal of the "Brick Earth" , for a period of two years from the land measuring <input type="text" name="land_measure" class="form-control text-uppercase" value="<?php echo $land_measure; ?>"> bigha/acres/hectares bearing Dag, Patta numbers <input type="text" name="details_of_dag" class="form-control text-uppercase" value="<?php echo $details_of_dag; ?>"> in the revenue estate of <input type="text" class="form-control text-uppercase" name="revenue_estate" value="<?php echo $revenue_estate; ?>"> Sub-division <input type="text" class="form-control text-uppercase" value="<?php echo $subdivision; ?>" disabled> , <input type="text" class="form-control text-uppercase" value="<?php echo $dist; ?>" disabled> District 2012. </td>
											
										</tr>
										<tr>
											<td colspan="4" class="form-inline">&emsp;The permission is hereby granted for removal of brick earth and manufacture of bricks from the aforesaid area during the period from <input type="text" class="dobindia form-control text-uppercase" name="permission_from" value="<?php if($permission_from!="0000-00-00" && $permission_from!="") echo date("d-m-Y",strtotime($permission_from)); else echo "";?>" placeholder="DD-MM-YYYY" > . to <input type="text" class="dobindia form-control text-uppercase" name="permission_to"  value="<?php if($permission_to!="0000-00-00" && $permission_to!="") echo date("d-m-Y",strtotime($permission_to)); else echo "";?>" placeholder="DD-MM-YYYY" > ( upto 31 st March, <input type="text" name="permission_year" class="form-control text-uppercase" value="<?php echo $permission_year; ?>" maxlength="4" validate="onlyNumbers">.) subject to the conditions given below :-</td>
											
										</tr>
										<tr>
											<td colspan="4">1. The holder of the permits shall keep the Government indemnified from third party claim relating to the extraction of brick earth from the land for which quarrying permit is given.</td>
										</tr>
										<tr>
											<td colspan="4">2. The holder of the permit shall excavate the brick earth in such a manner that the same shall not disturb or damage any road, public ways, buildings, premises of public grounds.</td>
										</tr>
										<tr>
											<td colspan="4">3. The holder of the permit shall not use the brick earth excavated from the land granted on permit for any other purpose than that of manufacturing of bricks. In case the brick earth is to be transported up to brick kiln from the site of excavation, the permit holder transports the same only by issuing a mineral Transit Pass.</td>
										</tr>
										<tr>
											<td colspan="4">4. That the holder of the permit shall not fell any tree standing on the land without obtaining prior permission in writing from the competent authority in the forest department. In Case Such Permission has been granted, he shall abide by the terms and conditions stipulated in such permission.</td>
										</tr>
										<tr>
											<td colspan="4">5. The permit holder shall not carry on surface operations in any area prohibited by any authority, without obtaining prior permission in writing from the concerned authority.</td>
										</tr>
										<tr>
											<td colspan="4">6. The permit holder shall not enter and work in any forest without obtaining prior written permission of the Forest Department.</td>
										</tr>
										<tr>
											<td colspan="4">7. The permit holder shall report immediately all accidents to the deputy commissioner and the competent authority concerned.</td>
										</tr>
										<tr>
											<td colspan="4">8. The depth of the pit below surface shall not exceed nine feet.</td>
										</tr>
										<tr>
											<td colspan="4">9. The annual amount of royalty shall be paid in advance by 1 st april of every year.</td>
										</tr>
										<tr>
											<td colspan="4"><strong>In Case the annual royalty is not paid on the date specified above , the permit holder shall be liable to pay interest as the following :</strong></td>
										</tr>
									<tr>
										<td colspan="4">
										
										<table class="table table-responsive table-bordered">
											<tr>
												<th width="10%">Sl no.</th>
												<th width="40%">Periods of delay</th>
												<th width="50%">Rate of Interest applicable</th>
												
											</tr>
											<tr>
												<td>1.</td>
												<td>If paid within a period of 7 days from the due date</td>
												<td>A grace period of up to 7 days is allowed without any interest;</td>
											
											</tr>
											<tr>
												<td>2.</td>
												<td>If paid after 7 days but up to 30 days of the due date</td>
												<td>15% on the amount of default for the period of default including the grace period;</td>
											</tr>
											<tr>
												<td>3.</td>
												<td>If paid after 30 days but within 60 days of due date</td>
												<td>18% on the amount of default for the period of default including the grace period</td>
											</tr>
											<tr>
												<td>4.</td>
												<td>Delay 60 days of the due date</td>
												<td>Termination of the permit and the entire outstanding amount would be recoverable along with interest calculated @21% for the entire period of default</td>
											</tr>
										
										</table></td>
									</tr>
										
										<tr>
											<td colspan="4">10. The brick Kiln Owner shall be liable to make payment of Lump-Sum royalty for the whole of the year notwithstanding the operation of the Kiln for any part of the year.</td>
										</tr>
										<tr>
											<td colspan="4">11. In case of any default in due observance of the terms and conditions of this permit or in payment of the installment on due date, the permit may be cancelled by the competent authority by giving one month's notice. Any sum due from the permit holder on account of royalty and interest thereon shall be recovered from him/ them as an arrear of land Revenue.</td>
										</tr>
										<tr>
											<td colspan="2">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
											Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>
											Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
										</tr>
																						
										<tr>									
											<td class="text-center" colspan="4">
												<button type="submit" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save and Next</button>
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