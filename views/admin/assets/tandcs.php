<?php
$dept_code = $this->session->staff_dept;
if ($this->session->flashdata("flashMsg")) {
    ?>
    <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Terms and conditions
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h2>Category-wise Industry Terms and Conditions</h2>
        </div>
        <div class="box-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="industry_type_id" value="" />
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Industry Type <span class="text-danger">*</span></label>
                        <input type="text" value="" name="industry_type" class="form-control" />
                    </div>  
                </div> <!-- End of .row -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>List of Category-wise Terms and Conditions <span class="text-danger">*</span></label>   
                        <div id="conditionslist">
                            <div class="input-group">
                                <input placeholder="Condition-1" name="conditionslist[]" class="form-control doclist" type="text" />
                                <span class="input-group-btn">
                                    <button type="button" class="add_btn btn btn-info">
                                        <span class="glyphicon glyphicon-plus"></span></button>                                                            
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">								
                    <div class="form-group col-md-12">
                        <label>Upload Annexure <span class="text-danger">*</span></label><br />
                        <input type="file" name="reportfile" id="file1" />
                    </div> 
                </div> <!-- End of .row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="reset" class="btn btn-danger">
                            <i class="glyphicon glyphicon-repeat" style="font-weight: bold"></i> Reset
                        </button>
                        <button type="submit" name="save" class="btn btn-success">
                            <i class="glyphicon glyphicon-ok-sign" style="font-weight: bold"></i> Submit
                        </button>
                    </div>
                </div> <!-- End of .row -->
            </form>
        </div>				
    </div>
    <table class="table table-bordered table-responsive" id="dtbl">
    </table>
</div>