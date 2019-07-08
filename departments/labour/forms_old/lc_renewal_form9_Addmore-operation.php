<?php
if(isset($form_id)){
	$part1=$labour->query("SELECT id FROM labour_form9_t1 WHERE form_id='$form_id'");
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

<script>	/*---------FOR TABLE-1------------*/
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
		t2.size="20";
		t2.validate="letters";			
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
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txtE"+index;
		t5.name = "txtE"+index;
		t5.className = "form-control text-uppercase";
		t5.size="10";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "txtF"+index;
		t6.name = "txtF"+index;
		t6.className = "form-control text-uppercase";
		t6.size="10";
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7=document.createElement("input");
		t7.id = "txtG"+index;
		t7.name = "txtG"+index;
		t7.className = "form-control text-uppercase";
		t7.maxLength="6";
		t7.validate="pincode";
		t7.size="5";			
		t7.pattern = "[0-9]{6,6}";
		t7.title = "Please Enter 6 digit Pin Code";
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
	/*---------FOR TABLE-2------------*/
</script>
<?php

if(isset($form_id)){
	$part2=$labour->query("SELECT id FROM labour_form9_t2 WHERE form_id='$form_id'");
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
<script>
	var index2=<?php echo $num2; ?>;
	function addMorefunction2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "textA"+index2;
		t1.name = "textA"+index2;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index2;
		t2.name = "textB"+index2;
		t2.className = "form-control text-uppercase";
		t2.size="20";		
		t2.validate = "letters";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "textC"+index2;
		t3.name = "textC"+index2;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "textD"+index2;				
		t4.name = "textD"+index2;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "textE"+index2;
		t5.name = "textE"+index2;
		t5.className = "form-control text-uppercase";
		t5.size="10";
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.id = "textF"+index2;
		t6.name = "textF"+index2;
		t6.className = "form-control text-uppercase";
		t6.size="10";
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7=document.createElement("input");
		t7.id = "textG"+index2;
		t7.name = "textG"+index2;
		t7.className = "form-control text-uppercase";
		t7.maxLength="6";
		t7.validate="pincode";
		t7.size="5";			
		t7.pattern = "[0-9]{6,6}";
		t7.title = "Please Enter 6 digit Pin Code";
		cell7.appendChild(t7);
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
	/*---------FOR TABLE-3------------*/
</script>
	<?php 
		$part3=$labour->query("SELECT * FROM labour_form9_t3 WHERE form_id='$form_id'");
		$num3 = $part3->num_rows;
		if($num3>0){
			$hiddenval3=$num3+1;
			$num3=$num3+1;
		}else{
			$hiddenval3=2;
			$num3=2;
		}
	?>
<script>
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
		var t3=document.createElement("input");
		t3.id = "txttC"+index3;
		t3.name = "txttC"+index3;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txttD"+index3;				
		t4.name = "txttD"+index3;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txttE"+index3;
		t5.name = "txttE"+index3;
		t5.className = "form-control text-uppercase";
		t5.size="10";
		cell5.appendChild(t5);
		index3++;
		document.getElementById("hiddenval3").value=index3;
	}
	function mydel_addmore3(){
		if(index3>2){	
			var myobj=document.getElementById("objectTable3");
			myobj.deleteRow(-1);
			index3--;
			document.getElementById("hiddenval3").value=index3;
		}
	}

</script>
	<?php 
		$part4=$labour->query("SELECT * FROM labour_form9_t4 WHERE form_id='$form_id'");
		$num4 = $part4->num_rows;
		if($num4>0){
			$hiddenval4=$num4+1;
			$num4=$num4+1;
		}else{
			$hiddenval4=2;
			$num4=2;
		}
	?>
<script>
/*---------FOR TABLE-4------------*/
	var index4=<?php echo $num4; ?>;
	function addmore4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txtttA"+index4;
		t1.name = "txtttA"+index4;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txtttB"+index4;
		t2.name = "txtttB"+index4;
		t2.className = "form-control text-uppercase";
		t2.size="20";			
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtttC"+index4;
		t3.name = "txtttC"+index4;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtttD"+index4;				
		t4.name = "txtttD"+index4;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txtttE"+index4;
		t5.name = "txtttE"+index4;
		t5.className = "form-control text-uppercase";
		t5.size="10";
		cell5.appendChild(t5);
		index4++;
		document.getElementById("hiddenval4").value=index4;
	}
	function mydel_addmore4(){
		if(index4>2){
			var myobj=document.getElementById("objectTable4");
			myobj.deleteRow(-1);
			index4--;
			document.getElementById("hiddenval4").value=index4;
		}
	}
</script>
	
	<?php 
		$part5=$labour->query("SELECT * FROM labour_form9_t5 WHERE form_id='$form_id'");
		$num5 = $part5->num_rows;
		if($num5>0){
			$hiddenval5=$num5+1;
			$num5=$num5+1;
		}else{
			$hiddenval5=2;
			$num5=2;
		}
	?>
<script>
/*---------FOR TABLE-5------------*/
	var index5=<?php echo $num5; ?>;
	function addmore5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txttttA"+index5;
		t1.name = "txttttA"+index5;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txttttB"+index5;
		t2.name = "txttttB"+index5;
		t2.className = "form-control text-uppercase";
		t2.size="20";			
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txttttC"+index5;
		t3.name = "txttttC"+index5;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txttttD"+index5;				
		t4.name = "txttttD"+index5;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txttttE"+index5;
		t5.name = "txttttE"+index5;
		t5.className = "form-control text-uppercase";
		t5.size="10";
		cell5.appendChild(t5);
		index5++;
		document.getElementById("hiddenval5").value=index5;

	}
	function mydel_addmore5(){
		if(index5>2){
			var myobj=document.getElementById("objectTable5");
			myobj.deleteRow(-1);
			index5--;
			document.getElementById("hiddenval5").value=index5;
		}
	}
</script>
	
	<?php 
		$part6=$labour->query("SELECT * FROM labour_form9_t6 WHERE form_id='$form_id'");
		$num6 = $part6->num_rows;
		if($num6>0){
			$hiddenval6=$num6+1;
			$num6=$num6+1;
		}else{
			$hiddenval6=2;
			$num6=2;
		}
	?>
<script>
/*---------FOR TABLE-6------------*/
	var index6=<?php echo $num6; ?>;
	function addmore6(){	
		var myobj=document.getElementById("objectTable6");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txtttttA"+index6;
		t1.name = "txtttttA"+index6;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index6;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txtttttB"+index6;
		t2.name = "txtttttB"+index6;
		t2.className = "form-control text-uppercase";
		t2.size="20";			
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtttttC"+index6;
		t3.name = "txtttttC"+index6;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtttttD"+index6;				
		t4.name = "txtttttD"+index6;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txtttttE"+index6;
		t5.name = "txtttttE"+index6;
		t5.className = "form-control text-uppercase";
		t5.size="10";
		cell5.appendChild(t5);
		index6++;
		document.getElementById("hiddenval6").value=index6;

	}

	function mydel_addmore6(){
		if(index6>2){	
			var myobj=document.getElementById("objectTable6");
			myobj.deleteRow(-1);
			index6--;
			document.getElementById("hiddenval6").value=index6;
		}
	}
</script>
