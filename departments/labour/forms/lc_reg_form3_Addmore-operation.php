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
	function addmore1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index;
		t1.name = "txtA"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
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
		t2.title = "No special characters are allowed except Dot";	
       	cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txtC"+index;
		t3.name = "txtC"+index;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="15";
        cell3.appendChild(t3);
        var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
        t4.id = "txtD"+index;
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="15";
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
        t5.id = "txtE"+index;
		t5.name = "txtE"+index;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="10";
        cell5.appendChild(t5);
		var cell6=row.insertCell(5);
        var t6=document.createElement("input");
       	t6.id = "txtF"+index;
		t6.name = "txtF"+index;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="10";
        cell6.appendChild(t6);
        var cell7=row.insertCell(6);
	    var t7=document.createElement("input");
		t7.id = "txtG"+index;
		t7.name = "txtG"+index;
		t7.className = "form-control text-uppercase";
		t7.style="";
		t7.maxLength="6";
		t7.validate="pincode";
		t7.size="5";	
		t7.pattern = "[0-9]{6,6}";
		t7.title = "Please Enter 6 digit Pin Code";
        cell7.appendChild(t7);
		index++;
		document.getElementById("hiddenval").value=index;
	}

	function mydelfunction4(){
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
	function addmore2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txttA"+index2;
		t1.name = "txttA"+index2;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txttB"+index2;
		t2.name = "txttB"+index2;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
        t3.id = "txttC"+index2;
		t3.name = "txttC"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="15";
        cell3.appendChild(t3);
        var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
        t4.id = "txttD"+index2;	
		t4.name = "txttD"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="15";
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
        t5.id = "txttE"+index2;
		t5.name = "txttE"+index2;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="10";
        cell5.appendChild(t5);
		var cell6=row.insertCell(5);
        var t6=document.createElement("input");
        t6.id = "txttF"+index2;
		t6.name = "txttF"+index2;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="10";
        cell6.appendChild(t6);
        var cell7=row.insertCell(6);
	    var t7=document.createElement("input");
		t7.id = "txttG"+index2;
		t7.name = "txttG"+index2;
		t7.className = "form-control text-uppercase";
		t7.style="";
		t7.size="5";
		t7.maxLength="6";
		t7.validate="pincode";
		t7.pattern = "[0-9]{6,6}";
		t7.title = "Please Enter 6 digit Pin Code";
       	cell7.appendChild(t7);
		index2++;
		document.getElementById("hiddenval2").value=index2;
	}
	function mydelfunction5(){
		if(index2>2){	
			var myobj=document.getElementById("objectTable2");
			myobj.deleteRow(-1);
			index2--;
			document.getElementById("hiddenval2").value=index2;
		}
	}

</script>

<!-- end of script -->