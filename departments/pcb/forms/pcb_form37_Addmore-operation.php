<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT * FROM  pcb_form37_t1 WHERE form_id='$form_id'");
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
}?>
<script>
	var index1=<?php echo $num1;?>;
	function addMore(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtaA"+index1 ;
		t1.name = "txtaA"+index1;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index1;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtaB"+index1;
		t2.name = "txtaB"+index1;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var array3 = ["Select Type","Product","Byproduct"];
		var array3a = ["","Product","Byproduct"];
		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id","txtaC"+index1);
		t3.setAttribute("name", "txtaC"+index1);
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
		t4.id = "txtaD"+index1;
		t4.name = "txtaD"+index1;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
			
		index1++;
		document.getElementById("hiddenval").value=index1;
	}
	function mydelfunction(){
		if(index1>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index1--;
			document.getElementById("hiddenval1").value=index1;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT * FROM  pcb_form37_t2 WHERE form_id='$form_id'");
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
        t1.id = "textA"+index2 ;
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
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
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
	$part3=$formFunctions->executeQuery($dept,"SELECT * FROM  pcb_form37_t3 WHERE form_id='$form_id'");
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
        t1.id = "txtA"+index3 ;
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
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var array3 = ["Select Type","Product","By-Product"];
		var array3a = ["","Product","Byproduct"];
		//Create and append select list
		var t3 = document.createElement("select");
		t3.setAttribute("id","txtC"+index3);
		t3.setAttribute("name", "txtC"+index3);
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
		t3.id = "txtD"+index3;
		t4.name = "txtD"+index3;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
			
		index3++;
		document.getElementById("hiddenval").value=index3;
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
	$part4=$formFunctions->executeQuery($dept,"SELECT * FROM  pcb_form37_t4 WHERE form_id='$form_id'");
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
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "texttC"+index4;
		t3.name = "texttC"+index4;
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
<!-- end of script -->