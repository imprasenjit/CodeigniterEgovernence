<section class="middleSection">
    <div class="container">
	<div class="row">
            <div class="col-md-12">
		<div style="height:auto; margin: 120px auto 10px auto" class="box box-success">
                    <div class="box-header with-border">
			<h2 class="box-title text-bold">
                            Approval Details
                        </h2>
                    </div>					
                    <div class="box-body no-padding">
                       <?php
					   $var=$this->uri->segment(4);
 
$qrysngle=$this->getApprovalusingId_model->getApproval($var);  
if($qrysngle->num_rows() == 0) {
    echo "No Records Found!";
    die();
} else {
	$row=$qrysngle->row();
	
    $dept_code = $row->dept_code;
    $sub_dept = $row->sub_dept;
    $sub_dept_name = $this->getApproval_model->get_deptbycode($sub_dept,"id")? $this->getApproval_model->get_deptbycode($sub_dept,"id")->name:"Not Found";
    $service_name = $row->service_name;

    $application_type = $row->application_type;
    if($application_type == 1 ) {
        $cat = "Pre-Establishment";
    } elseif($application_type == 2 ) {
        $cat = "Pre-Operation";
    } elseif($application_type == 3 ) {
        $cat = "Post Commencement";
    } elseif($application_type == 4 ) {
        $cat = "Returns & Renewals";
    } elseif($application_type == 5 ) {
        $cat = "Other Approvals";
    } elseif($application_type == 6 ) {
        $cat = "Registers";
    } else {
        $cat = "Undefined!";
    }
    $who_should_apply = $row->who_should_apply;
    $how_to_apply = $row->how_to_apply;
    $documents_list = $row->documents_list;
    $approval_time = $row->approval_time;
    $fees_payment = $row->fees_payment;
    $sample_form = $row->sample_form;
    
    if($sample_form =="") {
        $sf_link = "Not Uploaded!";
    } else {
        $sf_link = "<a href='../../cms/uploads/".$sample_form."' class='btn btn-info' target='_blank'><i class='glyphicon glyphicon-download'></i> ".$sample_form."</a>";
    }
    
    $apply_online = $row->apply_online;
    $sample_name = $row->sample_name;
    $timeline = $row->timeline;
    $approval_procedure = $row->approval_procedure;
    $procedure_attachment = $row->procedure_attachment;
    if($procedure_attachment =="") {
        $pa_link = "Not Uploaded!";
    } else {
        $pa_link = "<a href='uploads/".$sample_form."' class='btn btn-info' target='_blank'><i class='glyphicon glyphicon-download'></i> ".$procedure_attachment."</a>";
    }
} // End of if else ?>


<div class="row myrow">
    <div class="col-md-12">
        <label>Department : </label>            
        <?= $sub_dept_name; ?>
    </div>
</div>

<div class="row myrow">
    <div class="col-md-12">
        <label>Category of Application : </label>            
        <?= $cat; ?>
    </div>
</div>

<div class="row myrow">
    <div class="col-md-12">
        <label>Service Name : </label>            
        <?= $service_name; ?>
    </div>
</div>

<div class="row myrow">
    <div class="col-md-12">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#whoShouldApply">
                            Who should Apply : 
                        </a>
                    </h4>
                </div>
                <div id="whoShouldApply" class="panel-collapse collapse">
                    <div class="panel-body"><?= $who_should_apply; ?></div>
                </div>
            </div><!--End of .panel-->
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#howToApply">
                            How To Apply : 
                        </a>
                    </h4>
                </div>
                <div id="howToApply" class="panel-collapse collapse">
                    <div class="panel-body"><img src="<?= base_url(); ?>storage/ListOfApprovalsUploads/howtoapply.png" style="width:100%;" /></div>
                </div>
            </div><!--End of .panel-->
                        
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#approvalProcedure">
                            Department Approval Procedure :
                        </a>
                    </h4>
                </div>
                <div id="approvalProcedure" class="panel-collapse collapse">
                    <div class="panel-body"><?= $approval_procedure; ?></div>
                </div>
            </div><!--End of .panel-->
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#documentList">
                            List of documents to be submitted :
                        </a>
                    </h4>
                </div>
                <div id="documentList" class="panel-collapse collapse">
                    <div class="panel-body"><?= $documents_list; ?></div>
                </div>
            </div><!--End of .panel-->
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#approvalTime">
                            Timeline for approval : 
                        </a>
                    </h4>
                </div>
                <div id="approvalTime" class="panel-collapse collapse">
                    <div class="panel-body"><?= $approval_time; ?></div>
                </div>
            </div><!--End of .panel-->
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#feesPayment">
                            Fees & Payments : 
                        </a>
                    </h4>
                </div>
                <div id="feesPayment" class="panel-collapse collapse">
                    <div class="panel-body"><?= $fees_payment; ?></div>
                </div>
            </div><!--End of .panel-->
        </div><!--End of panel-group-->
    </div>
</div>

<div class="row myrow">
    <div class="col-md-12">
        <label>Apply Online Link : </label>            
        <a href="<?= $apply_online; ?>">
            Click to apply now
        </a> 
    </div>
</div>

<div class="row myrow">
    <div class="col-md-6">
        <label>Short Name of Service  : </label>            
        <?= $sample_name; ?>
    </div>
    <div class="col-md-6">
        <label>Timeline in days : </label>            
        <?= $timeline; ?>
    </div>
</div>

<div class="row myrow">
    <div class="col-md-6">
        <label>Procedure Attachment : </label>            
        <?= $pa_link; ?>
    </div>
    <div class="col-md-6">
        <label>Sample Form : </label>            
        <?= $sf_link; ?>
    </div>
</div>

<div class="row text-center">
    <a href="./" class="btn btn-warning">
        <i class="glyphicon glyphicon-chevron-left" style="font-weight: bold"></i> Back to List
    </a>
</div>
                    </div> <!-- End of .box-body -->
                </div> <!-- End of .box -->
            </div> <!-- End of .col-md-12 -->
	</div> <!-- End of .row -->
    </div> <!-- End of .container -->
</section>