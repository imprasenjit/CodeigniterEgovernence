<?php

if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t1 WHERE form_id='$form_id'");
	$num1 = $part1->num_rows;
}else{
	$num1=0;
}
if($num1>0){
	$hiddenval1=$num1+1;
	$num1=$num1+1;
}else{
	$hiddenval1=2;
	$num1=2;
}
?>
<script>	/*---------FOR TABLE-1------------*/
	var index1=<?php echo $num1; ?>;
	function addMorefunction1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txtA"+index1;
		t1.name = "txtA"+index1;
		t1.className = "form-control text-uppercase";
		t1.type="text";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index1;
		cell1.appendChild(t1);
		
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txtB"+index1;				
		t2.name = "txtB"+index1;
		t2.className = "dob form-control text-uppercase";
		t2.type="text";
		t2.size="15";
		cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index1;				
		t3.name = "txtC"+index1;
		t3.className = "form-control text-uppercase";
		t3.type="text";
		t3.size="15";
		cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtD"+index1;				
		t4.name = "txtD"+index1;
		t4.className = "form-control text-uppercase";
		t4.type="text";
		t4.size="15";
		cell4.appendChild(t4);	
		
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="txtE"+index1;
		t5.name="txtE"+index1;
		t5.className = "form-control text-uppercase";
		t5.type="text";
		t5.size="15";
		cell5.appendChild(t5);
	
		
		index1++;
		document.getElementById("hiddenval1").value=index1;
		//$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction1(){
	if(index1>2){	
		var myobj=document.getElementById("objectTable1");
		myobj.deleteRow(-1);
		index1--;
		document.getElementById("hiddenval1").value=index1;
		}
	}
	/*---------FOR TABLE-1------------*/
</script>