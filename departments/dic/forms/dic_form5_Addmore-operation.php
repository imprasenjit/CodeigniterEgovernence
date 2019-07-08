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
<script type="text/javascript">
	var index=<?php echo $num;?>;
	function addMore1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txtA"+index;
		t1.name = "txtA"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.type="text";
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);		
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txtB"+index;
		t2.name = "txtB"+index;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.type="text";
		t2.title = "Only Numbers are allowed";
		cell2.appendChild(t2);		
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index;
		t3.name = "txtC"+index;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
		cell3.appendChild(t3);		
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtD"+index;
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txtE"+index;
		t5.name = "txtE"+index;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
		cell5.appendChild(t5);		
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "txtF"+index;
		t6.name = "txtF"+index;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.type="text";
		t6.size="20";	
		cell6.appendChild(t6);		
		var cell7=row.insertCell(6);
		var t7=document.createElement("input");
		t7.id = "txtG"+index;
		t7.name = "txtG"+index;
		t7.className = "form-control text-uppercase";
		t7.style="";
		t7.type="text";
		t7.size="20";	
		cell7.appendChild(t7);		
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
<script type="text/javascript">
	var index2=<?php echo $num2;?>;
	function addMore2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "textA"+index2;
		t1.name = "textA"+index2;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.type="text";
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);		
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index2;
		t2.name = "textB"+index2;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.type="text";
		t2.title = "Only Numbers are allowed";
		cell2.appendChild(t2);		
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "textC"+index2;
		t3.name = "textC"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
		cell3.appendChild(t3);		
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "textD"+index2;
		t4.name = "textD"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "textE"+index2;
		t5.name = "textE"+index2;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
		cell5.appendChild(t5);		
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "textF"+index2;
		t6.name = "textF"+index2;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.type="text";
		t6.size="20";	
		cell6.appendChild(t6);		
		var cell7=row.insertCell(6);
		var t7=document.createElement("input");
		t7.id = "textG"+index2;
		t7.name = "textG"+index2;
		t7.className = "form-control text-uppercase";
		t7.style="";
		t7.type="text";
		t7.size="20";	
		cell7.appendChild(t7);		
		index2++;
		document.getElementById("hiddenval2").value=index2;
	}
		
	function mydelfunction2(){
		index2 = parseInt(index2);
		if(index2>2){	
			var myobj=document.getElementById("objectTable2");
			myobj.deleteRow(-1);
			index2--;
			document.getElementById("hiddenval2").value=index2;
		}
	}

</script>
<?php
if(isset($form_id)){
	$part3=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t3 WHERE form_id='$form_id'");
	$num3= $part3->num_rows;
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
<script>
	var index3=<?php echo $num3;?>;
	function addMore3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);						
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txxtA"+index3;
		t1.name = "txxtA"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";
		t1.type="text";
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);			
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txxtB"+index3;
		t2.name = "txxtB"+index3;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "Only Numbers are allowed";
		cell2.appendChild(t2);			
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txxtC"+index3;
		t3.name = "txxtC"+index3;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
		cell3.appendChild(t3);			
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index3;
		t4.name = "txxtD"+index3;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txxtE"+index3;
		t5.name = "txxtE"+index3;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
		cell5.appendChild(t5);			
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

</script>
<?php
if(isset($form_id)){
	$part4=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t4 WHERE form_id='$form_id'");
	$num4 = $part4->num_rows;
}else{
	$num4=0;
}
if($num4>0){
	$hiddenval4=$num4+1;
	$num4=$num4+1;
}else{
	$hiddenval4=2;
	$num4=2;
}
?>
<script type="text/javascript">
	var index4=<?php echo $num4;?>;
	function addMore4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txttA"+index4;
		t1.name = "txtA"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.type="text";
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);		
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txttB"+index4;
		t2.name = "txttB"+index4;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.type="text";
		t2.title = "Only Numbers are allowed";
		cell2.appendChild(t2);		
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txttC"+index4;
		t3.name = "txttC"+index4;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
		cell3.appendChild(t3);		
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txttD"+index4;
		t4.name = "txttD"+index4;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txttE"+index4;
		t5.name = "txttE"+index4;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
		cell5.appendChild(t5);		
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "txttF"+index4;
		t6.name = "txttF"+index4;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.type="text";
		t6.size="20";	
		cell6.appendChild(t6);		
		var cell7=row.insertCell(6);
		var t7=document.createElement("input");
		t7.id = "txttG"+index4;
		t7.name = "txttG"+index4;
		t7.className = "form-control text-uppercase";
		t7.style="";
		t7.type="text";
		t7.size="20";	
		cell7.appendChild(t7);		
		index4++;
		document.getElementById("hiddenval4").value=index4;
	}
		
	function mydelfunction4(){
		if(index4>2){	
			var myobj=document.getElementById("objectTable4");
			myobj.deleteRow(-1);
			index4--;
			document.getElementById("hiddenval4").value=index4;
		}
	}

</script>
<?php
if(isset($form_id)){
	$part5=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t5 WHERE form_id='$form_id'");
	$num5= $part5->num_rows;
}else{
	$num5=0;
}
if($num5>0){
	$hiddenval5=$num5+1;
	$num5=$num5+1;
}else{
		$hiddenval5=2;
		$num5=2;
}
?>
<script>
	var index5=<?php echo $num5;?>;
	function addMore5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);						
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "ttxtA"+index5;
		t1.name = "ttxtA"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";
		t1.type="text";
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);			
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "ttxtB"+index5;
		t2.name = "ttxtB"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "Only Numbers are allowed";
		cell2.appendChild(t2);			
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "ttxtC"+index5;
		t3.name = "ttxtC"+index5;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
		cell3.appendChild(t3);	
		index5++;
		document.getElementById("hiddenval5").value=index5;
	}
	function mydelfunction5(){
		if(index5>2){	
			var myobj=document.getElementById("objectTable5");
			myobj.deleteRow(-1);
			index5--;
			document.getElementById("hiddenval5").value=index5;
		}
	}

</script>
<!-- end of script -->