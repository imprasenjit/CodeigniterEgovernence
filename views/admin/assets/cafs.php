<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Common application  forms
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="caftbl">
        <thead>
            <tr>
                <th>UNIT ID</th>
                <th>UBIN</th>
                <th>Enterprise</th>
                <th>Unit Type</th>
                <th>Address</th>
            </tr>
        </thead>
    </table>
</div>