<?php
$id = $this->session->userdata('edit_unitid');
$row = $this->unit_model->getotherdetails($id);
$investment = array(
    "1" => "Below INR 10 LAKH",
    "2" => "INR 10 LAKH to 25 LAKH",
    "3" => "INR 25 LAKH to 2.00 CRORE",
    "4" => "INR 2.00 CRORE to 5.00 CRORE",
    "5" => "INR 5.00 CRORE to 10.00 CRORE",
    "6" => "Above 10.00 CRORE"
);

$pollutionarray = array(
    "1" => "RED",
    "2" => "ORANGE",
    "3" => "GREEN",
    "4" => "OTHERS"
);
if (!$row) {
    die();
}
$sector = $this->unit_model->getsectors($row->operation_sector);
$businesstypes = $this->unit_model->getbusinesstypes("", $row->business_type);
?>
<div class="row">
    <div class="col-md-12"> <h4>Size of Current Investment : <?= $investment[$row->investment_size]; ?></h4></div>
    <div class="col-md-12"> <h4>Current/Estimated Employment : <?= $row->no_of_employee; ?></h4></div>
    <div class="col-md-12"> <h4>Sector of Operation : <?= $sector[0]->sector_name; ?></h4></div>
    <div class="col-md-12"> <h4>business type : <?= $businesstypes[0]->business_type; ?></h4></div>
    <div class="col-md-12"> <h4>Category of Enterprise based on pollution : <?= $pollutionarray[$row->entp_category]; ?></h4></div>
    <div class="col-md-12"> <h4>Power Requirement in KW : <?= $row->power_requirement; ?></h4></div>
</div>