<div class="content-wrapper">		

    <section class="content">

        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>Resolved Grivances</h2>
                <?php echo anchor(site_url('cms/grievance/'), 'New Grivances', 'class="btn btn-primary"'); ?>

            </div>

            <div class="box-body" id="boxbody">                
                <table id="grivances" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
</div>
</section>
</div>
<script src="<?= base_url('public/'); ?>js/datatables.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $("#grivances").DataTable({
            "columns": [
                {"data": "g_id"},
                {"data": "name"},
                {"data": "company"},
                {"data": "department"},
                {"data": "date"},
                {"data": "action"}
            ],
            "columnDefs": [
                {"width": "1%", "targets": 0},
                {"width": "10%", "orderable": false, "targets": 1},
                {"width": "20%", "orderable": false, "targets": 2},
                {"width": "39%", "orderable": false, "targets": 3},
                {"width": "10%", "orderable": false, "targets": 4},
                {"width": "20%", "orderable": false, "targets": 5},
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url("cms/grievance/resolvedgrievances"); ?>",
                "dataType": "json",
                "type": "POST",
                "complete": function (jsn, type) {
                    $('.resolve').click(function (e) {
                        if (!confirm("Are you sure You want to resolve this Grivance?")) {
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