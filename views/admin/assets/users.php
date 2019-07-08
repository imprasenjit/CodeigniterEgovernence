<?php
$dept_code = $this->session->staff_dept;
if ($this->session->flashdata("flashMsg")) {
    ?>
    <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Users
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>    
    <table class="table table-bordered table-responsive" id="dtbl">
        <thead>
            <tr class="success">
                <th>#</th>
                <th>Level</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Username</th>
                <th>Rights</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            if ($this->deptusers_model->get_rows($dept_code)) {
                $sl = 1;
                foreach ($this->deptusers_model->get_rows($dept_code) as $rows) {
                    $user_id = $rows->user_id;
                    $utype_id = $rows->utype;
                    $utype_name = $this->utypes_model->get_row($utype_id, $dept_code) ? $this->utypes_model->get_row($utype_id, $dept_code)->utype_name : "Not found!";
                    $user_name = $rows->user_name;
                    $udesig = $rows->udesig;
                    $uemail = $rows->uemail;
                    $ucno = $rows->ucno;
                    $uname = $rows->uname;
                    $status = $rows->status;
                    $user_rights = $rows->user_rights;
                    if ($status == 1)
                        $user_status = '<h4><span class="label label-success"><i class="fa fa-check-circle "> Active</i></span><h4>';
                    else
                        $user_status = '<h4><span class="label label-danger"><i class="fa fa-times-circle "> Inactive</i></span><h4>';

                    $rights = Array();
                    $rights = explode(",", $user_rights);
                    $view_rights = "";
                    for ($i = 0; $i < count($rights); $i++) {
                        if ($rights[$i] == "M") {
                            $right = "Modify";
                        } else if ($rights[$i] == "Q") {
                            $right = "Query";
                        } else if ($rights[$i] == "R") {
                            $right = "Reject";
                        } else if ($rights[$i] == "F") {
                            $right = "Forward";
                        } else if ($rights[$i] == "V") {
                            $right = "Schedule Inspection";
                        } else if ($rights[$i] == "UVR") {
                            $right = "Upload Inspection Report";
                        } else if ($rights[$i] == "A") {
                            $right = "Approve";
                        } else if ($rights[$i] == "I") {
                            $right = "Issue Certifcate";
                        } else if ($rights[$i] == "C") {
                            $right = "Upload Certifcate";
                        } else if ($rights[$i] == "IF") {
                            $right = "Issue Fund";
                        } else if ($rights[$i] == "RF") {
                            $right = "Reject Refund Request";
                        } else if ($rights[$i] == "CR") {
                            $right = "View & Add Courier";
                        } else {
                            $right = "";
                        }
                        if ($i == 0) {
                            $view_rights = $right;
                        } else {
                            $view_rights = $view_rights . " , " . $right;
                        }
                    }
                    ?>
                    <tr>
                        <td><?= sprintf("%02d", $sl) ?></td>
                        <td><?= $utype_name ?></td>
                        <td><?= $user_name ?></td>
                        <td><?= $udesig ?></td>
                        <td><?= $ucno ?></td>
                        <td><?= $uemail ?></td>
                        <td><?= $uname ?></td>
                        <td><?= $view_rights ?></td>
                        <td><?= $user_status ?></td>
                        <td class="text-center">                    
                            <a class="btn btn-primary" href="<?= base_url('admin/levels/index/') . $user_id ?>">
                                <i class="fa fa-pencil"></i> Modify
                            </a>
                        </td>
                    </tr>
        <?php $sl++;
    }
} ?>
        </tbody>
    </table>
</div>