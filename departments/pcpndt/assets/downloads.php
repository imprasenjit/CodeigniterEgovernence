<?php $form_names=$cms->query("select * from gmc_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="downloads">
	<h2>Downloads</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/gmc/forms/TradeLicenceAppForm.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/gmc/forms/health_license.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/gmc/forms/vetenery_license.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==4){ ?>
				<td><i class="fa fa-download" aria-hidden="true"></i>
					Not Available
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>