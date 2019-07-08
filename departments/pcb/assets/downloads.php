<?php $form_names=$cms->query("select * from pcb_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="downloads">
	<h2>Downloads</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
 				
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Air_and_Water/Schedule-I.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Air_and_Water/Schedule-I.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==4){ ?>
 				
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form1.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==5){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form2.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==6){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form3.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==7){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form4.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==8){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form5.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==9){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form6.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==10){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form7.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==11){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form8.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==12){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Battery/Form9.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==13){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/E_Waste/E-waste_FORM-1.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==14){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/E_Waste/E-waste_FORM-2.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==15){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/E_Waste/E-waste_FORM-3.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==16){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/E_Waste/E-waste_FORM-4.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==17){ ?>
				<td><a href="<?php echo $server_url;?>dept_documents/pcb/Plastic/Form I.pdf" target="_blank"><i class="fa fa-download"></i> Download</span></a>
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>