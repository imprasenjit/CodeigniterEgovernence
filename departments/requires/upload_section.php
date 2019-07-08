<?php

require_once "login_session.php";
$ci->load->helper('get_uain_details');

$courier_section = 0;
if (isset($_POST["submit"])) {
    if (isset($_SESSION["dept"]) || isset($_SESSION["form"]) || $_SESSION["dept"] != "" || $_SESSION["form"] != "") {
        $dept = $_SESSION["dept"];
        $form = $_SESSION["form"];
        $form_id = $_SESSION["form_id"];
        $table_name = $_SESSION["table_name"];
        $sub_dept_id = $_SESSION["sub_dept_id"];
    } else {
        echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '" . $server_url . "user_area/';
			</script>";
    }
    $check_upload_section_query = "select uploaded_documents from " . $table_name . " where user_id='$swr_id' and form_id='$form_id' and save_mode='D' and active='1' ";
    $check_upload_section_results = $formFunctions->executeQuery($dept, $check_upload_section_query);

    if ($check_upload_section_results->num_rows > 0) {
        $documents = array_slice($_POST, 0, -1);
        $uploaded_documents = json_encode(array("documents" => ($documents)));

        $courier_section_sc = 0;
        $blank_document = 0;
        $uploaded_documents_decoded = json_decode($uploaded_documents, true);
        foreach ($uploaded_documents_decoded["documents"] as $key => $values) {
            if (in_array("SC", $values)) {
                $courier_section_sc = 1;
            }
            if (in_array("", $values)) {
                //print_r($values);die();
                $blank_document = 1;
            }
        }
     
        if ($courier_section_sc == 1) {
           $update_query = "update " . $table_name . " set uploaded_documents='$uploaded_documents',courier_details='1',received_date=NULL where form_id='$form_id' and user_id='$swr_id'";
        } else {
           $update_query = "update " . $table_name . " set uploaded_documents='$uploaded_documents',courier_details=NULL,received_date='$today' where form_id='$form_id' and user_id='$swr_id'";
        }
		
        $update_results = $formFunctions->executeQuery($dept, $update_query);
        if ($update_results) {
            if ($blank_document == 1) {
                echo "<script>
						alert('Please select an option for all the list of documents.');
						window.location.href = '" . $server_url . "departments/requires/upload_section.php?dept=" . $dept . "&form=" . $form . "';
				</script>";
            }
            echo "<script>
						alert('Successfully uploaded.');
						window.location.href = '" . $server_url . "departments/requires/preview.php?dept=" . $dept . "&form=" . $form . "';
				</script>";
        } else {
            echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '" . $server_url . "departments/requires/upload_section.php?dept=" . $dept . "&form=" . $form . "';
			</script>";
        }
    } else {
        echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '" . $server_url . "user_area/';
			</script>";
    }
}


