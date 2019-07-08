<?php
$dept_code = $this->session->staff_dept;
$staff_id = $this->session->staff_id;
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Edit My Profile
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <div class="box-body">
        <?php
        if ($this->deptusers_model->get_row($staff_id, $dept_code)) {
            $usr = $this->deptusers_model->get_row($staff_id, $dept_code);
            $user_name = $usr->user_name;
            $uname = $usr->uname;
            $udesig = $usr->udesig;
            $office_id = $usr->office_id;
            $ucno = $usr->ucno;
            $uemail = $usr->uemail;
            $utype = $usr->utype;
            $utype_name = ($this->utypes_model->get_row($utype, $dept_code)) ? $this->utypes_model->get_row($utype, $dept_code)->utype_name : "Not found";
            $user_rights = $usr->user_rights;
            ?>
            <form action="<?=base_url('staffs/editprofile')?>" method="post">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th colspan="4" class="bg-info" style="line-height: 26px; font-size: 18px">
                                Update Profile details
                            </th>							
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Full Name </td>
                            <td>
                                <input name="user_name" value="<?= $user_name ?>" type="text" class="form-control" />
                            </td>
                            <td>Username </td>
                            <td><?=$uname?></td>
                        </tr>
                        <tr>
                            <td>Role </td>
                            <td><?= $utype_name ?></td>
                            <td>Designation </td>
                            <td><?= $udesig ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">+91</span>
                                    <input name="uemail" value="<?= $ucno ?>" type="text" class="form-control" style="z-index: 1" />
                                </div>
                            </td>
                            <td>Email-id</td>
                            <td>
                                <input name="uemail" value="<?= $uemail ?>" type="text" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fa fa-refresh"></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-circle"></i>
                                    Submit
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
    </div><!--End of .box-body-->
</div>
