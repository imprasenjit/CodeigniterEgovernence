<div class="content-wrapper">		
    <section class="content">
        <div class="box box-primary">  
            <div class="box-header with-border">
                <h2>Notifications</h2>
                <a href="<?=base_url("cms/notifications/AddNotification/")?>" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i>&nbsp;Add New Notification</a>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>Select Department <span class="text-danger">*</span></label>
                    <select id="dept" class="form-control">
                        <option value="" selected="selected">Select</option>
                        <?php foreach ($this->getDepartments_model->get() as $depts) { ?>
                            <option value="<?php echo $depts["id"]; ?>"><?php echo $depts["name"]; ?></option>
                        <?php } // End of foreach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Select Sub Department <span class="text-danger">*</span></label>
                    <select id="sub_dept" class="form-control">
                        <option value="" selected="selected">Select</option>
                    </select>
                </div>
              
            </div> <!-- End of .row --> 
            <div class="box-body" id="boxbody">
                <table id="approvals" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Notification No</th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Issuing Authority</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Notification No</th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Issuing Authority</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div> <!-- End of .box-body -->  
        </div> <!-- End of .box -->  
    </section>
</div>  
<script src="<?= base_url('public/'); ?>js/datatables.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
    var table = $("#approvals").DataTable({
    "columns": [
    {"data": "id"},
    {"data": "noti_no"},
    {"data": "Noti_date"},
    {"data": "post_name"},
    {"data": "issue_by"},
    {"data": "action"},
    ],
            "columnDefs": [
            {"width": "1%", "targets": 0},
            {"width": "14%", "targets": 1},
            {"width": "4%", "targets": 2},
            {"width": "10%", "targets": 3,"orderable": false},
            {"width": "13%", "targets": 4 ,"orderable": false},
            {"width": "7%", "targets": 5 ,"orderable": false},
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
            "url": "<?= base_url("cms/notifications/getNotifications"); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":function (d) {
                    d.dept = $('#dept').val();
                    d.sub_dept= $("#sub_dept").val();
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

    $(document).on("change", "#dept", function () {
    var dept = $(this).val();
    $.ajax({
    type: "GET",
            url: "<?= base_url() ?>common/getSubdeptusingparentid/",
            data: {parent_id: dept},
            beforeSend: function () {
            $("#sub_dept").html("<option value=''>Loading...</option>");
            },
            success: function (data) {
            $("#sub_dept").html(data);
            }
    });
    });
    $("#sub_dept").change(function () {
      table.ajax.reload();
    });
    
    });
</script>
<script>$("[data-toggle='tooltip']").tooltip();</script>