if (isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"] > 0 && isset($_GET["dept"]) && strlen($_GET["dept"]) > 0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])) {
    $_SESSION["dept"] = $dept = $_GET["dept"];
    $_SESSION["form"] = $form = $_GET["form"];

    $_SESSION["table_name"] = $table_name = getTableName($dept, $form);
    $_SESSION["sub_dept_id"] = $sub_dept_id = $formFunctions->get_sub_dept_id($dept);


    //Check for form status
    require_once "check_form_save_mode.php";
    $get_file_name = basename(__FILE__);

    $check_upload_section_query = "select form_id,uploaded_documents from " . $table_name . " where user_id='$swr_id' and active='1' and save_mode='D' ORDER BY form_id DESC LIMIT 1";

    $check_upload_section_results = $formFunctions->executeQuery($dept, $check_upload_section_query);

    if ($check_upload_section_results->num_rows > 0) {
        $row = $check_upload_section_results->fetch_object();
        $uploaded_documents_json = $row->uploaded_documents;
        $_SESSION["form_id"] = $form_id = $row->form_id;
    } else {
        echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '" . $server_url . "user_area/';
			</script>";
    }

    $documentslist_values_query = "select documentslist,payment_required from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id' and status='1'";
    $documentslist_values_results = $formFunctions->executeQuery("cms", $documentslist_values_query);
    if ($documentslist_values_results->num_rows > 0) {
        $documentslist_values_row = $documentslist_values_results->fetch_object();
        $documentslist_values = $documentslist_values_row->documentslist;
        $documentslist = json_decode($documentslist_values, true);
        $_SESSION["payment_required"] = $payment_required = $documentslist_values_row->payment_required;

        if (empty($documentslist["obj"])) {
            if (($dept == "cei" && ($form == 3 || $form == 6 || $form == 7 || $form == 8 || $form == 10 || $form == 11 || $form == 12 || $form == 13 || $form == 14 || $form == 15 || $form == 16 || $form == 25 || $form == 26 || $form == 27 || $form == 28)) || ($dept == "sdc" && ($form == 20 || $form == 54 || $form == 58)) || ($dept == "boiler" && ($form == 1 || $form == 2))) {
                $update_query = "update " . $table_name . " set uploaded_documents=NULL,courier_details=NULL,received_date='$today' where form_id='$form_id' and user_id='$swr_id' and active='1' and save_mode='D'";
            } else {
                $update_query = "update " . $table_name . " set uploaded_documents=NULL,courier_details=NULL,received_date='$today' where form_id='$form_id' and user_id='$swr_id' and active='1'";
            }

            $update_results = $formFunctions->executeQuery($dept, $update_query);
            if ($update_results) {
                echo "<script>
							window.location.href = '" . $server_url . "departments/requires/preview.php?dept=" . $dept . "&form=" . $form . "';
					</script>";
            } else {
                echo "<script>
						alert('Something went wrong !!! Please try again');
						window.location.href = '" . $server_url . "user_area/';
				</script>";
            }
        }
    } else {

        if (($dept == "cei" && ($form == 3 || $form == 6 || $form == 7 || $form == 8 || $form == 10 || $form == 11 || $form == 12 || $form == 13 || $form == 14 || $form == 15 || $form == 16 || $form == 25 || $form == 26 || $form == 27 || $form == 28)) || ($dept == "sdc" && ($form == 20 || $form == 54 || $form == 58))) {
         $update_query = "update " . $table_name . " set uploaded_documents=NULL,courier_details=NULL,received_date='$today' where form_id='$form_id' and user_id='$swr_id' and active='1' and save_mode='D'";
        } else {
            $update_query = "update " . $table_name . " set uploaded_documents=NULL,courier_details=NULL,received_date='$today' where form_id='$form_id' and user_id='$swr_id' and active='1'";
        }
        $update_results = $formFunctions->executeQuery($dept, $update_query);
        if ($update_results) {
            echo "<script>
						window.location.href = '" . $server_url . "departments/requires/preview.php?dept=" . $dept . "&form=" . $form . "';
				</script>";
        } else {
            echo "<script>
					alert('Something went wrong !!! Please try again');
					window.location.href = '" . $server_url . "user_area/';
			</script>";
        }
    }
} else {
    echo "<script>
					alert('Invalid Page Access !!!');
					window.location.href = '" . $server_url . "user_area/';
			</script>";
}
?>
<?php require_once "header.php"; ?>
<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <?php require 'banner.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center" >
                            <strong><?php echo $form_name = $formFunctions->get_formName($dept, $form); ?> </strong>
                        </h4>	
                    </div>
                    <div class="panel-body">
                        <form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                            <table id="" class="table table-responsive">	
                                <tr>
                                    <td colspan="5">Checklist of Documents to be enclosed 
                                        <p class="text-success">(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</p></td>
                                </tr>

                                <?php
                                if ($uploaded_documents_json != "") {
                                    $uploaded_documents = json_decode($uploaded_documents_json, true);
                                    
                                    $sl = 1;
                                    foreach ($uploaded_documents["documents"] as $key => $values) {
                                        if ($values[0] != "") {
                                            ?>
                                            <tr>
                                                <td width="60%"><?php echo $sl; ?>. <input type="hidden" value="<?php echo clean($values[0]); ?>" name="doc<?php echo $sl; ?>[]"><?php echo $values[0]; ?></td>
                                                <td width="20%">
                                                    <select trigger="FileModal" id="file<?php echo $sl; ?>" required="required" class="form-control ">

                                                        <option value="" selected="selected">Please Select</option>
                                                        <option value="1" <?php if (strlen($values[1]) > 5) echo 'selected="selected"'; ?>>Upload File</option>
                                                        <!--<option value="2">From PC</option>-->
                                                        <option value="4" <?php if ($values[1] == "SC") echo 'selected="selected"'; ?>>Send by Courier</option>
                                                        <option value="3" <?php if ($values[1] == "NA") echo 'selected="selected"'; ?>>Not Applicable</option>
                                                    </select>
                                                    <input type="hidden" name="doc<?php echo $sl; ?>[]" id="mfile<?php echo $sl; ?>" value="<?php echo $values[1] !== '' ? $values[1] : ''; ?>" />

                                                </td>
                                                <td width="20%" id="tdfile<?php echo $sl; ?>">
                                                    <?php
                                                    if ($values[1] != "" && $values[1] != "SC" && $values[1] != "NA") {
                                                        echo '<a href="' . $upload . $values[1] . '" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>';
                                                    } else {
                                                        echo "No File Selected";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>

                                            <?php
                                            $sl++;
                                        }
                                    }
                                    ?>
                                    <?php
                                } else {
                                    //$documentslist_values='{"obj":["doc-1","doc-2","doc-3","Doc-4"]}';

                                    $sl = 1;
                                    foreach ($documentslist["obj"] as $key => $values) {
                                        ?>

                                        <tr>
                                            <td width="60%"><?php echo $sl; ?>. <input type="hidden" value="<?php echo clean($values); ?>" name="doc<?php echo $sl; ?>[]"><?php echo $values; ?></td>
                                            <td width="20%">
                                                <select trigger="FileModal" required="required" id="file<?php echo $sl; ?>" class="form-control check_selected">
                                                    <option value="" selected="selected">Please Select</option>
                                                    <option value="1">From E-Locker</option>
                                                    <!--<option value="2">From PC</option>-->
                                                    <option value="4">Send by Courier</option>
                                                    <option value="3">Not Applicable</option>
                                                </select>
                                                <input type="hidden" name="doc<?php echo $sl; ?>[]" id="mfile<?php echo $sl; ?>" value="" />
                                            </td>
                                            <td width="20%" id="tdfile<?php echo $sl; ?>">No File Selected</td>
                                        </tr>

                                        <?php
                                        $sl++;
                                    }
                                    ?>  
                                <?php } ?>									
                                <tr>
                                    <td class="text-center" colspan="4">
                                        <a href="<?php echo $server_url . $formFunctions->get_form_path($dept, $form); ?>"><button type="button" class="btn btn-primary">Go Back & Edit</button></a>	
                                        <input type="submit" class="btn btn-success" id="submit1" name="submit" value="Submit" title="Save it">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>			   
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>
<div class="modal fade" id="filefromPC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">Upload File From PC</h4>
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
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="myModalLabel">Upload From Locker</h4>
                <a href="#!" class="btn btn-primary pull-right" id="upload_from_pc" data-td-id="">Upload From PC</a>
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
                        <table role="tabpanel" id="tab1" class="tab-pane active table table-responsive">
                            <tbody>
                                <tr>
                                    <th>File Name</th>
                                    <th>Description</th>
                                    <th>Select</th>
                                </tr>

                                <?php
                                $select_query = $formFunctions->executeQuery("dicc", "select * from digital_locker where unit_id='$unit_id' and document_type='P' ORDER BY id ASC");
                                $sl = 1;
                                while ($results = $select_query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $results["name"]; ?></td>
                                        <td><input type="hidden" id="<?php echo $results["id"]; ?>" value="<?php echo $results["file"]; ?>"/><?php echo $results["description"]; ?></td>
                                        <td style="width:30%"><button type="button" class="btn btn-success" onclick="getName(<?php echo $results["id"]; ?>);" data-dismiss="modal">Select</button></td>											
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                                ?>
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
                                $select_query = $formFunctions->executeQuery("dicc", "select * from digital_locker where unit_id='$unit_id' and document_type='F' ORDER BY id DESC");
                                $sl = 1;
                                while ($results = $select_query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $results["name"]; ?></td>
                                        <td><input type="hidden" id="<?php echo $results["id"]; ?>" value="<?php echo $results["file"]; ?>"/><?php echo $results["description"]; ?></td>
                                        <td style="width:30%"><button type="button" class="btn btn-success" onclick="getName(<?php echo $results["id"]; ?>);" data-dismiss="modal">Select</button></td>											
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                                ?>
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
                                $select_query = $formFunctions->executeQuery("dicc", "select * from digital_locker where unit_id='$unit_id' and document_type='S' ORDER BY id DESC");
                                $sl = 1;
                                while ($results = $select_query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $results["name"]; ?></td>
                                        <td><input type="hidden" id="<?php echo $results["id"]; ?>" value="<?php echo $results["file"]; ?>"/><?php echo $results["description"]; ?></td>
                                        <td style="width:30%"><button type="button" class="btn btn-success" onclick="getName(<?php echo $results["id"]; ?>);" data-dismiss="modal">Select</button></td>											
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                                ?>
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
<script type="text/javascript" src="<?= $server_url; ?>public/pekeupload/js/pekeUpload.js" ></script>
<div class="modal fade" tabindex="-1" role="dialog" id="upload_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Mydocuments</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success alert-dismissible" style="display: none" id="success_msg_query">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <span id="info_msg_query"></span>
                </div>
                <div class="alert alert-danger alert-dismissible" style="display: none" id="error_msg_query">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <span id="info_msg_query_error"></span>
                </div>
                <div id="loader-wrapper">
                    <div id="loader"></div>
                </div>
                <form id="upload_form" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name</label>  
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name" name="name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" placeholder="Type your reply here"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="document" class="col-sm-3 control-label">Upload File: </label>
                        <div class="col-sm-9">
                            <input type="file" name="document" id="document" data-error="Please upload Address proof.">
                            <span class="filetype_Error"></span>
                        </div> 
                    </div> 
                </form>
                <script>
                                            $(document).ready(function () {
                                                $("#document").pekeUpload({
                                                    bootstrap: true,
                                                    url: "<?= $server_url; ?>upload/",
                                                    data: {file: "document"},
                                                    limit: 100,
                                                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                                                });
                                            });

                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="upload_mydocuments" data-td-id="">Upload</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require_once "../../views/users/requires/footer.php"; ?>
<?php require 'js.php' ?>
<script>
    <?php $unit_id=$CI->session->unit_id;?>
    $(document).ready(function () {
        $('#upload_mydocuments').click(function () {
            var data = $('#upload_form').serializeArray();
            var fileID = $(this).attr("data-td-id");
            //alert(tdfile);
           // var mfile = "#m" + fileID;
            $.ajax({
                url: "<?= $server_url."users/dashboard/upload_mydocuments/" . $unit_id . "";?>",
                method: "POST",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $('#loader-wrapper').fadeIn();
                },
                success: function (jsn) {
                    $('#loader-wrapper').hide();
                    console.log(jsn.success);
                    if (jsn.success === 1) {
                        $('#upload_form')[0].reset();
                        $('.pkrw').remove();
                        //alert(jsn.file);
                        var fleName = jsn.file;
                        var strArray = fleName.split("/");
                        //var file_name = strArray.pop();
						var file_name = strArray.splice(0, 3);
						var file_with_fulladdress = strArray.join("/");
						//alert(file_with_fulladdress);
                        $('#m' + fileID + '').val(file_with_fulladdress);

                        $('#td' + fileID + '').html('<a href="' + jsn.file + '" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>');
                        $("#upload_modal").modal('hide');
                    } else {
                        $('#success_msg_query').hide();
                        $('#info_msg_query_error').empty().append("</br>" + jsn.info);
                        $('#error_msg_query').fadeIn();
                    }
                }
            });
        });
    });
</script>
<script>
    /* ------------------------------------------------------ */
    //$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-100:+0"});
    //$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-100:+0"});
    function getName(file) {
        var fileID = $("#Elocker_file").val();
        var mfile = "#m" + fileID;
        var tdfile = "#td" + fileID;
        var fleTD = "#" + file;
        var fleName = $(fleTD).val();

        /* var strArray = fleName.split("/");
        var file_name = strArray.pop(); */
		
		var strArray = fleName.split("/");
		//var file_name = strArray.pop();
		var file_name = strArray.splice(0, 3);
		var file_with_fulladdress = strArray.join("/");
		//alert(file_with_fulladdress);
		
        $(mfile).val(file_with_fulladdress); //alert(file+" = "+fleName);
        $(tdfile).html('<a href="' + fleName + '" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>');
        /*
         var doc1 = document.getElementById("m"+$('#Elocker_file').val());
         var uploadtext = document.getElementById("td"+$('#Elocker_file').val());
         //doc1.value = document.getElementById(file).innerHTML;
         doc1.value = $('#'+file+'').val();
         uploadtext.innerHTML = '<a href="<?php echo $server_url; ?>Document_locker/'+doc1.value+'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="'+$('#Elocker_file').val()+'" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
         $('.'+$("#Elocker_file").val()+'').attr('disabled', 'disabled');
         */
    }

    /* ----------------------------------------------------- */
</script>
