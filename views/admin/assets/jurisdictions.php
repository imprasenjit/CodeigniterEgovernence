<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Jurisdictions
        <a href="javascript:void(1)" class="btn btn-warning backbtn-alm" data-toggle="modal" data-target="#officeModal">
            <i class="fa fa-plus-circle"></i> Add new office
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="dtbl">
        <thead>
            <tr class="success">
                <th>#</th>
                <th>Name of the office</th>
                <th>Jurisdiction</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            if($this->offices_model->get_rows($dept_code)) {
            $sl=1;
            foreach($this->offices_model->get_rows($dept_code) as $rows) {
                $office_id = $rows->id;
                $office_name = $rows->office_name;
                $jurisdiction = $rows->jurisdiction;
                ?>
            <tr>
                <td><?=sprintf("%02d", $sl)?></td>
                <td><?=$office_name?></td>
                <td><?=$jurisdiction?></td>
                <td class="text-center">                    
                    <a id="<?=$office_id?>" class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#officeModal">
                        <i class="fa fa-pencil"></i> Modify
                    </a>
                </td>
            </tr>
            <?php $sl++; } } ?>
        </tbody>
    </table>
</div>
        
<div class="modal fade" id="officeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width:50%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add new office</h4>
            </div>
            <form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="box box-success">
                    <div class="modal-body">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td width="50%">
                                    <div class="form-group">
                                        <label>Name of the Office <span style="color:#f00"> * </span></label>
                                        <input type="text" validate="specialChar" class="form-control text-uppercase" id="" name="office_name" placeholder="Name of Office" required/>
                                    </div>
                                </td>	
                                <td width="50%">
                                    <div class="form-group-addon">
                                        <label>Email-id <span style="color:#f00"> * </span></label>
                                        <input type="email" class="form-control" id="" name="email" placeholder="Enter valid email id" required/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <button type="submit" name="submit" class="btn btn-success">Add Office</button>
                                </td>
                            </tr>
                        </table>
                    </div>	
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>