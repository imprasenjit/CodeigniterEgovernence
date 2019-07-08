<<?php
if(isset($form_id)){
	$part1=$sdc->query("SELECT id FROM sdc_form16_t1 WHERE form_id='$form_id'");
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
		
		var array2 = ["select type","Testing ","Manufacture"];
		var array2a = ["","T","M"];

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


</script>
<!-- end of script -->