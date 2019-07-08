<?php
$unit_id = $this->session->unit_id;
$dept_code = $this->uri->segment("2");
$form_no=1;
/*
$unit_row = $this->unit_model->get_row($unit_id);
$key_person = $unit_row->Key_person;
$unit_name = $unit_row->Name;
$status_applicant = $unit_row->status_applicant;
$street_name1 = $unit_row->Street_name1;
$street_name2 = $unit_row->Street_name2;
$vill = $unit_row->Vill;
$dist = $unit_row->Dist;
$block = $unit_row->block;
$pincode = $unit_row->Pincode;
$mobile_no = $unit_row->Mobile_no;
$landline_std = $unit_row->Landline_std;
$landline_no = $unit_row->Landline_no;
$b_street_name1 = $unit_row->b_street_name1;
$b_street_name2 = $unit_row->b_street_name2;
$b_vill = $unit_row->b_vill;
$b_dist = $unit_row->b_dist;
$b_block = $unit_row->b_block;
$b_pincode = $unit_row->b_pincode;
$b_mobile_no = $unit_row->b_mobile_no;
$b_landline_std = $unit_row->b_landline_std;
$b_landline_no = $unit_row->b_landline_no;
$b_email = $unit_row->b_email;
$b_street_name3 = $unit_row->b_street_name3;
$b_street_name4 = $unit_row->b_street_name4;
$b_vill2 = $unit_row->b_vill2;
$b_dist2 = $unit_row->b_dist2;
$b_block2 = $unit_row->b_block2;
$b_pincode2 = $unit_row->b_pincode2;

$from = $key_person . "<br/>Address : " . $street_name1 . " " . $street_name2 . "<br/>Vill/Town : " . $vill . "," . $dist . "<br/>Pin Code : " . $pincode . "<br/>Mobile Number : +91 " . $mobile_no;

$unit_details = $unit_name . "\n" . $b_street_name1 . "  " . $b_street_name2 . "\nVill/Town :" . $b_vill . " , " . $b_dist . "\nPin Code : " . $b_pincode . "\nMobile Number : +91 " . $b_mobile_no . "\nPhone Number : " . $b_landline_std . "-" . $b_landline_no;

$owner_type = $unit_row->Type_of_ownership;
$date_of_commencement = $unit_row->date_of_commencement;

$sector_classes_b = $unit_row->sector_classes_b;
//$business_type = get_sector_classes_b_value($sector_classes_b);

$form_row = $this->form_details_model->get_row($form_id, $dept_code,$form_no);

$q = $formFunctions->executeQuery($dept, "select * from " . $table_name . " where user_id='$unit_id' and active='1'");
if ($q->num_rows < 1) {
    $p = $formFunctions->executeQuery($dept, "select * from " . $table_name . " where user_id='$unit_id' and active='0' ORDER BY form_id DESC LIMIT 1");
    if ($p->num_rows > 0) {
        $results = $p->fetch_assoc();
        $form_id = $results["form_id"];
        $manager_name = $results["manager_name"];
        $estab_category = $results["estab_category"];
        $max_workers = $results["max_workers"];

        if (!empty($results["situation"])) {
            $situation = json_decode($results["situation"]);
            $situation_office = $situation->office;
            $situation_storeroom = $situation->storeroom;
            $situation_godown = $situation->godown;
            $situation_warehouse = $situation->warehouse;
        } else {
            $situation_office = "";
            $situation_storeroom = "";
            $situation_godown = "";
            $situation_warehouse = "";
        }
        if (!empty($results["manager_address"])) {
            $manager_address = json_decode($results["manager_address"]);
            $m_street_name1 = $manager_address->sn1;
            $m_street_name2 = $manager_address->sn2;
            $m_vill = $manager_address->vill;
            $m_dist = $manager_address->dist;
            $m_pin = $manager_address->pin;
        } else {
            $m_street_name1 = "";
            $m_street_name2 = "";
            $m_vill = "";
            $m_dist = "";
            $m_pin = "";
        }
    } else {
        $form_id = "";
        $situation_office = "";
        $situation_storeroom = "";
        $situation_godown = "";
        $situation_warehouse = "";
        $manager_name = "";
        $m_street_name1 = "";
        $m_street_name2 = "";
        $m_vill = "";
        $m_dist = "";
        $m_pin = "";
        $estab_category = "";
        $max_workers = "0";
        $nature_business = "";
        $date_business = "";
    }
} else {
    $results = $q->fetch_assoc();
    $form_id = $results["form_id"];
    $manager_name = $results["manager_name"];
    $estab_category = $results["estab_category"];
    $max_workers = $results["max_workers"];

    if (!empty($results["situation"])) {
        $situation = json_decode($results["situation"]);
        $situation_office = $situation->office;
        $situation_storeroom = $situation->storeroom;
        $situation_godown = $situation->godown;
        $situation_warehouse = $situation->warehouse;
    } else {
        $situation_office = "";
        $situation_storeroom = "";
        $situation_godown = "";
        $situation_warehouse = "";
    }
    if (!empty($results["manager_address"])) {
        $manager_address = json_decode($results["manager_address"]);
        $m_street_name1 = $manager_address->sn1;
        $m_street_name2 = $manager_address->sn2;
        $m_vill = $manager_address->vill;
        $m_dist = $manager_address->dist;
        $m_pin = $manager_address->pin;
    } else {
        $m_street_name1 = "";
        $m_street_name2 = "";
        $m_vill = "";
        $m_dist = "";
        $m_pin = "";
    }
}
*/

