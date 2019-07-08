
<?php
$id = $this->session->userdata('edit_unitid');
$row = $this->unit_model->getapplicantdetails($id);
if(!$row)
{
   die();
}

?><div class="row">
    <div class="col-md-12"> <h4>Authorised person name : <?= $row->app_name ?></h4></div>
    <div class="col-md-12"> <h4>Username : <?= $row->app_username; ?></h4></div>
    <div class="col-md-12"> <h4>Designation : <?= $row->app_designation; ?></h4></div>
    <div class="col-md-2"> 
        <h4>Address : </h4></div>
        <div class="col-md-4"> <h4>
        <?php $this->load->helper("address");
        view_address($row->address);
        ?>
        </h4>
        </div>
   
        <h4>Mobile : <?= $row->app_mobile_no; ?> </h4>
        <h4>Email id : <?= $row->app_email; ?> </h4></div>
</div>