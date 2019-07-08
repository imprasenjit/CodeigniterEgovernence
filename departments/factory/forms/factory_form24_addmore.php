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
<script type="text/javascript">
		var index=<?php echo $num1;?>;
		function addMore(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
		
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index;
		t1.name = "txtA"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
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
        cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txtC"+index;
		t3.name = "txtC"+index;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txtD"+index;
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "txtE"+index;
		t5.name = "txtE"+index;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";	
        cell5.appendChild(t5);
		
		var cell6=row.insertCell(5);
	    var t6=document.createElement("input");
		t6.id = "txtF"+index;
		t6.name = "txtF"+index;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="20";	
        cell6.appendChild(t6);
		
      	index++;
		document.getElementById("hiddenval1").value=index;
		$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction(){
		if(index>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index--;
			document.getElementById("hiddenval1").value=index;
		}
	}
</script>

<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t2  WHERE form_id='$form_id'");
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
		var index1=<?php echo $num2;?>;
		function addMore2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
		
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txxtA"+index1;
		t1.name = "txxtA"+index1;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index1;
		cell1.appendChild(t1);
		
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txxtB"+index1;
		t2.name = "txxtB"+index1;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txxtC"+index1;
		t3.name = "txxtC"+index1;
		t3.className = "dob form-control";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txxtD"+index1;
		t4.name = "txxtD"+index1;
		t4.className = "dob form-control";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "txxtE"+index1;
		t5.name = "txxtE"+index1;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";	
        cell5.appendChild(t5);
		
		var cell6=row.insertCell(5);
	    var t6=document.createElement("input");
		t6.id = "txxtF"+index1;
		t6.name = "txxtF"+index1;
		t6.className = "dob form-control";
		t6.style="";
		t6.size="20";	
        cell6.appendChild(t6);
		
		var cell7=row.insertCell(6);
	    var t7=document.createElement("input");
		t7.id = "txxtG"+index1;
		t7.name = "txxtG"+index1;
		t7.className = "form-control text-uppercase";
		t7.style="";
		t7.size="20";	
        cell7.appendChild(t7);
		
      	index1++;
		document.getElementById("hiddenval2").value=index1;
		$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
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

