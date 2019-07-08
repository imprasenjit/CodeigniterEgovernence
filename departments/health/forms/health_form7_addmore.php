<?php
if(isset($form_id)){
	$part1=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t1 WHERE form_id='$form_id'");
	$num1=$part1->num_rows;
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
<script type="text/javascript">
		var index=<?php echo $num1;?>;
		function addMore1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "textA"+index;
		t1.name = "textA"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "textB"+index;
		t2.name = "textB"+index;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "textC"+index;
		t3.name = "textC"+index;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
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
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txtC"+index2;
		t3.name = "txtC"+index2;
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
        t1.id = "taA"+index3;
		t1.name = "taA"+index3;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index3;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "taB"+index3;
		t2.name = "taB"+index3;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "taC"+index3;
		t3.name = "taC"+index3;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		
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
<!-- end of script -->
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
        t1.id = "tbA"+index4;
		t1.name = "tbA"+index4;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index4;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tbB"+index4;
		t2.name = "tbB"+index4;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);	
        var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tbC"+index4;
		t3.name = "tbC"+index4;
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
		var index5=<?php echo $num5;?>;
		function addMore5(){
		var myobj=document.getElementById("objectTable5");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "txxA"+index5;
		t1.name = "txxA"+index5;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index5;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txxB"+index5;
		t2.name = "txxB"+index5;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "txxC"+index5;
		t3.name = "txxC"+index5;
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
        t1.id = "tdA"+index6;
		t1.name = "tdA"+index6;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index6;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tdB"+index6;
		t2.name = "tdB"+index6;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tdC"+index6;
		t3.name = "tdC"+index6;
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
        t1.id = "teA"+index7;
		t1.name = "teA"+index7;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index7;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "teB"+index7;
		t2.name = "teB"+index7;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "teC"+index7
		t3.name = "teC"+index7;
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
        t1.id = "tfA"+index8;
		t1.name = "tfA"+index8;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index8;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tfB"+index8;
		t2.name = "tfB"+index8;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tfC"+index8;
		t3.name = "tfC"+index8;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
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
</script>
<?php
if(isset($form_id)){
	$part9=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t9 WHERE form_id='$form_id'");
	$num9=$part9->num_rows;
}else{
	$num9=0;
}
if($num9>0){
	$hiddenval9=$num9+1;
	$num9=$num9+1;
}else{
	$hiddenval9=2;
	$num9=2;
}
?>
<script type="text/javascript">
		var index9=<?php echo $num9;?>;
		function addMore9(){
		var myobj=document.getElementById("objectTable9");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tgA"+index9;
		t1.name = "tgA"+index9;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index9;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tgB"+index9;
		t2.name = "tgB"+index9;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tgC"+index9;
		t3.name = "tgC"+index9;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index9++;
		document.getElementById("hiddenval9").value=index9;
	}
	function mydelfunction9(){
		if(index9>2){	
			var myobj=document.getElementById("objectTable9");
			myobj.deleteRow(-1);
			index9--;
			document.getElementById("hiddenval9").value=index9;
		}
	}
</script>

<?php
if(isset($form_id)){
	$part10=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t10 WHERE form_id='$form_id'");
	$num10=$part10->num_rows;
}else{
	$num10=0;
}
if($num10>0){
	$hiddenval10=$num10+1;
	$num10=$num10+1;
}else{
	$hiddenval10=2;
	$num10=2;
}
?>
<script type="text/javascript">
		var index10=<?php echo $num10;?>;
		function addMore10(){
		var myobj=document.getElementById("objectTable10");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "thA"+index10;
		t1.name = "thA"+index10;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index10;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "thB"+index10;
		t2.name = "thB"+index10;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "thC"+index10;
		t3.name = "thC"+index10;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index10++;
		document.getElementById("hiddenval10").value=index10;
	}
	function mydelfunction10(){
		if(index10>2){	
			var myobj=document.getElementById("objectTable10");
			myobj.deleteRow(-1);
			index10--;
			document.getElementById("hiddenval10").value=index10;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part11=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t11 WHERE form_id='$form_id'");
	$num11=$part11->num_rows;
}else{
	$num11=0;
}
if($num11>0){
	$hiddenval11=$num11+1;
	$num11=$num11+1;
}else{
	$hiddenval11=2;
	$num11=2;
}
?>
<script type="text/javascript">
		var index11=<?php echo $num11;?>;
		function addMore11(){
		var myobj=document.getElementById("objectTable11");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "taaA"+index11;
		t1.name = "taaA"+index11;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index11;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "taaB"+index11;
		t2.name = "taaB"+index11;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "taaC"+index11;
		t3.name = "taaC"+index11;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index11++;
		document.getElementById("hiddenval11").value=index11;
	}
	function mydelfunction11(){
		if(index11>2){	
			var myobj=document.getElementById("objectTable11");
			myobj.deleteRow(-1);
			index11--;
			document.getElementById("hiddenval11").value=index11;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part12=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t12 WHERE form_id='$form_id'");
	$num12=$part12->num_rows;
}else{
	$num12=0;
}
if($num12>0){
	$hiddenval12=$num12+1;
	$num12=$num12+1;
}else{
	$hiddenval12=2;
	$num12=2;
}
?>
<script type="text/javascript">
		var index12=<?php echo $num12;?>;
		function addMore12(){
		var myobj=document.getElementById("objectTable12");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tabA"+index12;
		t1.name = "tabA"+index12;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index12;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tabB"+index12;
		t2.name = "tabB"+index12;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tabC"+index12;
		t3.name = "tabC"+index12;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index12++;
		document.getElementById("hiddenval12").value=index12;
	}
	function mydelfunction12(){
		if(index12>2){	
			var myobj=document.getElementById("objectTable12");
			myobj.deleteRow(-1);
			index12--;
			document.getElementById("hiddenval12").value=index12;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part13=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t13 WHERE form_id='$form_id'");
	$num13=$part13->num_rows;
}else{
	$num13=0;
}
if($num13>0){
	$hiddenval13=$num13+1;
	$num13=$num13+1;
}else{
	$hiddenval13=2;
	$num13=2;
}
?>
<script type="text/javascript">
		var index13=<?php echo $num13;?>;
		function addMore13(){
		var myobj=document.getElementById("objectTable13");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tkA"+index13;
		t1.name = "tkA"+index13;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index13;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tkB"+index13;
		t2.name = "tkB"+index13;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tkC"+index13;
		t3.name = "tkC"+index13;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index13++;
		document.getElementById("hiddenval13").value=index13;
	}
	function mydelfunction13(){
		if(index13>2){	
			var myobj=document.getElementById("objectTable13");
			myobj.deleteRow(-1);
			index13--;
			document.getElementById("hiddenval13").value=index13;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part14=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t14 WHERE form_id='$form_id'");
	$num14=$part14->num_rows;
}else{
	$num14=0;
}
if($num14>0){
	$hiddenval14=$num14+1;
	$num14=$num14+1;
}else{
	$hiddenval14=2;
	$num14=2;
}
?>
<script type="text/javascript">
		var index14=<?php echo $num14;?>;
		function addMore14(){
		var myobj=document.getElementById("objectTable14");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tlA"+index14;
		t1.name = "tlA"+index14;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index14;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tlB"+index14;
		t2.name = "tlB"+index14;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tlC"+index14;
		t3.name = "tlC"+index14;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index14++;
		document.getElementById("hiddenval14").value=index14;
	}
	function mydelfunction14(){
		if(index14>2){	
			var myobj=document.getElementById("objectTable14");
			myobj.deleteRow(-1);
			index14--;
			document.getElementById("hiddenval14").value=index14;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part15=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t15 WHERE form_id='$form_id'");
	$num15=$part15->num_rows;
}else{
	$num15=0;
}
if($num15>0){
	$hiddenval15=$num15+1;
	$num15=$num15+1;
}else{
	$hiddenval15=2;
	$num15=2;
}
?>
<script type="text/javascript">
		var index15=<?php echo $num15;?>;
		function addMore15(){
		var myobj=document.getElementById("objectTable15");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tmA"+index15;
		t1.name = "tmA"+index15;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index15;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tmB"+index15;
		t2.name = "tmB"+index15;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tmC"+index15;
		t3.name = "tmC"+index15;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index15++;
		document.getElementById("hiddenval15").value=index15;
	}
	function mydelfunction15(){
		if(index15>2){	
			var myobj=document.getElementById("objectTable15");
			myobj.deleteRow(-1);
			index15--;
			document.getElementById("hiddenval15").value=index15;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part16=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t16 WHERE form_id='$form_id'");
	$num16=$part16->num_rows;
}else{
	$num16=0;
}
if($num16>0){
	$hiddenval16=$num16+1;
	$num16=$num16+1;
}else{
	$hiddenval16=2;
	$num16=2;
}
?>
<script type="text/javascript">
		var index16=<?php echo $num16;?>;
		function addMore16(){
		var myobj=document.getElementById("objectTable16");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "tnA"+index16;
		t1.name = "tnA"+index16;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index16;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "tnB"+index16;
		t2.name = "tnB"+index16;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "tnC"+index16;
		t3.name = "tnC"+index16;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index16++;
		document.getElementById("hiddenval16").value=index16;
	}
	function mydelfunction16(){
		if(index16>2){	
			var myobj=document.getElementById("objectTable16");
			myobj.deleteRow(-1);
			index16--;
			document.getElementById("hiddenval16").value=index16;
		}
	}
</script>
<?php
if(isset($form_id)){
	$part17=$formFunctions->executeQuery($dept,"SELECT id FROM ".$table_name."_t17 WHERE form_id='$form_id'");
	$num17=$part17->num_rows;
}else{
	$num17=0;
}
if($num17>0){
	$hiddenval17=$num17+1;
	$num17=$num17+1;
}else{
	$hiddenval17=2;
	$num17=2;
}
?>
<script type="text/javascript">
		var index17=<?php echo $num17;?>;
		function addMore17(){
		var myobj=document.getElementById("objectTable17");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "toA"+index17;
		t1.name = "toA"+index17;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="20";	
		t1.readOnly=true;
		t1.value=index17;
		cell1.appendChild(t1);
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "toB"+index17;
		t2.name = "toB"+index17;
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "toC"+index17;
		t3.name = "toC"+index17;
		t3.className = "form-control text-uppercase";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
	
		index17++;
		document.getElementById("hiddenval17").value=index17;
	}
	function mydelfunction17(){
		if(index17>2){	
			var myobj=document.getElementById("objectTable17");
			myobj.deleteRow(-1);
			index17--;
			document.getElementById("hiddenval17").value=index17;
		}
	}
</script>