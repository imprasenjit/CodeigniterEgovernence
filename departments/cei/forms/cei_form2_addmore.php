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
<script >	/*---------FOR TABLE-1------------*/
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
		t2.size="15";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index;				
		t3.name = "txtC"+index;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtD"+index;				
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		t4.validate="onlyNumners";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="txtE"+index;
		t5.name="txtE"+index;
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
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
	/*---------FOR TABLE-1------------*/
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
		t1.id = "txxtA"+index2;
		t1.name = "txxtA"+index2;
		t1.className = "form-control text-uppercase";
		t1.size="1";
		t1.readOnly=true;
		t1.type="text";
		t1.value=index2;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txxtB"+index2;				
		t2.name = "txxtB"+index2;
		t2.className = "form-control text-uppercase";
		t2.size="15";
		t2.type="text";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txxtC"+index2;				
		t3.name = "txxtC"+index2;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		t3.type="text";
		cell3.appendChild(t3);	
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index2;				
		t4.name = "txxtD"+index2;
		t4.className = "dob form-control text-uppercase";
		t4.size="15";
		t4.type="text";
		t4.validate="onlyNumners";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="txxtE"+index2;
		t5.name="txxtE"+index2;
		t5.type="text";
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6 = document.createElement("input");
		t6.id="txxtF"+index2;
		t6.name="txxtF"+index2;
		t6.type="text";
		t6.className = "dob form-control text-uppercase";
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7 = document.createElement("input");
		t7.id="txxtG"+index2;
		t7.name="txxtG"+index2;
		t7.type="text";
		t7.className = "dob form-control text-uppercase";
		cell7.appendChild(t7);
		var cell8=row.insertCell(7);
		var t8 = document.createElement("input");
		t8.id="txxtH"+index2;
		t8.name="txxtH"+index2;
		t8.type="text";
		t8.className = "form-control text-uppercase";
		cell8.appendChild(t8);
		
		index2++;
		document.getElementById("hiddenval2").value=index2;
		$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction2(){
	if(index2>2){	
		var myobj=document.getElementById("objectTable2");
		myobj.deleteRow(-1);
		index2--;
		document.getElementById("hiddenval2").value=index2;
		}
	}
	/*---------FOR TABLE-2------------*/
</script>
<?php
if(isset($form_id)){
	$part3=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t3 WHERE form_id='$form_id'");
	$num3 = $part3->num_rows;
}else{
	$num3=0;
}
if($num3>0){
	$hiddenval3=$num3+1;
	$num3=$num3+1;
}else{
	$hiddenval3=2;
	$num3=2;
}

?>

<script>	/*---------FOR TABLE-3------------*/
	var index3=<?php echo $num3; ?>;
	function addMorefunction3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txttA"+index3;
		t1.name = "txttA"+index3;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txttB"+index3;
		t2.name = "txttB"+index3;
		t2.className = "form-control text-uppercase";
		t2.size="20";			
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);			
		var t3 = document.createElement("input");
		t3.id= "txttC"+index3;
		t3.name= "txttC"+index3;
		t3.className = "form-control text-uppercase";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txttD"+index3;				
		t4.name = "txttD"+index3;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		t4.validate="onlyNumners";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);		
		var t5 = document.createElement("input");
		t5.id="txttE"+index3;
		t5.name="txttE"+index3;
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6 = document.createElement("input");
		t6.id="txttF"+index3;
		t6.name="txttF"+index3;
		t6.className = "form-control text-uppercase";
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7 = document.createElement("input");
		t7.id="txttG"+index3;
		t7.name="txttG"+index3;
		t7.className = "form-control text-uppercase";
		cell7.appendChild(t7);
		index3++;
		document.getElementById("hiddenval3").value=index3;
	}
	function mydelfunction3(){
	if(index3>2){	
		var myobj=document.getElementById("objectTable3");
		myobj.deleteRow(-1);
		index3--;
		document.getElementById("hiddenval3").value=index3;
		}
	}
	/*---------FOR TABLE-3------------*/

</script>