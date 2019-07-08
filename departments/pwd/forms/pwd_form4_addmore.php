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
        t1.id = "text1A"+index;
		t1.name = "text1A"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
		
		
		var array2 = ["Select Type","Prime Contractor","Sub Contractor"];
		var array2a = ["","P","S"];
		//Create and append select list
		var t2 = document.createElement("select");
		t2.setAttribute("id", "text1B"+index);
		t2.setAttribute("name", "text1B"+index);
		t2.className = "form-control text-uppercase";
		cell2.appendChild(t2);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t2.appendChild(option);
		}
		
	   
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text1C"+index;
		t3.name = "text1C"+index;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "text1D"+index;
		t4.name = "text1D"+index;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
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

<?php
if(isset($form_id)){
	$part2=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t2 WHERE form_id='$form_id'");
	$num2=$part2->num_rows;
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
        t1.id = "text2A"+index2;
		t1.name = "text2A"+index2;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index2;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
		
		var array2 = ["Select Type","Prime Contractor","Sub Contractor"];
		var array2a = ["","P","S"];
		//Create and append select list
		var t2 = document.createElement("select");
		t2.setAttribute("id", "text2B"+index2);
		t2.setAttribute("name", "text2B"+index2);
		t2.className = "form-control text-uppercase";
		cell2.appendChild(t2);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t2.appendChild(option);
		}
		
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text2C"+index2;
		t3.name = "text2C"+index2;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "text2D"+index2;
		t4.name = "text2D"+index2;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "text2E"+index2;
		t5.name = "text2E"+index2;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";	
        cell5.appendChild(t5);
		
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
	$part3=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t3 WHERE form_id='$form_id'");
	$num3=$part3->num_rows;
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
<script type="text/javascript">
		var index3=<?php echo $num3;?>;
		function addMore3(){
		var myobj=document.getElementById("objectTable3");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "text3A"+index3;
		t1.name = "text3A"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
		
		var array2 = ["Select Type","Prime Contractor","Sub Contractor"];
		var array2a = ["","P","S"];
		//Create and append select list
		var t2 = document.createElement("select");
		t2.setAttribute("id", "text3B"+index3);
		t2.setAttribute("name", "text3B"+index3);
		t2.className = "form-control text-uppercase";
		cell2.appendChild(t2);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t2.appendChild(option);
		}
		
	    
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text3C"+index3;
		t3.name = "text3C"+index3;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "text3D"+index3;
		t4.name = "text3D"+index3;
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
	$part4=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t4 WHERE form_id='$form_id'");
	$num4=$part4->num_rows;
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
<script type="text/javascript">
		var index4=<?php echo $num4;?>;
		function addMore4(){
		var myobj=document.getElementById("objectTable4");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "text4A"+index4;
		t1.name = "text4A"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
		
		var array2 = ["Select","Project Manager","Junior Engineer","Field Engineer"];
		var array2a = ["","M","J","F"];
		//Create and append select list
		var t2 = document.createElement("select");
		t2.setAttribute("id", "text4B"+index4);
		t2.setAttribute("name", "text4B"+index4);
		t2.className = "form-control text-uppercase";
		cell2.appendChild(t2);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t2.appendChild(option);
		}
		
		
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text4C"+index4;
		t3.name = "text4C"+index4;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		
		var array2 = ["Select","BE Civil","Diploma in Civil Engineering"];
		var array2a = ["","B","D"];
		//Create and append select list
		var t4 = document.createElement("select");
		t4.setAttribute("id", "text4D"+index4);
		t4.setAttribute("name", "text4D"+index4);
		t4.className = "form-control text-uppercase";
		cell4.appendChild(t4);
		//Create and append the options
		for (var i = 0; i < array2.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value", array2a[i]);
			option.text = array2[i];
			t4.appendChild(option);
		}
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "text4E"+index4;
		t5.name = "text4E"+index4;
		t5.className = "form-control text-uppercase";
		t5.style="";
		t5.size="20";	
        cell5.appendChild(t5);
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

<?php
if(isset($form_id)){
	$part5=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t5 WHERE form_id='$form_id'");
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
}
?>
<script type="text/javascript">
		var index5=<?php echo $num5?>;
		function addMore5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "text5A"+index5;
		t1.name = "text5A"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "text5B"+index5;
		t2.name = "text5B"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text5C"+index5;
		t3.name = "text5C"+index5;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "text5D"+index5;
		t4.name = "text5D"+index5;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
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
	$part6=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t6 WHERE form_id='$form_id'");
	$num6=$part6->num_rows;
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
<script type="text/javascript">
		var index6=<?php echo $num6;?>;
		function addMore6(){
		var myobj=document.getElementById("objectTable6");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "text6A"+index6;
		t1.name = "text6A"+index6;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index6;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "text6B"+index6;
		t2.name = "text6B"+index6;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text6C"+index6;
		t3.name = "text6C"+index6;
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
	$part7=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t7 WHERE form_id='$form_id'");
	$num7=$part7->num_rows;
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
<script type="text/javascript">
		var index7=<?php echo $num7;?>;
		function addMore7(){
		var myobj=document.getElementById("objectTable7");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "text7A"+index7;
		t1.name = "text7A"+index7;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index7;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "text7B"+index7;
		t2.name = "text7B"+index7;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text7C"+index7;
		t3.name = "text7C"+index7;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "text7D"+index7;
		t4.name = "text7D"+index7;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
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

<?php
if(isset($form_id)){
	$part8=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t8 WHERE form_id='$form_id'");
	$num8=$part8->num_rows;
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
<script type="text/javascript">
		var index8=<?php echo $num8;?>;
		function addMore8(){
		var myobj=document.getElementById("objectTable8");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "text8A"+index8;
		t1.name = "text8A"+index8;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index8;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "text8B"+index8;
		t2.name = "text8B"+index8;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "text8C"+index8;
		t3.name = "text8C"+index8;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "text8D"+index8;
		t4.name = "text8D"+index8;
		t4.className = "dob form-control text-uppercase";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		index8++;
		document.getElementById("hiddenval8").value=index8;
		$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	}
	function mydelfunction8(){
		if(index8>2){	
			var myobj=document.getElementById("objectTable8");
			myobj.deleteRow(-1);
			index8--;
			document.getElementById("hiddenval8").value=index8;
		}
	}
</script>


<!-- end of script -->