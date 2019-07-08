<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends Eodb {
    
    public $dept_code;
    public $frmtbl;
    public $form_id;
    public $uain;
    public $swr_id;
    
    function __construct() {
        parent::__construct();
        $this->load->helper("encode");
        $this->load->model("staffs/payments_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("cms/listofapprovals_model");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/cafs_model");
    }//End of __construct()
    
    function index($form_id=70) {
        $formInfos = $this->listofapprovals_model->get_row($form_id);
        if($formInfos){
            $data["forminfos"] = $formInfos;
            $this->load->view("staffs/payment_view", $data);
        } else {
            die("Form ID does not matched!");
        }//End of if else
    }//End of index()

    function treasury($uainencoded=NULL, $amntencoded=NULL) {
        $this->uain = "LEDF/F1/BO/000007/11/2017";//decodeme($uainencoded);
        $txn_amnt=100;//decodeme($amntencoded);
        $this->dept_code = uainexplode($this->uain, "dept_code");
        $this->form_id = uainexplode($this->uain, "form_id");
        $loaRow = $this->listofapprovals_model->get_row($this->form_id);
        if($loaRow){
            $challan_no = uniqid();
            $nowTime=date("Y-m-d H:i:s");
            $paycode = $loaRow->paycode;
            $treasuryRow = $this->payments_model->get_treasurypayinfo($paycode);
            if($treasuryRow) {
                $treasuryDeptName = $treasuryRow->Department;			
                $treasuryDeptCode = $treasuryRow->Dept_Code;
                $treasuryPayCode = $treasuryRow->Pay_Code;
            } else {
                $treasuryDeptName = $treasuryDeptCode = $treasuryPayCode = "NOTFOUND";
            }//End of if else
            //die($this->uain.", ".$this->form_id.", ".$paycode.", ".$treasuryPayCode);
            $dataRequest = array(
                "uain" => $this->uain,
                "challan_no" => $challan_no,
                "txn_amnt" => $txn_amnt,
                "dept_code" => $this->dept_code,
                "office_id" => NULL,
                "txn_for" => NULL,
                "txn_time" => $nowTime,
                "txn_gateway" => 2
            );
            $this->load->model("staffs/paymentrequest_model");
            $this->paymentrequest_model->add_row($dataRequest);
            
            $dataSend = array(
                "uain" => $this->uain,
                "txn_amnt" => $txn_amnt,
                "challan_no" => $challan_no,
                "treasuryDeptName" => $treasuryDeptName,
                "treasuryDeptCode" => $treasuryDeptCode,
                "treasuryPayCode" => $treasuryPayCode
            );
            $this->load->view("staffs/paymenttreasury_view", $dataSend);
        } else {
            die("Form ID does not matched!");
        }//End of if else
    }//End of treasury()
    
    function treasuryresponse() {
        $nowTime=date("Y-m-d H:i:s");
        $txn_time = date("Y-m-d H:i:s", strtotime($_POST["TxnDate"]));
        $challan_no = $_POST["challanNo"];
        $bank_id = $_POST["BankID"];
        $uain = $_POST["tin"];
        $txn_amnt = $_POST["totAmt"];
        $txn_status = $_POST["TxnStatus"];
        
        $dataResponse = array(
            "challan_no" => $challan_no,
            "bank_id" => $bank_id,
            "txn_amnt" => $txn_amnt,
            "txn_time" => $txn_time,
            "response_time" => $nowTime
        );
        $this->paymentresponses_model->add_row($dataResponse);    
        
        $dataReport = array(
            "txn_id" => $challan_no,
            "uain" => $uain,
            "office_id" => NULL,
            "txn_for" => $txn_for,
            "txn_amnt" => $txn_amnt,
            "txn_time" => $nowTime,
            "txn_gateway" => 2
        );
        $this->payments_model->add_row($dataReport); 
                
    }//End of treasuryresponse()
    
    function billdesk($uainencoded=NULL, $amntencoded=NULL, $txn_for="A", $addiotionalinfos4 = "NA|NA|NA|NA") {
        $nowTime=date("Y-m-d H:i:s");
        $this->uain = "LEDF/F1/BO/000007/11/2017";//decodeme($uainencoded);
        $txn_amnt=sprintf("%0.2f", 100);//decodeme($amntencoded);
        $this->dept_code = uainexplode($this->uain, "dept_code");
        $dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
        $this->form_id = uainexplode($this->uain, "form_id");
        $frmno = uainexplode($this->uain, "form_no"); //die($uain." : ".$frmno);
        if($frmno > 0) {
            $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
            $form_name = ($fromRow)?$fromRow->service_name:"Not found";  
            
            $this->frmtbl = $this->dept_code."_form".$frmno;
            $frmRow = $this->forms_model->get_uainrow($this->dept_code, $this->frmtbl, $this->uain);
            if($frmRow) {
                $this->swr_id = $frmRow->user_id;
                $cafRow = $this->cafs_model->get_row($this->swr_id);
                if($cafRow) {
                    $ubin = $cafRow->ubin;
                    $industryName = $cafRow->Name;
                } else {
                    $ubin = $industryName = "NOT FOUND";
                }//End of if else
                $challan_no = uniqid();
                $dataRequest = array(
                    "uain" => $this->uain,
                    "challan_no" => $challan_no,
                    "txn_amnt" => $txn_amnt,
                    "dept_code" => $this->dept_code,
                    "office_id" => NULL,
                    "txn_for" => NULL,
                    "txn_time" => $nowTime,
                    "txn_gateway" => 1
                );
                $this->load->model("staffs/paymentrequest_model");
                $this->paymentrequest_model->add_row($dataRequest);
                //MerchantID|CustomerID|NA|TxnAmount|NA|NA|NA|CurrencyType|NA|TypeField1|SecurityID|NA|NA|TypeField2|Txtadditionalinfo1| Txtadditionalinfo2| Txtadditionalinfo3|Txtadditionalinfo4| Txtadditionalinfo5| Txtadditionalinfo6| Txtadditionalinfo7|RU
                $ru = base_url('payments/billdeskresponse/');
                $newData = "DOIACGOA|".$this->uain."|".$txn_for."|".$txn_amnt."|".$challan_no."|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$nowTime."|".$industryName."|".$form_name."|".$addiotionalinfos4."|".$ru;
                /*if ($this->dept_code == "pcb") {
                    $newData = "DOIACGOA|".$sentCustomerID."|NA|".$reg_fees.".00|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$fee_type."|".$dept_bank_code."|".$txDateTime."|".$application_fees.".00|".$consent_fees.".00|".$dg_sets_fees.".00|".$returnUrl;
                } else {
                    $newData = "DOIACGOA|".$sentCustomerID."|NA|".$reg_fees.".00|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$financialYear."|".$dept_bank_code."|".$txDateTime."|".$form_name."|NA|NA|".$returnUrl;
                }*/
                $checksum=hash_hmac('sha256',$newData,'EHaiRbheoy8p', false); 
                $checksum=strtoupper($checksum);
                $dataWithCheckSumValue=$newData."|".$checksum;
                $msg=$dataWithCheckSumValue;
                $dataSend = array(
                    "uain" => $this->uain,
                    "txn_amnt" => $txn_amnt,
                    "industryName" => $industryName,
                    "form_name" => $form_name,
                    "msg" => $msg
                );
                //die("msg : ".$msg);
                $this->load->view("staffs/paymentbilldesk_view", $dataSend);
            } else {
                die("UAIN not found!");
            }//End of if else
        } else {
            die("Form does not exist");
        }//End of if else
    }//End of billdesk()
    
    function billdeskresponse() {
        $nowTime=date("Y-m-d H:i:s");
        $responseMsg = $_POST["msg"];
        echo "Response : <pre>";
        var_dump($responseMsg);
        echo "</pre>"; die();
        //"DOIACGOA|".$this->uain."|".$txn_for."|".$txn_amnt."|".$challan_no."|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$nowTime."|".$industryName."|".$form_name."|".$addiotionalinfos4."|".$ru;
        if(strlen($responseMsg)>0){            
            $responseMsgArray=explode("|",$responseMsg);
            $uain=$responseMsgArray[1];
            $txn_for=$responseMsgArray[2];
            $txn_amnt=$responseMsgArray[3];
            $challan_no=$responseMsgArray[4];
            
            $BankID=$responseMsgArray[5];
            $BankMerchantID=$responseMsgArray[6];
            $TxnType=$responseMsgArray[7];
            $CurrencyName=$responseMsgArray[8];
            $TxnDate=$responseMsgArray[13];
            $authStatus=$responseMsgArray[14]; /*0300=success*/
            $AdditionalInfo1=$responseMsgArray[16];
            $AdditionalInfo2=$responseMsgArray[17];
            $AdditionalInfo3=$responseMsgArray[18];
            $AdditionalInfo4=$responseMsgArray[19];
            $AdditionalInfo5=$responseMsgArray[20];
            $AdditionalInfo6=$responseMsgArray[21];
            $AdditionalInfo7=$responseMsgArray[22];
            $submitted_on=$nowTime;
            $responseChecksum=array_pop($responseMsgArray);
            $responseOrginalString=implode("|",$responseMsgArray);
            $responseCalcChecksum=hash_hmac('sha256',$responseOrginalString,'EHaiRbheoy8p', false); 
            $responseCalcChecksum=strtoupper($responseCalcChecksum);
            if($responseChecksum==$responseCalcChecksum){
                $checksumValidation=true;
            }//End of if
            $dataResponse = array(
                "challan_no" => $challan_no,
                "bank_id" => $bank_id,
                "txn_amnt" => $txn_amnt,
                "txn_time" => $txn_time,
                "response_time" => $nowTime
            );
            $this->paymentresponses_model->add_row($dataResponse);
            
            $dataReport = array(
                "txn_id" => $challan_no,
                "uain" => $uain,
                "office_id" => NULL,
                "txn_for" => $txn_for,
                "txn_amnt" => $txn_amnt,
                "txn_time" => $nowTime,
                "txn_gateway" => 1
            );
            $this->payments_model->add_row($dataReport);
        }        
    }//End of billdeskresponse()
}//End of Payment
