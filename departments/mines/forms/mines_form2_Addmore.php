<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t1 WHERE form_id='$form_id'");
	$num = $part1->num_rows;
}else{
	$num=0;
}
if($num>0){
	$hiddenval1=$num+1;
	$num=$num+1;
}else{
	$hiddenval1=2;
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
		t1.id = "textA"+index;
		t1.type = "text";
		t1.name = "textA"+index;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index;
		t2.type = "text";		
		t2.name = "textB"+index;
		t2.className = "form-control text-uppercase";
		t2.size="15";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "textC"+index;				
		t3.name = "textC"+index;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "textD"+index;				
		t4.name = "textD"+index;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="textE"+index;
		t5.name="textE"+index;
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6 = document.createElement("input");
		t6.id="textF"+index;
		t6.name="textF"+index;
		t6.className = "form-control text-uppercase";
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7 = document.createElement("input");
		t7.id="textG"+index;
		t7.name="textG"+index;
		t7.className = "form-control text-uppercase";
		cell7.appendChild(t7);
		index++;
		document.getElementById("hiddenval1").value=index;
		
	}
	function mydelfunction1(){
	if(index>2){	
		var myobj=document.getElementById("objectTable1");
		myobj.deleteRow(-1);
		index--;
		document.getElementById("hiddenval1").value=index;
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

<script type="text/javascript">/*---------FOR TABLE-2------------*/
		var index1=<?php echo $num2;?>;
		function addMore1(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index1;
		t1.name = "txtA"+index1;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index1;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index1;
		t2.name = "txtB"+index1;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "Only Numbers are allowed";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txtC"+index1;
		t3.name = "txtC"+index1;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txtD"+index1;
		t4.name = "txtD"+index1;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
      	index1++;
		document.getElementById("hiddenval2").value=index1;

	}
	function mydelfunction2(){
		if(index1>2){	
			var myobj=document.getElementById("objectTable2");
			myobj.deleteRow(-1);
			index1--;
			document.getElementById("hiddenval2").value=index1;
		}
	}
</script>

<!-- end of script -->