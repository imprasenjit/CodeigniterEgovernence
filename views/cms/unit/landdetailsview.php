<?php
$id = $this->session->userdata('edit_unitid');
$row = $this->unit_model->getlanddetails($id);
if(!$row)
{
   die();
}

?><div class="row">
    <div class="col-md-12"> <h4>Is Land / Shed situated in <br>Industrial Growth Center / Industrial Estate: <?php if($row->estate==""){echo "No";}else{echo $row->estate;} ?></h4></div>
    <div class="col-md-12"> <h4>Type of Area : <?= $row->area_type; ?></h4></div>
    <div class="col-md-12"> <h4>Status of Land/Building/Premises : <?= $row->land_status; ?></h4></div>
    <div class="col-md-12"> <h4>Type of Land : <?= $row->land_type; ?></h4></div>
    <div class="col-md-12"> <h4>Dag No : <?= $row->dag_no; ?></h4></div>
    <div class="col-md-12"> <h4>Patta No : <?= $row->patta_no; ?></h4></div>
    <div class="col-md-12"> <h4>Mouza : <?= $row->mouza; ?></h4></div>

</div>