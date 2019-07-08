<?php

    //$uain = $_GET["uain"];
    //$form = $_GET["form"];
    //$dept = $_GET["dept"];
    //$swr_id = $_GET["swr_id"];
    //$form_id = $_GET["form_id"];
    $adminupload = "";
    $adminupload = $adminupload . $dept . "/";
    $form_table = $tableName = getTableName($dept, $form);
    
//    $unit_details = $this->load->model("staffs/Formprocess_model"); 
//    $unit_details = $this->Formprocess_model->get_row($dept, $form_table, $form_id);
//    
//    
//    $process_query = "select * from " . $tableName . "_process where form_id='$form_id' and process_type!='Q' ORDER BY p_date ASC";
//    $processes = $admin_fetch_functions->executeQuery($dept, $process_query);
        
    $processes = $this->Formprocess_model->get_rows_without_query_processes($dept,$form_table,$form_id);
    $formQuery = $this->Queriedapplications_model->get_rows_by_uain($uain);
?>
<div class="box box-primary box-alm" id="printcontent1">
    
<?php 
    if ($dept == "fire") {
        $compl_query = $admin_fetch_functions->executeQuery("fire", "select * from compliance_report where uain='$uain' and active='0' and officer_id!='0' ORDER BY letter_date ASC");
        if ($compl_query->num_rows > 0) {
            ?>
            <h3 class="text-center">Compliance Report</h3>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr class="success">
                        <th>Letter Date</th>
                        <th>Letter No.</th>
                        <th>Submission Date</th>
                        <th>Download Compliance Report</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($compl_query_rec = $compl_query->fetch_object()) {
                        $letter_date = $compl_query_rec->letter_date;
                        $letter_no = $compl_query_rec->letter_no;
                        $reply_date = $compl_query_rec->reply_date;
                        ?>
                        <tr>
                            <td><?php echo date("d-m-Y", strtotime($letter_date)); ?></td>
                            <td><?php echo strtoupper($letter_no); ?></td>
                            <td><?php echo date('d-m-Y g:i A', strtotime($reply_date)); ?></td>
                            <td><?php echo "<a href='" . $server_url . "departments/fire/forms/compliance_report_pdf.php?token=" . $uain . "' class='btn btn-info' target='_blank'>Download</a>"; ?></td>
                        </tr>
            <?php } ?>
                </tbody>
            </table>
        <?php
        }
    }
    ?>
    <?php if ($formQuery) { ?>
        <h3 class="text-center">Queries</h3>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="success">
                    <th>Date</th>
                    <th>Queries and Replies</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($formQuery as $formQueryRec) {

                    $query_id = $formQueryRec->query_id;
                    $officer_id = $formQueryRec->query_from;
                    $officer_details = $admin_fetch_functions->getUserDetails($officer_id, $dept);
                    $udesigName = $officer_details->udesig;

                    $subject = $formQueryRec->subject;
                    if ($subject == "G") {
                        $sub = "General Query";
                    } else if ($subject == "F") {
                        $sub = "Fees and Payment Related";
                    } else if ($subject == "D") {
                        $sub = "Documents Related";
                    } else {
                        
                    }
                    $message = $formQueryRec->msg;
                    $q_date = $formQueryRec->q_date;
                    $active = $formQueryRec->status;
                    ?>
                    <tr>
                        <td width="200px" valign="top"><?php echo date('d-m-Y g:i A', strtotime($q_date)); ?></td>
                        <td>
                            <b>Query By </b> : <?php echo $udesigName; ?></b><br/>
                            <b>Subject</b> : <?php echo $sub; ?><br/>
                            <b>Query Message</b> : <?php echo $message; ?>
                        </td>
                    </tr>
                    <?php
                    if ($active != 0) {
                        if ($subject == "G") {
                            include "../includes/query_general.php";
                        } else if ($subject == "F") {
                            include "../includes/query_fees_related.php";
                        } else if ($subject == "D") {
                            include "../includes/query_documents.php";
                        } else {
                            
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    <?php } ?>

    <?php if ($processes) { ?>
        <h3 class="text-center">Actions/Processes</h3>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="success">
                    <th>Date</th>
                    <th>Process/Action</th>
                    <th>Processed By</th>
                    <th>Designation</th>
                    <th>File Uploaded</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($processes as $processesRecords) {
                    $p_date = $processesRecords->p_date;
                    $doi = $processesRecords->doi;
                    $p_process_type = $processesRecords->process_type;
                    
                    $p_user_id = $processesRecords->user_id;
                    $user_details = $this->Deptusers_model->get_row($p_user_id, $dept);
                    $p_user_name = $user_details->user_name;
                    $p_udesig_name = $user_details->udesig;
                    $p_file_path = $processesRecords->file_path;
                    $p_remark = $processesRecords->remark;
                    if (isset($processesRecords->forward_to)) {
                        $p_forward_to = $processesRecords->forward_to;
                    } else {
                        $p_forward_to = "";
                    }

                    if ($p_process_type == "F") {
                        if ($p_forward_to != "") {
                            $user_details = $this->Deptusers_model->get_row($p_forward_to, $dept);
                            
                            $forwarded_to = $user_details->user_name;
                            $forwarded_udesig_name = $user_details->udesig;
                            $p_process_type_name = "Forwarded to " . strtoupper($forwarded_to) . ", " . strtoupper($forwarded_udesig_name);
                        } else {
                            $p_process_type_name = "Forwarded";
                        }
                    } else if ($p_process_type == "V") {
                        $p_process_type_name = "Scheduled Inspection/Verification on " . date("d-m-Y", strtotime($doi));
                        if ($dept == "jdl") {
                            $p_process_type_name = "Scheduled Hearing Date on " . date("d-m-Y", strtotime($doi));
                        }
                    } else if ($p_process_type == "UVR") {
                        $p_process_type_name = "Inspection/Verification Report Uploaded";
                    } else if ($p_process_type == "A") {
                        $p_process_type_name = "Approved";
                    } else if ($p_process_type == "I") {
                        $p_process_type_name = "Certificate/License/NOC Issued";
                        if ($dept == "jdl") {
                            $p_process_type_name = "Case Disposed";
                        }
                    } else if ($p_process_type == "C") {
                        $p_process_type_name = "Certificate/License/NOC Uploaded";
                    } else if ($p_process_type == "R") {
                        $p_process_type_name = "Rejected";
                    } else if ($p_process_type == "Y") {
                        $p_process_type_name = "Recorded Report";
                    } else if ($p_process_type == "IE") {
                        $p_process_type_name = "Issued E-Summon";
                    } else {
                        
                    }
                    ?>
                    <tr>
                        <td><?php echo date('d-m-Y g:i A', strtotime($p_date)); ?></td>
                        <td><?php echo $p_process_type_name; ?></td>
                        <td><?php echo $p_user_name; ?></td>
                        <td><?php echo $p_udesig_name; ?></td>
                        <td>
                            <?php
                            if ($dept == "pcb" && $p_process_type == "UVR") {
                                if (!empty($p_file_path) and is_numeric($p_file_path)) {
                                    if ($form == 21 || $form == 24 || $form == 33 || $form == 34) {
                                        echo "<a href='" . $server_url . "admin/departments/" . $dept . "/pcb_form21_insp_report_print.php?report_id=" . $p_file_path . "&form=" . $form . "' target='_blank' class='btn btn-info'> Download</a>";
                                    } else {
                                        echo "<a href='" . $server_url . "admin/departments/" . $dept . "/inspection_report_print.php?report_id=" . $p_file_path . "&form=" . $form . "' target='_blank' class='btn btn-info'> Download</a>";
                                    }
                                } else if (!empty($p_file_path) and ! is_numeric($p_file_path)) {
                                    echo "<a href='" . $adminupload . $p_file_path . "' target='_blank' class='btn btn-info'> Download</a>";
                                } else {
                                    echo "No file uploaded";
                                }
                            } else if (($p_process_type == "I" || $p_process_type == "C") && $dept != "jdl") {
                                echo '<a href="' . base_url() . 'getcertificate.php?token=' . $uain . '" target="_blank">Download Certificate/License/NOC</a>';
                            } else if ($p_process_type == "IE") {
                                echo "<a href='" . $adminupload . "/" . $p_file_path . "' target='_blank' class='btn btn-info'> Download E-Summon</a>";
                            } else {
                                if (!empty($p_file_path)) {
                                    echo "<a href='" . $adminupload . $p_file_path . "' target='_blank' class='btn btn-info'> Download</a>";
                                } else {
                                    echo "No file uploaded";
                                }
                            }
                            ?>
                        </td>
                        <td style="width:350px"><?php echo $p_remark; ?></td>
                    </tr>
        <?php } ?>
            </tbody>
        </table>
    <?php
    }

?>         


</div>

