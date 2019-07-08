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
		var array4 = ["Please Select"];
		var array4a = [""];
		//Create and append select list
		var t1 = document.createElement("select");
		t1.setAttribute("id", "txtA"+index);
		t1.setAttribute("name", "txtA"+index);
		t1.className = "selectcd form-control text-uppercase";
		cell1.appendChild(t1);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			// $.ajax({ 
					// type: 'GET',
					// url: '../../../ajax/selectcd_tourism.php', 
					// data: { city: 1},
					// beforeSend:function(){
						// $(".selectcd").html("Loading..");
					// },
					// success:function(data){
						// $(".selectcd").html(data);
					// },
					// error:function(){ }
			// });
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
			t1.appendChild(option);
		}
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index;
		t2.name = "txtB"+index;
		t2.className = "dob form-control";
		t2.style="";
		t2.size="20";	
		//t2.title = "Only Numbers are allowed";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index;
		t3.name = "txtC"+index;
		t3.className = "dob form-control";
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
		t5.className = "timepicker form-control text-uppercase hasWickedpicker";
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