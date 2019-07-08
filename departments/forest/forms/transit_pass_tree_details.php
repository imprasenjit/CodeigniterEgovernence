<?php require_once "../../requires/login_session.php";  ?>
<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
	<thead>
		<tr>
			<th></th>
			<th>3. Kind of forest produce</th>
			<th>4. Number of pieces packages or bundles</th>
			<th>5. Measurement Cubic consents or weight</th>
			<th>6. Marks hammar or Other</th>
			<th>7. Rate</th>
			<th>8. Amount Paid</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$trees_availability=0;
		$ref_uain=$_POST["ref_uain"];
		$transit_pass_generated=0;
		$select_tree_query=$forest->query("select id from transit_pass where ref_uain='$ref_uain'") or die($forest->error);
		if($select_tree_query->num_rows>0){
			$transit_id=$select_tree_query->fetch_object()->id;
			$transit_pass_generated=1;
		}
		$sl=1;
		$species_results=$forest->query("select b.id,b.species from forest_form2 a, forest_form2_t1 b where b.form_id=a.form_id and a.uain='$ref_uain'") or die($forest->error);
		if($species_results->num_rows>0){ 
			while($species_row=$species_results->fetch_object()){ 
				$species_id=$species_row->id;
				$species=$species_row->species;
				
				$transit_pass_transported_trees_queries=$forest->query("select id from transit_pass_transported_trees where species_id='$species_id'");
				if($transit_pass_transported_trees_queries->num_rows>0){
					continue;
				}
				$trees_availability=1;
				?>
				<input type="hidden" name="input_size" value="<?php echo $sl; ?>">
				<tr>
					<td><input type="checkbox" value="1" name="checked_species<?php echo $sl; ?>"></td>
					<input type="hidden" name="species_id<?php echo $sl; ?>" value="<?php echo $species_id; ?>" readonly="readonly" class="form-control text-uppercase">
					<td><input type="text" value="<?php echo $species; ?>" readonly="readonly" class="form-control text-uppercase"></td>
					
					<?php 
					$species_details_results=$forest->query("select * from forest_form2_certificates_t1 where c_species_id='$species_id'");
					
					if($species_details_results->num_rows>0){
						
						$species_details_row=$species_details_results->fetch_object();
						$c_piece_no=$species_details_row->c_piece_no;
						$c_measurement=$species_details_row->c_measurement;
						?>
						<td><input type="text" name="piece_no<?php echo $sl; ?>" value="<?php echo $c_piece_no; ?>" class="form-control" readonly></td>
						<td><input type="text" name="measurement<?php echo $sl; ?>" value="<?php echo $c_measurement; ?>" class="form-control" readonly></td>
						<td><input type="text" name="hammer_mark<?php echo $sl; ?>" class="form-control"></td>
						<td><input type="text" name="rate<?php echo $sl; ?>" class="form-control"></td>
						<td><input type="text" name="amount_paid<?php echo $sl; ?>" class="form-control"></td>
							
					<?php }else{ ?>
						<td><input type="text" name="piece_no<?php echo $sl; ?>" value="" class="form-control"></td>
						<td><input type="text" name="measurement<?php echo $sl; ?>" value="" class="form-control"></td>
						<td><input type="text" name="hammer_mark<?php echo $sl; ?>" class="form-control"></td>
						<td><input type="text" name="rate<?php echo $sl; ?>" class="form-control"></td>
						<td><input type="text" name="amount_paid<?php echo $sl; ?>" class="form-control"></td>
					<?php } ?>
				</tr>
						
	<?php	$sl++;
			}
		}else{
			
		}
		if($trees_availability!=1){ ?>
				<tr class="danger"><td colspan="7">No trees are available to transport in this UAIN.</td></tr>
	<?php	}
		
		
	?>
	
		
	</tbody>
</table>