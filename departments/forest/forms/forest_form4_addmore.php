<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
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
function addmore(){
	var myobj=document.getElementById("objectTable1");
	var row=myobj.insertRow(myobj.rows.length);
    var cell1=row.insertCell(0);
    var t1=document.createElement("input");
	t1.id = "txtA"+index;
	t1.className = "form-control text-uppercase";
	t1.name = "txtA"+index;
	t1.style="";
	t1.size="1";			
	t1.readOnly=true;
	t1.value=index;
	cell1.appendChild(t1);
	
	var cell2=row.insertCell(1);
	var t2=document.createElement("input");
	t2.id = "txtB"+index;
	t2.className = "form-control text-uppercase";
	t2.name = "txtB"+index;
	t2.style="";
	t2.size="15";		
	cell2.appendChild(t2);
	
    var cell3=row.insertCell(2);
	var t3=document.createElement("input");
	t3.id = "txtC"+index;
	t3.className = "form-control text-uppercase";
	t3.name = "txtC"+index;
	t3.style="";
	t3.size="15";		
	cell3.appendChild(t3);
	
	var cell4=row.insertCell(3);
	var t4=document.createElement("input");
	t4.id = "txtD"+index;
	t4.className = "form-control text-uppercase";
	t4.name = "txtD"+index;
	t4.style="";
	t4.size="15";
	cell4.appendChild(t4);
	
	var cell5=row.insertCell(4);
	var t5=document.createElement("input");
	t5.id = "txtE"+index;
	t5.className = "form-control text-uppercase";				
	t5.name = "txtE"+index;
	t5.style="";
	t5.size="15";
	cell5.appendChild(t5);
	
	var cell6=row.insertCell(5);
	var t6=document.createElement("input");
	t6.id = "txtF"+index;
	t6.className = "form-control text-uppercase";				
	t6.name = "txtF"+index;
	t6.style="";
	t6.size="15";
	cell6.appendChild(t6);
	
	var cell7=row.insertCell(6);
	var t7=document.createElement("input");
	t7.id = "txtG"+index;
	t7.className = "form-control text-uppercase";				
	t7.name = "txtG"+index;
	t7.style="";
	t7.size="15";
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
