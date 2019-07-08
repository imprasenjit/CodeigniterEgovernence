<?php $form_names=$cms->query("select * from boiler_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="loapplications">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=boiler" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/boiler/forms/Form_1.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=boiler" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/boiler/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
 				<td><!--<a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=boiler" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>-->&nbsp;
				</td>
				<td><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==4){ ?>
 				<td><a href="forms/boiler_license.php" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>