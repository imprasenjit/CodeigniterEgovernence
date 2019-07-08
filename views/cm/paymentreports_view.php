<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CM Dashboard :: Departments Payments</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("cm/requires/cssjs"); ?>
        <link href="<?=base_url('public/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('public/datatables/Buttons-1.4.2/css/buttons.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/dataTables.buttons.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.bootstrap.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/JSZip-2.5.0/jszip.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/pdfmake-0.1.32/pdfmake.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/pdfmake-0.1.32/vfs_fonts.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.html5.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.print.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.colVis.min.js')?>" type="text/javascript"></script>     
        <link rel="stylesheet" href="<?=base_url('public/css/loading.css')?>" />
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>   
        <script type="text/javascript">
            $(document).ready(function () {

                $(".dp").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true
                });

                $("#dtbl").DataTable({
                    dom: "Bfrtip",
                    buttons: ["excel", "pdf", "print"],
                    "columns": [
                        {"data": "challan_no"},
                        {"data": "txn_time"},
                        {"data": "txn_refno"},
                        {"data": "txn_amnt"},
                        {"data": "bank_refno"}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "<?=base_url("cms/payments/getrecords")?>",
                        "dataType": "json",
                        "type": "POST",
                    },
                    language: {
                        processing: "<div class='loading'>Loading...</div>",
                    },
                    "order": [[0, 'desc']],
                    "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]],

                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;
                        var intVal = function (i) {
                            return typeof i === 'string' ?i.replace(/[\$,]/g, '') * 1 :typeof i === 'number' ? i : 0;
                        };
                        pageTotal = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        AllTotal = api.column(3).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        $(api.column(0).footer()).html('Total : ');
                        $(api.column(3).footer()).html('<i class="fa fa-inr"></i> '+pageTotal.toFixed(3)+" ("+AllTotal.toFixed(3)+")");
                        $(api.column(4).footer()).html('');
                    }
                });

                $(document).on("click", "#searchbtn", function(){
                    var frmdt = $("#frmdt").val();
                    var todt = $("#todt").val();
                    if(frmdt.length != 10) {
                        $("#frmdt").notify("Please select a date!", {position:"top"});
                        $("#frmdt").focus();
                    } else if(todt.length != 10) {
                        $("#todt").notify("Please select a date!", {position:"top"});
                        $("#todt").focus();
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url('cms/payments/getfilteredrecords')?>",
                            data: {"frmdt": frmdt, "todt": todt},
                            success:function(res){ //alert(ids+" : "+res);
                                $("#resdiv").html(res);
                            }
                        });//End of ajax()
                    }//End of if else
                }); //End of onclick .del   
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <?php if ($this->session->flashdata("flashMsg")) { ?>
            <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
        <?php }//End of if ?>
    
        <div class="wrapper">
            <?php
            $this->load->view("cm/requires/header");
            $this->load->view("cm/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <section class="content-header" style="padding-top: 2px">
                    <div class="box box-primary" style="margin-bottom: 0px">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center text-uppercase"> Payment Reports</h3>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-control dp" id="frmdt" placeholder="From Date" type="text" />
                                        </td>
                                        <td>
                                            <input class="form-control dp" id="todt" placeholder="To Date" type="text" />
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" id="searchbtn">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="resdiv">
                                <table class="table table-bordered table-responsive" id="dtbl">
                                    <thead>
                                        <tr>
                                            <th>Challen No.</th>
                                            <th>Date &amp; Time</th>
                                            <th>Ref. No.</th>
                                            <th>Amount</th>
                                            <th>Bank Ref.</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Date &amp; Time</th>
                                            <th>Amount</th>
                                            <th>Bank Ref.</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!--End of .col-md-12 -->
                    </div><!--End of .row -->
                </section>
            </div>
            <?php $this->load->view("cm/requires/footer"); ?>
        </div>
    </body>
</html>