if (isset($result)) {
    $form_id = $result->form_id;
} elseif ($this->unit_model->get_row($unit_id)) {
    $form_id = "";
    $row_unit = $this->unit_model->get_row($unit_id);
    $key_person = $row_unit->Key_person;
    $unit_name = $row_unit->Name;
    $status_applicant = $row_unit->status_applicant;
    $street_name1 = $row_unit->Street_name1;
    $street_name2 = $row_unit->Street_name2;
    $vill = $row_unit->Vill;
    $dist = $row_unit->Dist;
    $block = $row_unit->block;
    $pincode = $row_unit->Pincode;
    $mobile_no = $row_unit->Mobile_no;
    $landline_std = $row_unit->Landline_std;
    $landline_no = $row_unit->Landline_no;
    $b_street_name1 = $row_unit->b_street_name1;
    $b_street_name2 = $row_unit->b_street_name2;
    $b_vill = $row_unit->b_vill;
    $b_dist = $row_unit->b_dist;
    $b_block = $row_unit->b_block;
    $b_pincode = $row_unit->b_pincode;
    $b_mobile_no = $row_unit->b_mobile_no;
    $b_landline_std = $row_unit->b_landline_std;
    $b_landline_no = $row_unit->b_landline_no;
    $b_email = $this->session->user_email;

    $b_street_name3 = $row_unit->b_street_name3;
    $b_street_name4 = $row_unit->b_street_name4;
    $b_vill2 = $row_unit->b_vill2;
    $b_dist2 = $row_unit->b_dist2;
    $b_block = $row_unit->b_block2;
    $b_pincode2 = $row_unit->b_pincode2;


    $n_rail_station = set_value("n_rail_station");
    $particulars = set_value("particulars");
    $fac_situation = set_value("fac_situation");
    $province = set_value("province");
    $vill3 = set_value("vill3");
    $pin3 = set_value("pin3");
    $m_no = set_value("m_no");
    $signature = set_value("signature");
} else {
    $form_id = "";
    $key_person = set_value("key_person");
    $street_name1 = set_value("street_name1");
    $street_name2 = set_value("street_name2");
    $vill = set_value("vill");
    $dist = set_value("dist");
    $pincode = set_value("pincode");
    $mobile_no = set_value("mobile_no");
    $landline_std = set_value("landline_std");
    $landline_no = set_value("landline_no");
    $b_email = set_value("b_email");
    $unit_name = set_value("unit_name");
    $particulars = set_value("particulars");
    $fac_situation = set_value("fac_situation");
    $province = set_value("province");
    $vill3 = set_value("vill3");
    $pin3 = set_value("pin3");
    $m_no = set_value("m_no");
    $signature = set_value("signature");
}
if ($this->session->flashdata("flashMsg")) {
    ?>
    <script type="text/javascript">
        $.notify("<?= $this->session->flashdata('flashMsg') ?>", "success");
    </script>
<?php } ?>



