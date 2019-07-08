<?php

function get_legal_entity($l_o_business) {
    if ($l_o_business == "PP") {
        $l_o_business_val = "Partnership Firm";
        $l_o_business_name = "Partners";
    } else if ($l_o_business == "LLP") {
        $l_o_business_val = "Limited Liability Partnership";
        $l_o_business_name = "Partners";
    } else if ($l_o_business == "PTLC") {
        $l_o_business_val = "Private Limited Company";
        $l_o_business_name = "Directors";
    } else if ($l_o_business == "PBLC") {
        $l_o_business_val = "Public Limited Company";
        $l_o_business_name = "Directors";
    } else if ($l_o_business == "CS") {
        $l_o_business_val = "Cooperative Society";
        $l_o_business_name = "Members";
    } else if ($l_o_business == "SOC") {
        $l_o_business_val = "Society";
        $l_o_business_name = "Members";
    } else if ($l_o_business == "AP") {
        $l_o_business_val = "Association of Persons";
        $l_o_business_name = "Members";
    } else if ($l_o_business == "T") {
        $l_o_business_val = "Trust";
        $l_o_business_name = "Trusties";
    } else if ($l_o_business == "C") {
        $l_o_business_val = "Club";
        $l_o_business_name = "Members";
    } else if ($l_o_business == "H") {
        $l_o_business_val = "Hindu Undivided Family";
        $l_o_business_name = "Members";
    } else if ($l_o_business == "PSU") {
        $l_o_business_val = "Public Sector Undertaking";
        $l_o_business_name = "Members";
    } else if ($l_o_business == "CG") {
        $l_o_business_val = "Central Government";
        $l_o_business_name = "Authorised Signatory";
    } else if ($l_o_business == "SG") {
        $l_o_business_val = "State Government";
        $l_o_business_name = "Authorised Signatory";
    } else {
        $l_o_business_val = "Proprietorship";
        $l_o_business_name = "Proprietor";
    }
    return $l_o_business_val . "/" . $l_o_business_name;
}

class Form_functions extends DbConnect {

    function __construct() {
        
    }

    public function getAssamSarkarLogo($server_url) {
        $assam_govt_logo = '<img style="height:auto;width:60px" src="' . $server_url . 'public/imgs/assam.png" title="Govt. of Assam"><br/>';
        return $assam_govt_logo;
    }

    public function get_sub_dept_id($dept) {
        $query = "SELECT id FROM SubDepartment WHERE dept_code='$dept'";
        $qry = $this->executeQuery("dicc", $query);
        if ($qry->num_rows > 0) {
            $id = $qry->fetch_object()->id;
        } else {
            $id = "";
        }
        return $id;
    }

    public function get_formName($dept, $form) {

        $sub_dept_id = $this->get_sub_dept_id($dept);
        $form_name_query = $this->executeQuery("cms", "select service_name from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id'") or die($cms->error);
        if ($form_name_query->num_rows > 0) {
            $form_name = $form_name_query->fetch_object()->service_name;
        } else {
            $form_name = "";
        }
        return $form_name;
    }

