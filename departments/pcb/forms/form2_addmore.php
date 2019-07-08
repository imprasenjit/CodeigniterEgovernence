<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_products WHERE form_id='$form_id'");
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
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);		
		var array1 = ["Product","By-Product"];
		var array1a = ["P","B"];

		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id", "txtC"+index);
		t3.setAttribute("name", "txtC"+index);
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
		t4.id = "txtD"+index;				
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
		
		var array2 = ["in tonnes / month","in kl / month","in numbers / month","in kg / month"];
		var array2a = ["T","K","N","KG"];

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
	/*---------FOR TABLE-2------------*/
</script>
<?php

if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_materials WHERE form_id='$form_id'");
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
		t2.title = "No special characters are allowed except Dot";			
		cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);		
		var array3 = ["RAW MATERIAL","PROCESS CHEMICAL"];
		var array3a = ["R","C"];

		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id", "textC"+index2);
		t3.setAttribute("name", "textC"+index2);
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
		t4.id = "textD"+index2;				
		t4.name = "textD"+index2;
		t4.className = "form-control text-uppercase";
		t4.size="15";
		cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);		
		var array4 = ["in tonnes / month","in kl / month","in numbers / month","in kg / month"];
		var array4a = ["T","K","N","KG"];
		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "textE"+index2);
		t5.setAttribute("name", "textE"+index2);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
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
	/*---------FOR TABLE-3------------*/
</script>
<?php 
if(isset($form_id)){
	$part3=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_dgsets WHERE form_id='$form_id'");
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
		cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txxtC"+index3;
		t3.name = "txxtC"+index3;
		t3.className = "form-control text-uppercase";
		t3.size="20";				
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txxtD"+index3;
		t4.name = "txxtD"+index3;
		t4.className = "form-control text-uppercase";
		t4.size="20";				
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txxtE"+index3;
		t5.name = "txxtE"+index3;
		t5.className = "form-control text-uppercase";
		t5.size="20";				
		cell5.appendChild(t5);
		var cell6=row.insertCell(5);
		var t6=document.createElement("input");
		t6.setAttribute("type", "number");
		t6.id = "txxtF"+index3;
		t6.name = "txxtF"+index3;
		t6.className = "form-control text-uppercase";
		t6.size="20";				
		cell6.appendChild(t6);
		var cell7=row.insertCell(6);
		var t7=document.createElement("input");
		t7.id = "txxtG"+index3;
		t7.name = "txxtG"+index3;
		t7.className = "form-control text-uppercase";
		t7.size="20";				
		cell7.appendChild(t7);
		var cell8=row.insertCell(7);
		var t8=document.createElement("input");
		t8.id = "txxtH"+index3;
		t8.name = "txxtH"+index3;
		t8.className = "form-control text-uppercase";
		t8.size="20";				
		cell8.appendChild(t8);
        
		var cell9=row.insertCell(8);
                
		var array5 = ["YES","NO"];
		var array5a = ["Y","N"];
        
		//Create and append select list
		var t9 = document.createElement("select");
		t9.setAttribute("id", "txxtI"+index3);
		t9.setAttribute("name", "txxtI"+index3);
		t9.className = "form-control text-uppercase";
		cell9.appendChild(t9);
		//Create and append the options
		for (var i = 0; i < array5.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array5a[i]);
			option.text = array5[i];
			t9.appendChild(option);
		}
		var cell10=row.insertCell(9);
                
		var array6 = ["ACOUSTIC ENCLOSURE", "NOT APPLICABLE"];
		var array6b = ["A", "NA"];
        
		//Create and append select list
		var t10 = document.createElement("select");
		t10.setAttribute("id", "txxtJ"+index3);
		t10.setAttribute("name", "txxtJ"+index3);
		t10.className = "form-control text-uppercase";
		cell10.appendChild(t10);
		//Create and append the options
		for (var i = 0; i < array6.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array6b[i]);
			option.text = array6[i];
			t10.appendChild(option);
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
</script>