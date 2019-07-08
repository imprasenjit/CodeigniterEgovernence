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
		t7.maxLength="6";
		t7.validate="pincode";
		t7.style="";
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
	$num2= $part2->num_rows;
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
<script>
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
		t7.maxLength="6";
		t7.validate="pincode";
		t7.style="";
		t7.size="5";
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
<?php
if(isset($form_id)){
	$part3=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t3 WHERE form_id='$form_id'");
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
	function addmore3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "textA"+index3;
		t1.name = "textA"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "textB"+index3;
		t2.name = "textB"+index3;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
        t3.id = "textC"+index3;
		t3.name = "textC"+index3;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="15";
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
        t4.id = "textD"+index3;	
		t4.name = "textD"+index3;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="15";
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
        t5.id = "textE"+index3;
		t5.name = "textE"+index3;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="10";
        cell5.appendChild(t5);
		var cell6=row.insertCell(5);
        var t6=document.createElement("input");
        t6.id = "textF"+index3;
		t6.name = "textF"+index3;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="10";
        cell6.appendChild(t6);
        var cell7=row.insertCell(6);
	    var t7=document.createElement("input");
        t7.id = "textG"+index3;
		t7.name = "textG"+index3;
		t7.className = "form-control text-uppercase";
		t7.maxLength="6";
		t7.validate="pincode";
		t7.style="";
		t7.size="5";
		t7.pattern = "[0-9]{6,6}";
		t7.title = "Please Enter 6 digit Pin Code";
        cell7.appendChild(t7);
		index3++;
		document.getElementById("hiddenval3").value=index3;

	}
	function mydelfunction6(){
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
	$part4=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t4 WHERE form_id='$form_id'");
	$num4= $part4->num_rows;
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
<script>
	var index4=<?php echo $num4;?>;
	function addmore4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "texttA"+index4 ;
		t1.name = "texttA"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "texttB"+index4;
		t2.name = "texttB"+index4;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "texttC"+index4;
		t3.name = "texttC"+index4;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "texttD"+index4;				
		t4.name = "texttD"+index4;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="15";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "texttE"+index4;
		t5.name = "texttE"+index4;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="10";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
        var t6=document.createElement("input");
        t6.id = "texttF"+index4;
		t6.name = "texttF"+index4;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.size="10";			
        cell6.appendChild(t6);
        var cell7=row.insertCell(6);
	    var t7=document.createElement("input");
        t7.id = "texttG"+index4;
		t7.name = "texttG"+index4;
		t7.className = "form-control text-uppercase";
		t7.maxLength="6";
		t7.validate="pincode";
		t7.style="";
		t7.size="5";
		t7.pattern = "[0-9]{6,6}";
		t7.title = "Please Enter 6 digit Pin Code";
        cell7.appendChild(t7);
		index4++;
		document.getElementById("hiddenval4").value=index4;

	}
	function mydelfunction7(){
		if(index4>2){	
			var myobj=document.getElementById("objectTable4");
			myobj.deleteRow(-1);
			index4--;
			document.getElementById("hiddenval4").value=index4;
		}
	}
</script>

<!-- end of script -->