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
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
		
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txtB"+index;
		t2.name = "txtB"+index;
		t2.className = "form-control text-uppercase";
		t2.placeholder="Number";		
		cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index;				
		t3.name = "txtC"+index;
		t3.className = "form-control text-uppercase";
		t3.placeholder="Capacity in m3";		
		cell3.appendChild(t3);
		
		index++;
		document.getElementById("hiddenval").value=index;
	}
	
	function mydelfunction1(){
		if(index>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index--;
			document.getElementById("hiddenval").value=index;
		}
	} 		
</script>

<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t2 WHERE form_id='$form_id'");
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
<script>	/*---------FOR TABLE-2------------*/
	var index2=<?php echo $num2; ?>;
	function addMorefunction2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
		
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "textA"+index2;
		t1.name = "textA"+index2;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
		
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index2;
		t2.name = "textB"+index2;
		t2.className = "form-control text-uppercase";
		t2.placeholder="Waste transported";		
		cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "textC"+index2;				
		t3.name = "textC"+index2;
		t3.className = "form-control text-uppercase";
		t3.placeholder="Trips made";
		cell3.appendChild(t3);
		
		index2++;
		document.getElementById("hiddenval2").value=index2;
	}
	
	function mydelfunction2(){
	if(index2>2){	
		var myobj=document.getElementById("objectTable2");
		myobj.deleteRow(-1);
		index2--;
		document.getElementById("hiddenval2").value=index2;
		}
	}
</script>