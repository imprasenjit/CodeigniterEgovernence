<tbody>
	<tr class="text-bold"><td width="25%">Department Name</td><td width="25%"><?php echo $dept_name; ?></td><td width="25%">Office Name</td><td width="25%"><?php echo $office_name; ?></td></tr>
	<tr class="text-bold">
		<td>Designation</td>
		<td><?php echo $udesig_name; ?></td>
		<td>Date</td>
		<td><?php echo date("d-m-Y H:i:s");?></td>			
	</tr>	
	<tr>
		<td class="text-center" colspan="4"><input type="submit" class="btn btn-success text-bold" name="issue" value="Submit"/></td>
	</tr>
</tbody>