<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="text-center" >
            <strong>FORM NO. <?= $form_no ?></strong><br/><p class="text-center">(Prescribed under Rule 3)</p>
            <strong><?= $form_name ?></strong>
            
        </h4>	
    </div>
    <div class="panel-body"><?php //print_r($row_unit);   ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
        <form  method="post" action="<?= base_url('forms/factory/form1/save') ?>" enctype="multipart/form-data">
            <input type="hidden" name="form_id" value="<?= $form_id ?>" />
            <table class="table table-responsive">
                <tr>
                    <td>1.Name of the Applicant:</td>
                    <td>
                        <input type="text" disabled="disabled" class="form-control text-uppercase" value="<?= $key_person ?>" />
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">2. Address of the Applicant :</td>
                </tr>
                <tr>
                    <td>Street Name1 :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $street_name1 ?>"></td>
                    <td>Street Name2 :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $street_name2 ?>"></td>
                </tr>
                <tr>
                    <td>Village/Town :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $vill ?>"></td>
                    <td>District :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $dist ?>"></td>
                </tr>
                <tr>
                    <td>Pin Code :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $pincode ?>"></td>
                    <td>Mobile No :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= "+91-" . $mobile_no ?>"></td>
                </tr>
                <tr>
                    <td>Phone No :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $landline_std . " - " . $landline_no ?>"></td>
                    <td>Email ID :</td>
                    <td><input type="text" class="form-control" disabled="disabled" value="<?= $b_email ?>"></td>
                </tr>
                <tr>
                    <td>3.(a) Full name of the Factory/Establishment :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $unit_name ?>"></td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td colspan="4">3.(b) Address for communication of the factory/establishment :</td>
                </tr>
                <tr>
                    <td>Street Name1 :</td>
                    <td><input type="text" class="form-control text-uppercase" name="fac_situation" value="<?= $fac_situation ?>" /></td>
                    <td>Street Name2 :</td>										
                    <td><input type="text" class="form-control text-uppercase" name="province"  value="<?= $b_street_name4 ?>"></td>
                </tr>
                <tr>
                    <td>Village/Town :</td>
                    <td><input type="text" class="form-control text-uppercase" name="vill3" value="<?= $vill3 ?>"></td>
                    <td>District :<span class="mandatory_field">*</span></td>										
                    <td><input type="text" class="form-control text-uppercase" name="vill3" value=""></td>
                </tr>
                <tr>
                    <td>Pin Code :</td>										
                    <td><input type="text" class="form-control text-uppercase" name="pin3" validate="pincode" maxlength="6" value="<?= $pin3; ?>"/></td>
                    <td>Mobile No :</td>
                    <td><input type="text" class="form-control text-uppercase" name="m_no" validate="mobileNumber" maxlength="10" value="<?= $m_no; ?>"></td>
                </tr>
                <tr>
                    <td colspan="4"> 4. Location of the Factory :</td>
                </tr>
                <tr>

                    <td>Street Name :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $b_street_name3 ?>"/></td>
                    <td>Province :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $b_street_name4 ?>"></td>
                </tr>
                <tr>
                    <td>Village/Town :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $b_vill2 ?>"></td>
                    <td>District :</td>										
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $b_dist2 ?>"></td>
                </tr>
                <tr>
                    <td>Pin Code :</td>
                    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?= $b_pincode2 ?>"></td>
                    <td>Nearest railway station :<span class="mandatory_field">*</span></td>
                    <td><input type="text" class="form-control text-uppercase" name="n_rail_station" value="<?= $n_rail_station ?>"><?= form_error("n_rail_station") ?></td>
                </tr>
                <tr>
                    <td>5. Particulars of Plants & Machinery to be installed :</td>
                    <td><textarea class="form-control text-uppercase" name="particulars"><?= $particulars ?></textarea></td>


                </tr>
                <tr>
                    <td >6. Nature of Manufacturing Powers/Inputs/Outputs/Wastages : </td>
                    <td colspan="3">
                        <label class="radio-inline"><input type="radio" id="inlineRadio1" value="Y" name="is_hazardous"> Hazardous </label>
                        <label class="radio-inline"><input type="radio" id="inlineRadio1"  value="N" name="is_hazardous"> Non-Hazardous </label><br/>*If you choose HAZARDOUS then after final submission,you need to fill up the SITE APPRAISAL FORM.
                    </td>									
                </tr>
                <tr>
                    <td>Date : <?= date('d-m-Y') ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Signature of the applicant : <label id="signature" class="text-uppercase"><?= $signature ?></label></td>
                </tr>
                <tr>									
                    <td class="text-center" colspan="4">
                        <button type="submit" name="save" class="btn btn-success submit1" name="signature">Save &amp; Next</button>
                    </td>									
                </tr>
            </table>
        </form>
    </div>
</div>
</div> <!--End of .content-wrapper -->