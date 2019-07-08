<?php require_once "../../requires/login_session.php";  ?>
<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
	<thead>
		<tr>
			<th width="20%">Sl No.</th>
			<th width="20%">Transit ID</th>
			<th width="20%">Species</th>
			<th width="20%">Date</th>
			<th width="20%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$ref_uain=$_POST['ref_uain'];
			
			$prev_tp_results=$forest->query("SELECT t1.*, t2.* FROM transit_pass_transported_trees t1 INNER JOIN transit_pass t2 on t1.transit_id = t2.id WHERE ref_uain='$ref_uain' AND t1.transit_id=t2.id GROUP BY t1.transit_id");
			$sl=1;
			while($row_1=$prev_tp_results->fetch_array()){
				
				$transit_id = $row_1['transit_id'];
				
				$species_results=$forest->query("SELECT species FROM transit_pass_transported_trees a, forest_form2_t1 b WHERE a.species_id=b.id AND a.transit_id='$transit_id'");
				$species="";
				while($species_results_rows=$species_results->fetch_object()){
					$species=$species . ", " .$species_results_rows->species;
				}
				
			
		?>
		<tr>
			<td><?=$sl;?></td>
			<td><?=strtoupper($row_1['transit_id']);?></td>
			<td><?=strtoupper(trim($species,","));?></td>
			<td><?=strtoupper($row_1['sub_date']);?></td>
			<td><a href="transit_pass_print.php?transit_id=<?=$row_1['transit_id']?>" class="btn btn-warning">VIEW</a></td>
		</tr>		
		<?php $sl++; } ?>
	</tbody>
</table>