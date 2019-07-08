<?php
$dept_code = $this->session->staff_dept; 
$staff_id = $this->session->staff_id;
$results = $this->applicationsup_model->get_staffprocessrows($dept_code, $staff_id, "CS");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Courier receipts </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dtbl").DataTable();
                $(document).on("click", ".receive-courier", function () {
                    if(confirm("Are you sure you want to receive this courier?")){
                        var ids = $(this).attr("id");
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url('staffs/courierreceipts/receive')?>",
                            data: { ids: ids},
                            success:function(res){ //alert(ids+" : "+res);
                                $.notify(res);
                                setTimeout(location.reload.bind(location), 1000);
                            }
                        });//End of ajax()
                    }
                    else{
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <?php if ($this->session->flashdata("flashMsg")) { ?>
            <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
        <?php } ?>
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Courier receipts
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th class="text-center">SN</th>
                                <th>UAIN</th>
                                <th>Enterprise/Unit Name</th>
                                <th>Courier details</th>
                                <th>Courier date</th>
                                <th class="text-center">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            if($results) {
                            $sl=1;
                            foreach($results as $rows) {
                                $unit_id = $rows->unit_id;
                                $unit_name = $rows->unit_name;
                                $uain = $rows->uain;
                                $uainencoded = encodeme($uain);
                                $process_date = $rows->process_date;
                                if(strlen($process_date) >= 10) {                                    
                                    $pdt = date("d-m-Y h:i A", strtotime($process_date));
                                } else {
                                    $pdt = "";
                                }
                                $processed_by = $rows->processed_by;
                                $process = $rows->process;
                                $office_id = $rows->office_id;
                                $current_userid = $rows->current_userid;
                                $frm_no = uainexplode($uain, "form_no");
                                $frmtbl = $dept_code."_form".$frm_no;

                                $fromRow = $this->forms_model->get_uainrow($dept_code, $frmtbl, $uain);
                                if($fromRow) {
                                    $courier_details = $fromRow->courier_details;
                                    if(strlen($courier_details) > 1) {
                                        $obj = json_decode($courier_details);
                                        $cn = (isset($obj->cn) ? $obj->cn : "Not Found!");
                                        $rn =  (isset($obj->rn) ? $obj->rn : "Not Found!");
                                        $dt =  (isset($obj->dt) ? $obj->dt : "Not Found!");
                                    } else {
                                        $cn=$rn=$dt = "";
                                    }
                                } else {
                                    $cn=$rn=$dt = "";
                                } 
                                ?>
                            <tr>
                                <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                                <td><?=$uain?></td>
                                <td><?=$unit_name?></td>
                                <td><?="Courier Name : <b>".$cn."</b><br /> Reference No. <b>".$rn."</b>"?></td>
                                <td><?=$pdt?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning receive-courier" id="<?=$frmtbl."|||".$uain?>">
                                        <i class="fa fa-inbox"></i> Receive
                                    </button>
                                </td>
                            </tr>
                            <?php $sl++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>
