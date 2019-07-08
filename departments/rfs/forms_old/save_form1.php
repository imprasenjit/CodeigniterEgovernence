<?php
if(isset($_POST['save3'])){
    $present_name=strtoupper($_POST['present_name']);$present_address=strtoupper($_POST['present_address']);
	$date_alteration=$_POST['date_alteration'];
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  $sql=$rfs->query("select * from rfs_form3 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form3(user_id,form_id,date_alteration,present_name,present_address,partner)values('$swr_id','$form_id','$date_alteration','$present_name','$present_address','$partner') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form3 set date_alteration='$date_alteration',present_name='$present_name',present_address='$present_address',partner='$partner'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','3'); //fire-- dept name and 1 -- form no 
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form3.php';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form3.php';
			</script>";
	}	
}if(isset($_POST['submit3'])){
    $present_name=strtoupper($_POST['present_name']);$present_address=strtoupper($_POST['present_address']);
	$date_alteration=$_POST['date_alteration'];
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  $sql=$rfs->query("select * from rfs_form3 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form3(user_id,form_id,date_alteration,present_name,present_address,partner)values('$swr_id','$form_id','$date_alteration','$present_name','$present_address','$partner') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form3 set date_alteration='$date_alteration',present_name='$present_name',present_address='$present_address',partner='$partner'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','3'); //fire-- dept name and 1 -- form no 
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=3';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form3.php';
			</script>";
	}	
}


if(isset($_POST['save4'])||isset($_POST['submit4'])){
     $date_open=$_POST["date_open"];$date_close=$_POST["date_close"];$remark=$_POST["remark"];$business_open=$_POST["business_open"]; $regn_no=$_POST["regn_no"];
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  $sql=$rfs->query("select * from rfs_form4 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form4(user_id,form_id,date_open,date_close,remark,business_open,partner,regn_no)values('$swr_id','$form_id','$date_open','$date_close','$remark','$business_open','$partner','$regn_no') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form4 set date_open='$date_open',date_close='$date_close',remark='$remark',business_open='$business_open',partner='$partner',regn_no='$regn_no'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','4');  
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form4.php';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form4.php';
			</script>";
	}	
}
if(isset($_POST['save5'])){
     $reg_no=$_POST["reg_no"];
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  
	  if(!empty($_POST['partner_address'])) {
	 	 $partner_address=json_encode($_POST['partner_address']); 
	  }else{
	  $partner_address=NULL;}
	  $sql=$rfs->query("select * from rfs_form5 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form5(user_id,form_id,reg_no,partner,partner_address)values('$swr_id','$form_id','$reg_no','$partner','$partner_address') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form5 set reg_no='$reg_no',partner='$partner',partner_address='$partner_address'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','5');  
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form5.php';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form5.php';
			</script>";
	}	
}
if(isset($_POST['save6'])){
     
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  
	  if(!empty($_POST['partner_address'])) {
	 $partner_address=json_encode($_POST['partner_address']);
	  }else{
	  $partner_address=NULL;}
	  $sql=$rfs->query("select * from rfs_form6 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form6(user_id,form_id,partner,partner_address)values('$swr_id','$form_id','$partner','$partner_address') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form6 set partner='$partner',partner_address='$partner_address'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','6');  
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form6.php';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form6.php';
			</script>";
	}	
}
if(isset($_POST['save7'])){
     $dissolved_on=$_POST["dissolved_on"];
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  $sql=$rfs->query("select * from rfs_form7 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form7(user_id,form_id,dissolved_on,partner)values('$swr_id','$form_id','$dissolved_on','$partner') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form7 set dissolved_on='$dissolved_on',partner='$partner'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','7');  
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form7.php';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form7.php';
			</script>";
	}	
}
if(isset($_POST['save8'])){
     $regn_no=$_POST["regn_no"];
    if(!empty($_POST['partner'])) {
	 	 $partner=json_encode($_POST['partner']);
		
	  }else{
	  $partner=NULL;}
	  $sql=$rfs->query("select * from rfs_form8 where user_id='$swr_id'");
	  if(mysqli_num_rows($sql)<1)
	  {
	  $sql=$rfs->query("insert into rfs_form8(user_id,form_id,regn_no,partner)values('$swr_id','$form_id','$regn_no','$partner') ")or die("sunil:".$rfs->error);
	  }
	  else{
		  $sql=$rfs->query("update rfs_form8 set regn_no='$regn_no',partner='$partner'")or die("error1".$rfs->error);
	  }
	  if($sql){
			$formFunctions->insert_incomplete_forms('rfs','8');  
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form8.php';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form8.php';
			</script>";
	}	
}
?>