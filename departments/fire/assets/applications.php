<?php $form_names=$cms->query("select * from fire_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="loapplications">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form1.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form3.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php }
				if($rows->form_no==4){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form4.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==5){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form5.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==6){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form6.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php }
				if($rows->form_no==7){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form7.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==8){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form8.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==9){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form9.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php }
				if($rows->form_no==10){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form10.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==11){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form11.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==12){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form12.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==13){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=fire" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form13.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>