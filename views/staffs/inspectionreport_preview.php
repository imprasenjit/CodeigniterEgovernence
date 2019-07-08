<?php
$deptuserRow = $this->deptusers_model->get_row($processed_by, $this->dept_code);//die($this->dept_code." : ".$processed_by);
if($deptuserRow) {
    $staff_name = $deptuserRow->user_name;
    $staff_designation = $deptuserRow->udesig; 
} else {
    $staff_name = $staff_designation = "Not found";                      
}//End of if else
                    
$cafRow = $this->cafs_model->get_joinrow($unit_id);
if($cafRow) {
    $ubin = $cafRow->ubin;   
    $key_person=$cafRow->Key_person;
    $unit_name=$cafRow->Name;
    $status_applicant=$cafRow->status_applicant;
    $street_name1=$cafRow->Street_name1;
    $street_name2=$cafRow->Street_name2;
    $vill=$cafRow->Vill;
    $dist=$cafRow->Dist;
    $block=$cafRow->block;
    $pincode=$cafRow->Pincode;
    $mobile_no=$cafRow->Mobile_no;
    $landline_std=$cafRow->Landline_std;
    $landline_no=$cafRow->Landline_no;
    $b_street_name1=$cafRow->b_street_name1;
    $b_street_name2=$cafRow->b_street_name2;
    $b_vill=$cafRow->b_vill;
    $b_dist=$cafRow->b_dist;
    $b_block=$cafRow->b_block;
    $b_pincode=$cafRow->b_pincode;
    $b_mobile_no=$cafRow->b_mobile_no;
    $b_landline_std=$cafRow->b_landline_std;
    $b_landline_no=$cafRow->b_landline_no;
    $b_email=$cafRow->b_email;
    $date_of_commencement=$cafRow->date_of_commencement;
    $from=strtoupper($street_name1)." , ".strtoupper($street_name2)." , ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode;
    $unit_details=strtoupper($b_street_name1)." , ".strtoupper($b_street_name2)." , ".strtoupper($b_vill)." \nDistrict : ".strtoupper($b_dist)." \nPin Code : ".$b_pincode;
    $Type_of_ownership=$cafRow->Type_of_ownership;
    $Name_of_owner=$cafRow->Name_of_owner;
} else {
    die("swr_id : ".$unit_id." does not exis");
}//End of if else

