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
		t1.type="text";
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
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "textC"+index2;
		t3.name = "textC"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";
		t3.validate="onlyNumbers";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "textD"+index2;
		t4.name = "textD"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";
		t4.validate="onlyNumbers";
		t4.maxlength="4";
        cell4.appendChild(t4);
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
		t2.title = "No special characters are allowed except Dot";
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
        t1.id = "txttA"+index4;
		t1.name = "txttA"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
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
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
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
        t1.id = "txttA"+index5;
		t1.name = "txttA"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txttB"+index5;
		t2.name = "txttB"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txttC"+index5;
		t3.name = "txttC"+index5;
		t3.className = "dobindiaaddmore form-control text-uppercase";
		t3.placeholder="DD-MM-YYYY";
		t3.readOnly=true;
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txttD"+index5;
		t4.name = "txttD"+index5;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);		
      	index5++;
		document.getElementById("hiddenval5").value=index5;
		$('.dobindiaaddmore').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
		
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
	$part6=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t6 WHERE form_id='$form_id'");
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
        t1.id = "txxtA"+index6;
		t1.name = "txxtA"+index6;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.readOnly=true;
		t1.value=index6;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txxtB"+index6;
		t2.name = "txxtB"+index6;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txxtC"+index6;
		t3.name = "txxtC"+index6;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txxtD"+index6;
		t4.name = "txxtD"+index6;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);
      	var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "txxtE"+index6;
		t5.name = "txxtE"+index6;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
        cell5.appendChild(t5);
		var cell6=row.insertCell(5);
	    var t6=document.createElement("input");
		t6.id = "txxtF"+index6;
		t6.name = "txxtF"+index6;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.type="text";
		t6.size="20";	
        cell6.appendChild(t6);
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
	$part7=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t7 WHERE form_id='$form_id'");
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
        t1.id = "textA"+index7;
		t1.name = "textA"+index7;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.size="1";
		t1.readOnly=true;
		t1.value=index7;		
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "textB"+index7;
		t2.name = "textB"+index7;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "textC"+index7;
		t3.name = "textC"+index7;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "textD"+index7;
		t4.name = "textD"+index7;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "textE"+index7;
		t5.name = "textE"+index7;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
        cell5.appendChild(t5);
      	var cell6=row.insertCell(5);
	    var t6=document.createElement("input");
		t6.id = "textF"+index7;
		t6.name = "textF"+index7;
		t6.className = "form-control text-uppercase";
		t6.style="";
		t6.type="text";
		t6.size="20";	
        cell6.appendChild(t6);
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
	$part8=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t8 WHERE form_id='$form_id'");
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
        t1.id = "textA"+index8;
		t1.name = "textA"+index8;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.size="1";
		t1.readOnly=true;
		t1.value=index8;		
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "textB"+index8;
		t2.name = "textB"+index8;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "textC"+index8;
		t3.name = "textC"+index8;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "textD"+index8;
		t4.name = "textD"+index8;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "textE"+index8;
		t5.name = "textE"+index8;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
        cell5.appendChild(t5);
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
<?php
if(isset($form_id)){
	$part9=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t9 WHERE form_id='$form_id'");
	$num9= $part9->num_rows;
}else{
	$num9=0;
}
if($num9>0){
	$hiddenval9=$num9+1;
	$num9=$num9+1;
}else{
		$hiddenval9=2;
		$num9=2;
}
?>
<script>
	var index9=<?php echo $num9;?>;
	function addMore9(){
		var myobj=document.getElementById("objectTable9");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txxtA"+index9;
		t1.name = "txxtA"+index9;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.readOnly=true;
		t1.value=index9;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txxtB"+index9;
		t2.name = "txxtB"+index9;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txxtC"+index9;
		t3.name = "txxtC"+index9;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txxtD"+index9;
		t4.name = "txxtD"+index9;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);
      	var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "txxtE"+index9;
		t5.name = "txxtE"+index9;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
        cell5.appendChild(t5);
      	index9++;
		document.getElementById("hiddenval9").value=index9;
	}
	function mydelfunction9(){
		if(index9>2){	
			var myobj=document.getElementById("objectTable9");
			myobj.deleteRow(-1);
			index9--;
			document.getElementById("hiddenval9").value=index9;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part10=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t10 WHERE form_id='$form_id'");
	$num10= $part10->num_rows;
}else{
	$num10=0;
}
if($num10>0){
	$hiddenval10=$num10+1;
	$num10=$num10+1;
}else{
		$hiddenval10=2;
		$num10=2;
}
?>
<script>
	var index10=<?php echo $num10;?>;
	function addMore10(){
		var myobj=document.getElementById("objectTable10");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txttA"+index10;
		t1.name = "txttA"+index10;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.readOnly=true;
		t1.value=index10;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txttB"+index10;
		t2.name = "txttB"+index10;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txttC"+index10;
		t3.name = "txttC"+index10;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
      	var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txttD"+index10;
		t4.name = "txttD"+index10;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "txttE"+index10;
		t5.name = "txttE"+index10;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
        cell5.appendChild(t5);
      	index10++;
		document.getElementById("hiddenval10").value=index10;
	}
	function mydelfunction10(){
		if(index10>2){	
			var myobj=document.getElementById("objectTable10");
			myobj.deleteRow(-1);
			index10--;
			document.getElementById("hiddenval10").value=index10;
		}
	}
	
</script>
<?php
if(isset($form_id)){
	$part11=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t11 WHERE form_id='$form_id'");
	$num11 = $part11->num_rows;
}else{
	$num11=0;
}
if($num11>0){
	$hiddenval11=$num11+1;
	$num11=$num11+1;
}else{
	$hiddenval11=2;
	$num11=2;
}
?>
<script type="text/javascript">
		var index11=<?php echo $num11;?>;
		function addMore11(){
		var myobj=document.getElementById("objectTable11");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index11;
		t1.name = "txtA"+index11;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.type="text";
		t1.size="20";
		t1.readOnly=true;
		t1.value=index11;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index11;
		t2.name = "txtB"+index11;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.type="text";
		t2.size="20";	
		t2.title = "Only Numbers are allowed";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txtC"+index11;
		t3.name = "txtC"+index11;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.type="text";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txtD"+index11;
		t4.name = "txtD"+index11;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.type="text";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "txtE"+index11;
		t5.name = "txtE"+index11;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.type="text";
		t5.size="20";	
        cell5.appendChild(t5);
      	index11++;
		document.getElementById("hiddenval11").value=index11;

	}
	function mydelfunction11(){
		if(index11>2){	
			var myobj=document.getElementById("objectTable11");
			myobj.deleteRow(-1);
			index11--;
			document.getElementById("hiddenval11").value=index11;
		}
	}

</script>
<!-- end of script -->