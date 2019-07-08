<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t1 WHERE form_id='$form_id'");
	$num1= $part1->num_rows;
}else{
	$num1=0;
}
if($num1>0){
	$hiddenval=$num1+1;
	$num1=$num1+1;
}else{
		$hiddenval=2;
		$num1=2;
}
?>
<script>
	var index1=<?php echo $num1;?>;
	function addMore(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index1 ;
		t1.name = "txtA"+index1;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index1;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index1;
		t2.name = "txtB"+index1;
		t2.className = "dob form-control text-uppercase";
		t2.style="";
		t2.size="20";
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
		
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txtE"+index1;
		t5.name = "txtE"+index1;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";
		cell5.appendChild(t5);
		
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "txtF"+index1;
		t6.name = "txtF"+index1;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="20";
		cell6.appendChild(t6);
			
			
		index1++;
		document.getElementById("hiddenval").value=index1;
		$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction(){
		if(index1>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index1--;
			document.getElementById("hiddenval").value=index1;
		}
	}
</script>

<!-- end of script -->


<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t2 WHERE form_id='$form_id'");
	$num2= $part2->num_rows;
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
<script>
	var index2=<?php echo $num2;?>;
	function addMore1(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txxtA"+index2 ;
		t1.name = "txxtA"+index2;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txxtB"+index2;
		t2.name = "txxtB"+index2;
		t2.className = "dob form-control text-uppercase";
		t2.style="";
		t2.size="20";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txxtC"+index2;
		t3.name = "txxtC"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index2;
		t4.name = "txxtD"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txxtE"+index2;
		t5.name = "txxtE"+index2;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";
		cell5.appendChild(t5);
		
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "txxtF"+index2;
		t6.name = "txxtF"+index2;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="20";
		cell6.appendChild(t6);
			
			
		index2++;
		document.getElementById("hiddenval1").value=index2;
		$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction1(){
		if(index2>2){	
			var myobj=document.getElementById("objectTable2");
			myobj.deleteRow(-1);
			index2--;
			document.getElementById("hiddenval1").value=index2;
		}
	}
</script>