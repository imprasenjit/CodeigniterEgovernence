<div class="content-wrapper">		

    <section class="content">

        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>Active Feedbacks</h2>


            </div>

            <div class="box-body" id="boxbody">
                <table id="feedbacks" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
</div>
<script src="<?= base_url('public/'); ?>js/datatables.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $("#feedbacks").DataTable({
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "msg"},
                {"data": "date"},
                {"data": "action"}
            ],
            "columnDefs": [
                {"width": "1%", "targets": 0},
                {"width": "20%", "orderable": false, "targets": 1},
                {"width": "49%", "orderable": false, "targets": 2},
                {"width": "10%", "orderable": false, "targets": 3},
                {"width": "20%", "orderable": false, "targets": 4},
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url("cms/feedback/getactivefeedbacks"); ?>",
                "dataType": "json",
                "type": "POST",
                "complete": function (jsn, type) {
                    $('.deactivate').click(function (e) {
                        if (!confirm("Are you sure You want to deactivate this feedback?")) {
                            e.preventDefault();
                        }
                    });
                }
            },
            language: {
                processing: "<div class='loading'>Loading...</div>",
            },
            "order": [[0, 'asc']],
            "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]],
            "destroy": false
        });
    });
    //End of datatables
</script>