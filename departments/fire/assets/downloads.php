<?php $form_names=$cms->query("select * from fire_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="downloads">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form1.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form3.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php }
				if($rows->form_no==4){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form4.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==5){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form5.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==6){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form6.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php }
				if($rows->form_no==7){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form7.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==8){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form8.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==9){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form9.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php }
				if($rows->form_no==10){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form10.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==11){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form11.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==12){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form12.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==13){ ?>
				<td><a href="<?php echo $server_url?>dept_documents/fire/forms/form13.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>