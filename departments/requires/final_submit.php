<?php

require_once "login_session.php";
$ci->load->helper('get_uain_details');
if (isset($_SESSION["form"]) && is_numeric($_SESSION["form"]) && $_SESSION["form"] > 0 && isset($_SESSION["dept"]) && strlen($_SESSION["dept"]) > 0 && !preg_match('/[^A-Za-z]/', $_SESSION["dept"])) {
    $dept = $_SESSION["dept"];
    $form = $_SESSION["form"];
    $table_name = getTableName($dept, $form);
    $_SESSION["sub_dept_id"] = $sub_dept_id = $formFunctions->get_sub_dept_id($dept);


	
	
    $query = $formFunctions->executeQuery($dept, "select form_id,user_id,save_mode,uain,payment_mode,courier_details,uploaded_documents from " . $table_name . " where user_id='$swr_id' and active='1' and save_mode!='C' ORDER BY form_id DESC");
    if ($query->num_rows == 0) { 
	
        echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'preview.php?form=" . $form . "&dept=" . $dept . "';
			</script>";
    } else {
		
	
        $row = $query->fetch_assoc();
        $form_id = $row["form_id"];
        $unit_id = $row["user_id"];
        $save_mode = $row["save_mode"];
        $courier_details = $row["courier_details"];
        $uploaded_documents_json = $row["uploaded_documents"];
        $uain = $row["uain"];
        $payment_mode = $row["payment_mode"];
        $courier_section_sc = 0;
        if (!empty($uploaded_documents_json)) {
            $uploaded_documents = json_decode($uploaded_documents_json, true);
            foreach ($uploaded_documents["documents"] as $key => $values) {
                if (in_array("SC", $values)) {
                    $courier_section_sc = 1;
                }
            }
        }

        $payment_required_query = "select payment_required from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id'";
        $payment_required_results = $formFunctions->executeQuery("cms", $payment_required_query);
        if ($payment_required_results->num_rows > 0) {
            $payment_required_row = $payment_required_results->fetch_object();
            $_SESSION["payment_required"] = $payment_required = $payment_required_row->payment_required;
        } else {
            $payment_required = "";
        }
		
		//echo $courier_details."------".$courier_section_sc;
		
        if ($payment_required == 1 && $payment_mode == "") {
			//die("2");
            if ($uain == "")
                $uain = $formFunctions->create_uain($form_id, $dept, $form);

            $query = "update " . $table_name . " set sub_date='$today',uain='$uain',save_mode='P',received_date='$today' where form_id='$form_id'";
            $save_query = $formFunctions->executeQuery($dept, $query);
            if ($save_query) {
                echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?form=" . $form . "&dept=" . $dept . "';
				</script>";
            } else {
                echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?form=" . $form . "&dept=" . $dept . "';
				</script>";
            }
        } else if (($courier_details == 1 || $courier_section_sc == 1) && strlen($courier_details) < 2) {
			
			
            if ($uain == ""){
				$uain = $formFunctions->create_uain($form_id, $dept, $form);
			}
                
            $query = "update " . $table_name . " set sub_date='$today',uain='$uain',save_mode='F',received_date=NULL where form_id='$form_id'";
            $save_query = $formFunctions->executeQuery($dept, $query);
            if ($save_query) {
                echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'courier_details_new.php?form=" . $form . "&dept=" . $dept . "';
				</script>";
            } else {
                echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?form=" . $form . "&dept=" . $dept . "';
				</script>";
            }
        } else {
			
            if ($uain != "") {
				
                $update_form_table_query = "update " . $table_name . " set sub_date='$today' where user_id='$swr_id' and active='1' and form_id='$form_id'";
				
            } else {
				
                $uain = $formFunctions->create_uain($form_id, $dept, $form);
                $update_form_table_query = "update " . $table_name . " set uain='$uain',sub_date='$today' where user_id='$swr_id' and active='1' and form_id='$form_id'";
            }
			
            $save_query = $formFunctions->executeQuery($dept, $update_form_table_query);
            if ($save_query) {
				
                $submitted = $formFunctions->insert_applications($uain);
                if ($submitted) {
					
					
                    $update_form_table_query = $formFunctions->executeQuery($dept, "update " . $table_name . " set save_mode='C' where user_id='$swr_id' and active='1' and form_id='$form_id'");
                    $str = $formFunctions->getEmail_str($uain);
                    /////////////////////////////SEND MAIL////////////////////////////////
                    //$user_email=$formFunctions->get_usermail($swr_id);
                    //$dept_email=$formFunctions->getDeptEmail($dept);
                    //require_once "sdc_form21_print.php"; 
                    require_once "../../" . $formFunctions->get_printpath($dept, $form);
					
                    $mypdf = "Acknowledgement-" . $form_id . ".pdf";
                    $ci->load->library('Tcpdflib');

                    ob_end_clean();

                    $pdf = new Tcpdflib('P', 'mm', 'A4', true, 'UTF-8', false);
                    $pdf->SetTitle($mypdf);
                    $pdf->AddPage();
                    $printContents = $printContents . '</body></html>';
                    $pdf->writeHTML(utf8_encode($printContents), true, false, true, false, '');
                    //$pdf->Output('storage/'.$mypdf, 'I');
                    //ob_end_flush();
                    $pdf->Output("eodbci/departments/requires/pdfs/" . $mypdf, 'F');


                    //require_once "../../../eodb/mailsending/sendAttachment.php";
                    //$emal=$dept_email.",".$user_email;
                    //send_attachment($user_email, $str, $mypdf);
					
					$ci->load->helper('sendmail');
					sendmail($user_email,'Acknowledgement - '.$uain, $str, $mypdf);
					
                    unlink("pdfs/" . $mypdf);		

                    echo "<script>
						alert('Successfully Submitted....');
						window.location.href = 'acknowledgement.php?dept=" . $dept . "&form=" . $form . "';
					</script>";
                } else {
					
                    echo "<script>alert('Something went wrong !!!');window.location.href = '../../users/'</script>";
                }
            } else {
				
                echo "<script>alert('Something went wrong !!!');window.location.href = '../../users/'</script>";
            }
        }
    }
} else {
    echo "<script>alert('Something went wrong !!!');window.location.href = '../../users/'</script>";
}
?>