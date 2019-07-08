<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB || Admin Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("admin/requires/cssjs"); ?>
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
                
                var rows=1;
                $(document).on("click",".add_btn",function() { 
                    if(rows < 20){ //alert("Hi");
                        rows++;
                        $("#conditionslist").append("<div class='input-group' style='margin:2px 0px'><input type='text' placeholder='Condition-"+rows+"' name='conditionslist[]' class='form-control' /><span class='input-group-btn'><button type='button' class='del_btn btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></span></div>");
                    }
                });

                $(document).on("click", ".del_btn", function () {
                    $(this).parent().parent("div").remove();
                    rows--;
                });
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("admin/requires/header");
            $this->load->view("admin/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php $this->load->view("admin/assets/tandcs"); ?>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("admin/requires/footer"); ?>
        </div><!--End of wrapper-->
    </body>
</html>