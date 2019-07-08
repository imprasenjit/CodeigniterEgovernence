<?php
$unit_id = $this->session->unit_id;
//$ubin_details = $this->unit_model->get_row($unit_id);
//$ubin=$ubin_details->ubin;
//$applications_results = $this->unit_model->approved_applications($unit_id);
//$recent_submitted_applications = $this->unit_model->recent_submitted_applications($unit_id);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>USER AREA || EODB DASHBOARD</title>
        <?php $this->load->view("users/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <?php if ($this->session->flashdata("successMsg")) { ?>
            <script>$.notify("<?= $this->session->flashdata("successMsg"); ?>", "success");</script>
        <?php } ?>
        <?php if ($this->session->flashdata("errorMsg")) { ?>
            <script>$.notify("<?= $this->session->flashdata("errorMsg"); ?>", "error");</script>
        <?php } ?>
        <div class="wrapper">
            <?php $this->load->view("users/requires/header"); ?>
            <div class="content-wrapper" style="padding:80px 10px 20px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border text-center">
                                <h2>Add Unit</h2>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="active_ubin">

                                <form name="myform1" id="myform1" method="post" action="<?php echo base_url(); ?>user/addunit" enctype="multipart/form-data">
                                    <div class="row" style="margin-bottom: 20px; margin-top: 30px;">
                                        <label for="" class="col-xs-2 col-form-label text-left"><font style="color: #3c763d">If you have an additional unit (branch, godown, factory, regional head office etc.) then you can obtain an additional Unique Business Identification Number (UBIN) pertaining to your unit without having to file Common Application Form again.</font></label>
                                        <div class="col-lg-10"><div class="connecting-line" style="border: 1px solid #90EE90; margin-top: 10px;"></div></div>
                                    </div>
                                    <table class="table table-responsive">
                                        <tr>
                                            <td colspan="2">Type Of Unit<span class="mandatory_field">*</span></td>
                                            <td colspan="2">
                                                <select name="unit_type" class="form-control text-uppercase" id="unit_type" required="required">
                                                    <option value="">Please Select</option>
                                                    <option value="H">Head Office</option>
                                                    <option value="B">Branch Office</option>
                                                    <option value="F">Factory</option>
                                                    <option value="G">Godown</option>
                                                    <option value="O">Others</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Unit Name :</td>
                                            <td colspan="3"><input type="text" name="add_unit_name" placeholder="Optional" class="form-control text-uppercase"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Address of the Unit :</td>
                                        </tr>
                                        <tr>
                                            <td>Street 1 <span class="mandatory_field">*</span></td>
                                            <td><input type="text" name="street1" required="required" class="form-control text-uppercase"></td>
                                            <td>Street 2 </td>
                                            <td><input type="text" name="street2" class="form-control text-uppercase"></td>
                                        </tr>
                                        <tr>
                                            <td>Village/Town <span class="mandatory_field">*</span></td>
                                            <td><input type="text"  name="vill" required="required" class="form-control text-uppercase"></td>
                                            <td>District <span class="mandatory_field">*</span></td>
                                            <td><?php
                                                $dstresult = $this->GetDistrict_model->getAllDistrict();
                                                ?>
                                                <select name="dist" id="insert_caf_dist" required="required" class="form-control text-uppercase" >
                                                    <option value="">Please Select</option>
                                                    <?php foreach ($dstresult as $key => $dstrows) { ?>
                                                        <option value="<?php echo $dstrows['district']; ?>" ><?php echo $dstrows['district']; ?></option>
                                                    <?php } ?>					
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>							
                                            <td>Block <span class="mandatory_field">*</span></td>
                                            <td>
                                                <select name="block" id="b_block" required="required" class="form-control text-uppercase " >
                                                    <option value=""> Select Block </option>
                                                </select>
                                                <br/><a style="text-decoration:none" href="../common/know-your-ward.html" target="_blank"><span id="knowWard-3" class="tooltip-kyw knowWard">Know Your Ward</span></a>
                                            </td>
                                            <td>Pin Code <span class="mandatory_field">*</span></td>
                                            <td>
                                                <select name="pincode" id="b_pincode" class="form-control text-uppercase">
                                                    <option value=""> Select Pincode</option>																		
                                                </select>
                                                <font class="compulsory"> </font>
                                            </td>							
                                        </tr>						
                                        <tr>
                                            <td>Revenue Circle <span class="mandatory_field">*</span> </td>
                                            <td>
                                                <select name="revenue" id="revenue" class="form-control text-uppercase">
                                                    <option value=""> Select Revenue Circle</option>																		
                                                </select>
                                            </td>
                                            <td>Subdivision <span class="mandatory_field">*</span> </td>
                                            <td>
                                                <select name="subdivision" id="subdivision" class="form-control text-uppercase">
                                                    <option value=""> Select Subdivision</option>																	
                                                </select>
                                            </td>	
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="center"><button type="submit" class="btn btn-success" name="addunit" >Add Unit</button></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div> <!--End of .row -->
                    </div> <!--End of .content-wrapper -->
                </div> <!--End of .wrapper -->
                <?php $this->load->view("users/requires/usersModal"); ?>
                <?php $this->load->view("users/requires/footer"); ?>
                </body>
                </html>
