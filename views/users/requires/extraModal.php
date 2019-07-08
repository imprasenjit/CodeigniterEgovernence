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

<!--filefromLocker Modal-->
<div class="modal fade" id="filefromLocker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload From Locker</h4>
          </div>
          <div class="box box-success">
                <div class="modal-body">
                    <div class="tab-content">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">Permanent Document</a></li>
                            <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">Form Documents</a></li>
                            <li role="presentation"><a href="#tab3" aria-controls="messages" role="tab" data-toggle="tab">Self Uploaded Documents</a></li>
                        </ul>
                        <input type="hidden" id="Elocker_file" value="" name="Elocker_file">
                        <table role="tabpanel" id="tab1" class="tab-pane active table table-responsive" style="display:table">
                            <tbody>
                                <tr>
                                        <th>File Name</th>
                                        <th>Description</th>
                                        <th>Select</th>
                                </tr>

                                <?php 
                                $select_query=$mysqli->query("select * from digital_locker where user_id='$sid' and document_type='P' ORDER BY id ASC") or die("Error : ".$mysqli->error);
                                $sl=1;
                                                while($results=$select_query->fetch_assoc()){?>
                                                <tr>
                                                        <td><?php echo $results["name"]; ?></td>
                                                        <td><input type="hidden" id="<?php echo $results["id"]; ?>" value="<?php echo $results["file"]; ?>"/><?php echo $results["description"]; ?></td>
                                                        <td style="width:30%"><button type="button" class="btn btn-success" onclick="getName(<?php echo $results["id"]; ?>);" data-dismiss="modal">Select</button></td>											
                                                </tr>
                                        <?php $sl++;
                                } ?>
                            </tbody>
                        </table>
                        <table role="tabpanel" id="tab2" class="tab-pane table table-responsive">
                            <tbody>
                                <tr>
                                        <th>File Name</th>
                                        <th>Description </th>
                                        <th>Select</th>
                                </tr>
                                <?php 
                                $select_query=$mysqli->query("select * from digital_locker where user_id='$sid' and document_type='F' ORDER BY id DESC") or die("Error : ".$mysqli->error);
                                $sl=1;
                                                while($results=$select_query->fetch_assoc()){?>
                                                <tr>
                                                        <td><?php echo $results["name"]; ?></td>
                                                        <td><input type="hidden" id="<?php echo $results["id"]; ?>" value="<?php echo $results["file"]; ?>"/><?php echo $results["description"]; ?></td>
                                                        <td style="width:30%"><button type="button" class="btn btn-success" onclick="getName(<?php echo $results["id"]; ?>);" data-dismiss="modal">Select</button></td>											
                                                </tr>
                                        <?php $sl++;
                                } ?>
                            </tbody>
                        </table>
                        <table role="tabpanel" id="tab3" class="tab-pane table table-responsive">
                            <tbody>
                                <tr>
                                        <th>File Name</th>
                                        <th>Description </th>
                                        <th>Select</th>
                                </tr>
                                <?php 
                                $select_query=$mysqli->query("select * from digital_locker where user_id='$sid' and document_type='S' ORDER BY id DESC") or die("Error : ".$mysqli->error);
                                $sl=1;
                                                while($results=$select_query->fetch_assoc()){?>
                                                <tr>
                                                        <td><?php echo $results["name"]; ?></td>
                                                        <td><input type="hidden" id="<?php echo $results["id"]; ?>" value="<?php echo $results["file"]; ?>"/><?php echo $results["description"]; ?></td>
                                                        <td style="width:30%"><button type="button" class="btn btn-success" onclick="getName(<?php echo $results["id"]; ?>);" data-dismiss="modal">Select</button></td>											
                                                </tr>
                                        <?php $sl++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
          </div>
        </div>
  </div>
</div>
<!-- add unit modal -->
<div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Add Unit</h4>
            </div>
            <div class="modal-body">
            <div class="box box-shadow"><p class="text-bold text-success">If you have an additional unit (branch, godown, factory, regional head office etc.) then you can obtain an additional Unique Business Identification Number (UBIN) pertaining to your unit without having to file Common Application Form again.</p><p class="text-danger">Please Note : Add Unit feature can be availed only for units having the same business constitution (legal entity) and enterprise name as your initial registered enterprise.</p></div>
                <form name="myform1" id="myform1" method="post" action="<?php echo $server_url; ?>user_area/manage_ubin.php" enctype="multipart/form-data">
                    <table class="table table-responsive table-bordered">
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
                            <td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
                                                    <select name="dist" id="insert_caf_dist" required="required" class="form-control text-uppercase" >
                                                            <option value="">Please Select</option>
                                                            <?php
                                                            while($dstrows=$dstresult->fetch_object()) { ?>
                                                            <option value="<?php echo $dstrows->district; ?>" ><?php echo $dstrows->district; ?></option>
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
                                            <?php if(isset($b_pincode) && ($b_pincode!="")){ ?>
                                                    <option value="<?php echo $b_pincode; ?>"><?php echo $b_pincode; ?></option>
                                            <?php }else{ ?>
                                            <option value=""> Select Pincode</option>
                                            <?php } ?>																		
                                    </select>
                                    <font class="compulsory"> </font>
                            </td>							
                        </tr>						
                        <tr>
                            <td>Revenue Circle <span class="mandatory_field">*</span> </td>
                            <td>
                                    <select name="revenue" id="revenue" class="form-control text-uppercase">
                                            <?php if(isset($revenue) && ($revenue!="")){ ?>
                                                    <option value="<?php echo $revenue; ?>"><?php echo $revenue; ?></option>
                                            <?php }else{ ?>
                                            <option value=""> Select Revenue Circle</option>
                                            <?php } ?>																		
                                    </select>
                            </td>
                            <td>Subdivision <span class="mandatory_field">*</span> </td>
                            <td>
                                    <select name="subdivision" id="subdivision" class="form-control text-uppercase">
                                            <?php if(isset($subdivision) && ($subdivision!="")){ ?>
                                                    <option value="<?php echo $subdivision; ?>"><?php echo $subdivision; ?></option>
                                            <?php }else{ ?>
                                            <option value=""> Select Subdivision</option>
                                            <?php } ?>																		
                                    </select>
                            </td>	
                        </tr>
                        <tr>
                            <td colspan="4" align="center"><button type="submit" class="btn btn-success" name="addunit" >Add Unit</button></td>
                        </tr>
                        </table>
                </form>
                <br>
                <div id="fileError"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>		
            </div>
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
          <div class="row">
                <p class="text-success"></p>
          </div>

          <?php $ubins_manage=$mysqli->query("select id,Name,unit_type,b_street_name1,b_dist,ubin from singe_window_registration where user_id='$sid'") or die("Error :".$mysqli->error);
                while($rows=$ubins_manage->fetch_object()){
          ?>
                <a class="btn btn-block btn-danger" href="<?php echo $server_url; ?>user_area/manage_ubin.php?ubin=<?php echo $rows->ubin; ?>">
                        <p align="left">
                        UBIN : <b><?php echo $rows->ubin; ?></b><br/>
                        Enterprise/Unit Name : <b><?php echo strtoupper($rows->Name); ?></b><br/>
                        Type of Unit : <b><?php echo get_unit_type($rows->unit_type); ?></b><br/>
                        Address : <b><?php echo strtoupper($rows->b_street_name1 ." , ".$rows->b_dist); ?></b>
                        </p>
                </a>
                <?php } ?>			
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
<?php $phone=$mysqli->query("select phone from users where id='$sid'")->fetch_object()->phone;	?>
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
                                <label for="">Enter Mobile Number &nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Please provide a valid 10 digit Mobile Number for all important updates and informations." aria-hidden="true"></i>&nbsp;<span class="text-danger">*&nbsp;<?php if(isset($code3)) echo "[".$code3."]"; ?></span><span class="text-danger" id="mobile_no_Exists"></span></label>				
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
            <a href="<?php echo $server_url; ?>user_area/elocker.php" class="btn btn-primary">Upload</a>				
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
