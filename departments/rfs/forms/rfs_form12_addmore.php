<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT id FROM rfs_form".$form."_members WHERE form_id='$form_id'");
	$num2 = $part2->num_rows;
}else{
	$num2=0;
}
if($num2>0){
	$hiddenval1=$num2+1;
	$num2=$num2+1;
}else{
	$hiddenval1=2;
	$num2=2;
}
?>
<script>	/*---------FOR TABLE-1------------*/
	var index2=<?php echo $num2; ?>;
	function addMorefunction1(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txxtA"+index2;
		t1.name = "txxtA"+index2;
		t1.className = "form-control text-uppercase";
		t1.type="text";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txxtB"+index2;				
		t2.name = "txxtB"+index2;
		t2.className = "form-control text-uppercase";
		t2.type="text";
		t2.size="15";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txxtC"+index2;				
		t3.name = "txxtC"+index2;
		t3.className = "form-control text-uppercase";
		t3.type="text";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index2;				
		t4.name = "txxtD"+index2;
		t4.className = "form-control text-uppercase";
		t4.type="text";
		t4.size="15";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="txxtE"+index2;
		t5.name="txxtE"+index2;
		t5.className = "form-control text-uppercase";
		t5.type="text";
		t5.size="15";
		cell5.appendChild(t5);
		
		index2++;
		document.getElementById("hiddenval1").value=index2;
		$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction1(){
	if(index2>2){	
		var myobj=document.getElementById("objectTable2");
		myobj.deleteRow(-1);
		index2--;
		document.getElementById("hiddenval1").value=index2;
		}
	}
	/*---------FOR TABLE-1------------*/
</script>