    public function send_sms($msisdn, $msg_string) {
        if ($msisdn != 0 && is_numeric($msisdn) && strlen($msisdn) == 10) {
            $save_msg = $msg_string;
            $msg_string = urlencode($msg_string);
            $msisdn = urlencode($msisdn);

            //$rsp=file_get_contents("http://103.8.249.55/smsgwam/form_/send_api_edb_get.php?username=edbgov&password=edbdb@123&groupname=EDBGOV&to=$msisdn&msg=$msg_string");
            $rsp = 1;

            if ($rsp) {
                $file = $_SERVER["DOCUMENT_ROOT"] . '/eodb/mobile_sms_log_file.txt';
                $write_text = PHP_EOL . "
				
				DATETIME : " . date("d-m-Y H:i:s") . "  Mobile Number : " . $msisdn . "   Message : " . $save_msg . PHP_EOL;
                file_put_contents($file, $write_text, FILE_APPEND | LOCK_EX);

                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function insert_incomplete_forms($dept, $form) {
        global $swr_id;
        $today = date("Y-m-d");
        $values = $this->executeQuery("dicc", "select id from incomplete_forms where swr_id='$swr_id' and dept_name='$dept' and form_no='$form'");
        $numRows = $values->num_rows;
        if ($numRows == 0) {
            $this->executeQuery("dicc", "insert into incomplete_forms(swr_id,dept_name,form_no,date) values('$swr_id','$dept','$form','$today');");
        }
        return true;
    }

    public function get_printpath($dept, $form) {

        switch ($dept) {
            case "labour":
                if ($form < 6 || $form == 13) {
                    $form_path = "/forms/lc_reg_form" . $form . "_print.php";
                } else if ($form > 5 && $form < 9) {
                    $form_path = "/forms/lc_license_form" . $form . "_print.php";
                } else if ($form > 8 && $form < 13) {
                    $form_path = "/forms/lc_renewal_form" . $form . "_print.php";
                } else {
                    $form_path = "/forms/labour_form" . $form . "_print.php";
                }
                break;
            case "pcb": switch ($form) {
                    case 1: $form_path = "/forms/form1_print.php";
                        break;
                    case 2: $form_path = "/forms/form2_print.php";
                        break;
                    default :$form_path = $form_path = "/forms/pcb_form" . $form . "_print.php";
                        break;
                }
                break;
            case "sdc":
                if ($form == 27 || $form == 28 || $form == 29 || $form == 30 || $form == 33 || $form == 34) {

                    $form_path = "/forms/sdc_retention_retail_print.php";
                } else if ($form == 35 || $form == 36 || $form == 38 || $form == 39 || $form == 40 || $form == 41 || $form == 42 || $form == 44 || $form == 45 || $form == 47 || $form == 48 || $form == 51) {

                    $form_path = "/forms/sdc_retention_manufacture_print.php";
                } else {
                    $form_path = "/forms/" . $dept . "_form" . $form . "_print.php";
                }
                break;
            default :$form_path = "/forms/" . $dept . "_form" . $form . "_print.php";
                break;
        }
        $path = "departments/" . $dept . $form_path;
        return $path;
    }

    public function get_form_path($dept, $form) {
        global $server_url;

        switch ($dept) {
            case "labour":
                if ($form < 6 || $form == 13) {
                    $form_path = "/forms/lc_reg_form" . $form . ".php";
                } else if ($form < 9) {
                    $form_path = "/forms/lc_license_form" . $form . ".php";
                } else {
                    $form_path = "/forms/lc_renewal_form" . $form . ".php";
                }
                break;
            case "pcb": switch ($form) {
                    case 1: $form_path = "/forms/form1.php";
                        break;
                    case 2: $form_path = "/forms/form2.php";
                        break;
                    default :$form_path = $form_path = "/forms/pcb_form" . $form . ".php";
                        break;
                }
                break;
            case "sdc":
                if ($form == 27 || $form == 28 || $form == 29 || $form == 30 || $form == 33 || $form == 34) {

                    $form_path = "/forms/sdc_retention_retail.php";
                } else if ($form == 35 || $form == 36 || $form == 38 || $form == 39 || $form == 40 || $form == 41 || $form == 42 || $form == 44 || $form == 45 || $form == 47 || $form == 48 || $form == 51) {

                    $form_path = "/forms/sdc_retention_manufacture.php";
                } else {
                    $form_path = "/forms/" . $dept . "_form" . $form . ".php";
                }
                break;
            default :$form_path = "/forms/" . $dept . "_form" . $form . ".php";
                break;
        }
        $path = "departments/" . $dept . $form_path;
        return $path;
    }

    public function get_preview_path($dept, $form) {
        global $server_url;

        switch ($dept) {
            case "labour":
                if ($form < 6 || $form == 13) {
                    $form_path = "/forms/lc_reg_form" . $form . "_print.php";
                } else if ($form > 5 && $form < 9) {
                    $form_path = "/forms/lc_license_form" . $form . "_print.php";
                } else if ($form > 8 && $form < 13) {
                    $form_path = "/forms/lc_renewal_form" . $form . "_print.php";
                } else {
                    $form_path = "/forms/labour_form" . $form . "_print.php";
                }
                break;
            case "pcb": switch ($form) {
                    case 1: $form_path = "/forms/form1_print.php";
                        break;
                    case 2: $form_path = "/forms/form2_print.php";
                        break;
                    default :$form_path = $form_path = "/forms/pcb_form" . $form . "_print.php";
                        break;
                }
                break;
            case "sdc":
                if ($form == 27 || $form == 28 || $form == 29 || $form == 30 || $form == 33 || $form == 34) {

                    $form_path = "/forms/sdc_retention_retail_print.php";
                } else if ($form == 35 || $form == 36 || $form == 38 || $form == 39 || $form == 40 || $form == 41 || $form == 42 || $form == 44 || $form == 45 || $form == 47 || $form == 48 || $form == 51) {

                    $form_path = "/forms/sdc_retention_manufacture_print.php";
                } else {
                    $form_path = "/forms/" . $dept . "_form" . $form . "_print.php";
                }
                break;
            default :$form_path = "/forms/" . $dept . "_form" . $form . "_print.php";
                break;
        }
        $path = "departments/" . $dept . $form_path;
        return $path;
    }
    public function get_usermail($swr_id){
	
		$email=$this->executeQuery("dicc","select a.email from users as a LEFT JOIN singe_window_registration as b ON b.user_id=a.id where b.id='$swr_id'")->fetch_object()->email;
		
		return $email;
	}
    public function fetch_swr($swr_id) {
        $row = false;
        $sql = $this->executeQuery("dicc", "select * from singe_window_registration a, singe_window_registration_part1 b where a.id='$swr_id' and b.swr_id='$swr_id'");
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
        }
        return $row;
    }

    public function print_upload_payment_details($results) {

        $printContents = "";
        $upload = "";
        if (!empty($results["uploaded_documents"])) {

            $printContents = $printContents . '
			<tr>
				<td colspan="2" height="50px"><h4>List of documents to be enclosed/submitted :</h4></td>
			</tr>';

            $uploaded_documents_json = $results["uploaded_documents"];
            $uploaded_documents = json_decode($uploaded_documents_json, true);

            foreach ($uploaded_documents["documents"] as $values) {
                $file_value = $this->get_uploadFile($values[1]);
                $printContents = $printContents . '

				<tr>
					<td>' . $values[0] . '</td>
					<td>' . $file_value . '</td>
				</tr>';
            }
        }

        if (!empty($results["courier_details"]) && $results["courier_details"] != 1) {

            $courier_details = json_decode($results["courier_details"]);
            $courier_details_cn = $courier_details->cn;
            $courier_details_rn = $courier_details->rn;
            $courier_details_dt = $courier_details->dt;

            $printContents = $printContents . '
			 <tr>
				<td colspan="2" height="50px"><h4>Courier Details :</h4></td>
			</tr>
			<tr>
				<td width="50%">Name of Courier Service </td><td>' . strtoupper($courier_details_cn) . '</td>
			</tr>
			<tr><td>Ref. No. / Consignment No. </td><td>' . strtoupper($courier_details_rn) . '</td></tr>
			<tr><td>Dispatch Date </td><td>' . strtoupper($courier_details_dt) . '</td></tr>
			';
        }
        if ($results["payment_mode"] == 0) {
            $payment_mode = "OFFLINE";
            $offline_challan = "<a href='" . $upload . $results['offline_challan'] . "' target='_blank'>Download Challan/DD</a>";
        } else {
            $payment_mode = "ONLINE";
        }
        if ($results["payment_mode"] != NULL) {
            $printContents = $printContents . '
                    <tr>		    
		<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr><td height="50px" colspan="2"><h4>Payment Details :</h4></td></tr>
			<tr><td width="50%">Payment Mode :</td><td>' . strtoupper($payment_mode) . '</td></tr>';
            if ($results["payment_mode"] == 0) {
                $printContents = $printContents . '
				<tr>
					<td width="50%" valign="top">Demand Draft/Payment Reciept :</td>
					<td>' . $offline_challan . '<br/><br/>' . $this->offline_payment_details($results["uain"]) . '</td>
				</tr>';
            } else {
                $printContents = $printContents . $this->online_payment_details($results["uain"]);
            }
            $printContents = $printContents . '</table>		
			</td>
		  </tr>';
        }
        return $printContents;
    }

    public function get_uainDept($uian) {
        $uian_type = Array();
        $uian_type = explode("/", $uian, 3);
        $dept_code = $uian_type[0];
        $dept = $this->get_db_name($dept_code);
        return $dept;
    }

    public function get_db_name($dept_code) {
        switch ($dept_code) {
            case "LEDF":$dept = "factory";
                break;
            case "LEDB":$dept = "boiler";
                break;
            case "LEDL":$dept = "labour";
                break;
            case "DEFT":$dept = "forest";
                break;
            case "DOT":$dept = "tourism";
                break;
            case "RCS":$dept = "society";
                break;
            case "DP":$dept = "power";
                break;
            case "EXD":$dept = "excise";
                break;
            case "GJB":$dept = "jalboard";
                break;
            case "WS":$dept = "water";
                break;
            case "DME":$dept = "dmedu";
                break;
            case "DSE":$dept = "dsedu";
                break;
            case "DEE":$dept = "deedu";
                break;
            case "DHE":$dept = "dhedu";
                break;
            default :$dept = strtolower($dept_code);
                break;
        }
        return $dept;
    }

    public function get_uploadFile($file) {
        global $server_url;
        if ($file == "")
            $val = "Not Uploaded";
        elseif ($file == "NA")
            $val = "Not Applicable";
        elseif ($file == "SC")
            $val = "Send By Courier";
        else {
            $file_results = $this->executeQuery("dicc", "SELECT name,file FROM digital_locker WHERE file LIKE '%$file%'");
            if ($file_results->num_rows > 0) {
                $row = $file_results->fetch_object();
                $name = $row->name;
                $file = $row->file;
                $val = "<a href='" . $file . "' target='_blank'>" . $name . "</a>";
            } else {
                $val = "Not Uploaded";
            }
        }

        return $val;
    }

    public function get_useruploadFile($file, $applicant_id) {
        global $server_url;
        if ($file == "")
            $val = "Not Uploaded";
        elseif ($file == "NA")
            $val = "Not Applicable";
        elseif ($file == "SC")
            $val = "Send By Courier";
        else
            $val = "<a href='" . $server_url . "Document_locker/" . $file . "' target='_blank'>" . $this->executeQuery("dicc", "SELECT name FROM digital_locker WHERE user_id='$applicant_id' AND file='$file'")->fetch_object()->name . "</a>";
        return $val;
    }

    public function online_payment_details($uain) {

        $dept = $this->get_uainDept($uain);
        $form = $this->get_uainForm($uain);
        $table_name = $this->getTableName($dept, $form);
        if ($dept == "pcb" || $dept == "gmc" || $dept == "power") {
            $query = "select * from " . $table_name . "_payment where CustomerID='" . $uain . "/A'";
            $results = $this->executeQuery($dept, $query);
            if ($results->num_rows > 0) {
                $row = $results->fetch_object();

                if ($row->AuthStatus == "0300")
                    $AuthStatus = "SUCCESS";
                else
                    $AuthStatus = "FAILED";
                $TxnAmount = $row->TxnAmount;
                $TxnReferenceNo = $row->TxnReferenceNo;
                //$CurrencyName=$row->CurrencyName;
                $TxnDate = $row->TxnDate;

                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : ' . $AuthStatus . '
						<br/>Transaction Reference No. : ' . $TxnReferenceNo . '
						<br/>Transaction Amount (Rs.) : ' . ltrim($TxnAmount, "0") . '
						<br/>Transaction Date & Time : ' . date("d-m-Y H:i:s", strtotime($TxnDate)) . '
					</td>
				</tr>';
            }else {
                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
            }
        } else {
            $payment_results = $this->executeQuery("dicc", "select ChallanNo from pre_treasury_request where UAIN='" . $uain . "' and PaymentType='A' and PaymentStatus='1' ORDER BY id DESC LIMIT 1");
            if ($payment_results->num_rows > 0) {
                $row = $payment_results->fetch_object();
                $ChallanNo = $row->ChallanNo;

                $results2 = $this->executeQuery("dicc", "select * from treasury_response where challanNo='$ChallanNo' ORDER BY id DESC LIMIT 1");
                if ($results2->num_rows > 0) {
                    $row2 = $results2->fetch_object();

                    if ($row2->TxnStatus == "S")
                        $AuthStatus = "SUCCESS";
                    else
                        $AuthStatus = "FAILED";
                    $TxnAmount = $row2->totAmt;
                    $TxnDate = $row2->TxnDate;

                    $show_details = '<tr>
						<td valign="top">Treasury Payment Transaction Details :</td>
						<td>
							Transaction Status : ' . $AuthStatus . '
							<br/>Challan No. : ' . $ChallanNo . '
							<br/>Transaction Amount (Rs.) : ' . $TxnAmount . '.00
							<br/>Transaction Date & Time : ' . $TxnDate . '
						</td>
					</tr>';
                }else {
                    $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
                }
            } else {
                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
            }
        }

        return $show_details;
    }

    public function online_query_payment_details($uain) {

        $dept = $this->get_uainDept($uain);
        $form = $this->get_uainForm($uain);
        $table_name = $this->getTableName($dept, $form);
        if ($dept == "pcb") {
            $query = "select * from " . $table_name . "_payment where CustomerID='" . $uain . "/C'";
            $results = $this->executeQuery($dept, $query);
            if ($results->num_rows > 0) {
                $row = $results->fetch_object();

                if ($row->AuthStatus == "0300")
                    $AuthStatus = "SUCCESS";
                else
                    $AuthStatus = "FAILED";
                $TxnAmount = $row->TxnAmount;
                $TxnReferenceNo = $row->TxnReferenceNo;
                //$CurrencyName=$row->CurrencyName;
                $TxnDate = $row->TxnDate;

                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : ' . $AuthStatus . '
						<br/>Transaction Reference No. : ' . $TxnReferenceNo . '
						<br/>Transaction Amount (Rs.) : ' . ltrim($TxnAmount, "0") . '
						<br/>Transaction Date & Time : ' . date("d-m-Y H:i:s", strtotime($TxnDate)) . '
					</td>
				</tr>';
            }else {
                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
            }
        } else if ($dept == "gmc" || $dept == "power") {
            $query = "select * from online_billdesk_payments where CustomerID='" . $uain . "/C'";
            $results = $this->executeQuery($dept, $query);
            if ($results->num_rows > 0) {
                $row = $results->fetch_object();

                if ($row->AuthStatus == "0300")
                    $AuthStatus = "SUCCESS";
                else
                    $AuthStatus = "FAILED";
                $TxnAmount = $row->TxnAmount;
                $TxnReferenceNo = $row->TxnReferenceNo;
                //$CurrencyName=$row->CurrencyName;
                $TxnDate = $row->TxnDate;

                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : ' . $AuthStatus . '
						<br/>Transaction Reference No. : ' . $TxnReferenceNo . '
						<br/>Transaction Amount (Rs.) : ' . ltrim($TxnAmount, "0") . '
						<br/>Transaction Date & Time : ' . date("d-m-Y H:i:s", strtotime($TxnDate)) . '
					</td>
				</tr>';
            }else {
                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
            }
        } else {
            $payment_results = $this->executeQuery("dicc", "select ChallanNo from pre_treasury_request where UAIN='" . $uain . "' and PaymentType='C' and PaymentStatus='1' ORDER BY id DESC LIMIT 1");
            if ($payment_results->num_rows > 0) {
                $row = $payment_results->fetch_object();
                $ChallanNo = $row->ChallanNo;

                $results2 = $this->executeQuery("dicc", "select * from treasury_response where challanNo='$ChallanNo' ORDER BY id DESC LIMIT 1");
                if ($results2->num_rows > 0) {
                    $row2 = $results2->fetch_object();

                    if ($row2->TxnStatus == "S")
                        $AuthStatus = "SUCCESS";
                    else
                        $AuthStatus = "FAILED";
                    $TxnAmount = $row2->totAmt;
                    $TxnDate = $row2->TxnDate;

                    $show_details = '<tr>
						<td valign="top">Treasury Payment Transaction Details :</td>
						<td>
							Transaction Status : ' . $AuthStatus . '
							<br/>Challan No. : ' . $ChallanNo . '
							<br/>Transaction Amount (Rs.) : ' . $TxnAmount . '.00
							<br/>Transaction Date & Time : ' . $TxnDate . '
						</td>
					</tr>';
                }else {
                    $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
                }
            } else {
                $show_details = '<tr>
					<td valign="top">Payment Transaction Details :</td>
					<td>
						Transaction Status : REJECTED
						<br/>Transaction Reference No. : 
						<br/>Transaction Amount : 
					</td>
				</tr>';
            }
        }

        return $show_details;
    }

// End of online_payment_details()		

    public function insert_offline_payment_details($dept, $uain, $txn_amount, $txn_ref_no, $txn_date, $bank_name, $fee_type) {
        $query = "insert into offline_payments(uain,txn_amount,txn_ref_no,txn_date,bank_name,fee_type) values('$uain','$txn_amount','$txn_ref_no','$txn_date','$bank_name','$fee_type')";

        $results = $this->executeQuery($dept, $query);
        //$results=$pcb->query($query) or die($pcb->error);		
        if ($results) {
            return 1; //Success		
        } else {
            return 0; //Error		
        }
    }

    public function insert_pcb_offline_payment_details($dept, $uain, $txn_amount, $txn_ref_no, $txn_date, $bank_name, $fee_details, $fee_type) {
        $query = "insert into offline_payments(uain,txn_amount,txn_ref_no,txn_date,bank_name,fee_details,fee_type) values('$uain','$txn_amount','$txn_ref_no','$txn_date','$bank_name','$fee_details','$fee_type')";

        $results = $this->executeQuery($dept, $query);
        //$results=$pcb->query($query) or die($pcb->error);		
        if ($results) {
            return 1; //Success		
        } else {
            return 0; //Error		
        }
    }

    public function offline_payment_details($uain) {
        $dept = $this->get_uainDept($uain);
        //$form = $this->get_uainForm($uain);

        $query = "select * from offline_payments where uain='" . $uain . "' and fee_type='A'";
        $results = $this->executeQuery($dept, $query);
        if ($results->num_rows > 0) {
            $row = $results->fetch_object();

            $txn_amount = $row->txn_amount;
            $txn_ref_no = $row->txn_ref_no;
            $txn_date = $row->txn_date;
            $bank_name = $row->bank_name;
            //$show_details="";
            $show_details = '<b>Demand Draft Details :</b><br/>Amount (Rs.) : ' . ltrim($txn_amount, "0") . '<br/>Ref/DD No. : ' . $txn_ref_no . '<br/>Date : ' . date("d-m-Y", strtotime($txn_date)) . '<br/>Name of the Bank : ' . $bank_name . '';
        } else {
            $show_details = '';
        }
        return $show_details;
    }

    public function offline_query_payment_details($uain) {
        $dept = $this->get_uainDept($uain);
        $form = $this->get_uainForm($uain);

        $query = "select * from offline_payments where uain='" . $uain . "' and fee_type='C'";
        $results = $this->executeQuery($dept, $query);
        if ($results->num_rows > 0) {
            $row = $results->fetch_object();

            $txn_amount = $row->txn_amount;
            $txn_ref_no = $row->txn_ref_no;
            $txn_date = $row->txn_date;
            $bank_name = $row->bank_name;

            $show_details = '
			<p><b>Demand Draft Details :</b><br/>
				Amount (Rs.) : ' . ltrim($txn_amount, "0") . '
				<br/>Ref/DD No. : ' . $txn_ref_no . '
				<br/>Date : ' . date("d-m-Y", strtotime($txn_date)) . '
				<br/>Name of the Bank : ' . $bank_name . '
				';
        } else {
            $show_details = '';
        }
        return $show_details;
    }

    public function get_dept_bank_code($swr_id, $uain) {
        $dept = $this->get_uainDept($uain);
        $form = $this->get_uainForm($uain);
        $table_name = $this->getTableName($dept, $form);

        if ($dept == "gmc") {
            $bank_code = "GMC001";
        } else if ($dept == "pcb") {
            $bank_code = "PCB001";
            $submit_query = "select b_dist from singe_window_registration where id='$swr_id' and active='1'";
            $save_query = $this->executeQuery("mysqli", $submit_query);
            if ($save_query->num_rows > 0) {
                $b_dist = $save_query->fetch_object()->b_dist;
                $query = "SELECT billdesk_code FROM  payment_bank_details a, offices b WHERE  b.jurisdiction LIKE  '%$b_dist%' and b.id=a.ref_office_id and b.id!=1 and b.id!=10";
                $results = $this->executeQuery($dept, $query);
                if ($results->num_rows > 0) {
                    $bank_code = $results->fetch_object()->billdesk_code;
                }
            }
        } else if ($dept == "power") {
            $submit_query = "select exist_con_no from " . $table_name . " where uain='$uain' and user_id='$swr_id' and active='1'";
            $save_query = $this->executeQuery($dept, $submit_query);
            if ($save_query->num_rows > 0) {
                $exist_con_no = $save_query->fetch_object()->exist_con_no;
                if (is_numeric($exist_con_no)) {
                    $exist_con_no = substr($exist_con_no, 0, 3);
                    $query = "SELECT billdesk_code FROM online_payment_codes WHERE non_rapdr_code='$exist_con_no'";
                    $results = $this->executeQuery($dept, $query);
                    if ($results->num_rows > 0) {
                        $bank_code = $results->fetch_object()->billdesk_code;
                    } else {
                        $bank_code = "";
                    }
                } else {
                    $bank_code = "";
                }
            } else {
                $bank_code = "";
            }
        } else {
            $bank_code == "";
        }
        return $bank_code;
    }

    public function getApdclEsd($exist_con_no) {

        $exist_con_no = substr($exist_con_no, 0, 3);
        $consumer_loc = "";
        $results = $this->executeQuery("power", "SELECT * FROM nearest_cons_esd WHERE cons_no='$exist_con_no'");
        if ($results->num_rows > 0) {
            $consumer_loc = $results->fetch_object()->consumer_loc;
        }
        return $consumer_loc;
    }

    public function get_nearest_fire_station_name($fire_station_id) {

        if ($fire_station_id != "") {
            $fire_station_query = $this->executeQuery("fire", "select nearest_fire_station from nearest_fire_stations where id='$fire_station_id'");
            if ($fire_station_query->num_rows > 0) {
                $nearest_fire_station = $fire_station_query->fetch_object()->nearest_fire_station;
            } else {
                $nearest_fire_station = "";
            }
        } else {
            $nearest_fire_station = "";
        }
        return $nearest_fire_station;
    }

    public function create_uain($form_id, $dept, $form) {
        global $unit_id;
        $sqla = $this->executeQuery("dicc", "select c.code from unit_master_record as a LEFT JOIN address as b ON a.address = b.id LEFT JOIN district as c ON c.district = b.dist where a.unit_id='$unit_id'");
        $rowa = $sqla->fetch_object();
        $dist_code = $rowa->code;
        $unq = str_pad($form_id, 6, '0', STR_PAD_LEFT);

        switch ($dept) {
            case 'gmc': $dept_code = "GMC";
                switch ($form) {
                    case 1: $form_code = "TRADE";
                        break;
                    default :$form_code = "F" . $form;
                        break;
                }
                break;
            case 'forest': $dept_code = "DEFT";
                $form_code = "F" . $form;
                break;
            case 'factory': $dept_code = "LEDF";
                $form_code = "F" . $form;
                break;
            case 'boiler': $dept_code = "LEDB";
                $form_code = "F" . $form;
                break;
            case 'excise': $dept_code = "EXD";
                $form_code = "F" . $form;
                break;
            case 'jalboard': $dept_code = "GJB";
                $form_code = "F" . $form;
                break;
            case 'labour': $dept_code = "LEDL";
                $form_code = "F" . $form;
                break;
            case 'pcb': $dept_code = "PCB";
                switch ($form) {
                    case 1: $form_code = "CTE";
                        break;
                    case 2: $form_code = "CTO";
                        break;
                    default : $form_code = "F" . $form;
                        break;
                }
                break;
            case 'tourism': $dept_code = "DOT";
                $form_code = "F" . $form;
                break;
            case 'power': $dept_code = "DP";
                $form_code = "F" . $form;
                break;
            case 'society': $dept_code = "RCS";
                $form_code = "F" . $form;
                break;
            case 'water': $dept_code = "WS";
                $form_code = "F" . $form;
                break;
            case 'dsedu': $dept_code = "DSE";
                $form_code = "F" . $form;
                break;
            case 'dhedu': $dept_code = "DHE";
                $form_code = "F" . $form;
                break;
            case 'dmedu': $dept_code = "DME";
                $form_code = "F" . $form;
                break;
            case 'deedu': $dept_code = "DEE";
                $form_code = "F" . $form;
                break;
            default: $dept_code = strtoupper($dept);
                $form_code = "F" . $form;
                break;
        }
        $uain_part = $dept_code . "/" . $form_code . "/";

        $form_no = $uain_part . $dist_code . "/" . $unq . "/" . date('m/Y');
        $form_no = strtoupper($form_no);
        return $form_no;
    }

    public function getPaymentDetails($id) {
        $query = "SELECT * FROM list_of_approvals as a LEFT JOIN Treasury_payment_details as b ON a.paycode=b.ID WHERE a.id='$id' LIMIT 1";
        $qry = $this->executeQuery("cms", $query);
        $row = $qry->fetch_assoc();
        return $row;
    }

    public function getTableName($dept, $form) {
        $table = $dept . "_form" . $form;
        return $table;
    }

    public function insert_applications($uain) {
        //$today=date("Y-m-d H:i:s");
        global $server_url, $swr_id, $unit_name, $sid, $today, $b_dist, $b_block, $ci;
        $dept = $this->get_uainDept($uain);
        $dept_id = $this->get_sub_dept_id($dept);

        $form = $this->get_uainForm($uain);
        $form_name = $this->get_formName($dept, $form);
        $form_name = clean($form_name);
        $table_name = $this->getTableName($dept, $form);
        //$dept_name=$this->get_deptName($dept);

        if ($dept == "fire") {
            $fetch_data = "nearest_station,courier_details,save_mode,received_date";
        } else if ($dept == "doa" || ($dept == "dic" && ($form == 10 || $form == 11))) {
            $fetch_data = "officer_id,courier_details,save_mode,received_date";
        } else {
            $office_details = $this->executeQuery($dept, "select id,jurisdiction from offices where id!='1' AND (jurisdiction LIKE '%$b_dist%' OR jurisdiction LIKE '%$b_block%')");
            if ($office_details->num_rows > 0) {
                $office_row = $office_details->fetch_object();
                $office_id = $office_row->id;
                $user_details = $this->executeQuery($dept, "select user_id from users where utype='2' and office_id='$office_id' and status='1' ORDER BY user_id DESC ");
                if ($office_details->num_rows > 0) {
                    $process_user_id = $user_details->fetch_object()->user_id;
                } else {
                    return false;
                    exit();
                }
            } else {
                return false;
                exit();
            }
            $fetch_data = "courier_details,save_mode,received_date";
        }

        $check_query = "select " . $fetch_data . " from " . $table_name . " where user_id='$swr_id' and active='1'";
        $check_query_result = $this->executeQuery($dept, $check_query);
        if ($check_query_result->num_rows > 0) {
            $check_query_row = $check_query_result->fetch_object();
            $save_mode = $check_query_row->save_mode;
            $courier_details = $check_query_row->courier_details;
            $received_date = $check_query_row->received_date;

            $sms = $this->send_sms_submitted_application($sid, $uain); ////send sms alert
            if ($courier_details == "") {
                $query = "update " . $table_name . " set received_date='$today' where user_id='$swr_id' and active='1' and courier_details is NULL";
                $result = $this->executeQuery($dept, $query);

                $check_query = $this->executeQuery("dicc", "select swr_id from applications_up where uain='$uain'");
                if ($check_query->num_rows == 0) {
                    switch ($dept) {
                        case "fire":
                            $nearest_station = $check_query_row->nearest_station;
                            $process_user_id = $this->executeQuery("fire", "select user_id from users where fire_station='$nearest_station'")->fetch_object()->user_id;
                            $insert_query1 = $this->executeQuery($dept, "INSERT INTO applications_up (unit_id,unit_name,uain,office_id,current_userid,process,process_date) VALUES ('$swr_id','$unit_name',$uain','$office_id','$process_user_id','U','$today')");
                            break;
                        case "doa":
                        case "dic":
                            $process_user_id = $check_query_row->officer_id;
                            $insert_query1 = $this->executeQuery($dept, "INSERT INTO applications_up (unit_id,unit_name,uain,office_id,current_userid,process,process_date) VALUES ($swr_id','$unit_name','$uain','$office_id','$process_user_id','U','$today')");
                            break;
                        case "power":
                            $insert_query1 = $this->executeQuery($dept, "INSERT INTO applications_up (unit_id,unit_name,uain,office_id,current_userid,process,process_date) VALUES ('$swr_id','$unit_name','$uain','$office_id','$process_user_id','U','$today')");
                            break;
                        default :
                            $insert_query1 = $this->executeQuery($dept, "INSERT INTO applications_up (unit_id,unit_name,uain,office_id,current_userid,process,process_date) VALUES ('$swr_id','$unit_name','$uain','$office_id','$process_user_id','U','$today')");
                            break;
                    }
                }
            } else {

                $check_query = $this->executeQuery($dept, "select unit_id from applications_up where uain='$uain'");
                if ($check_query->num_rows == 0) {

                    if ($dept == "fire") {
                        $nearest_station = $check_query_row->nearest_station;
                        $process_user_id = $this->executeQuery("fire", "select user_id from users where fire_station='$nearest_station'")->fetch_object()->user_id;
                        $insert_query1 = $this->executeQuery($dept, "INSERT INTO applications_up (unit_id,unit_name,uain,office_id,current_userid,process,process_date) VALUES ('$swr_id','$unit_name','$uain','$office_id','$process_user_id','CS','$today')");
                    } else {
                        $insert_query1 = $this->executeQuery($dept, "INSERT INTO applications_up (unit_id,unit_name,uain,office_id,current_userid,process,process_date) VALUES ('$swr_id','$unit_name','$uain','$office_id','$process_user_id','CS','$today')");
                    }
                }


                $result = true;
            }


            $insert_query = $this->executeQuery("dicc", "INSERT INTO applications (dept_id,unit_id,uain) VALUES ('$dept_id','$swr_id','$uain')");



            $insert_query2 = $this->executeQuery("dicc", "INSERT INTO notifications (swr_id,uain,notice) VALUES ('$swr_id','$uain','Your " . $form_name . " has been submitted successfully.')");


            $insert_query3 = $this->executeQuery("dicc", "delete from incomplete_forms where dept_name='$dept' and form_no='$form' and swr_id='$swr_id'");
            /*
              $documents_values=$this->executeQuery("dicc","select * from digital_locker where document_type='T' and user_id='$sid'") or die("Error :".$mysqli->error);

              while($documents=$documents_values->fetch_assoc()){
              $document=$documents["file"];
              unlink ($_SERVER['DOCUMENT_ROOT']."/Document_locker/".$document);
              }
              $this->executeQuery("dicc","delete from digital_locker where document_type='T' and user_id='$sid'") or die("Error :".$mysqli->error); */
            if ($result == false || $insert_query == false || $insert_query2 == false || $insert_query3 == false) {
                return false;
                exit();
            } else {
                return true;
            }
        }
    }

    public function send_sms_submitted_application($user_id, $uain) {
        $mobile_no = $this->is_mobile_no_verified($user_id);
        $msg_string = "Your application form with UAIN - " . $uain . " has been successfully submitted. Helpline 7086044425 - EODB ASSAM";
        $this->send_sms($mobile_no, $msg_string);
        return 1;
    }

    public function is_mobile_no_verified($user_id) {
        $results = $this->executeQuery("dicc", "select phone from users where id='$user_id'");
        if ($results->num_rows > 0) {
            $mobile_no = $results->fetch_object()->phone;
            return $mobile_no;
        } else {
            return 0;
        }
    }

    public function getEmail_str($uain) {
        $form = $this->get_uainForm($uain);
        $dept = $this->get_uainDept($uain);
        $form_name = $this->get_formName($dept, $form);
        $str = "Dear User, We have received your <b>" . $form_name . "</b>. Please note your Unique Application Identification Number for further queries. UAIN : <b>" . $uain . "</b> Kindly check the attachment and download your application form.";
        return $str;
    }

    public function get_uainForm($uian) {
        $uian_type = Array();
        $uian_type = explode("/", $uian, 3);
        $count = count($uian_type);
        if ($count > 1) {
            $form_type = $uian_type[1];
            $form = "";
            switch ($form_type) {
                case "TRADE": $form = 1;
                    break;
                case "CTE": $form = 1;
                    break;
                case "CTO": $form = 2;
                    break;
                case "F1": $form = 1;
                    break;
                default : $form = substr($form_type, 1);
                    break;
            }
            return $form;
        } else {
            return 0;
        }
    }

// End of get_district_id()
}

?>