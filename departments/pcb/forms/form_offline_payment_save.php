<?php
if(isset($_POST["submit_fees"])){
		$token=$_POST["token"];
		$table_name=$formFunctions->getTableName("pcb",$token);
		$form_id=$pcb->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'")->fetch_object()->form_id;	
		if($_POST["payment_mode"]==1){
			echo "<script>
					alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
					window.location.href = 'certificate_payment.php?token=".$token."';
				</script>";
		}else if($_POST["payment_mode"]==0){
				if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
					echo "<script>
						alert('Error in file / You didnot select any option.');
						window.location.href = 'form_offline_fees.php?token=".$token."';
					</script>";
				}else{
					$offline_fees_challan=clean($_POST["offline_challan"]);
					$save_query=$pcb->query("update ".$table_name."_certificates set offline_fees_challan='$offline_fees_challan',is_paid='Y' where form_id='$form_id'") or die($pcb->error);
				if($save_query){
					
					$msgBody="Dear User, We have received your certificate fees reciept. Your certificate will be issued soon";
					$mysqli->query("INSERT INTO notifications (swr_id,notice) VALUES ('$swr_id','".$msgBody."')") or die($mysqli->error);
					/*----------------SEND MAIL-----------------*/
					$user_email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
					$dept_email="esgoa.pollution@gmail.com";
					$sub="Certificate fees is received";
					require_once "../../../mailsending/onlineMail.php";
					send_mail($user_email, $sub, $msgBody);
					echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '../../../user_area/';
				</script>";
				}else{
					echo $pcb->error;
					echo "<script>window.location.href = 'form_offline_fees.php?token=".$token."';</script>";
				}
			}								
		}else{
				echo "<script>
					alert('Invalid Entry.');
					window.location.href = 'form_offline_fees.php?token=".$token."';
				</script>";
		}
}
?>