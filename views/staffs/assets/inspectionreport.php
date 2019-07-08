<?php
$deptuserRow = $this->deptusers_model->get_row($processed_by, $this->dept_code);//die($this->dept_code." : ".$processed_by);
if($deptuserRow) {
    $staff_name = $deptuserRow->user_name;
    $staff_designation = $deptuserRow->udesig; 
} else {
    $staff_name = $staff_designation = "Not found";                      
}
                    
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
}

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
?>
<form action="<?=base_url('staffs/inspectionreports/save')?>" method="post" enctype="multipart/form-data">
    <!--<input type="hidden" class="form-control text-uppercase" name="token" value="<?=$token?>">
    <input type="hidden" class="form-control text-uppercase" name="path_to_redirect" value="<?=$path_to_redirect?>">
    <input type="hidden" class="form-control text-uppercase" name="inspection_yearly" value="<?=$inspection_yearly?>">-->
    <input type="hidden" class="form-control text-uppercase" name="uain" value="<?=$uain?>" placeholder="jhgjg">
    <input type="hidden" class="form-control text-uppercase" name="swr_id" value="<?=$unit_id?>">
    <table class="table table-responsive ">
        <tr>
            <td colspan="4">1. Name and complete postal address of the Industry : </td>					
        </tr>
        <tr>
            <td style="width: 25%">Name of the industry :</td>
            <td style="width: 25%">
                <input type="text" class="form-control text-uppercase" disabled="disabled" value="<?=$unit_name?>">
            </td>
            <td style="width: 25%">Postal Address</td>
            <td style="width: 25%">
                <textarea type="text" class="form-control text-uppercase" disabled="disabled"><?=$unit_details?></textarea>
            </td>
        </tr>					
        <tr>
            <td colspan="4">2. Contact person with Tel/ Fax/ E-mail:</td>					
        </tr>
        <tr>
            <td>Name of the Contact Person :</td>
            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?=$key_person?>"></td>
            <td>Postal Address</td>
            <td><textarea type="text" class="form-control text-uppercase" disabled="disabled"><?=$from?></textarea></td>						
        </tr>	
        <tr>
            <td>Mobile No.</td>
            <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?=$mobile_no?>"></td>
            <td>E-Mail ID</td>
            <td><input type="text" class="form-control" disabled="disabled" value="<?=$b_email?>"></td>
        </tr>
        <tr>
            <td >3. Date of visit:</td>
            <td><input type="text" class="form-control text-uppercase dob" name="visit_date" value="<?=$process_date?>"></td>
            <td >4.Name of officials visiting the Unit:</td>
            <td><input type="text" class="form-control" disabled="disabled" value="<?=$staff_name?>"></td>
        </tr>
        <tr>
            <td colspan="3">5. Information about the Unit:</td>
        </tr>

        <tr>
            <td colspan="2"> 5.1 Source of Water</td>					
            <td colspan="2"> <input type="text" class="form-control text-uppercase" value="<?=$water_source?>" name="water_source" ></td>					
        </tr>
        <tr>
            <td>a)Drinking</td>
            <td><input type="text" class="form-control text-uppercase" value="<?=$drinking_water?>" name="drinking_water" ></td>
            <td>b)Other uses</td>
            <td><input type="text" class="form-control text-uppercase"  value="<?=$other_water?>" name="other_water"></td>
        </tr>
        <tr>
            <td>5.2 Details of raw materials used</td>
            <td><textarea type="text" class="form-control text-uppercase" name="raw_materials"><?=$raw_materials?></textarea></td>
            <td>5.3 Details of products with capacity</td>
            <td><textarea type="text" class="form-control text-uppercase" name="details_product"><?=$details_product?></textarea></td>
        </tr>
        <tr>
            <td>5.4 Details designed capacity</td>
            <td><textarea type="text" class="form-control text-uppercase" name="designed_capacity"><?=$designed_capacity?></textarea></td>
            <td>5.5 About manufacturing process</td>
            <td><textarea type="text" class="form-control text-uppercase" name="manufacr_process"><?=$manufacr_process?></textarea></td>
        </tr>	
        <tr>
            <td colspan="4"> 6. Water Consumption:</td>					
        </tr>
        <tr>
            <td>6.1 Quantity of effluent treated and disposed</td>
            <td><input type="text" class="form-control text-uppercase" value="<?=$effluent?>" name="effluent"></td>
            <td>6.2 Details of outfall point</td>
            <td><input type="text" class="form-control text-uppercase" value="<?=$outfall_point?>" name="outfall_point"></td>
        </tr>
        <tr>
            <td>6.3 Details of receiving source</td>
            <td><textarea type="text" class="form-control text-uppercase" name="receiving_sources"><?=$receiving_sources?></textarea></td>
            <td>6.4 Status of ETP</td>
            <td><input type="text" class="form-control text-uppercase"  value="<?=$status_etp?>" name="status_etp"></td>
        </tr>
        <tr>
            <td>6.5 Name of treatment units in the system</td>
            <td><input type="text" class="form-control text-uppercase" value="<?=$treatment_name?>" name="treatment_name"></td>
            <td>6.6 Adequacy of ETP (Adequate / Not Adequate)</td>
            <td><input type="text" class="form-control text-uppercase" value="<?=$adequency_etp?>" name="adequency_etp"></td>
        </tr>	
        <tr>
            <td>6.7 Operational status of ETP</td>
            <td><textarea type="text" class="form-control text-uppercase" name="operational_etp"><?=$operational_etp?></textarea></td>
            <td>6.8 Status of Consent order under Water Act, 1974</td>
            <td><textarea type="text" class="form-control text-uppercase" name="status_consent"><?=$status_consent?></textarea></td>
        </tr>
        <tr>
            <td colspan="4"> 7. Status of Emission Control System (ECS):</td>					
        </tr>
        <tr>
            <td>7.1 Name and functioning of emission control system (ECS)</td>
            <td><textarea type="text" class="form-control text-uppercase" name="emmission_cn_sys"><?=$emmission_cn_sys?></textarea></td>
            <td>7.2 Provision for Stack Monitoring arrangement</td>
            <td><input type="text" class="form-control text-uppercase" name="stack_arrange" value="<?=$stack_arrange?>"></td>
        </tr>
        <tr>
            <td>7.3 Adequacy of the ECS (Adequate/Not adequate)</td>
            <td><input type="text" class="form-control text-uppercase" name="adequency_of_ecs" value="<?=$adequency_of_ecs?>"></td>
            <td>7.4 Operational Status</td>
            <td><input type="text" class="form-control text-uppercase" name="operational_status" value="<?=$operational_status?>"></td>
        </tr>
        <tr>
            <td>7.5 Status of Consent under Air Act,1981</td>
            <td><input type="text" class="form-control text-uppercase" name="status_consent_air" value="<?=$status_consent_air?>"></td>
        </tr>
        <tr>
            <td colspan="4"> 8. Hazardous Waste Disposal:</td>					
        </tr>
        <tr>
            <td>8.1 Daily generation, treatment,storage facilities & recovery</td>
            <td><textarea type="text" class="form-control text-uppercase" name="generation_treatment"><?=$generation_treatment?></textarea></td>
            <td>8.2 Type of Disposal facility</td>
            <td><textarea type="text" class="form-control text-uppercase" name="disposal_facility"><?=$disposal_facility?></textarea></td>
        </tr>
        <tr>
            <td>8.3 Status of Authorization under the Hazardous waste (Management & Handling) Rule, 1989</td>
            <td><input type="text" class="form-control text-uppercase" name="authorization_hazardous" value="<?=$authorization_hazardous?>"></td>
            <td>8.4 Status of On-site Emergency Plan & its submission to PCBA</td>
            <td><input type="text" class="form-control text-uppercase" name="emergency_plan" value="<?=$emergency_plan?>"></td>
        </tr>
        <tr>
            <td>8.5 Status of Safety Report</td>
            <td><input type="text" class="form-control text-uppercase" name="status_safty" value="<?=$status_safty?>"></td>
            <td>8.6 Implementation of Public Liability Insurance Act. </td>           
            <td><input type="text" class="form-control text-uppercase" name="public_liability" value="<?=$public_liability?>"></td>
        </tr>
        <tr>
            <td>9. Applicability of Bio-Medical Waste Rules, 1998</td>
            <td><input type="text" class="form-control text-uppercase" name="biomedical" value="<?=$biomedical?>"></td>
            <td>10. Status of Water Cess Act:</td>
            <td><input type="text" class="form-control text-uppercase" name="water_cess" value="<?=$water_cess?>"></td>
        </tr>
        <tr>
            <td>11. Overall observation:</td>
            <td><textarea type="text" class="form-control text-uppercase" name="overall_obser"><?=$overall_obser?></textarea></td>
            <td>12. Recommendations in respect of specific actions to be taken by PCBA against the Unit in regard to Pollution Control measures mentioned above:</td>
            <td><textarea type="text" class="form-control text-uppercase" maxlength="1000" name="recom_act"><?=$recom_act?></textarea></td>
        </tr>										
        <tr>
            <td>Date : <label><?=date('d-m-Y')?></label><br/>
                Place: <label><?=strtoupper($b_dist)?></label></td>
            <td></td>
            <td></td>
            <td align="right">
                <label>Signature: <?=strtoupper($staff_name) ?></label><br/>
                <label>Designation: <?=strtoupper($staff_designation) ?></label>
            </td>
        </tr>
        <tr class="bg-teal-active">
            <td>* Remarks :</td>
            <td><textarea type="text" required="required" class="form-control text-uppercase" name="remarks"></textarea></td>
            <td>* Overall Compliance ?</td>
            <td>
                <label class="radio-inline"><input type="radio" required="required" value="S" name="compliance">Satisfactory</label><br/>
                <label class="radio-inline"><input type="radio" required="required" value="M" name="compliance">Moderately Satisfactory</label><br/>
                <label class="radio-inline"><input type="radio" required="required" value="N" name="compliance">Not Satisfactory</label>
            </td>
        </tr>
        <tr>										
            <td class="text-center" colspan="4">
                <button type="submit" class="btn btn-success" name="submit_report" onclick="return confirm('Do you really want to submit this Inspection Report form ?')" >Submit Report</button>
            </td>									
        </tr>
    </table>
</form>