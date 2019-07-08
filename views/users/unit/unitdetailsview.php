<?php
$id = $this->session->userdata('edit_unitid');
$row = $this->unit_model->getunitdetails($id);
$this->load->helper("unittype");
?><div class="row">
    <div class="col-md-6"> <h4>unit name : <?= $row->unit_name ?></h4></div><div class="col-md-6"> <h4>unit type : <?= get_unittype($row->unit_type); ?></h4></div>
    <div class="col-md-12">  </div>
    <div class="col-md-12"> <h4>Date of commencement : <?= $row->dateofcommencement; ?> </h4></div>
    <div class="col-md-2"> 
        <h4>Address </h4></div><div class="col-md-4"> 
            <?php $this->load->helper("address");
            view_address($row->address);?>
    </div>    
    <div class="col-md-6"> <h4>Landline no : <?= $row->landline_std; ?> <?= $row->landline_no ?></h4>
        <h4>Mobile number : <?= $row->mobile_no; ?> </h4>
        <h4>Email id : <?= $row->email_id; ?> </h4></div>
    <div class="col-md-6"><h4>Block:<?=$row->block?> </h4> </div> <div class="col-md-6"><h4>Revenue Circle:<?=$row->revenue_circle?></h4></div>
</div>