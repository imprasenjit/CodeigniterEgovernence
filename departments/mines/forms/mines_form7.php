 <?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="7";
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
			$form_id=$results["form_id"];$grant_excavation=$results["grant_excavation"];$tonnes_cubic=$results["tonnes_cubic"];$minor_mineral=$results["minor_mineral"];
			$disposal_mineral=$results["disposal_mineral"];$periodfrm_dt=$results["periodfrm_dt"];$periodto_dt=$results["periodto_dt"];
		}else{
			$form_id="";
			$grant_excavation=""; $tonnes_cubic="";$minor_mineral="";
			$disposal_mineral=""; $periodfrm_dt=""; $periodto_dt="";
		}
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];$grant_excavation=$results["grant_excavation"];$tonnes_cubic=$results["tonnes_cubic"];$minor_mineral=$results["minor_mineral"];
			$disposal_mineral=$results["disposal_mineral"];$periodfrm_dt=$results["periodfrm_dt"];$periodto_dt=$results["periodto_dt"];
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
											<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Whereas Sh. / Messers &nbsp;&nbsp;&nbsp;<input type="text" name="key_person" class="form-control text-uppercase" value="<?php echo $key_person; ?>">&nbsp;&nbsp;&nbsp;&nbsp;has applied for the grant of a permit under Rule 27 of the Assam Minor Mineral Concessision Rules , 2012, for excavation of&nbsp;&nbsp;<input type="text" name="grant_excavation" class="form-control text-uppercase" value="<?php echo $grant_excavation; ?>">&nbsp;tonnes/ cubic meter / quintals of&nbsp;&nbsp;<input type="text" name="tonnes_cubic" class="form-control text-uppercase" value="<?php echo $tonnes_cubic; ?>" >&nbsp;&nbsp; Ordinary Clay/earth, a minor minerals for excavation/removal from&nbsp;<textarea class="form-control text-uppercase" name="minor_mineral" ><?php echo $minor_mineral; ?></textarea>&nbsp;(details of area).</td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;The permission is hereby granted for disposal of the mineral &nbsp;<input type="text" name="disposal_mineral" class="form-control text-uppercase" value="<?php echo $disposal_mineral; ?>">&nbsp;(name of minor minerals) tones/ cubic meter /quintals excavated / removed from the aforesaid area for the period from&nbsp;<input type="text" name="periodfrm_dt" class="dob form-control text-uppercase" value="<?php echo $periodfrm_dt; ?>"> &nbsp;&nbsp;To&nbsp;<input type="text" name="periodto_dt" class="dob form-control text-uppercase" value="<?php echo $periodto_dt; ?>" >&nbsp;&nbsp;subject to following conditions :-</td>
										</tr>
										<tr>
										   <td colspan="4"></td>
										</tr>
										<tr>
											<td  colspan="4">1. The holder of the permits shall keep the Government indemnified from third party claim relating to the extraction of ordinary clay/earth from the Land for which quarrying permit is Given.</td>
										</tr>
									    <tr>
											<td  colspan="4">2. The holder of the permit shall excavate the ordinary clay/earth in such a manner that same shall not disturb or damage any Road, Public Ways , buildings, premises of public grounds.</td>
										</tr>
										<tr>
											<td  colspan="4">3. That the holder of the permit shall not fell any tree standing on the land without obtaining prior permission in writing from the competent authority in the Forest Department. In case such permission has been granted, he shall abide by the terms and conditions stipulated in suchpermission. </td>
										</tr>
										<tr>
											<td  colspan="4">4. The permit holder shall not carry on surface operations in any area prohibited by any authority,without obtaining prior permission in writing from the concerned authority.</td>
										</tr>
										<tr>
											<td  colspan="4">5. The permit holder shall not enter and work in any forest land without obtaining prior written permission of the Forest Department.</td>
										</tr>
										<tr>
										    <td colspan="4">6. The permit holder shall report immediately all accidents to the Deputy Commissioner and the competent authority concerned.</td>
										</tr>
										<tr>
											<td  colspan="4">7. The depth of the pith below surface shall not exceed nine feet and in case where sand deposits are found, the depth of the pit below surface shall not exceed three feet.</td>
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