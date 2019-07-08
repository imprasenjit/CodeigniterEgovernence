<?php
if(isset($_POST['save1a'])){
		
	
			$firm_duration=strtoupper($_POST['firm_duration']);
			if($firm_duration=='L')
            $firm_date_expiry=date('Y-m-d',strtotime($_POST['firm_date_expiry']));
            else
            	$firm_date_expiry='';
			$today=date('Y-m-d h:i');
			

      $sql=$rfs->query("select * from rfs_form1 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
			 
	if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$succ1=$rfs->query("insert into rfs_form1(user_id,firm_duration,firm_date_expiry,save_mode,registration_date)values('$swr_id','$firm_duration','$firm_date_expiry','D','$today')")or die("errorji:".$rfs->error);
			
			$insertid=mysqli_insert_id($rfs);
            
			$suc=$rfs->query("insert into rfs_form1_address(form_id,address_type)values('$insertid','P')")or die("error1:".$rfs->error);
			$suc=$rfs->query("insert into rfs_form1_address(form_id,address_type)values('$insertid','O')")or die("error2:".$rfs->error);
			$su=$rfs->query("insert into  rfs_form1_credentials(form_id)values('$insertid')")or die("error3:".$rfs->error);
			$s=$rfs->query("insert into  rfs_form1_docs(form_id)values('$insertid')")or die("error4:".$rfs->error);
			$s1=$rfs->query("insert into rfs_form1_partners (form_id)values('$insertid')")or die("error5:".$rfs->error);
			
			
	}else{  ////////////table is not empty//////////////
			
			$succ1=$rfs->query("update rfs_form1 set firm_duration='$firm_duration',firm_date_expiry='$firm_date_expiry' where user_id='$swr_id'")or die("error6:".$rfs->error);
					
	}	
		
	if($succ1){
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'form1.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'form1.php?tab=1';
			</script>";
	}						
}
		
		
	//Tab1 complete
	//Tab2 start
	if(isset($_POST['save1b'])){
				
	 $p_po=strtoupper($_POST['p_po']);
	 $p_ps=strtoupper($_POST['p_ps']);
	
	 $o_mouza=strtoupper($_POST['o_mouza']); 
	 $o_land_type=strtoupper($_POST['o_land_type']); 
	 $o_circle=strtoupper($_POST['o_circle']);
	 $o_patta_no=strtoupper($_POST['o_patta_no']);
	 $o_dag_no=strtoupper($_POST['o_dag_no']);
	
	 $o_area_no=strtoupper($_POST['o_area_no']);

	 $o_po=strtoupper($_POST['o_po']);
	 $o_ps=strtoupper($_POST['o_ps']); 
	 $set_option=$_POST['is_different']; 

	$form_id=$rfs->query("select form_id from rfs_form1 where user_id='".$swr_id."'")->fetch_object()->form_id;
	
			$chk=$rfs->query("select * from rfs_form1_address where form_id='$form_id'");
			
			if(mysqli_num_rows($chk)>0){
				    //echo $set_option;exit;
					$suc1=$rfs->query("update rfs_form1_address set po_name='$p_po',ps_name='$p_ps' where form_id='$form_id' and address_type='P'");
				
                    if($set_option=='N')
                    {$suc2=$rfs->query("update rfs_form1_address set land_type='',mouza='',circle='',
					patta_no='',dag_no='',area='',vtc_name='',po_name='',ps_name='',
					dist_name='',pin_code='' where form_id='$form_id' and address_type='O'");}
                    else
                    {$suc2=$rfs->query("update rfs_form1_address set mouza='$o_mouza',land_type='$o_land_type',circle='$o_circle',patta_no='$o_patta_no',dag_no='$o_dag_no',area='$o_area_no',po_name='$o_po',ps_name='$o_ps' where form_id='$form_id' and address_type='O'");}

					if($suc1==true && $suc2==true){
						echo "<script type='text/javascript'>window.location.href='".$_SERVER['REQUEST_URI']."?tab=3';</script>";
					}
				
				
			}else{
        
			}
			
		}
		
		
	
	
	if(isset($_POST['save1c']) || isset($_POST['submit1c'])){
		
		if($iscomplete>0){
			echo "<script>alert('Sorry You allready completed your Registration !! ');</script>";
		}else{
			
			if(!empty($_POST['partner'])){
		 	   $partner=json_encode($_POST['partner']);
			
		}else
		{
			$partner=NULL;
		}
			
			//echo "select form_id from rfs_form1 where user_id='".$user."'";
			$form_id=$rfs->query("select form_id from rfs_form1 where user_id='$swr_id'")->fetch_object()->form_id;
			//echo $form_id; exit;

				$rfs->query("update rfs_form1_partners set partner_details='$partner' where form_id='$form_id' ") or die($rfs->error());
				
			
			echo "<script>window.location.href='".$_SERVER['REQUEST_URI']."?tab=4';</script>";
				
			 
			
		}
		
		
	}
	//TAB ends here
	//TAB4 starts here 
	if(isset($_POST['save1d'])){
		
		$deed_no=protect($_POST['deed_no']);$deed_date=protect($_POST['deed_date']);$deed_reg_place=protect($_POST['deed_reg_place']);
		$t_challan_no=protect($_POST['t_challan_no']);$t_challan_date=$_POST['t_challan_date'];$branch_name=protect($_POST['branch_name']);
		$t_amount=50;
		$iscer=$_POST['piscertificate'];
		if($iscer=='Y'){
		$cerno=$_POST['pcertificateno'];
		$issby=$_POST['pcer_issuedby'];
		$issdate=$_POST['pcer_issuedate'];
		
		}else{
		$cerno='';
		$issby='';
		$issdate='';
		}
		$affid=$_POST['paffidavid'];
		
		$form_id=$rfs->query("select form_id from rfs_form1 where user_id='".$swr_id."'")->fetch_object()->form_id;
		
		$chk=$rfs->query("select * from rfs_form1_credentials where form_id='".$form_id."'");
		
		if(mysqli_num_rows($chk)>0){
			
			
				$suc1=$rfs->query("update rfs_form1_credentials set deed_no='$deed_no',deed_date='$deed_date',deed_place='$deed_reg_place',
				challan_no='$t_challan_no',challan_date='$t_challan_date',
				challan_branch='$branch_name',challan_amount='$t_amount',is_cer='$iscer',cer_no='$cerno',issue_by='$issby',issue_date='$issdate',affidafit='$affid' where form_id='$form_id'");
				$suc3=$rfs->query("update rfs_form1_docs set si_tax_afdt='' where form_id='$form_id'");
				
				
					
				 echo "<script>window.location.href='".$_SERVER['REQUEST_URI']."?tab=5';</script>";
				
			
		}
}  

     if(isset($_POST['submit1e'])){
     	
	   if($iscomplete>0){
			echo "<script>alert('Sorry You already completed your Registration !! ');</script>";
		}else{
			$mfile1=$_POST['mfile10'];
			$mfile2=$_POST['mfile2'];
			$mfile3=$_POST['mfile3'];
			if (isset($_POST['mfile4'])){$mfile4=$_POST['mfile4'];}else{$mfile4="";}
			if (isset($_POST['mfile5'])){$mfile5=$_POST['mfile5'];}else{$mfile5="";}
			if (isset($_POST['mfile6'])){$mfile6=$_POST['mfile6'];}else{$mfile6="";}
			if (isset($_POST['mfile7'])){$mfile7=$_POST['mfile7'];}else{$mfile7="";}
			if (isset($_POST['mfile8'])){$mfile8=$_POST['mfile8'];}else{$mfile8="";}
			if (isset($_POST['mfile9'])){$mfile9=$_POST['mfile9'];}else{$mfile9="";}
			
			
			$form_id=$rfs->query("select form_id from rfs_form1 where user_id='".$swr_id."'")->fetch_object()->form_id;
			
			$chk=$rfs->query("select * from rfs_form1_docs where form_id='".$form_id."'");
			if(mysqli_num_rows($chk)>0){
				
					$suc1=$rfs->query("update rfs_form1_docs set reg_form='$mfile1',partnership_deed='$mfile2',principal_land='$mfile3',
					principal_land_afdt='$mfile4',other_land='$mfile5',other_land_afdt='$mfile6',trade_license='$mfile7',pan_card='$mfile8',
					treasury_challan='$mfile9' where form_id='$form_id'");
					
					if($suc1==true){
						$_SESSION['form_id']=$form_id;
						echo "<script> window.location.href = 'preview.php?token=1'; </script>";
					}
				
			}
		if($mfile1=="SC" || $mfile2=="SC" ||  $mfile3=="SC" ||  $mfile4=="SC" ||  $mfile5=="SC"||  $mfile6=="SC"||  $mfile7=="SC"||  $mfile8=="SC"||  $mfile9=="SC"){
				  
					$save_query=$rfs->query("update rfs_form1 set courier_details='1',sub_date='$today' where form_id='$form_id'") or die($rfs->error);
					
				}else{
					$save_query=$rfs->query("update rfs_form1 set courier_details='' where form_id='$form_id'") or die($rfs->error);
				}	
		}
		if($suc1==true){
						$_SESSION['form_id']=$form_id;
						echo "<script> window.location.href = 'preview.php?token=1'; </script>";
					}
		
	}
	
	if(isset($_POST["proceed1"])){		
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$rfs->query("update rfs_form1 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'form1.php?tab=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
		}
	}		
}
if(isset($_POST["submit1f"])){
	if($_POST["payment_mode"]==1){
		echo "<script>
				alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
				window.location.href = 'form_payment.php?token=rfs';
			</script>";
	}else if($_POST["payment_mode"]==0){
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form1.php?tab=6';
			</script>";
		}else{
			$sql=$rfs->query("select form_id from rfs_form1 where user_id='$swr_id' order by form_id desc LIMIT 1");
			$row=$sql->fetch_array();			
			if($sql->num_rows>0){
				$form_id=$row["form_id"];
				
				$offline_challan=$_POST["offline_challan"];$payment_mode=$_POST["payment_mode"];
				$save_query=$rfs->query("update rfs_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($rfs->error);
				if($save_query){
					$uain=$rfs->query("select uain from rfs_form1 where form_id='$form_id'")->fetch_object()->uain;
					$save_query=$formFunctions->updateSubmit($uain,$form_id);
					$formFunctions->insert_applications($uain);
					$str=$formFunctions->getEmail_str($uain);
					/*----------------SEND MAIL-----------------*/
					$user_email=$formFunctions->get_usermail($swr_id);
					$dept_email="esgoa.rfs@gmail.com";
					
					require_once "rfs_form1_print.php"; 
					$mypdf=uniqid(rand()).".pdf";
					/*---------mpdf logic-----------*/
					require_once "../../../mpdf60/mpdf.php"; 
					$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
					$mpdf->SetDisplayMode('fullpage');
					// 1 or 0 - whether to indent the first level of a list 
					$mpdf->list_indent_first_level = 0;
					$mpdf->WriteHTML($printContents);         
					$mpdf->Output($mypdf,'F');
					require_once "../../../mailsending/sendAttachment.php";		
					$emal=$dept_email.",".$user_email;
					send_attachment($emal,$str,$mypdf);
					unlink($mypdf);
					
					echo "<script>
						alert('Successfully Submitted....');
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=rfs';
					</script>";
				}else{
					echo $rfs->error;
					echo "<script>window.location.href = 'form1.php?tab=6';</script>";
				}
			}else{
				echo "<script>
					alert('Invalid Entry...2.');
					window.location.href = 'form1.php?tab=6';
				</script>";
			}
		}								
	}else{
			echo "<script>
				alert('Invalid Entry..4..');
				window.location.href = 'form1.php?tab=6';
			</script>";
	}
}
           //#######CONDITION SET FOR FORM1-TAB 2  OTHER ADDRESS############

                       
			//######END OF CONDITION SET FORM1-TAB 2  OTHER ADDRESS###############
                      
					
////////////form2 starts///////////

if(isset($_POST['save2a'])){

        $soc_name=strtoupper($_POST["soc_name"]); 
        $rural_dev=strtoupper($_POST['rural_dev']); $s_techno=strtoupper($_POST['s_techno']);
		$health=strtoupper($_POST['health']);$w_c_welfare=strtoupper($_POST['w_c_welfare']);$education=strtoupper($_POST['education']);$s_techno=strtoupper($_POST['s_techno']);
		$art_cul=strtoupper($_POST['art_cul']);
		$sports=strtoupper($_POST['sports']);
		$agriculture=strtoupper($_POST['agriculture']);
		$environment=strtoupper($_POST['environment']);
		$others=strtoupper($_POST['others']);
		if(!empty($_POST['soc_address'])){
			$soc_address=json_encode($_POST['soc_address']);
		}else
		{
			$soc_address=NULL;
		}

 $soc=$rfs->query("select * from rfs_form2 where user_id='$swr_id' and active='1'");
	if(mysqli_num_rows($soc)>0){
		$query=$rfs->query("update rfs_form2 set soc_name='$soc_name',obj_rural='$rural_dev',obj_health='$health',obj_woman='$w_c_welfare',obj_education='$education',obj_arts='$art_cul',obj_sports='$sports',obj_agri='$agriculture',obj_env='$environment',obj_other='$others',obj_science='$s_techno',soc_address='$soc_address' where user_id='$swr_id' ");

 }else{
 	$query=$rfs->query("insert into rfs_form2 (user_id,soc_name,obj_rural,obj_health,obj_woman,obj_education,obj_arts,obj_sports,obj_agri,obj_env,obj_other,obj_science,soc_address) values('$swr_id','$soc_name','$rural_dev','$health','$w_c_welfare','$education','$art_cul','$sports','$agriculture','$environment','$others','$s_techno','$soc_address') ")OR die("Error: ".$rfs->error);
 }
 if($query){
			
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form2.php?tab=2';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=1';
			</script>";
	}				



}

if(isset($_POST['save2b'])){
	$est_date=$_POST['est_date'];
	if(!empty($_POST['partner'])){
		 	  $partner=json_encode($_POST['partner']);
		}else
		{
			$partner=NULL;
		}
$form_id=$rfs->query("select form_id from rfs_form2 where user_id='$swr_id'")->fetch_object()->form_id;
$soc=$rfs->query("select * from rfs_form2_members where form_id='$form_id' ");
	if(mysqli_num_rows($soc)>0){
		$query1=$rfs->query("update rfs_form2_members set est_date='$est_date',partner='$partner'  where form_id='$form_id'")or die("ravi :".$rfs->error);;

 }else{
 	$query1=$rfs->query("insert into rfs_form2_members(form_id, est_date,partner) values ('$form_id','$est_date','$partner')")or die("sunil :".$rfs->error);
 }
if($query1){
			
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form2.php?tab=3';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=2';
			</script>";
	}		
}





if(isset($_POST['save2c'])){
	 $mem_qualification=strtoupper($_POST["memb_qualification"]); $mem_donation=strtoupper($_POST["sub_donation"]);  $mem_fund=strtoupper($_POST["fund_collection"]);  $mem_fund_control=strtoupper($_POST["fund_control"]);  $meeting_proc=strtoupper($_POST["meeting_proc"]);  $meeting_quorum=strtoupper($_POST["meeting_quorum"]);  $election_proc=strtoupper($_POST["election_proc"]);  $eb_desc=strtoupper($_POST["executive_body"]);  $eb_term=strtoupper($_POST["executive_body_term"]);  $reelect_proc=strtoupper($_POST["executive_body_reelection"]);  $eb_meeting=strtoupper($_POST["executive_body_proc"]);  $eb_quorum=strtoupper($_POST["executive_body_quorum"]);  $mem_expulsion=strtoupper($_POST["Expulsion_u_member"]);  $auditor=strtoupper($_POST["auditor_name"]);  $legal_proc=strtoupper($_POST["legel_procedure"]);  $dissolution=strtoupper($_POST["dissolution"]);
	 if(!empty($_POST['gm_meeting'])) {
	 	$gm_meeting=json_encode($_POST['gm_meeting']);
	 }else{
	 	$gm_meeting=NULL;
	 }

$form_id=$rfs->query("select form_id from rfs_form2 where user_id='$swr_id'")->fetch_object()->form_id;
$soc=$rfs->query("select * from rfs_form2_rules where form_id='$form_id' ");
	if(mysqli_num_rows($soc)>0){
		$query1=$rfs->query("update rfs_form2_rules set  mem_qualification='$mem_qualification', mem_donation='$mem_donation', mem_fund='$mem_fund', mem_fund_control='$mem_fund_control', meeting_proc='$meeting_proc', meeting_quorum='$meeting_quorum', election_proc='$election_proc', eb_desc='$eb_desc', eb_term='$eb_term', reelect_proc='$reelect_proc', eb_meeting='$eb_meeting', eb_quorum='$eb_quorum', mem_expulsion='$mem_expulsion', auditor='$auditor', legal_proc='$legal_proc', dissolution='$dissolution', gm_meeting='$gm_meeting'  where form_id='$form_id'");

 }else{
 	$query1=$rfs->query("insert into rfs_form2_rules(form_id, mem_qualification, mem_donation, mem_fund, mem_fund_control, meeting_proc, meeting_quorum, election_proc, eb_desc, eb_term, reelect_proc, eb_meeting, eb_quorum, mem_expulsion, auditor, legal_proc, dissolution, gm_meeting) values ('$form_id','$mem_qualification','$mem_donation','$mem_fund','$mem_fund_control','$meeting_proc','$meeting_quorum','$election_proc','$eb_desc','$eb_term','$reelect_proc','$eb_meeting','$eb_quorum','$mem_expulsion','$auditor','$legal_proc','$dissolution','$gm_meeting')")or die("sunil :".$rfs->error);
 }



if($query1){
			
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form2.php?tab=4';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=3';
			</script>";
	}				



}

if(isset($_POST['save2d'])){

	 if(!empty($_POST['bank'])) {
	 	$bank=json_encode($_POST['bank']);
	 }else{
	 	$bank=NULL;
	 }
	 if(!empty($_POST['treasury'])) {
	 	$treasury=json_encode($_POST['treasury']);
	 }else{
	 	$treasury=NULL;
	 }
	  if(!empty($_POST['photo'])) {
	 	$photo=json_encode($_POST['photo']);
	 }else{
	 	$photo=NULL;
	 }

$form_id=$rfs->query("select form_id from rfs_form2 where user_id='$swr_id'")->fetch_object()->form_id;
$soc=$rfs->query("select * from rfs_form2_rules where form_id='$form_id' ");
	if(mysqli_num_rows($soc)>0){
		$query1=$rfs->query("update rfs_form2_rules set  photo='$photo',treasury_challan='$treasury', bank_details='$bank'  where form_id='$form_id'")or die("error:".$rfs->error);
		echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'form2.php?tab=5';
			</script>";	

 }else{
 	echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=4';
			</script>";
 }

}









	if(isset($_POST["submit2"])) {

	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) ||empty($_POST["mfile6"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2'|| $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3')
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form2.php?tab=5';
			</script>";
	}else{	

		 $file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);

						
		$query=$rfs->query("select form_id from rfs_form2 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);

		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form2.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);		
			
			$query2=$rfs->query("select * from rfs_form2_docs where form_id='$form_id'") or die("Error :". $rfs->error);
			if($query2->num_rows>0){ 
				$save_query=$rfs->query("update rfs_form2_docs set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6' where form_id='$form_id'") or die($rfs->error);	
							
			}else{
				$save_query=$rfs->query("insert into rfs_form2_docs(form_id,file1,file2,file3,file4,file5,file6) values('$form_id','$file1','$file2','$file3','$file4','$file5','$file6') ") or die($rfs->error);	
							
			}

			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"||  $file6=="SC"){
				  
					$save_query=$rfs->query("update rfs_form2 set courier_details='1',sub_date='$today' where form_id='$form_id'") or die($rfs->error);
					
				}else{
					$save_query=$rfs->query("update rfs_form2 set courier_details='' where form_id='$form_id'") or die($rfs->error);
				}	 
		}
      
		if($save_query){
			echo "<script>
			window.location.href = 'preview.php?token=2';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form2.php?tab=5';
			</script>";
		}
	}
}



