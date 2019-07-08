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
		t2.size="15";
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
		
		var array2 = ["select unit","in metric tonnes / month","in kl / month"];
		var array2a = ["","MT","K"];

		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "txtE"+index);
		t5.setAttribute("name", "txtE"+index);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t5.appendChild(option);
		}
		
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
<script>	/*---------FOR TABLE-2------------*/
	var index2=<?php echo $num2; ?>;
	function addMorefunction2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txttA"+index2;
		t1.name = "txttA"+index2;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txttB"+index2;				
		t2.name = "txttB"+index2;
		t2.className = "form-control text-uppercase";
		t2.size="15";
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txttC"+index2;				
		t3.name = "txttC"+index2;
		t3.className = "form-control text-uppercase";
		t3.size="15";
		cell3.appendChild(t3);	
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txttD"+index2;				
		t4.name = "txttD"+index2;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);
		
		var array2 = ["select unit","in metric tonnes / month","in kl / month"];
		var array2a = ["","MT","K"];

		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "txttE"+index2);
		t5.setAttribute("name", "txttE"+index2);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t5.appendChild(option);
		}
		
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
	/*---------FOR TABLE-2------------*/
</script>
<?php
if(isset($form_id)){
	$part3=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t3 WHERE form_id='$form_id'");
	$num3 = $part3->num_rows;
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
<script>	/*---------FOR TABLE-3------------*/
	var index3=<?php echo $num3; ?>;
	function addMorefunction3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txxtA"+index3;
		t1.name = "txxtA"+index3;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txxtB"+index3;
		t2.name = "txxtB"+index3;
		t2.className = "form-control text-uppercase";
		t2.size="20";			
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);		
		var array3 = ["Select Type","Product","By-Product"];
		var array3a = ["","P","B"];
		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id", "txxtC"+index3);
		t3.setAttribute("name", "txxtC"+index3);
		t3.className = "form-control text-uppercase";
		cell3.appendChild(t3);
		//Create and append the options
		for (var i = 0; i < array3.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array3a[i]);
			option.text = array3[i];
			t3.appendChild(option);
		}
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index3;				
		t4.name = "txxtD"+index3;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);		
		var array4 = ["select unit","in tonnes / month","in kl / month","in numbers / month"];
		var array4a = ["","T","K","N"];
		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "txxtE"+index3);
		t5.setAttribute("name", "txxtE"+index3);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
			t5.appendChild(option);
		}	
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
	/*---------FOR TABLE-3------------*/
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
<script>
	var index4=<?php echo $num4; ?>;
	function addMorefunction4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "textA"+index4;
		t1.name = "textA"+index4;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index4;
		t2.name = "textB"+index4;
		t2.className = "form-control text-uppercase";
		t2.size="20";		
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);		
		//Create and append select list
		var t3 = document.createElement("input");
		t3.id="textC"+index4;
		t3.name="textC"+index4;
		t3.className = "form-control text-uppercase";
		cell3.appendChild(t3);
		//Create and append the option
		
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "textD"+index4;				
		t4.name = "textD"+index4;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);		
		var array4 = ["select unit","in tonnes / month","in kl / month","in numbers / month"];
		var array4a = ["","T","K","N"];
		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "textE"+index4);
		t5.setAttribute("name", "textE"+index4);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
			t5.appendChild(option);
		}
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
	/*---------FOR TABLE-4------------*/
</script>
<?php
if(isset($form_id)){
	$part5=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t5 WHERE form_id='$form_id'");
	$num5 = $part5->num_rows;
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
	var index5=<?php echo $num5; ?>;
	function addMorefunction5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "text1A"+index5;
		t1.name = "text1A"+index5;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "text1B"+index5;
		t2.name = "text1B"+index5;
		t2.className = "form-control text-uppercase";
		t2.size="20";		
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);		
		var array1 = ["Select Type","Hazardous Waste","Other Waste"];
		var array1a = ["","HW","OW"];
		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id", "text1C"+index5);
		t3.setAttribute("name", "text1C"+index5);
		t3.className = "form-control text-uppercase";
		cell3.appendChild(t3);
		//Create and append the options
		for (var i = 0; i < array1.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array1a[i]);
			option.text = array1[i];
			t3.appendChild(option);
		}
		
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "text1D"+index5;				
		t4.name = "text1D"+index5;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);		
		var array4 = ["select unit","in tonnes / month","in kl / month","in numbers / month"];
		var array4a = ["","T","K","N"];
		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "text1E"+index5);
		t5.setAttribute("name", "text1E"+index5);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
			t5.appendChild(option);
		}
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
	/*---------FOR TABLE-4------------*/
