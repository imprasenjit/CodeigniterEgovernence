<?php
$dept_code = $this->session->staff_dept;
$staff_id = $this->session->staff_id;
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        My Profile
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <div class="box-body">
        <?php
        if($this->deptusers_model->get_row($staff_id, $dept_code)) {
            $usr = $this->deptusers_model->get_row($staff_id, $dept_code);
            $user_name = $usr->user_name;
            $uname = $usr->uname;
            $udesig = $usr->udesig;
            $office_id = $usr->office_id;
            $ucno = $usr->ucno;
            $uemail = $usr->uemail;
            $utype = $usr->utype;
            $utype_name = ($this->utypes_model->get_row($utype, $dept_code))?$this->utypes_model->get_row($utype, $dept_code)->utype_name:"Not found";
            $user_rights = $usr->user_rights;
            ?>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th colspan="4" class="bg-info" style="line-height: 26px; font-size: 18px">
                            Profile details
                            <a href="<?=base_url('staffs/editprofile')?>" class="btn btn-warning backbtn-alm">
                                <i class="fa fa-pencil-square"></i> Edit profile
                            </a>
                        </th>							
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Full Name </td>
                        <td><?=$user_name?></td>
                        <td>Username </td>
                        <td><?=$uname." (uid : ".$staff_id.")"?></td>
                    </tr>
                    <tr>
                        <td>Role </td>
                        <td><?=$utype_name?></td>
                        <td>Designation </td>
                        <td><?=$udesig?></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td><?="+91 - ".$ucno?></td>
                        <td>Email-id</td>
                        <td><?=$uemail?></td>
                    </tr>
                </tbody>
            </table>
            <br />
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="bg-success text-center" style="width: 50%">
                            User rights
                        </th>
                        <th class="bg-warning text-center">
                            User jurisdictions
                        </th>							
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <?php
                                $urArr = explode(",", $user_rights);
                                foreach ($urArr as $ur) {                                    
                                    echo "<span class='rightbox'>".get_right($ur)."</span>";
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if($this->offices_model->get_row($office_id, $dept_code)) {
                                    $urArr = explode(",", $this->offices_model->get_row($office_id, $dept_code)->jurisdiction);
                                    foreach ($urArr as $ur) {                                    
                                        echo "<span class='rightbox'>".$ur."</span>";
                                    }
                                } else {
                                    echo "No records found!";
                                }//End of if else
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } else {
            echo "<h2 class='text-center'>No records found!</h2>";
        }//End of if else ?>        
    </div><!--End of .box-body-->
</div>