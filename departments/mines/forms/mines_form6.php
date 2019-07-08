<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="6";
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
			$land_measure=$results["land_measure"];$details_of_dag=$results["details_of_dag"];$area_location=$results["area_location"];$purpose=$results["purpose"];$total_area=$results["total_area"];$extent_area_l=$results["extent_area_l"];$extent_area_b=$results["extent_area_b"];$extent_area_d=$results["extent_area_d"];$qty_of_clay_removed=$results["qty_of_clay_removed"];$qty_of_clay_disposed=$results["qty_of_clay_disposed"];$existing_status=$results["existing_status"];$advance_royalty=$results["advance_royalty"];
		}else{
			$form_id="";
			$land_measure="";$details_of_dag="";$area_location="";$purpose="";$total_area="";$extent_area_l="";$extent_area_b="";$extent_area_d="";$qty_of_clay_removed="";$qty_of_clay_disposed="";$existing_status="";$advance_royalty="";
		}
	}else{
			$results=$q->fetch_array();
			$form_id=$results["form_id"];
			$land_measure=$results["land_measure"];$details_of_dag=$results["details_of_dag"];$area_location=$results["area_location"];$purpose=$results["purpose"];$total_area=$results["total_area"];$extent_area_l=$results["extent_area_l"];$extent_area_b=$results["extent_area_b"];$extent_area_d=$results["extent_area_d"];$qty_of_clay_removed=$results["qty_of_clay_removed"];$qty_of_clay_disposed=$results["qty_of_clay_disposed"];$existing_status=$results["existing_status"];$advance_royalty=$results["advance_royalty"];
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">Dear Sir,</td>
										</tr>
										<tr>
											<td colspan="4" class="form-inline">&emsp;The applicant is the owner of the land or is having the written consent of the land owner of the land measuring <input type="text" name="land_measure" class="form-control text-uppercase" value="<?php echo $land_measure; ?>"> .bigha/ha <input type="text" name="details_of_dag" class="form-control text-uppercase" value="<?php echo $details_of_dag; ?>"> (details of Dag, Patta numbers)in village <input type="text" class="form-control text-uppercase" value="<?php echo $vill; ?>" disabled> .Sub-division <input type="text" class="form-control text-uppercase" value="<?php echo $subdivision; ?>" disabled> .District <input type="text" class="form-control text-uppercase" value="<?php echo $dist; ?>" disabled> and have to remove the ordinary clay/earth for leveling the land or selling the same for commercial purpose. As a result of leveling of land or excavation, Ordinary Clay / earth excavated is to be disposed off, for which permission is solicited. </td>
											
										</tr>
										<tr>
											<td colspan="4">1. The details of the area for which permission is being sought, is given as under :</td>
										</tr>
										<tr>
											<td width="25%">(a) Location of the area :</td>
											<td><textarea class="form-control text-uppercase" name="area_location" ><?php echo $area_location; ?></textarea></td>
											<td width="25%">(b) Purpose :</td>
											<td><textarea class="form-control text-uppercase" name="purpose" ><?php echo $purpose; ?></textarea></td>
										</tr>
										<tr>
											<td>(c) Total area to be excavated/leveled :</td>
											<td><input type="text" name="total_area" class="form-control text-uppercase" value="<?php echo $total_area; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">(d) Extent of the area[Length, Breadth and Depth(in metres)] :</td>
										</tr>
										<tr>
											<td>Length :</td>
											<td><input type="text" name="extent_area_l" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $extent_area_l; ?>"></td>
											<td>Breadth :</td>
											<td><input type="text" name="extent_area_b" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $extent_area_b; ?>"></td>
										</tr>
										<tr>
											<td>Depth :</td>
											<td><input type="text" name="extent_area_d" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $extent_area_d; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td colspan="4">(e) Quantity of the ordinary clay to be removed and disposed off :</td>
										</tr>
										<tr>
										    <td>To be removed :</td>
											<td><input type="text" class="form-control text-uppercase" name="qty_of_clay_removed" value="<?php echo $qty_of_clay_removed; ?>"></td>
											<td>To be Disposed off :</td>
											<td><input type="text" class="form-control text-uppercase" name="qty_of_clay_disposed" value="<?php echo $qty_of_clay_disposed; ?>"></td>
										</tr>
										
										
										<tr>
											<td>(f) Existing status of the land as compared to the general ground level of the area :</td>
											<td><input type="text" class="form-control text-uppercase" name="existing_status" value="<?php echo $existing_status; ?>"></td>
											<td>(g) Advance royalty :</td>
											<td><input type="text" class="form-control text-uppercase" name="advance_royalty" value="<?php echo $advance_royalty; ?>"></td>
										</tr>
										<tr>
											<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
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