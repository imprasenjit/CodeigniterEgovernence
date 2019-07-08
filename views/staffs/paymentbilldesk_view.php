<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB ::  Billdesk Payment Informations</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">Payment Informations</h3>
                    <div class="box-body">
                        <form id="payfrm" action="https://pgi.billdesk.com/pgidsk/PGIMerchantPayment" method="post">
                            <input type="hidden" value="<?=$msg?>" name="msg" />                            
                            <table class="table" style="margin-bottom: 0px">
                                <tbody>
                                    <tr>
                                        <td>UAIN : </td>
                                        <td><?=$uain?></td>
                                    </tr>
                                    <tr>
                                        <td>Unit/Organization : </td>
                                        <td><?=$industryName?></td>
                                    </tr>
                                    <tr>
                                        <td>Form Name : </td>
                                        <td><?=$form_name?></td>
                                    </tr>
                                    <tr>
                                        <td>Amount : </td>
                                        <td><?=sprintf("%0.2f", $txn_amnt)?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-check-circle"></i> Continue
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
        </div><!--End of .wrapper-->
        <script type="text/javascript">
        $(document).ready(function () {
            //$("#payfrm").submit();
        });
        </script>
    </body>
</html>