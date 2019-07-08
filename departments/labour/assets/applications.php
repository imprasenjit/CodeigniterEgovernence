<?php $form_names=$cms->query("select * from labour_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="loapplications">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_1.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>&nbsp;
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_3.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==4){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_4.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==5){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_5.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==6){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_6.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==7){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_7.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==8){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_8.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==9){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_9.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==10){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_10.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
				<?php if($rows->form_no==11){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=labour" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url;?>dept_documents/labour/forms/Form_11.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>