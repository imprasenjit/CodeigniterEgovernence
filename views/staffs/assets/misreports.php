<?php
$dept_code = $this->session->staff_dept;
$transactions = $this->misreports_model->get_rows($this->dept_code);
$officeRows = $this->offices_model->get_rows($this->dept_code);
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        MIS Reports
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
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
                <td style="display:<?=($dept_code=='pcb')?'block':'none'?>">
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
                <th style="text-align: center">SN</th>                    
                <th>Transaction Time</th>
                <th>UAIN</th>
                <th>Amount</th>
                <th>Reference No.</th>
                <th>Fee Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($transactions) {
                $sl = 1;
                foreach ($transactions as $rows) {
                    $id = $rows->id;
                    $amnt = $rows->amnt;
                    $dt = $rows->dt;
                    $refno = $rows->refno;                    
                    if($dept_code == "pcb") {
                        $uainType = $rows->uain;
                        $pcs = explode("/", $uainType);
                        $typ = end($pcs);
                        $uain = substr($uainType, 0, -2);
                        //echo $uainType." => ".$uain." : ".$typ."<br>";
                    } else {               
                        $uain = $rows->uain;         
                        $typ = $rows->typ;
                    }//End of if else                                        
                    $type = ($typ=="A")?"Application Fee":"Certificate Fee";
                    ?>
                    <tr>
                        <td style="text-align: center"><?=sprintf("%02d", $sl)?></td>
                        <td><?=date("d-m-Y h:i A", strtotime($dt))?></td>
                        <td>
                            <a id="<?=$rows->uain?>" data-toggle="modal" data-target="#transactionModal" href="javascript:void(0)">
                                <?=$uain?>
                            </a>
                        </td>
                        <td><?=sprintf("%0.2f", $amnt)?></td>
                        <td><?=$refno?></td>
                        <td><?=$type?></td>
                    </tr>
                    <?php $sl++;
                }
            } ?>
        </tbody>
    </table>
</div><!--End of .box-->

<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box box-success">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="transactionModalLabel">Transaction Details</h4>
                </div>
                <div class="modal-body" id="transactionModalBody">
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-remove"></i>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div><!--End of .modal-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#transactionModal").on("show.bs.modal", function (e) {
            var uain = e.relatedTarget.id; //alert("uain : "+uain);
            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/misreports/gettransaction')?>",
                data: {uain: uain},
                beforeSend: function () {
                    $("#transactionModalBody").html("<div class='loading'></div>");
                },
                success: function (res) { //alert(res);
                    $("#transactionModalBody").html(res);
                }
            }); //End of ajax()
        });
    });
</script>