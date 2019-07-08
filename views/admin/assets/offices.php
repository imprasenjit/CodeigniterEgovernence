<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Offices
        <a href="javascript:void(1)" class="btn btn-warning backbtn-alm" data-toggle="modal" data-target="#officeModal">
            <i class="fa fa-plus-circle"></i> Add new office
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="dtbl">
        <thead>
            <tr class="success">
                <th>#</th>
                <th>Name of the office</th>
                <th>Address</th>
                <th>Block/Ward</th>
                <th>District</th>
                <th>Pincode</th>
                <th>Tel No.</th>
                <th>Mobile No.</th>
                <th>E-Mail Id</th>
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
                $street1 = $rows->street1;
                $street2 = $rows->street2;
                $city = $rows->city;
                $district = $rows->district;
                $block = $rows->block;
                $pin = $rows->pin;
                $email = $rows->email;
                $mobile_no = $rows->mobile_no;
                $tel_std_code = $rows->tel_std_code;
                $tel_no = $rows->tel_no;
                $jurisdiction = $rows->jurisdiction;
                ?>
            <tr>
                <td><?=sprintf("%02d", $sl)?></td>
                <td><?=$office_name?></td>
                <td><?=$street1." ".$street2." ".$city?></td>
                <td><?=$block?></td>
                <td><?=$district?></td>
                <td><?=$pin?></td>
                <td><?=$tel_no?></td>
                <td><?=$mobile_no?></td>
                <td><?=$email?></td>
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
                                <td>
                                    <div class="form-group">
                                        <label>Street Name 1 <span style="color:#f00"> * </span></label>
                                        <input type="text" validate="specialChar" class="form-control text-uppercase" name="street1" id="" placeholder="Enter Street Name" required/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label>Street Name 2</label>
                                        <input type="text" validate="specialChar" class="form-control text-uppercase" name="street2"  id="" placeholder="Enter Street Name" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label>City/Town <span style="color:#f00"> * </span></label>
                                        <input type="text" validate="specialChar" class="form-control text-uppercase"  name="city" id="" placeholder="Enter City/Town Name" required/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label>District <span style="color:#f00"> * </span></label>
                                        <select name="district" required="required" class="form-control text-uppercase" id="dist">
                                            <option value="">Please Select</option>
                                            <?php
                                            foreach ($this->districts_model->get_rows() as $rows) {
                                                ?>
                                                <option value="<?php echo $rows->district; ?>"><?php echo $rows->district; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label>Block/Ward</label>
                                        <select class="form-control text-uppercase" name="block" disabled="disabled" id="block"></select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label>Pincode <span style="color:#f00"> * </span></label>
                                        <input type="text" validate="pincode" class="form-control text-uppercase" name="pin" id="" placeholder="Enter 6 digit Pincode" required/>
                                    </div>
                                <td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-inline">
                                        <label>Office Telephone No.</label><br/>
                                        <input type="text" class="form-control text-uppercase" style="width:60px" validate="onlyNumbers" id="" pattern="[0-9]{3,5}" title="Please Enter a valid std code e.g. 0361" name="tel_std_code" maxlength="5" placeholder="STD" /> - <input type="text" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{5,7}" maxlength="7" name="tel_no" id="" title="Please Enter a valid phone no. e.g. 262056" placeholder="Tel No" />
                                    </div>
                                </td>			   
                                <td>
                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">+91</div>
                                            <input type="text" validate="mobileNumber" class="form-control text-uppercase" name="mobile_no" id="" placeholder="Enter your mobile number" required/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><button type="submit" name="submit" class="btn btn-success">Add Office</button></td>
                            </tr>
                        </table>
                    </div>	
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>