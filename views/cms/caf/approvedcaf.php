<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pending Common Application Forms  <span data-toggle="tooltip" title="" data-placement="right" class="badge bg-yellow" data-original-title="<?php //echo $total;     ?> Pending Applications"><?php //echo $total;     ?></span></h3> 
                        <!-- /.box-tools -->
                    </div>
                    <!-- Start of Search -->

                    <!-- End of Search -->
                    <table id="approvedcaf" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>User Name</th>
                                <th>Enterprise's Name</th>
                                <th>Enterprise's Address</th>
                                <th>Mobile No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl No.</th>
                                <th>User Name</th>
                                <th>Enterprise's Name</th>
                                <th>Enterprise's Address</th>
                                <th>Mobile No.</th>
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
        var table = $("#approvedcaf").DataTable({
            "columns": [
                {"data": "id"},
                {"data": "username"},
                {"data": "entpname"},
                {"data": "entpaddress"},
                {"data": "mobile"},
                {"data": "action"},
            ],
            "columnDefs": [
                {"width": "1%", "targets": 0},
                {"width": "4%", "targets": 1},
                {"width": "10%", "targets": 2},
                {"width": "40%", "targets": 3},
                {"width": "5%", "targets": 4},
                {"width": "10%", "targets": 5},
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url("cms/caf/getapprovedcaf"); ?>",
                "dataType": "json",
                "type": "POST"
            },
            language: {
                processing: "<div class='loading'>Loading...</div>",
            },
            "order": [[0, 'asc']],
            "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]],
            "destroy": true
        });
    });
</script>
