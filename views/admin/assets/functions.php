<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Functions
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="dtbl">       
        <thead>
            <tr>
                <th style="width: 50px;">SN</th>
                <th>Area</th>
                <th>Function</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Application Form</td>
                <td>Modify</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Application Form</td>
                <td>Query</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Application Form</td>
                <td>Reject</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Application Form</td>
                <td>Forward</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Application Form</td>
                <td>Schedule Inspection</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Application Form</td>
                <td>Upload Inspection Report</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Certificate</td>
                <td>Approve</td>
            </tr> 
            <tr>
                <td>8</td>
                <td>Certificate</td>
                <td>Upload</td>
            </tr> 
            <tr>
                <td>9</td>
                <td>Payment</td>
                <td>Issue Fund</td>
            </tr> 
            <tr>
                <td>10</td>
                <td>Payment</td>
                <td>Reject Refund Request</td>
            </tr>  
            <tr>
                <td>11</td>
                <td>Courier Receipt</td>
                <td>View & Receive</td>
            </tr>
        </tbody>
    </table>
</div>