</script>
<?php
if(isset($form_id)){
	$part6=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t6 WHERE form_id='$form_id'");
	$num6 = $part6->num_rows;
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
	var index6=<?php echo $num6; ?>;
	function addMorefunction6(){
		var myobj=document.getElementById("objectTable6");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "textA"+index6;
		t1.name = "textA"+index6;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index6;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index6;
		t2.name = "textB"+index6;
		t2.className = "form-control text-uppercase";
		t2.size="20";		
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);		
		var cell3=row.insertCell(2);
		var t3 = document.createElement("input");
		t3.id="textC"+index6;
		t3.name="textC"+index6;
		t3.className = "form-control text-uppercase";
		t3.size="20";
		cell3.appendChild(t3);		
		var cell4=row.insertCell(3);
		
		var array2 = ["select unit","in tonnes / month","in kl / month","in numbers / month"];
		var array2a = ["","T","K","N"];

		//Create and append select list
		var t4 = document.createElement("select");
		t4.setAttribute("id", "textD"+index6);
		t4.setAttribute("name", "textD"+index6);
		t4.className = "form-control text-uppercase";
		cell4.appendChild(t4);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t4.appendChild(option);
		}	
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
	/*---------FOR TABLE-4------------*/
</script>
<?php
if(isset($form_id)){
	$part7=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t7 WHERE form_id='$form_id'");
	$num7 = $part7->num_rows;
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
	var index7=<?php echo $num7; ?>;
	function addMorefunction7(){
		var myobj=document.getElementById("objectTable7");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "textA"+index7;
		t1.name = "textA"+index7;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index7;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "textB"+index7;
		t2.name = "textB"+index7;
		t2.className = "form-control text-uppercase";
		t2.size="20";		
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);		
		var cell3=row.insertCell(2);
		var t3 = document.createElement("input");
		t3.id="textC"+index7;
		t3.name="textC"+index7;
		t3.className = "form-control text-uppercase";
		t3.size="20";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4 = document.createElement("input");
		t4.id="textD"+index7;
		t4.name="textD"+index7;
		t4.className = "form-control text-uppercase";
		t4.size="20";
		cell4.appendChild(t4);	
		var cell5=row.insertCell(4);
		var t5 = document.createElement("input");
		t5.id="textE"+index7;
		t5.name="textE"+index7;
		t5.className = "form-control text-uppercase";
		t5.size="20";
		cell5.appendChild(t5);	
		
		var cell6=row.insertCell(5);
		
		var array2 = ["select Source","Domestic","Imported","Both"];
		var array2a = ["","D","I","M"];

		//Create and append select list
		var t6 = document.createElement("select");
		t6.setAttribute("id", "textF"+index7);
		t6.setAttribute("name", "textF"+index7);
		t6.className = "form-control text-uppercase";
		cell6.appendChild(t6);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t6.appendChild(option);
		}
	
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
	/*---------FOR TABLE-4------------*/
</script>
<?php
if(isset($form_id)){
	$part8=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t8 WHERE form_id='$form_id'");
	$num8 = $part8->num_rows;
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

<script>	/*---------FOR TABLE-8------------*/
	var index8=<?php echo $num8; ?>;
	function addMorefunction8(){
		var myobj=document.getElementById("objectTable8");
		var row=myobj.insertRow(myobj.rows.length);
		var cell1=row.insertCell(0);
		var t1=document.createElement("input");
		t1.id = "txxtA"+index8;
		t1.name = "txxtA"+index8;
		t1.className = "form-control text-uppercase";
		t1.size="1";			
		t1.readOnly=true;
		t1.value=index8;
		cell1.appendChild(t1);
		var cell2=row.insertCell(1);
		var t2=document.createElement("input");
		t2.id = "txxtB"+index8;
		t2.name = "txxtB"+index8;
		t2.className = "form-control text-uppercase";
		t2.size="20";			
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);		
		var array1 = ["Select Type","Product","By-Product"];
		var array1a = ["","P","B"];
		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id", "txxtC"+index8);
		t3.setAttribute("name", "txxtC"+index8);
		t3.className = "form-control text-uppercase";
		cell3.appendChild(t3);
		//Create and append the options
		for (var i = 0; i < array1.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array1a[i]);
			option.text = array1[i];
			t3.appendChild(option);
		}
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index8;				
		t4.name = "txxtD"+index8;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);		
		var cell5=row.insertCell(4);		
		var array4 = ["select unit","in tonnes / month","in kl / month","in numbers / month"];
		var array4a = ["","T","K","N"];
		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "txxtE"+index8);
		t5.setAttribute("name", "txxtE"+index8);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
			t5.appendChild(option);
		}	
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
	/*---------FOR TABLE-8------------*/
</script>