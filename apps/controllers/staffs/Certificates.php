<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Certificates extends Eodbs {

    public $dept_code;
    public $dept_name;
    public $staff_id;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->library("ciqrcode");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/applicationsir_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/offices_model"); 
        $this->dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
    }
            
    function index() {
        $this->load->view("staffs/certificatelist_view");
    }//End of index()
        
    function details($uainencoded=NULL) {
        $uain = decodeme($uainencoded);
        $certRow = $this->applicationsir_model->get_uainrow($this->dept_code, $uain);
        if($certRow) {
            $dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
            $frmno = uainexplode($uain, "form_no");
            $form_table = $this->dept_code."_form".$frmno;
            $form_id = uainexplode($uain, "form_id");
            $this->load->model("staffs/formcertifcates_model"); 
            $this->load->model("staffs/formprocess_model"); 
            $this->load->model("staffs/forms_model");
            $this->load->model("users/unit_model");
            
            $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
            $frmname = ($fromRow)?$fromRow->service_name:"Not found";                                
            $this->load->model("staffs/cafs_model");
            $data = array(
                "form_table" => $form_table,
                "form_id" => $form_id,
                "form_name" => $frmname,
                "uain" => $uain,
                "swr_id" => $certRow->unit_id
            );
            $this->load->view("depts/".$this->dept_code."/form".$frmno."_certificate", $data);
        } else {
            die("UAIN does not Exist!");
        }//End of if else
    }//End of details()    
    
    function pdf() {
        $this->load->view("staffs/certificatetest_view");
    }//End of pdf()
    
    function pcb($par=NULL) {        
        $uain = decodeme($par);
        //$par = "PCB/F50/KM/003334/04/2018"; $encodedPar = encodeme($par); $decodedPar = decodeme($encodedPar); echo $encodedPar."<br><br>".$decodedPar; 
        //die("uain : ".$uain);
        $this->load->view("staffs/certificatepcb_view");
    }//End of pcb()
    
    function factory($par=NULL) {        
        $this->load->view("staffs/certificatefactory_view");
    }//End of factory()
    
    function getpdf($uainencoded=NULL) {
        $uain = decodeme($uainencoded);
        $certRow = $this->applicationsup_model->get_uainrow($this->dept_code, $uain);
        //die("dept : ".$this->dept_code.", uain : ".$uain);
        if($certRow) {
            $dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
            $frmno = uainexplode($uain, "form_no");
            $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
            $frmname = ($fromRow)?$fromRow->service_name:"Not found"; 
            
            $this->load->model("staffs/cafs_model");
            $swr_id = $certRow->unit_id;
            $cafRow = $this->cafs_model->get_row($swr_id);
            if($cafRow) {
                $ubin = $cafRow->ubin;
                $companyName = $cafRow->Name;
                $companyOwner = $cafRow->Name_of_owner;
            } else {
                die("CAF does not Exist!");
            }//End of if else
        } else {
            die("UAIN does not Exist!");
        }//End of if else
      
        $this->load->library('Tcpdflib');
        $html = '<table style="width: 100%; border: none; margin: 0px auto;">
            <thead>
                <tr>
                    <th style="font-size: 18px; font-weight: bold; text-align: center; line-height:50px;">
                        INSPECTORATE OF FACTORIES<br />
                        (GOVERNMENT OF ASSAM)<br />
                        <img src="'.base_url('public/imgs/assam.png').'" style="width: 120px; height:120px" /><br />
                        <span style="font-size:18px">'.$frmname.'<br></span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="padding: 10px 30px;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="font-size: 12px; line-height: 18px">
                                        UBIN : <strong>'.$ubin.'</strong><br />
                                        Registration No. : <strong>KAM/524</strong>
                                    </td>
                                    <td style="text-align: right; font-size: 12px; line-height: 18px">
                                        UAIN : <strong>'.$uain.'<br></strong><br />
                                        Fees : <strong>Rs. 5100.00</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top: 40px">
                                        <p style="  text-align:justify; font-family: AlgerFont; font-size:1.3em; line-height:32px;">
                                            This licence is hereby granted to <strong>'.$companyOwner.'</strong> of 
                                            <strong>'.$companyName.'</strong> valid only for the premises described 
                                            below for use as a factory employing not more than 250 persons 
                                            on any one day during the year and using motive power not exceeding 
                                            918 H.P subject to the provisions of the Factories Act. 1948 and the 
                                            rules made thereunder.
                                        </p>
                                        <p style="font-size:12px; line-height:25px; text-align: center">            
                                            This licence shall remain in force till the Thirty first day of December, 2018    
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; line-height: 18px">
                                        Place : <strong>Guwahati</strong><br />
                                        Date : <strong>../../....</strong>
                                    </td>
                                    <td style="text-align: right; font-size: 12px">
                                        CHIEF INSPECTOR OF FACTORIES, ASSAM<br />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top: 40px; font-size: 12px; line-height: 18px; text-align: center">
                                        <strong style="text-decoration: underline;">Description of the licensed premises</strong><br />
                                        <div style="text-align: justify">
                                            This licensed premises shown on Plan No .... dated 01-01-1970 are situated in 
                                            NH37,,SARPARA,KAMRUP (RURAL) and consist of .... .
                                        </div>                                                            
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-size: 12px; line-height: 18px;">
                                        <strong style="text-decoration: underline;">Details of the fees</strong><br />
                                        <ol>
                                            <li>Regular Fees for the year : Rs. .00</li>
                                            <li>Arrear Fees for the year : Rs. .00</li>
                                            <li>Penalty/other charges : Rs. .00</li>
                                        </ol>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>';
        $pdf = new Tcpdflib('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Test PDF');
        $pdf->AddPage(); 
        $pdf->writeHTML(utf8_encode($html), true, false, true, false, '');
        $pdf->Output('storage/MyFileName.pdf', 'I');
    }//End of index()
}//End of Certificates
