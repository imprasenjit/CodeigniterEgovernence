<?php $officeRows = $this->offices_model->get_rows($this->dept_code); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Transaction Reports </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("cms/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url('public/css/loading.css')?>" />
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
        <link href="<?=base_url('public/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet" />
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dtbl").DataTable({
                    "columns": [
                        {"data": "txn_id"},
                        {"data": "txn_time"},
                        {"data": "uain"},
                        {"data": "txn_amnt"},
                        {"data": "txn_gateway"}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "<?= base_url("cms/payments/getrecords"); ?>",
                        "dataType": "json",
                        "type": "POST",
                    },
                    language: {
                        processing: "<div class='loading'>Loading...</div>",
                    },
                    "order": [[0, 'desc']],
                    "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
                });
                
                $(".dp").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true
                });
                $(document).on("change", "#pay_mode", function () {
                    var frmdate = $("#frmdate").val();
                    var todate = $("#todate").val();
                    var mod = $(this).val(); //alert("catid : "+catid);
                    if(frmdate == "") {
                        $("#frmdate").notify("From date cannot be empty!", {position:"top"});
                        $("#frmdate").focus();
                    } else if(todate == "") {
                        $("#todate").notify("To date cannot be empty!", {position:"top"});
                        $("#todate").focus();
                    } else if(mod == "") {
                        $(this).notify("Please select a payment mode!", {position:"top"});
                    } else {
                        var url = "<?=base_url('cms/misreports/index/')?>"+mod
                        window.location = url;
                    }//End of if else                        
                });
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("cms/requires/header");
            $this->load->view("cms/requires/aside");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Transaction reports
                    </h3>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    From date :
                                    <input id="frmdate" class="form-control dp" type="text" />
                                </td>
                                <td>
                                    To date :
                                    <input id="todate" class="form-control dp" type="text" />
                                </td>
                                <td style="display:<?=($this->dept_code=='pcb')?'block':'block'?>">
                                    Registered Office :
                                    <select id="office_id" class="form-control">
                                        <option value="">Select</option>
                                        <?php if($officeRows) {
                                            foreach($officeRows as $orows) {
                                                echo '<option value="'.$orows->id.'">'.$orows->office_name.'</option>';
                                            }
                                        }//End of if?>
                                    </select>
                                </td>
                                <td>
                                    Payment mode :
                                    <select id="pay_mode" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Online</option>
                                        <option value="2">Offline</option>
                                        <option value="3">Both</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date &amp; Time</th>
                                <th>UAIN</th>
                                <th>Amount</th>
                                <th>Gateway</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <?php $this->load->view("cms/requires/footer"); ?>
        </div>
    </body>
</html>
