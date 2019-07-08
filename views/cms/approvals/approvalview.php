<?php
$id = $this->uri->segment(4);
$approval = $this->approvals_model->getApproval($id);
$caregory = array(
    1 => "Pre-Establishment",
    2 => "Pre-Operation",
    3 => "Post Commencement",
    4 => "Returns & Renewals",
    5 => "Other Approvals",
    6 => "Registers",
);
?>
<div class="content-wrapper">		

    <section class="content">

        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>List of Approval Details</h2>

            </div>

            <div class="box-body" id="boxbody">

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Department : </label>            
                        <?php echo $this->getDepartments_model->get($approval->dept_code)->name; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Sub Department : </label>            
                        <?php echo $this->getSubDepartment_model->get_deptbyid($approval->sub_dept)->name; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Category of Application : </label>            
                        <?php echo $caregory[$approval->application_type]; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Service Name : </label>            
                        <?php echo $approval->service_name; ?>
                    </div>
                </div>
                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Who should Apply : </label>            
                        <?php echo $approval->who_should_apply; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>How To Apply : </label>            
                        <?php echo $approval->how_to_apply; ?>
                    </div>
                </div>
                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Department Approval Procedure : </label>            
                        <?php echo $approval->approval_procedure; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>List Of Documents to be submitted : </label>            
                        <?php echo $approval->documents_list; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>List Of Documents to be submitted (New) : </label>    
                        <ul style="padding-left: 20px">
                            <?php
                            if (isset($approval->documentslist)) {
                                $temp = json_decode($approval->documentslist, true);
                                foreach ($temp["obj"] as $key => $values) {
                                    echo "<li>$values</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Timeline for approval : </label>            
                        <?php echo $approval->approval_time; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Fees & Payments : </label>            
                        <?php echo $approval->fees_payment; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-12">
                        <label>Apply Online Link : </label>            
                        <?php echo $approval->apply_online; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-6">
                        <label>Short Name of Service  : </label>            
                        <?php echo $approval->sample_name; ?>
                    </div>
                    <div class="col-md-6">
                        <label>Timeline in days : </label>            
                        <?php echo $approval->timeline; ?>
                    </div>
                </div>

                <div class="row myrow">
                    <div class="col-md-6">
                        <label>Procedure Attachment : </label>            
                        <?php                         
                         $pa_link= "<a href='uploads/".$approval->procedure_attachment."' class='btn btn-info' target='_blank'><i class='glyphicon glyphicon-download'></i> ".$approval->procedure_attachment."</a>";
                         echo $pa_link;
                        ?>
                    </div>
                    <div class="col-md-6">
                        <label>Sample Form : </label>            
                        <?php $sf_link = "<a href='uploads/" . $approval->sample_form . "' class='btn btn-info' target='_blank'><i class='glyphicon glyphicon-download'></i> " . $approval->sample_form . "</a>";
                        echo $sf_link;
                        ?>
                    </div>
                </div>

                <div class="row text-center">
                    <a href="approvals.php" class="btn btn-warning">
                        <i class="glyphicon glyphicon-chevron-left" style="font-weight: bold"></i> Back to List
                    </a>
                    <a href="new_approval.php?id=<?php echo $id; ?>" class="btn btn-info">
                        <i class="glyphicon glyphicon-pencil" style="font-weight: bold"></i> Edit
                    </a>
                </div>

            </div> <!-- End of .box-body -->  

        </div> <!-- End of .box -->  

    </section>

</div>  