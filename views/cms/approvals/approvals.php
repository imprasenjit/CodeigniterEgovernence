<div class="content-wrapper">		
    <section class="content">
        <div class="box box-primary">  
            <div class="box-header with-border">
                <h2>List of Approvals</h2>
                <a href="<?=base_url("cms/approvals/newapproval/")?>" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i>&nbsp;Add New Approval</a>
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
                <div class="col-md-4">
                    <label>Select Category of Application <span class="text-danger">*</span></label>
                    <select id="app_cat" class="form-control">
                        <option value="" selected="selected">Select</option>
                        <option value="1">Pre-Establishment</option>
                        <option value="2">Pre-Operation</option>
                        <option value="3">Post-Commencement</option>
                        <option value="4">Returns And Renewals</option>
                        <option value="6">Registers</option>
                        <option value="5">Other Approvals</option>
                    </select>
                </div>                
            </div> <!-- End of .row --> 
            <div class="box-body" id="boxbody">
                <table id="approvals" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Service Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Service Name</th>
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




    $("#app_cat").change(function () {
    var cat = $(this).val();
    var dept = $("#dept").val();
    var sub_dept = $("#sub_dept").val();
    table.ajax.reload();
    });
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
    $("#app_cat").val("");
    table.ajax.reload();
    });
    
    });
</script>
