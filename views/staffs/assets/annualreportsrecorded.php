<?php
$dept_code = $this->session->staff_dept;
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Recorded Annual Reports
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="tbl">
        <thead>
            <tr class="success">
                <th class="text-center">Record Date</th>
                <th>UAIN</th>
                <th>Enterprise Name</th>
                <th>Form Name</th>
                <th class="text-center">Operation</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>