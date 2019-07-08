<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t1 WHERE form_id='$form_id'");
	$num = $part1->num_rows;
}else{
	$num=0;
}
if($num>0){
	$hiddenval=$num+1;
	$num=$num+1;
}else{
	$hiddenval=2;
	$num=2;
}
?>
<script>	/*---------FOR TABLE-1------------*/
	var index=<?php echo $num; ?>;
	function addMorefunction1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txtA"+index;
		t1.name = "txtA"+index;
		t1.className = "form-control text-uppercase";
		t1.type="text";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txtB"+index;				
		t2.name = "txtB"+index;
		t2.className = "form-control text-uppercase";
		t2.type="text";
		t2.size="15";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index;				
		t3.name = "txtC"+index;
		t3.className = "dob form-control text-uppercase";
		t3.type="text";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtD"+index;				
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.type="text";
		t4.size="15";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="txtE"+index;
		t5.name="txtE"+index;
		t5.className = "form-control text-uppercase";
		t5.type="text";
		t5.size="15";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6 = document.createElement("input");
		t6.id="txtF"+index;
		t6.name="txtF"+index;
		t6.className = "form-control text-uppercase";
		t6.type="text";
		t6.size="15";
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7 = document.createElement("input");
		t7.id="txtG"+index;
		t7.name="txtG"+index;
		t7.className = "form-control text-uppercase";
		t7.type="text";
		t7.size="15";
		cell7.appendChild(t7);
		var cell8=row.insertCell(7);
		var t8 = document.createElement("input");
		t8.id="txtH"+index;
		t8.name="txtH"+index;
		t8.className = "form-control text-uppercase";
		t8.type="text";
		t8.size="15";
		t8.validate="onlyNumners";
		cell8.appendChild(t8);
		var cell9=row.insertCell(8);
		var t9 = document.createElement("input");
		t9.id="txtI"+index;
		t9.name="txtI"+index;
		t9.className = "form-control text-uppercase";
		t9.type="text";
		t9.size="15";
		t9.validate="onlyNumners";
		cell9.appendChild(t9);
		var cell10=row.insertCell(9);
		var t10 = document.createElement("input");
		t10.id="txtJ"+index;
		t10.name="txtJ"+index;
		t10.className = "form-control text-uppercase";
		t10.type="text";
		t10.size="15";
		t10.validate="onlyNumners";
		cell10.appendChild(t10);
		var cell11=row.insertCell(10);
		var t11 = document.createElement("input");
		t11.id="txtK"+index;
		t11.name="txtK"+index;
		t11.className = "form-control text-uppercase";
		t11.type="text";
		t11.size="15";
		t11.validate="onlyNumners";
		cell11.appendChild(t11);
		var cell12=row.insertCell(11);
		var t12 = document.createElement("input");
		t12.id="txtL"+index;
		t12.name="txtL"+index;
		t12.className = "form-control text-uppercase";
		t12.type="text";
		t12.size="15";
		cell12.appendChild(t12);
		
		index++;
		document.getElementById("hiddenval").value=index;
		$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction1(){
	if(index>2){	
		var myobj=document.getElementById("objectTable1");
		myobj.deleteRow(-1);
		index--;
		document.getElementById("hiddenval").value=index;
		}
	}
	/*---------FOR TABLE-1------------*/
</script>

<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT id FROM rfs_form".$form."_members WHERE form_id='$form_id'");
	$num2 = $part2->num_rows;
}else{
	$num2=0;
}
if($num2>0){
	$hiddenval2=$num2+1;
	$num2=$num2+1;
}else{
	$hiddenval2=2;
	$num2=2;
}
?>
<script>	/*---------FOR TABLE-1------------*/
	var index2=<?php echo $num2; ?>;
	function addMorefunction2(){
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
		document.getElementById("hiddenval2").value=index2;
		$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction2(){
	if(index2>2){	
		var myobj=document.getElementById("objectTable2");
		myobj.deleteRow(-1);
		index2--;
		document.getElementById("hiddenval2").value=index2;
		}
	}
	/*---------FOR TABLE-1------------*/
</script>
