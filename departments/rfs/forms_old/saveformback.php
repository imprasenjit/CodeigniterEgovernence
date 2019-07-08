<?php
if(isset($_POST["save8"])){		
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"])|| isset($_POST["b_mouza"])|| isset($_POST["b_circle"])|| isset($_POST["b_patta"])||isset($_POST["b_dag"])||isset($_POST["b_area"])||isset($_POST["b_locality"])||isset($_POST["b_village"])isset($_POST["b_postoffice"])||isset($_POST["b_policestation"])||isset($_POST["b_district"])||isset($_POST["b_pincode1"])||isset($_POST["b_mobile"])||isset($_POST["b_email1"])){
		$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"]
		$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];
	
	$sql=$rfs->query("select form_id from rfs_form8 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form8(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety,b_mouza,b_circle,b_patta,b_dag,b_area,b_locality,b_village,b_postoffice,b_policestation,b_district,b_pincode1,b_mobile,b_email1) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station''$b_mouza','$b_circle','$b_patta','$b_dag','$b_area','$b_locality','$b_village','$b_postoffice',
			'$b_policestation','$b_district','$b_pincode1','$b_mobile','$b_email1) OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form12 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,propsociety='$propsociety' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','12'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'form12.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form12.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit12"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form12.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
		$query=$rfs->query("select form_id from rfs_form12 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ){
				$save_query=$rfs->query("update rfs_form12 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form12 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form12.php?tab=2';
				</script>";
			}							
		}
	}
}