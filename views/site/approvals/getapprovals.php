<?php
$qrylimit=$this->getApproval_model->getApprovals();
$tot_rows=$qrylimit->num_rows();
?>
<div class="box-header with-border">
    <h2 style="text-align: left">
        List of Approvals
    </h2>
</div>


<?php if($tot_rows == 0) { ?>
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <b style="color: red">No Records Found!</b>
</div>
<?php } else { ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Service Name</th>
            <th>Category</th>
            <th>Sample Form</th>
            <th>View Details</th>
            <th>Apply Online</th>
        </tr>
    </thead>
    <tbody>                        
    <?php 
    $sl=1;
   foreach($qrylimit->result() as $rows) {  
        $id = $rows->id;
        
        $dept_code = $rows->dept_code;
		$sub_dept_name = $this->getApproval_model->get_deptbycode($dept_code)? $this->getApproval_model->get_deptbycode($dept_code)->name:"Not Found";
   
        $service_name = $rows->service_name;
        $pieces = explode(" ", $service_name);
        $service_name1 = implode(" ", array_splice($pieces, 0, 10));
        if(str_word_count($service_name) > 10) $service_name1=$service_name1."...";
        
        $application_type = $rows->application_type;
        if($application_type == 4 ) $cat = "Returns And Renewals";
        elseif($application_type == 1 ) $cat = "Pre-Establishment";
        elseif($application_type == 2 ) $cat = "Pre-Operation";
        elseif($application_type == 3 ) $cat = "Post-Commencement";
        elseif($application_type == 5 ) $cat = "Other Approvals";
        elseif($application_type == 6 ) $cat = "Registers";
        else $cat = "Undefined!";
        
        $who_should_apply = $rows->who_should_apply;
        $how_to_apply = $rows->how_to_apply;
        $documents_list = $rows->documents_list;
        $approval_time = $rows->approval_time;
        $fees_payment = $rows->fees_payment;
        $sample_form = $rows->sample_form;
        $form_no = $rows->form_no;
        if($sample_form =="") $sf_link = "<button type='button' class='btn btn-info' disabled='disabled'><i class='glyphicon glyphicon-download'></i> Currently Unavailable!</button>";
        else $sf_link = "<a href='".base_url()."departments/requires/blank_pdf.php?dept=".$dept_code."&form=".$form_no."' class='btn btn-info' target='_blank'><i class='glyphicon glyphicon-download'></i> Download Sample</a>";
    
        $apply_online = $rows->apply_online;
        if($apply_online =="") $ao_link = "<button type='button' class='btn btn-warning' disabled='disabled'><i class='glyphicon glyphicon-share'></i> Coming Soon!</button>";
        else $ao_link = "<a href='".$apply_online."' class='btn btn-warning' target='_blank'><i class='glyphicon glyphicon-share'></i> Apply Now</a>";
		
		
        $sample_name = $rows->sample_name;
        $timeline = $rows->timeline;
        $approval_procedure = $rows->approval_procedure;
        $procedure_attachment = $rows->procedure_attachment;
        ?>
        <tr>
            <td style="text-align: left"><?php echo $service_name; ?></td>
            <!--<td style="text-align: left" data-container="body" data-toggle="tooltip" title="<?php echo $service_name; ?>">
                <?php echo $service_name1; ?>
            </td>-->
            <td style="text-align: left"><?php echo $cat; ?></td>
            <td style="text-align: left"><?php echo $sf_link; ?></td>
            <td style="text-align: left">
                <a href="<?= base_url(); ?>site/approvals/viewapproval/<?php echo $id; ?>/" class="btn btn-success">
                    <i class="glyphicon glyphicon-eye-open" style="font-weight: bold"></i> View
                </a>
            </td>
            <td style="text-align: left;"><?php echo $ao_link; ?></td>
        </tr>
    <?php $sl++; } // End of while ?>
    </tbody>
</table>
<?php } // End of if else ?>
<script>$("[data-toggle='tooltip']").tooltip();</script>
