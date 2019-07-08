<tbody>
	<tr class="text-bold">
		<td width="25%">Department Name</td>
		<td width="25%"><?php echo $dept_name; ?></td>
		<td width="25%">Office Name</td>
		<td width="25%"><?php echo $office_name; ?></td>		
	</tr>
	<tr class="text-bold">
		<td>Designation</td>
		<td><?php echo $udesig_name; ?></td>
		<td>Date</td>
		<td><?php echo date("d-m-Y H:i:s");?></td>			
	</tr>					
	<tr>
		<td>Maximum Continuous Evaporation :</td>
		<td><div class="form-group">
			<input type="text" id="" name="max_evaporation" required="required" class="form-control"/>
		</div></td>
		<td colspan="2">Hydraulically Tested on : <input type="text" id="" required="required" name="tested_on" class=""/> to <input type="text" id="" name="ibs_no" required="required" class=""/> Ibs. per sq.inch</td>
	</tr>				
	<tr>
		<td>Remarks </td>
		<td><div class="form-group"><textarea name="remarks" class="form-control classy-editor" id="for_remerk" style="" placeholder="Your Remarks"></textarea></div></td>
		<td>Repairs :</td>
		<td>
			<div class="form-group">
				<input type="text" id="" name="repairs" class="form-control">
			</div>
		</td>
	</tr>
	<tr>
		<td class="text-center" colspan="4"><input type="submit" class="btn btn-success text-bold" name="issue" value="Submit"/></td>
	</tr>
</tbody>