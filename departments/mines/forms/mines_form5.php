<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="5";
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
			$form_id=$results["form_id"];$brick_category=$results["brick_category"];$area_applied=$results["area_applied"];$status_land=$results["status_land"];$brick_quantity=$results["brick_quantity"];$advance_amount=$results["advance_amount"];$secu_rity=$results["secu_rity"];
			
			if(!empty($results["brick_location"])){
				$brick_location=json_decode($results["brick_location"]);
				$brick_location_a=$brick_location->a;$brick_location_b=$brick_location->b;$brick_location_d=$brick_location->d;
			}else{				
				$brick_location_a="";$brick_location_b="";$brick_location_d="";
			}				
			if(!empty($results["brick_earth"])){
				$brick_earth=json_decode($results["brick_earth"]);
				$brick_earth_a=$brick_earth->a;$brick_earth_b=$brick_earth->b;
			}else{				
				$brick_earth_a="";$brick_earth_b="";
			}
		}else{
			$form_id="";
			$brick_category=""; $area_applied="";$status_land="";
			$brick_quantity=""; $advance_amount=""; $secu_rity="";
			$brick_earth_a="";$brick_earth_b="";
			$brick_location_a="";$brick_location_b="";$brick_location_d="";
			
		}
	}else{	
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$brick_category=$results["brick_category"];$area_applied=$results["area_applied"];$status_land=$results["status_land"];$brick_quantity=$results["brick_quantity"];$advance_amount=$results["advance_amount"];$secu_rity=$results["secu_rity"];
		
		if(!empty($results["brick_location"])){
			$brick_location=json_decode($results["brick_location"]);
			$brick_location_a=$brick_location->a;$brick_location_b=$brick_location->b;$brick_location_d=$brick_location->d;
		}else{				
			$brick_location_a="";$brick_location_b="";$brick_location_d="";
		}				
		if(!empty($results["brick_earth"])){
			$brick_earth=json_decode($results["brick_earth"]);
			$brick_earth_a=$brick_earth->a;$brick_earth_b=$brick_earth->b;
		}else{				
			$brick_earth_a="";$brick_earth_b="";
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
									  <tr class="form-inline">
											<td colspan="4">Dear Sir,</br>Undersigned intends to install a brick Kiln or is the owner of &nbsp;<?php echo $unit_name;?>&nbsp;,&nbsp;&nbsp;<?php echo $unit_details;?> &nbsp;&nbsp;&nbsp; and for manufacturing of the bricks requires the minor mineral namely "Brick Earth".</td>
										</tr>
									    <tr>
											<td colspan="4">1. The Details of the area for which permission is being sought, is given as under:- </td>
										</tr>
										<tr>
											<td colspan="4">a)Location of Brick Kiln :</td>
										</tr>
										<tr>
										    <td width="25%">Village :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="brick_location[a]" value="<?php echo  $brick_location_a; ?>"></td>
											<td>Sub-division :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="brick_location[b]" value="<?php echo  $brick_location_b; ?>"></td>
										</tr>
										<tr>
											<td width="25%">District :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="brick_location[d]" value="<?php echo  $brick_location_d; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
										   <td width="25%">b) Category of the Brick Kiln :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="brick_category" value="<?php echo  $brick_category; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">c) Extent of the land from which brick earth is to be excavated :</td>
										</tr>
										<tr>
										    <td width="25%">Dag No. :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="brick_earth[a]" value="<?php echo  $brick_earth_a; ?>"></td>
											<td>Patta no :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="brick_earth[b]" value="<?php echo  $brick_earth_b; ?>"></td>
										</tr>
				
										<tr>
											<td>d) Lay out plan of the area applied for permit :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="area_applied" value="<?php echo  $area_applied; ?>"></td>
											<td>e) Existing status of the land as compared to general ground level of the area :</td>
											<td><input type="text" class="form-control text-uppercase" name="status_land" value="<?php echo  $status_land; ?>"></td>
										</tr>
										<tr>
											<td>f) Quantity of brick kiln required to be removed :</td>
											<td><input type="text" class="form-control text-uppercase" name="brick_quantity" value="<?php echo $brick_quantity; ?>"></td>
										    <td>g) Advance amount of permit fee/royalty :</td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="advance_amount" value="<?php echo $advance_amount; ?>"></td>
										</tr>
										<tr>
											<td>h) Security (refundable) :</td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="secu_rity"  value="<?php echo  $secu_rity; ?>"></td>
										</tr>
										<tr>
											<td  colspan="4">2. Applicant further submits that :</td>
										</tr>
										<tr>
											<td  colspan="4">i) Royalty at the rates prescribed under First Schedule to the Assam Minor Mineral Concession Rules, 2012 shall be paid for the brick earth to be removed from the area under permit.</td>
										</tr>
									    <tr>
											<td  colspan="4">ii)Area is free from Plantation or is not forest land.</td>
										</tr>
										<tr>
											<td  colspan="4">iii)Digging of the earth at the site is otherwise not prohibited by any court of law or any authority. </td>
										</tr>
										<tr>
											<td  colspan="4">iv) Brick earth will be used only for manufacturing of bricks.</td>
										</tr>
										<tr>
											<td  colspan="4">v) He will abide by all relevant provision for excavation of earth.</td>
										</tr>
										<tr>
										    <td colspan="4">vi)A compensation has been settled with land owner mutually and a copy of the agreement signed between the applicant and the land owner qua mutual settlement of the compensation attached (in case land is owned by the applicant himself , the proof thereof ). </td>
										</tr>
										<tr>
											<td  colspan="4">vii) In case of renewal of permit copy of last permit, along with proof of payment towards applicable permit money or royalty.</td>
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