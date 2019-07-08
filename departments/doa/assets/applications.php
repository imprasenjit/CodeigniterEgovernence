<?php $form_names=$cms->query("select * from cei_form_names") or die("Error : ".$cms->error); ?>

<div role="tabpanel" class="tab-pane box box-primary" id="loapplications">
	<h2>Applications</h2>
	<table class="table table-bordered">
		<tbody>
		<?php while($rows=$form_names->fetch_object()){?>
			<tr>
				<td><?php echo $rows->form_no; ?></td>
				<td><?php echo $rows->form_name; ?></td>
				<?php if($rows->form_no==1){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url; ?>dept_documents/cei/forms/Form_1.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==2){ ?>
 				<td><a href="<?php echo $server_url; ?>departments/requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==3){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_3.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==4){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==5){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==6){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==7){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==8){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==9){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==10){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==11){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==12){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==13){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==14){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==15){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==16){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==17){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==18){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==19){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==20){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==21){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==22){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==23){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==24){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==25){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
				<?php if($rows->form_no==26){ ?>
 				<td><a href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei" ><i class="fa fa-file" aria-hidden="true"></i>
					Apply</a>
				</td>
				<td><a href="<?php echo $server_url?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>
					Download</a>
				</td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>