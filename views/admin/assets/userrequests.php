<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        User Requests
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="dtbl">
        <thead>
            <tr>
                <th>SN</th>
                <th>Date & Time</th>
                <th>Name</th>
                <th>Contact No.</th>
                <th>Email ID</th>
                <th>Address</th>
                <th>Message</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            if($this->userrequests_model->get_rows($dept_code)) {
            $sl=1;
            foreach($this->userrequests_model->get_rows($dept_code) as $rows) {
                $request_id = $rows->request_id;
                $dept = $rows->dept_code;
                $name = $rows->name;
                $cno = $rows->cno;
                $email = $rows->email;
                $address = $rows->address;
                $message = $rows->message;
                $request_date = $rows->request_date;
                $request_time = $rows->request_time;
                $vals  = $request_id."||".$name."||".$cno;
                ?>
            <tr>
                <td><?php echo sprintf("%02d", $sl); ?></td>
                <td><?php echo date("d-m-Y", strtotime($request_date))." ".$request_time; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $cno; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $message; ?></td>
            </tr>
            <?php $sl++; } } ?>
        </tbody>
    </table>
</div>