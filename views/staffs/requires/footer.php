<?php
$dept = $this->session->staff_dept;
?>
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-left col-md-4">
        <span id="realtime"></span>
    </div>
    <div class="text-right hidden-xs col-md-8">
        &copy; 2016 All Rights Reserved. Developed By <a href="http://www.avantikain.com" target="_blank">AIPL</a>
    </div>
</footer>
<!--
<div class="modal fade" id="query" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box box-success">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Application Query</h4>
                </div>
                <div class="modal-body">
                    <form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="token" id="query_id" value="">
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="sub" id="query_subject" class="form-control" required="required">
                                <option value="">Please select</option>
                                <option value="G">General Query</option>
                                <option value="F">Fees and Payment Related</option>
                                <option value="D">Documents Related</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea class="form-control" id="" name="message" required="required" placeholder="Type your message here"></textarea>
                        </div>
                        <div id="query_fees" class="input-group">
                            <label for="">Amount to be Paid :</label>
                            <input type="text" class="form-control" name="fees_amount" id="fees_amount" validate="onlyNumbers" placeholder="Please enter the amount here (in Rs.)">
                            <span class="input-group-addon" id="basic-addon2">INR</span>
                        </div>
                        <div id="query_document">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th><th>Description of the document to be uploaded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td><td><input type="text" class="form-control" name="document1_desc" id="document1_desc"/></td>
                                    </tr>
                                    <tr>
                                        <td>2</td><td><input type="text" class="form-control" name="document2_desc"/></td>
                                    </tr>
                                    <tr>
                                        <td>3</td><td><input type="text" class="form-control" name="document3_desc"/></td>
                                    </tr>
                                    <tr>
                                        <td>4</td><td><input type="text" class="form-control" name="document4_desc"/></td>
                                    </tr>
                                    <tr>
                                        <td>5</td><td><input type="text" class="form-control" name="document5_desc"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <div align="center">
                            <button type="submit" name="send_msg" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- CHANGE PASSWORD MODAL -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chnage Password</h4>
            </div>
            <div class="modal-body">
                <form action="change_password.php" method="post" enctype="multipart/form-data"> 
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" required="required" class="form-control" name="old_password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">New Password</label>
                        <input type="password" required="required" class="form-control" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Confirm Password</label>
                        <input type="password" required="required" class="form-control" name="cfmPassword" placeholder="Retype New Password">
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
<!-- Modal -->
<div class="modal fade" id="uploadForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">File Name</label>
                        <input type="text" class="form-control" id="filename" name="name" required="required" placeholder="Enter File Name" onchange="checkFilename(this.value)">
                    </div>									
                    <div class="form-group">
                        <label for="exampleInputPassword1">File Description</label>
                        <textarea class="form-control" cols="40" rows="4" name="description" ></textarea>
                    </div>						  
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile" name="document" required="required">							
                    </div>						  
                    <button type="submit" class="btn btn-default" value="Submit" name="upload">Upload</button>
                </form>
                <br>
                <div id="fileError">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div> 
</div>
<!-- Receive Button Modal -->
<div class="modal fade" id="receiveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Receive Acknowledgement</h4>
            </div>
            <div class="modal-body">

                <form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="token" id="value_id" value="">
                    <div class="form-group">
                        <label for="">Received Date </label>
                        <input type="text" class="form-control" name="received_date" disabled="disabled" value="<?= isset($today)?date("d-m-Y h:i A", strtotime($today)):""; ?>" placeholder="Date">
                    </div>
                    <input type="submit" name="recieve_courier" value="Submit" onclick="return confirm('Do you really want to Submit ?')" class="btn btn-sm btn-primary">
                </form>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div> 
</div>
<!-- uploadReport Modal -->
<div class="modal fade" id="uploadReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Report</h4>
            </div>
            <div class="modal-body">
                <form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="token" id="UploadReport-value1" value="" />
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="info"><th class="text-center text-bold" colspan="4">Upload Verification Report</th></tr>
                        </thead>
                        <tbody>
                            <tr class="text-bold">
                                <td>Department Name</td>
                                <td><?php //echo $formFunctions->get_deptName($dept); ?></td>
                                <td>Office Name</td>
                                <td><?php //echo $adminFunctions->get_officeName($office_id, $dept); ?></td>	
                            </tr>
                            <tr class="text-bold">
                                <td>Designation</td>
                                <td><?= isset($udesig_name)?$udesig_name:"" ; ?></td>
                                <td>Date</td>
                                <td><?php echo date("d-m-Y H:i:s"); ?></td>			
                            </tr>
                            <?php if ($dept == "fire") { ?>
                                <tr>
                                    <td> Compliance Report ? </td>
                                    <td><div class="form-inline">
                                            <input type="radio" name="compliance_report" id="compliance_report" value="Y"/> Satisfactory &nbsp;&nbsp;
                                            <input type="radio" name="compliance_report" id="compliance_report" checked value="N"/> Not Satisfactory
                                        </div></td>
                                    <td>Letter No. </td>
                                    <td><input type="text" id="letter_no" required="required" name="letter_no" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Upload File</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="file" id="" name="upload" required="required" accept=".jpg, .jpeg, .png, .pdf">
                                        </div>
                                        <div class="filetype_Error"></div>
                                    </td>
                                    <td>Remarks (If Any)</td>
                                    <td><div class="form-group">
                                            <textarea name="remarks" class="form-control classy-editor" id="for_remerk" style="" placeholder="Your Remarks"></textarea></div>
                                    </td>	
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="4"><input type="submit" class="btn btn-success text-bold" name="comply" value="Submit"/></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td>Remarks (If Any)</td>
                                    <td><div class="form-group"><textarea name="remarks" class="form-control classy-editor" id="for_remerk" style="width:300px; height: 50px" placeholder="Your Remarks"></textarea></div></td>
                                    <td>Upload File</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="file" id="" name="upload" accept=".jpg, .jpeg, .png, .pdf"  required="required" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><div class="filetype_Error"></div></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="4"><input type="submit" class="btn btn-success text-bold" name="report_upload" value="Upload Report"/></td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div> 
</div>
<!-- issue certificate modal -->
<div class="modal fade" id="issueCertificateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Certificate</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <a class="btn-block btn btn-warning" id="certificate_path" href="" target="_blank">Print Certificate</a>
                    </div>
                </div>
                <hr>
                <form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="hidden"  name="token" value="" id="cuUpload-value1"/>
                    <div class="row">	
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date : <?php echo date("d-m-Y H:i:s"); ?></label>

                            </div>
                            <div class="form-group">
                                <label>Upload Document</label>
                                <input type="file" required="required" name="upload" accept=".pdf">
                                <div class="filetype_Error"></div>
                            </div>
                            <input type="submit" class="pull-right btn btn-success" name="upload_certificate" value="Upload"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div> 
</div>
