<div class="modal fade" id="filefromPC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload File From PC</h4>
            </div>
            <form class="frmUpload" action="" method="post" enctype="multipart/form-data">
                <div class="box box-success">
                    <div class="modal-body">
                        <div class="img-preview"></div>
                        <input type="hidden" id="formupload_file" value="" name="formupload_file">
                        <div class="form-group">
                            <input type="file" id="userImage" name="file" required="required" />							
                        </div>
                        <div class="filetype_Error"></div>						
                        <div class="form-group">
                            <label for="exampleInputEmail1">File Name</label>
                            <input type="text" class="form-control" id="filename" name="imagename" required="required" placeholder="Enter File Name" onchange="checkFilename2(this.value)">
                        </div>
                        <div id="filenameError2"></div>						
                        <div class="form-group">
                            <label for="exampleInputPassword1">File Description</label>
                            <textarea class="form-control" cols="40" rows="4" placeholder="Optional" id="desc" name="description" ></textarea>
                        </div>						  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Upload" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MANAGE UBIN MODAL -->
<div class="modal fade" id="manageUBIN" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Manage UBIN</h4>
            </div>
            <div class="modal-body">
                <div class="well well-sm bg-green">
                    <p align="justify"> <strong>Active UBIN along with your business details will be changed automatically on selecting any UBIN.</strong></p>
                </div>
                <div class="row" style="padding-top:30px" id="open_ubin_list">
                </div>
			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- CHANGE PASSWORD MODAL -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
                <form action="change_password.php" method="post" enctype="multipart/form-data"> 
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" class="form-control" id="" name="old_password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">New Password</label>
                        <input type="password" class="form-control" id="" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Confirm Password</label>
                        <input type="password" class="form-control" id="" name="cfmPassword" placeholder="Retype New Password">
                    </div>
                    <button type="submit" name="change" class="btn btn-default">Submit</button>
                </form>  

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- Start of #uploadForm -->
<div class="modal fade" id="uploadForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form method="post" action="<?php echo base_url(); ?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload File</h4>
                </div>                            
                <div class="modal-body">					  
                    <div class="form-group">
                        <input type="file" id="exampleInputFile" name="file" required="required">							
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">File Name</label>
                        <input type="text" class="form-control" id="filename" name="name" required="required" placeholder="Enter File Name" onchange="checkFilename(this.value)">
                    </div>									
                    <div class="form-group">
                        <label for="exampleInputPassword1">File Description</label>
                        <textarea class="form-control" cols="40" rows="4" placeholder="Optional" name="description" ></textarea>
                    </div>	
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" value="Submit" name="upload">Upload</button>				
                </div>
            </div>
        </form>
    </div> 
</div>
<!-- End of #uploadForm -->
<!-- CHANGE Mobile Number MODAL -->
<?php $phone = $this->session->phone; ?>
<div class="modal fade" id="verifyMobileNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Verify Mobile Number</h4>
            </div>
            <div class="modal-body">
                <form action="change_mobile_number.php" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label for="" class="text-danger">Please verify your mobile number to get SMS notifications on your mobile.</label>
                        <br/>
                        <p>Your Mobile Number - +91 <?php echo $phone; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-md btn-primary" href="../common/email_verification.php?verify=phone">Click here to verify</a></p>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Do you want to change your mobile number ? &nbsp;&nbsp;&nbsp;</label>
                        <label class="radio-inline">
                            <input type="radio" name="change_mobile_number" class="change_mobile_number" value="Y">Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="change_mobile_number" class="change_mobile_number" value="N">No
                        </label>
                    </div>
                    <div id="mobile_number_form">

                        <div class="form-group">
                            <label for="">Enter Mobile Number &nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Please provide a valid 10 digit Mobile Number for all important updates and informations." aria-hidden="true"></i>&nbsp;<span class="text-danger">*&nbsp;<?php if (isset($code3)) echo "[" . $code3 . "]"; ?></span><span class="text-danger" id="mobile_no_Exists"></span></label>				
                            <div class="input-group">
                                <div class="input-group-addon">+91</div>
                                <input type="text" class="form-control" required="required" validate="mobileNumber" maxlength="10" id="phone" name="phone" onblur="chechMobileNo(this.value)" placeholder="Enter 10 Digit Mobile Number"/>
                                <div class="input-group-addon"><span id="mobile_no_checker"></span></div>
                            </div>
                        </div>
                        <button type="submit" name="change" id="submit_change_phone" class="btn btn-success">Submit</button>

                    </div>
                </form>  

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>			
            </div>
        </div>
    </div>
</div>


<!-- Upload Files which are deleted -->
<div class="modal fade " id="updateDocumentAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form method="post" action="<?php echo base_url(); ?>" enctype="multipart/form-data">
            <input type="hidden" name="recorded_file_name" id="recorded_file_name" value="" required="required">

            <div class="modal-content alert alert-danger">
                <div class="modal-header">
                  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <h4 class="modal-title" id="myModalLabel">Update File Alert</h4>
                </div>                            
                <div class="modal-body">					  
                    <div class="form-group">
                        <label>Due to security reasons, the files which were corrupted or error encoded are removed. So, we request you to update the files as soon as possible in MIME type or UTF8 encoded.<br/>---<br/>Thanking you , Team EODB Assam.<br/>Helpdesk: +91 7086044425<br/>Please call Helpdesk for any further queries, clarifications or technical support.</label>		
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url(); ?>user_area/elocker.php" class="btn btn-primary">Upload</a>				
                </div>
            </div>
        </form>
    </div> 
</div>


<!-- Appeal Rejection Modal -->
<div class="modal fade" id="appealmodel" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Appeal Against Rejection</h4>
            </div>
            <form method="post" action="<?php echo base_url(); ?>" enctype="multipart/form-data">
                <input type="hidden" name="appeal_rejection_uain" id="appeal_rejection_uain" value=""/>
                <div class="modal-body">
                    <div class="form-group">
                        Please state your reason for the appeal against the Rejection : 
                        <textarea class="form-control" name="appeal_reason"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="appeal_submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
