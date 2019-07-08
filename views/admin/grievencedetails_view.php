<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB || Admin Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("admin/requires/cssjs"); ?>
        <script type="text/javascript">
            $(document).ready(function () {                
                $(document).on("change","#appoptions",function() {
                    var optn = $(this).val();
                    if(optn === "") {
                        $(this).notify("please select an option");
                        $(this).focus();
                    } else {
                        if(optn == '1') {
                            $("#replytbl").css("display","table");
                            $("#forwardtbl").css("display","none");
                        } else {

                            $("#replytbl").css("display","none");
                            $("#forwardtbl").css("display","table");
                        }//End of if else
                    }//End of if else
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
                <?php $this->load->view("admin/assets/grievencedetails"); ?>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("admin/requires/footer"); ?>
        </div><!--End of wrapper-->
    </body>
</html>