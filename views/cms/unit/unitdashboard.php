<?php
$this->load->helper("unittype");
?>
<?php if ($this->session->flashdata("successMsg")) { ?>
    <script>$.notify("<?= $this->session->flashdata("successMsg"); ?>", "success");</script>
<?php } ?>
<?php if ($this->session->flashdata("errorMsg")) { ?>
    <script>$.notify("<?= $this->session->flashdata("errorMsg"); ?>", "error");</script>
<?php } ?>
    
<div class="content-wrapper" style="padding:80px 10px 20px 10px">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary fixedHeight">
                <div class="box-header with-border">
                    <i class="fa fa-database"></i>
                    <h3 class="box-title">Active UBIN : <b id="ubin"></b></h3>
                    <a href="#">
                        <span data-toggle="tooltip" data-placement="left" title="If you have another unit at a different address but with the same Enterprise name. You can easily obtain an additional UBIN for such unit by clicking on Add Unit." class="glyphicon glyphicon-question-sign pull-right"></span>
                    </a>
                </div>
                 <!-- /.box-header -->
                <div class="box-body" id="active_ubin">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                        <h5><i class="icon fa fa-industry"></i> <strong>Enterprise/Unit Name</strong></h5>
                                <p></p>

                        <h5><i class="icon fa fa-info"></i> <strong>Type of Unit</strong></h5>
                                <p></p>		

                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                        <h5><i class="icon fa fa-map-marker"></i> <strong>Address of Unit</strong></h5>
                                <p>Street : </p>
                                <p>Block/Ward No. : </p>

                    <div class="row">
                        <div class="col-md-4">
                        <a href="" class="btn btn-block btn-success btn-sm"><b>Add Unit</b></a>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                                <button data-toggle="modal" data-target="#manageUBIN" class="btn btn-block btn-primary btn-sm open_manage_ubin" type="button"><b>Manage UBIN</b></button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div> <!--End of .col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary fixedHeight">
                <div class="box-header with-border">
                    <h3 class="box-title">Recent Application Status</h3>
                    <a href="#">
                        <span data-toggle="tooltip" data-placement="left" title="Recent Application Status" class="glyphicon glyphicon-question-sign pull-right"></span>
                    </a>
                </div>
                <div class="box-body" id="recent_applications">
                    <table class="table table-responsive table-bordered table-striped">
					
                        <tr>					  
                            <td></td>
                            <td></td>
                            <td><div class="progress progress-xs"><div style="width: <?php echo $process_width; ?>%" class="progress-bar <?php echo $color_code; ?>"></div></div></td>						  
                        </tr>	
                    </table>
                </div>
            </div>
        </div> <!--End of .col-md-6 -->
    </div> <!--End of .row -->

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary fixedHeight">
                <div class="box-header with-border" style="padding:2px 10px">
                    <i class="fa fa-database"></i>
                    <h3 class="box-title">E-Locker </h3>
                    <button class="btn  btn-info pull-right" data-toggle="modal" data-target="#uploadFileModel" type="button"  data-placement="bottom" title="" class="dropdown messages-menu" data-original-title="Upload your doocuments to the E-locker and you can use these documents anywhere in this portal in future.Documents will remail in your E-locker untill you delete it.">
                        <i aria-hidden="true" class="fa fa-upload"></i> 
                        Upload New Document
                    </button>
                </div>
                <div class="box-body text-center" id="elocker"></div>
            </div>
        </div> <!--End of .col-md-6 -->

        <div class="col-md-6">
            <div class="box box-primary fixedHeight">
                <div class="box-header with-border">
                    <h3 class="box-title">Your Approvals</h3>
                    <a href="#">
                        <span data-toggle="tooltip" data-placement="left" title="Your Approvals" class="glyphicon glyphicon-question-sign pull-right"></span>
                    </a>
                </div>
                <div class="box-body" id="urapprovals">

                    <ul class="products-list product-list-in-box">
                    
                            <li class="item">
                                <div class="product-img">
                                    <i class="fa fa-3x fa-file-pdf-o" aria-hidden="true"></i>
                                </div>
                                <div class="product-info">
                                    <a class="product-title" target="_blank" href="#!">Download Certificate ()
                                    <span class="label label-warning pull-right"></span></a>
                                    <span class="product-description">
                                    
                                    </span>
                                </div>
                            </li>
                    </ul>

                </div>
                <div class="box-footer text-center">

                </div>
            </div>
        </div> <!--End of .col-md-6 -->
    </div> <!--End of .row -->
</div> <!--End of .content-wrapper -->
</div> <!--End of .wrapper -->
    
<?php $this->load->view("users/requires/usersModal"); ?>