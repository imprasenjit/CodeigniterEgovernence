<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Upload certificates </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#file1").pekeUpload({
                    bootstrap: true,
                    url: "<?=base_url('upload/')?>",
                    data: {file: "reportfile"},
                    limit: 1,
                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                });//End of pekeUpload                
                $("#uctbl").DataTable();
                
                $("#uploadcertificateModal").on("show.bs.modal", function (e) {
                    var ids = e.relatedTarget.id; //alert(pars);
                    $("#modalids").val(ids);
                });
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php $this->load->view("staffs/assets/uploadcertificates"); ?>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
        <div class="modal fade" id="uploadcertificateModal" tabindex="-1" role="dialog" aria-labelledby="uploadcertificateModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="uploadcertificateModalLabel">Certificate Uploading</h4>
                    </div>
                    <form action="<?=base_url('staffs/uploadcertificates/save')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body text-left">
                            <input type="hidden" name="modalids" id="modalids" />
                            <input type="file" name="reportfile" id="file1" />                    
                            <textarea name="remarks" class="form-control" placeholder="Remarks" style="margin:4px auto"></textarea>
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-remove"></i>
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-cloud-upload"></i>
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- End of #uploadcertificateModal -->
    </body>
</html>