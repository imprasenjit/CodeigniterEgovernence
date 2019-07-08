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
	function addMore(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
		t1.type="text";
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
		t2.type="text";
        t2.id = "txtB"+index;
		t2.name = "txtB"+index;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.type="text";
		t3.id = "txtC"+index;
		t3.name = "txtC"+index;
		t3.className = "form-control text-uppercase";
		t3.size="20";	
        cell3.appendChild(t3);
      	index++;
		document.getElementById("hiddenval").value=index;

	}
	function mydelfunction(){
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
<script type="text/javascript">
	var index2=<?php echo $num2;?>;
	function addMore2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
		t1.type="text";
        t1.id = "textA"+index2;
		t1.name = "textA"+index2;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
		t2.type="text";
        t2.id = "textB"+index2;
		t2.name = "textB"+index2;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.type="text";
		t3.id = "textC"+index2;
		t3.name = "textC"+index2;
		t3.className = "form-control text-uppercase";
		t3.validate="onlyNumbers";
		t3.size="20";	
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
<!-- end of script -->
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
<script type="text/javascript">
	var index3=<?php echo $num3;?>;
	function addMore3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
		t1.type="text";
        t1.id = "taA"+index3;
		t1.name = "taA"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
		
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
		t2.type="text";
        t2.id = "taB"+index3;
		t2.name = "taB"+index3;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.type="text";
		t3.id = "taC"+index3;
		t3.name = "taC"+index3;
		t3.className = "form-control text-uppercase";
		t3.validate="onlyNumbers";
		t3.size="20";	
        cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.type="text";
		t4.id = "taD"+index3;
		t4.name = "taD"+index3;
		t4.className = "form-control text-uppercase";
		t4.size="20";	
        cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.type="text";
		t5.id = "taE"+index3;
		t5.name = "taE"+index3;
		t5.className = "dob form-control text-uppercase";
		t5.size="20";	
        cell5.appendChild(t5);
		
		var cell6=row.insertCell(5);
	    var t6=document.createElement("input");
		t6.type="text";
		t6.id = "taF"+index3;
		t6.name = "taF"+index3;
		t6.className = "form-control text-uppercase";
		t6.size="20";	
        cell6.appendChild(t6);
		
      	index3++;
		document.getElementById("hiddenval3").value=index3;
		$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
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
<script type="text/javascript">
	var index4=<?php echo $num4;?>;
	function addMore4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
		t1.type="text";
        t1.id = "tbA"+index4;
		t1.name = "tbA"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
		
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
		t2.type="text";
        t2.id = "tbB"+index4;
		t2.name = "tbB"+index4;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.type="text";
		t3.id = "tbC"+index4;
		t3.name = "tbC"+index4;
		t3.className = "form-control text-uppercase";
		t3.size="20";	
        cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.type="text";
		t4.id = "tbD"+index4;
		t4.name = "tbD"+index4;
		t4.className = "form-control text-uppercase";
		t4.size="20";	
        cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.type="text";
		t5.id = "tbE"+index4;
		t5.name = "tbE"+index4;
		t5.className = "form-control text-uppercase";
		t5.size="20";	
        cell5.appendChild(t5);
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
	$num5=$part5->num_rows;
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
<script type="text/javascript">
	var index5=<?php echo $num5;?>;
	function addMore5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
		t1.type="text";
        t1.id = "tcA"+index5;
		t1.name = "tcA"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
		
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
		t2.type="text";
        t2.id = "tcB"+index5;
		t2.name = "tcB"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.type="text";
		t3.id = "tcC"+index5;
		t3.name = "tcC"+index5;
		t3.className = "form-control text-uppercase";
		t3.size="20";	
        cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.type="text";
		t4.id = "tcD"+index5;
		t4.name = "tcD"+index5;
		t4.className = "form-control text-uppercase";
		t4.size="20";	
        cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.type="text";
		t5.id = "tcE"+index5;
		t5.name = "tcE"+index5;
		t5.className = "form-control text-uppercase";
		t5.size="20";	
        cell5.appendChild(t5);
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
