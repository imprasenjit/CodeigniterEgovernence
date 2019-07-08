<?php $form_names=$cms->query("select * from pcb_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="loapplications">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){ 
			if($rows->form_apply!=1){
				
			}else{
				
			} 
			?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_apply!=1){ 
							$sample_form=$server_url."dept_documents/pcb/forms/pcb_form". $rows->form_no .".pdf";
						?>
						<td></td>
						<td><a href="<?php echo $sample_form; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
				<?php }else{ 
							$apply_online=$server_url."departments/requires/terms.php?form=" . $rows->form_no . "&dept=pcb";
							$sample_form=$server_url."departments/requires/blank_pdf.php?form=" . $rows->form_no . "&dept=pcb";
				?>
						<td><a href="<?php echo $apply_online; ?>" ><i class="fa fa-file" aria-hidden="true"></i>Apply</a></td>
						<td><a href="<?php echo $sample_form; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>