if(isset($_POST["proceed2"])){
	
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form2.php';
		</script>";
	}else{
	$row=$sql->fetch_array();
	$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];	
	$uain=$formFunctions->create_uain($form_id,'rfs','2');
	if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form2_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);
			if($save_query){
				
				echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form2.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
		}
	}	
}
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
				alert('Successfully Submitted.');
				window.location.href = 'preview.php?token=3';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form3.php';
			</script>";
	}	
}
if(isset($_POST["proceed3"])){
	
	$sql=$rfs->query("select form_id,save_mode from rfs_form3 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the form.');
			window.location.href = 'form3.php';
		</script>";
	}else{
	$row=$sql->fetch_array();
	$form_id=$row["form_id"];$save_mode=$row["save_mode"];	
	$uain=$formFunctions->create_uain($form_id,'rfs','3');
	 if($save_mode=="D"){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form3_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);
			if($save_query){
				
				echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form3.php';
				</script>";
			}
		}
	}	
}

///end of form 3///
////start form4////
if(isset($_POST['save4'])){
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
if(isset($_POST['submit4'])){
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
				alert('Successfully Submitted.');
				window.location.href = 'preview.php?token=4';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form4.php';
			</script>";
	}	
}
if(isset($_POST["proceed4"])){
	
	$sql=$rfs->query("select form_id,save_mode from rfs_form4 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the form.');
			window.location.href = 'form4.php';
		</script>";
	}else{
	$row=$sql->fetch_array();
	$form_id=$row["form_id"];$save_mode=$row["save_mode"];	
	$uain=$formFunctions->create_uain($form_id,'rfs','4');
	 if($save_mode=="D"){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form4_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);
			if($save_query){
				
				echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form4.php';
				</script>";
			}
		}
	}	
}
	?>