if($InsRow) {
    $water_source=$InsRow->water_source;
    $drinking_water=$InsRow->drinking_water;
    $other_water=$InsRow->other_water;
    $raw_materials=$InsRow->raw_materials;
    $details_product=$InsRow->details_product;
    $designed_capacity=$InsRow->designed_capacity;
    $manufacr_process=$InsRow->manufacr_process;
    $effluent=$InsRow->effluent;
    $outfall_point=$InsRow->outfall_point;
    $receiving_sources=$InsRow->receiving_sources;
    $status_etp=$InsRow->status_etp;
    $treatment_name=$InsRow->treatment_name;
    $adequency_etp=$InsRow->adequency_etp;
    $operational_etp=$InsRow->operational_etp;
    $status_consent=$InsRow->status_consent;
    $emmission_cn_sys=$InsRow->emmission_cn_sys;
    $stack_arrange=$InsRow->stack_arrange;
    $adequency_of_ecs=$InsRow->adequency_of_ecs;
    $status_consent_air=$InsRow->status_consent_air;
    $generation_treatment=$InsRow->generation_treatment;
    $disposal_facility=$InsRow->disposal_facility;
    $authorization_hazardous=$InsRow->authorization_hazardous;
    $emergency_plan=$InsRow->emergency_plan;
    $status_safty=$InsRow->status_safty;
    $public_liability=$InsRow->public_liability;
    $biomedical=$InsRow->biomedical;
    $water_cess=$InsRow->water_cess;
    $overall_obser=$InsRow->overall_obser;
    $operational_status=$InsRow->operational_status;
    $recom_act=$InsRow->recom_act;    
} else {
    $form_id="";
    $water_source="";
    $drinking_water="";
    $other_water="";
    $raw_materials="";
    $details_product="";
    $designed_capacity="";
    $manufacr_process="";
    $effluent="";
    $outfall_point="";
    $receiving_sources="";
    $status_etp="";
    $treatment_name="";
    $adequency_etp="";
    $operational_etp="";
    $status_consent="";
    $emmission_cn_sys="";
    $stack_arrange="";
    $adequency_of_ecs="";
    $status_consent_air="";
    $generation_treatment="";
    $disposal_facility="";
    $authorization_hazardous="";
    $emergency_plan="";
    $status_safty="";
    $public_liability="";
    $biomedical="";
    $water_cess="";
    $overall_obser="";
    $operational_status="";
    $recom_act="";
}//End of if else
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Inspection report </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <?php if ($this->session->flashdata("flashMsg")) { ?>
            <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
        <?php } ?>
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Inspection report
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <div class="box-body">
                        <table class="table table-responsive ">
                            <tr>
                                <td colspan="4">1. Name and complete postal address of the Industry : </td>					
                            </tr>
                            <tr>
                                <td style="width: 25%">Name of the industry :</td>
                                <td style="width: 25%">
                                    <?= $unit_name ?>
                                </td>
                                <td style="width: 25%">Postal Address</td>
                                <td style="width: 25%">
                                    <?= $unit_details ?>
                                </td>
                            </tr>					
                            <tr>
                                <td colspan="4">2. Contact person with Tel/ Fax/ E-mail:</td>					
                            </tr>
                            <tr>
                                <td>Name of the Contact Person :</td>
                                <td><?= $key_person ?></td>
                                <td>Postal Address</td>
                                <td><?= $from ?></td>						
                            </tr>	
                            <tr>
                                <td>Mobile No.</td>
                                <td><?= $mobile_no ?></td>
                                <td>E-Mail ID</td>
                                <td><?= $b_email ?></td>
                            </tr>
                            <tr>
                                <td >3. Date of visit:</td>
                                <td><?= $process_date ?></td>
                                <td >4.Name of officials visiting the Unit:</td>
                                <td><?= $staff_name ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">5. Information about the Unit:</td>
                            </tr>

                            <tr>
                                <td colspan="2"> 5.1 Source of Water</td>					
                                <td colspan="2"><?= $water_source ?></td>					
                            </tr>
                            <tr>
                                <td>a)Drinking</td>
                                <td><?= $drinking_water ?></td>
                                <td>b)Other uses</td>
                                <td><?= $other_water ?></td>
                            </tr>
                            <tr>
                                <td>5.2 Details of raw materials used</td>
                                <td><?= $raw_materials ?></td>
                                <td>5.3 Details of products with capacity</td>
                                <td><?= $details_product ?></td>
                            </tr>
                            <tr>
                                <td>5.4 Details designed capacity</td>
                                <td><?= $designed_capacity ?></td>
                                <td>5.5 About manufacturing process</td>
                                <td><?= $manufacr_process ?></td>
                            </tr>	
                            <tr>
                                <td colspan="4"> 6. Water Consumption:</td>					
                            </tr>
                            <tr>
                                <td>6.1 Quantity of effluent treated and disposed</td>
                                <td><?= $effluent ?></td>
                                <td>6.2 Details of outfall point</td>
                                <td><?= $outfall_point ?></td>
                            </tr>
                            <tr>
                                <td>6.3 Details of receiving source</td>
                                <td><?= $receiving_sources ?></td>
                                <td>6.4 Status of ETP</td>
                                <td><?= $status_etp ?></td>
                            </tr>
                            <tr>
                                <td>6.5 Name of treatment units in the system</td>
                                <td><?= $treatment_name ?></td>
                                <td>6.6 Adequacy of ETP (Adequate / Not Adequate)</td>
                                <td><?= $adequency_etp ?></td>
                            </tr>	
                            <tr>
                                <td>6.7 Operational status of ETP</td>
                                <td><?= $operational_etp ?></td>
                                <td>6.8 Status of Consent order under Water Act, 1974</td>
                                <td><?= $status_consent ?></td>
                            </tr>
                            <tr>
                                <td colspan="4"> 7. Status of Emission Control System (ECS):</td>					
                            </tr>
                            <tr>
                                <td>7.1 Name and functioning of emission control system (ECS)</td>
                                <td><?= $emmission_cn_sys ?></td>
                                <td>7.2 Provision for Stack Monitoring arrangement</td>
                                <td><?= $stack_arrange ?></td>
                            </tr>
                            <tr>
                                <td>7.3 Adequacy of the ECS (Adequate/Not adequate)</td>
                                <td><?= $adequency_of_ecs ?></td>
                                <td>7.4 Operational Status</td>
                                <td><?= $operational_status ?></td>
                            </tr>
                            <tr>
                                <td>7.5 Status of Consent under Air Act,1981</td>
                                <td><?= $status_consent_air ?></td>
                            </tr>
                            <tr>
                                <td colspan="4"> 8. Hazardous Waste Disposal:</td>					
                            </tr>
                            <tr>
                                <td>8.1 Daily generation, treatment,storage facilities & recovery</td>
                                <td><?= $generation_treatment ?></td>
                                <td>8.2 Type of Disposal facility</td>
                                <td><?= $disposal_facility ?></td>
                            </tr>
                            <tr>
                                <td>8.3 Status of Authorization under the Hazardous waste (Management & Handling) Rule, 1989</td>
                                <td><?= $authorization_hazardous ?></td>
                                <td>8.4 Status of On-site Emergency Plan & its submission to PCBA</td>
                                <td><?= $emergency_plan ?></td>
                            </tr>
                            <tr>
                                <td>8.5 Status of Safety Report</td>
                                <td><?= $status_safty ?></td>
                                <td>8.6 Implementation of Public Liability Insurance Act. </td>           
                                <td><?= $public_liability ?></td>
                            </tr>
                            <tr>
                                <td>9. Applicability of Bio-Medical Waste Rules, 1998</td>
                                <td><?= $biomedical ?></td>
                                <td>10. Status of Water Cess Act:</td>
                                <td><?= $water_cess ?></td>
                            </tr>
                            <tr>
                                <td>11. Overall observation:</td>
                                <td><?= $overall_obser ?></td>
                                <td>12. Recommendations in respect of specific actions to be taken by PCBA against the Unit in regard to Pollution Control measures mentioned above:</td>
                                <td><?= $recom_act ?></td>
                            </tr>										
                            <tr>
                                <td>Date : <label><?= date('d-m-Y') ?></label><br/>
                                    Place: <label><?= strtoupper($b_dist) ?></label></td>
                                <td></td>
                                <td></td>
                                <td align="right">
                                    <label>Signature: <?= strtoupper($staff_name) ?></label><br/>
                                    <label>Designation: <?= strtoupper($staff_designation) ?></label>
                                </td>
                            </tr>
                        </table>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>