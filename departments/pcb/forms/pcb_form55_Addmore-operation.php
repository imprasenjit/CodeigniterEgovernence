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
	$part2=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t2 WHERE form_id='$form_id'");
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
	$part3=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t3 WHERE form_id='$form_id'");
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
        t1.id = "txttA"+index3 ;
		t1.name = "txttA"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txttB"+index3;
		t2.name = "txttB"+index3;
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
		t3.setAttribute("id","txttC"+index3);
		t3.setAttribute("name", "txttC"+index3);
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
		t3.id = "txttD"+index3;
		t4.name = "txttD"+index3;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
			
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
	$part4=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t4 WHERE form_id='$form_id'");
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

<?php
if(isset($form_id)){
	$part5=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t5 WHERE form_id='$form_id'");
	$num5=$part5->num_rows;
}else{
	$num5=0;
}
if($num5>0){
	$hiddenval5=$num5+1;
	$num5=$num5+1;
}else{
		$hiddenval5=2;
		$num5=2;
}?>
<script>
	var index5=<?php echo $num5;?>;
	function addMore5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tbA"+index5 ;
		t1.name = "tbA"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tbB"+index5;
		t2.name = "tbB"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "tbC"+index5;
		t3.name = "tbC"+index5;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
			
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
</script>
<?php
if(isset($form_id)){
	$part6=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t6 WHERE form_id='$form_id'");
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
        t1.id = "txxxtA"+index6 ;
		t1.name = "txxxtA"+index6;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txxxtB"+index6;
		t2.name = "txxxtB"+index6;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txxxtC"+index6;
		t3.name = "txxxtC"+index6;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
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
	$part7=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t7 WHERE form_id='$form_id'");
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
        t1.id = "tattA"+index7 ;
		t1.name = "tattA"+index7;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="1";	
		t1.readOnly=true;
		t1.value=index7;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tattB"+index7;
		t2.name = "tattB"+index7;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";
		//t2.pattern = "[a-zA-Z0-9./\s\w*/]+";
		t2.title = "No special characters are allowed except Dot";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "tattC"+index7;
		t3.name = "tattC"+index7;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		
			
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
