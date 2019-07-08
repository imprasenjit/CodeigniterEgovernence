<div class="box box-primary box-alm" style="margin-top: 10px;">
    <h3 class="boxalm-head">
        Public Grievance
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <?php
    $gid = decodeme($this->uri->segment("4"));
    $dept_code = $this->session->staff_dept;
    if ($this->publicgrivances_model->get_row($gid)) {
        $row = $this->publicgrivances_model->get_row($gid);
        $complaint_no = $row->complaint_no;
        $user_id = $row->user_id;
        if($this->deptusers_model->get_row($user_id, $dept_code)) {
            $deptuser = $this->deptusers_model->get_row($user_id, $dept_code);
            $udesig_name=$deptuser->udesig;
            $utype=$deptuser->utype;
            $office_id=$deptuser->office_id;
            $user_rights = $deptuser->user_rights;
        }
        //$user_name = $this->users_model->get_row($user_id) ? $this->users_model->get_row($user_id)->name : "Not found!";
        $subject = $row->subject;
        $g_date = $row->g_date;
        if (is_null($g_date) || $g_date == "") {
            $gdate = "Not found!";
        } else {
            $gdate = date("d/m/Y");
        }//End of if else
        ?>
        <form name="myform1" id="myform1" method="post" action="<?= base_url('admin/grievances/save') ?>" enctype="multipart/form-data">
            <input type="hidden" name="gid" value="<?=$gid?>" />
            <input type="hidden" name="complaint_no" value="<?=$complaint_no?>" />
            <input type="hidden" name="staff_id" value="<?=$user_id?>" />
            
            <table style="width: 100%; margin-bottom: 5px">
                <tbody>
                    <tr class="bg-success">
                        <td style="vertical-align: middle; font-weight: bold; text-align: right; font-size: 18px">
                            Please select an option : 
                        </td>
                        <td>
                            <select id="appoptions" class="form-control" style="width: auto;">
                                <option selected>Please Select</option>
                                <option value='1'>Reply to the Grievance</option>
                                <option value='2'>Forward the Grievance</option>	
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table id="replytbl" style="display:none" class="table table-bordered table-responsive">
                <thead>
                    <tr class="info">
                        <th class="text-center text-bold" colspan="4">Reply to the Grievance</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Action </td>
                        <td>
                            <div class="form-group">
                                <label class="radio-inline"><input type="radio" name="process_type" value="U" checked>Under Resolution</label>
                                <label class="radio-inline"><input type="radio" name="process_type" value="R" >Resolved</label>
                            </div>
                        </td>
                        <td>Remarks (If Any)</td>
                        <td><div class="form-group"><textarea name="remarks" required="required" class="form-control classy-editor" id="for_remerk" style="width:300px; height: 50px" placeholder="Your Remarks"></textarea></div></td>							
                    </tr>					

                    <tr>
                        <td colspan="4"><div class="filetype_Error"></div></td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="4">
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-refresh"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-commenting-o"></i> Reply
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <table id="forwardtbl" style="display:none" class="table table-bordered table-responsive">
                <thead>
                    <tr class="info"><th class="text-center text-bold" colspan="4">Forward the Grievance</th></tr>
                </thead>
                <tbody>										
                    <tr>
                        <td>Forward to </td>
                        <td>
                            <div class="form-group">

                                <select name="forward_to" class="form-control" required="required">
                                    <option value="">Please Select</option>
                                    <?php
                                    $dept_db = $this->load->database($dept_code, TRUE);
                                    //$usertbl = ($utype == 1 || $dept == "goa")?"goa_users":"users";
                                    $usertbl = "users";
                                    $forwardUsersQuery = "SELECT user_id, utype, user_rights, user_name FROM $usertbl WHERE utype>'" . $utype . "' or utype=1 and status='1'";
                                    $results = $dept_db->query($forwardUsersQuery);
                                    foreach ($results->result() as $forwardUserRows) {
                                        $userRights = $forwardUserRows->user_rights;
                                        $userRights = explode(",", $userRights);
                                        $forward_user_id = $forwardUserRows->user_id;
                                        if (in_array("GR", $userRights) || $forwardUserRows->utype == 1) {
                                            echo '<option value="' . $forward_user_id . '">' . $forwardUserRows->user_name . '</option>';
                                        }
                                    }
                                    ?>				
                                </select>

                            </div>
                        </td>
                        <td>Remarks (If Any)</td>
                        <td>
                            <div class="form-group"><textarea name="remarks" required="required" class="form-control classy-editor" id="for_remerk" style="width:300px; height: 50px" placeholder="Your Remarks"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="filetype_Error"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="4">
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-refresh"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-forward"></i> Forward
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    <?php
    } else {
        echo "<h2 class='text-center'>No records found!</h2>";
    }//End of if else 
    ?>
</div>