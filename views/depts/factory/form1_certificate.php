<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
}//End of if

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$file_no = $formCertRow->file_no;
	$sub_date = $formCertRow->sub_date;
} else {
	$file_no= $sub_date= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$issue_date = $formCertRow->p_date;
	
} else {
	$issue_date= "Not Found!";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Certificate View </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link href="<?=base_url('public/css/certificate.css')?>" rel="stylesheet">        
        <script src="<?=base_url('public/js/jQuery.print.min.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on("click", ".printbtn", function(){
                    $(".printcontent").print({
                        globalStyles : true,
                        mediaPrint : false,
                        stylesheet : null,
                        iframe : false,
                        noPrintSelector : ".avoidme",
                        append : null,
                        prepend : null
                    });
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
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Certificate
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <table class="alomcertbl printcontent">
                            <thead>
                                <tr>
                                    <th>
                                        <img style="height:100px; width:100px;" src="<?=base_url('public/imgs/assam.png')?>"/> <br/>
                                    </th>
                                    
                                    <th style="text-align: center;">
                                         <strong style="font-size: 25px;">GOVT. OF ASSAM <br />            
                                        OFFICE OF THE CHIEF INSPECTOR OF FACTORIES,ASSAM</strong><br/>  
                                        <h4>NPS International School Lane, Betkuchi, Lokhora, Guwahati-781040.</h4>
                                    </th>
                                    
                                </tr>
                                <tr>
                                        <th colspan="2"><hr></th>
                                </tr>
                              
                            </thead>
                           
                            <tbody>
                                <tr>
                                    <td colspan="3" style="padding: 10px 30px;">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size: 16px; ">
                                                        
                                                        No. : <strong><?=$file_no?></strong> <br/><br/>
                                                    </td>
                                                      <td style="margin-top: -10px; text-align: right; font-size: 16px;">
                                                       Dated <strong><?=date("d-m-Y", strtotime($issue_date))?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; line-height: 24px">
                                                        From:<p  style="margin-left: 100px; margin-top: -20px;">Shri Saniram Das,   <br/>
                                                               Chief Inspector of Factories,Assam,<br/>
                                                               Betkuchi, Lokhora,Guwahati-781040.</p><br/>
                                                        To, <p style="margin-left: 100px;">
                                                            The Manager/Occupier,<br/>
                                                            T.G.Plasto Industries<br/>
                                                            Brahmaputra Industrial Park<br/>
                                                            Gauripur, Kamrup(R)<br/>
                                                            Pin- 781031</p><br/>
                                                        Sub:<p style="margin-left: 100px;margin-top: -20px;">Permission and approval of plant and machinery layout plan.</p><br/>
                                                        
                                                        Ref:<p style="margin-left: 100px;margin-top: -20px;">Your Online No. <strong><?=$uain?></strong></p> 
                                                              
                                                        
                                                    </td>
                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px; font-size: 16px;">Sir,<br/>
                                                    
                                                        <p style="margin-left: 100px; font-family: AlgerFont; font-size:16px; line-height:32px;">
                                                            Reference to your application, the submitted plans are hereby approved and granted to install the</p><p style="margin-top: -10px;"> plant & machinery and prime movers etc as indicated in the plan.
                                                        </p>
                                                        <p style="margin-left: 100px; font-family: AlgerFont; font-size:16px; line-height:32px;">    
                                                           The machinery installed are not to b used until the Certificate of Stability is obtained from</p><p style="margin-top: -10px;"> Component Person and is accepted by the undersigned.
                                                        </p>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        Place : <strong>Guwahati</strong> <br />
                                                        Date : <strong><?=date("d-m-Y", strtotime($issue_date))?></strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px">
                                                        <p style="margin-right: 40px;">Yours faithfully,</p><br/><br/><br/>
                                                        Chief Inspector of Factories,<br/>
                                                        <p style="margin-right: 20px;">Assam,Guwahati-40.</p>
                                                    </td>
                                                </tr>
                                               
                                                <tr>
                                                   <td colspan="2" style="padding-top: 40px; font-size: 16px;">Copy to:<br/>
                                                    
                                                        <p style="margin-left: 100px; font-family: AlgerFont; font-size:16px; line-height:32px;">
                                                           1. The Senior Inspector of Factories, Zonal Factory Office, Guwahati
                                                        </p><br/><br/>
                                                        
                                                    </td>
                                                </tr>
                                                 <tr>
                                                   
                                                    <td colspan="2"  style="margin-left: 50px; text-align: right; font-size: 16px">
                                                        
                                                        Chief Inspector of Factories,<br/>
                                                        <p style="margin-right: 20px;">Assam,Guwahati-40.</p>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
