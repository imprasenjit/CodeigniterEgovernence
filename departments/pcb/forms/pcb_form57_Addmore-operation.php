<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t1 WHERE form_id='$form_id'");
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
}
?>
<script>
	var index1=<?php echo $num1;?>;
	function addMore(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txtA"+index1 ;
		t1.name = "txtA"+index1;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index1;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index1;
		t2.name = "txtB"+index1;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index1;
		t3.name = "txtC"+index1;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);			
		index1++;
		document.getElementById("hiddenval").value=index1;
	}
	function mydelfunction(){
		if(index1>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index1--;
			document.getElementById("hiddenval").value=index1;
		}
	}
</script>