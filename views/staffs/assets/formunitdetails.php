<?php
$cafRow = $this->cafs_model->get_row($this->swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $unit_type = $cafRow->unit_type;
    $unitName = get_unittype($unit_type);
    $b_dist = $cafRow->b_dist;
    $b_block = $cafRow->b_block;
}//End of if
?>
<table class="table table-bordered table-responsive">
    <thead>
        <tr class="success">
            <th>UBIN</th>
            <th>Enterprise Name</th>
            <th>Enterprise Address</th>
            <th>Unit Type</th>
        </tr>
    </thead>
    <tbody>
        <tr>	
            <td><?=$ubin?></td>
            <td><?=$companyName?>C</td>
            <td><?=$b_dist." ".$b_block?></td>
            <td><?=$unitName?></td>
        </tr>
    </tbody>
</table>