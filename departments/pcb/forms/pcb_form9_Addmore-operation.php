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
		t2.title = "Only Numbers are allowed";
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
	function addMore2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
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
        t2.id = "textB"+index2;
		t2.name = "textB"+index2;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "textC"+index2;
		t3.name = "textC"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "textD"+index2;				
		t4.name = "textD"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "textE"+index2;				
		t5.name = "textE"+index2;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";
		cell5.appendChild(t5);
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
	function addMore3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index3;
		t1.name = "txtA"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index3;
		t2.name = "txtB"+index3;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
        t3.id = "txtC"+index3;
		t3.name = "txtC"+index3;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		
        cell3.appendChild(t3);
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
	function addMore4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "textA"+index4 ;
		t1.name = "textA"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "textB"+index4;
		t2.name = "textB"+index4;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "textC"+index4;
		t3.name = "textC"+index4;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		
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
	$part5=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t5 WHERE form_id='$form_id'");
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
        t1.id = "txttA"+index5 ;
		t1.name = "txttA"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txttB"+index5;
		t2.name = "txttB"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txttC"+index5;
		t3.name = "txttC"+index5;
		t3.className = "form-control text-uppercase";
		t3.style="";
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
<?php
if(isset($form_id)){
	$part6=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t6 WHERE form_id='$form_id'");
	$num6= $part6->num_rows;
}else{
	$num6=0;
}
if($num6>0){
	$hiddenval6=$num6+1;
	$num6=$num6+1;
}else{
		$hiddenval6=2;
		$num6=2;
}
?>
<script>
	var index6=<?php echo $num6;?>;
	function addMore6(){
		var myobj=document.getElementById("objectTable6");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "texttA"+index6 ;
		t1.name = "texttA"+index6;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index6;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "texttB"+index6;
		t2.name = "texttB"+index6;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "texttC"+index6;
		t3.name = "texttC"+index6;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "texttD"+index6;				
		t4.name = "texttD"+index6;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
		
		index6++;
		document.getElementById("hiddenval6").value=index6;

	}
	function mydelfunction6(){
		if(index6>2){	
			var myobj=document.getElementById("objectTable6");
			myobj.deleteRow(-1);
			index6--;
			document.getElementById("hiddenval6").value=index6;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part7=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t7 WHERE form_id='$form_id'");
	$num7= $part7->num_rows;
}else{
	$num7=0;
}
if($num7>0){
	$hiddenval7=$num7+1;
	$num7=$num7+1;
}else{
		$hiddenval7=2;
		$num7=2;
}
?>
<script>
	var index7=<?php echo $num7;?>;
	function addMore7(){
		var myobj=document.getElementById("objectTable7");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtttA"+index7 ;
		t1.name = "txtttA"+index7;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index7;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtttB"+index7;
		t2.name = "txtttB"+index7;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtttC"+index7;
		t3.name = "txtttC"+index7;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtttD"+index7;				
		t4.name = "txtttD"+index7;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
		
		index7++;
		document.getElementById("hiddenval7").value=index7;

	}
	function mydelfunction7(){
		if(index7>2){	
			var myobj=document.getElementById("objectTable7");
			myobj.deleteRow(-1);
			index7--;
			document.getElementById("hiddenval7").value=index7;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part8=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t8 WHERE form_id='$form_id'");
	$num8= $part8->num_rows;
}else{
	$num8=0;
}
if($num8>0){
	$hiddenval8=$num8+1;
	$num8=$num8+1;
}else{
		$hiddenval8=2;
		$num8=2;
}
?>
<script>
	var index8=<?php echo $num8;?>;
	function addMore8(){
		var myobj=document.getElementById("objectTable8");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "ttxtA"+index8 ;
		t1.name = "ttxtA"+index8;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index8;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "ttxtB"+index8;
		t2.name = "ttxtB"+index8;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "ttxtC"+index8;
		t3.name = "ttxtC"+index8;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "ttxtD"+index8;				
		t4.name = "ttxtD"+index8;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		t4.pattern = "[0-9]{1,10}";
		t4.title = "Only Numbers";
		cell4.appendChild(t4);
		index8++;
		document.getElementById("hiddenval8").value=index8;

	}
	function mydelfunction8(){
		if(index8>2){	
			var myobj=document.getElementById("objectTable8");
			myobj.deleteRow(-1);
			index8--;
			document.getElementById("hiddenval8").value=index8;
		}
	}
</script>
<!-- end of script -->