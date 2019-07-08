<?php $form_names=$cms->query("select * from sdc_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="loapplications">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=sdc" ><i class="fa fa-file" aria-hidden="true"></i>Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/sdc/forms/sdc_form1.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=sdc" ><i class="fa fa-file" aria-hidden="true"></i>Apply</a></td>
				<td><a href="<?php echo $server_url?>dept_documents/sdc/forms/sdc_form2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=sdc" ><i class="fa fa-file" aria-hidden="true"></i>Apply</a></td>
				<td><a href="<?php echo $server_url?>dept_documents/sdc/forms/sdc_form3.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>