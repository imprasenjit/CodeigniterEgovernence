<?php ?>

<div class="content-wrapper">		

    <section class="content">

        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>Feedback Details</h2>

            </div>

            <div class="box-body" id="boxbody">
                <table id="approvals" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>



    </section>

</div>  
<script src="<?= base_url('public/'); ?>js/datatables.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
    var table = $("#approvals").DataTable({
    "columns": [
    {"data": "id"},
    {"data": "sub_dept"},
    {"data": "application_type"},
    {"data": "service_name"},
    {"data": "action"},
    ],
            "columnDefs": [
            {"width": "1%", "targets": 0},
            {"width": "4%","orderable": false, "targets": 1},
            {"width": "3%", "orderable": false,"targets": 2},
            {"width": "40%","orderable": false, "targets": 3},
            {"width": "10%","orderable": false, "targets": 4},
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
            "url": "<?= base_url("cms/approvals/getApprovals"); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":function (d) {
                    d.dept = $('#dept').val();
                    d.sub_dept= $("#sub_dept").val();
                    d.cat=$("#app_cat").val();
                    }
            },
            language: {
            processing: "<div class='loading'>Loading...</div>",
            },
            "order": [[0, 'asc']],
            "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]],
            "destroy": true
    });
    //End of datatables
    </script>