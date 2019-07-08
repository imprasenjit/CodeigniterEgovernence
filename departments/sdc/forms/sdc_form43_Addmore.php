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
        t1.id = "txttA"+index;
		t1.name = "txttA"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txttB"+index;
		t2.name = "txttB"+index;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "Only Letters are allowed";
        cell2.appendChild(t2);
		
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
<!-- end of script -->
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
		function addMore2(){
		var myobj=document.getElementById("objectTable2");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index2;
		t1.name = "txtA"+index2;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index2;
		t2.name = "txtB"+index2;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
		t2.title = "Only Numbers are allowed";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txtC"+index2;
		t3.name = "txtC"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "txtD"+index2;
		t4.name = "txtD"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		
		var array2 = ["select type","Medical Officer ","Technical Supervisor","Registered Nurse","Blood Bank Technician"];
		var array2a = ["","MO","TS","RN","BB"];

		//Create and append select list
		var t5 = document.createElement("select");
		t5.setAttribute("id", "txtE"+index2);
		t5.setAttribute("name", "txtE"+index2);
		t5.className = "form-control text-uppercase";
		cell5.appendChild(t5);
		t5.required=true;
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

</script>
<!-- end of script -->