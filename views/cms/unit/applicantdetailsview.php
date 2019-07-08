
<?php
$id = $this->session->userdata('edit_unitid');
$row = $this->unit_model->getapplicantdetails($id);
if(!$row)
{
   die();
}

?><div class="row">
    <div class="col-md-12"> <h4>Authorised person name : <?= $row->app_name ?></h4></div>
    <div class="col-md-12"> <h4>Designation : <?= $row->app_designation; ?></h4></div>
    <div class="col-md-2"> 
        <h4>Address : </h4></div>
        <div class="col-md-4"> <h4><?= $row->address->house_no; ?>
            <br><?= $row->address->street; ?>
            <br><?= $row->address->village; ?>
            <br><?= $row->address->dist; ?>
            <br><?= $row->address->state; ?>-<?= $row->address->pin; ?>
        </h4>
        </div>
    <div class="col-md-6"> <h4>Landline : <?= $row->app_std_code; ?> <?= $row->app_phone_no ?></h4>
        <h4>Mobile : <?= $row->app_mobile_no; ?> </h4>
        <h4>Email id : <?= $row->app_email; ?> </h4></div>
</div>