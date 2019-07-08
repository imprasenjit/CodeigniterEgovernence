<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $key_person=$cafRow->Key_person;
    $street_name1=$cafRow->b_street_name1 ." , ".$cafRow->b_street_name2;
    $dist=$cafRow->b_dist;
    $address=$street_name1." , ".$dist;
    
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params);
}//End of if

$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formRow) {
	$make = $formRow->make; 
	$model = $formRow->model;
	$machine = $formRow->machine;
	$platform = $formRow->platform;
	$max_capacity = $formRow->max_capacity;
	$min_capacity = $formRow->min_capacity;
	$e_value = $formRow->e_value;
} else {
	$make = "Not found";
	$model = "Not found";
	$machine = "Not found";
	$platform = "Not found";
	$max_capacity = "Not found";
	$min_capacity = "Not found";
	$e_value = "Not found";
}
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {	
	$concern_ins = $formCertRow->concern_ins;	
} else {
	$concern_ins = "Not found";
}
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$p_date = $formProcessRow->p_date;
} else {
	$p_date= "Not Found!";
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
                        <div class="alomcertbl printcontent">
	
		<div style="position:relative;text-align:center;">							
		<img src = "<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg">
		</div>
		<br/>
		<h2 align = "center">GOVERNMENT OF ASSAM</h2>
		<h4 align = "center">OFFICE OF THE CONTROLLER OF LEGAL METROLOGY::ASSAM::GUWAHATI</h4>
		<h4 align = "center">(Office Address: R.K Mission Road, Ulubari, Guwahati-781007)</h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b> </br> 
				
				UAIN : <b><?php echo $uain; ?></b> </br> </br>
				
				
				To, </br>
				<b><?=strtoupper($concern_ins);?></b></br>
				Sub:  Approval for Verification and Stamping of Weigh Bridge.</br> </br>
							
				</td>
				
				<td align="right"></br> 
				Dated Guwahati, the :  <b><?php echo date('d-m-Y',strtotime(date("h:i:sa"))); ?></b>
				
				</td>
				
				
				
			</tr>
			
		</table>
		<br/>
		<p align="justify">
		With reference to the subject cited above, you are hereby allowed to verify and stamp the following Weigh Bridge as per rule and following instructions : </br>
		
		1) Prior to verifying the weighbridge ensure that the party possess duly verified and stamped weights at the Site of the Weighing instruments equal to one-tenth of the capacity of the instrument or one ton, whichever is less as required under the provision of the Rule 21 (4) of the Assam Legal Metrology (Enforcement) Rules, 2011. </br>
		2) Realise the Govt. Verification & Stamping fee as per rule and incorporate in the remarks column that verification done after compliance of the instruction (1) mentioned above
		
		</p>
		<br/>
		
		
		<table class="table"  border="1">
    <thead>
      <tr>
	  <th style="border-bottom:1px solid black; width:10%; text-align:center;">Sl No</th>
        <th style="border-bottom:1px solid black; width:45%; text-align:center;">Name and Address of the owner of the Weigh Bridge</th>
        <th style="border-bottom:1px solid black; width:45%; text-align:center;">Details of the Weigh Bridge with conversion</th>
       
      </tr>
    </thead>
    <tbody style="border:1px solid black;">
      <tr>
        <td>1</td>
		<td><?=$address; ?></td>
		<td>
		
		Make : <?=$make; ?></br>
		Model No : <?=$model; ?></br>
		Machine Sl. No. : <?=$machine; ?></br>
		Platform Size : <?=$platform; ?></br>
		Max. Capacity : <?=$max_capacity; ?></br>
		Min. Capacity : <?=$min_capacity; ?></br>
		e – Value : <?=$e_value ;?></br>
		Class : 
		</td>
      </tr>
      
      
    </tbody>
  </table>
		<div class="row">
		<div class="col-sm-12" style="padding:0">			
			<div class="col-sm-6">
				<p align="left">Date: <b><?php echo date('d-m-Y',strtotime($p_date)); ?></b> </p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<strong>Controller of Legal Metrology, </br>
				Assam, Guwahati-7  </strong>
			</div>			
		</div>
		</div>
		<p align="justify">They are asked to keep duly verified and stamped weights at the site of the weighing instruments equal to one tenth of the capacity of the instrument or one ton whichever is less as required under the provision of the rule 21 (4) of the Assam Legal Metrology (Enforcement) Rules, 2011.</p>
	</div>
					   
					   <!-- copied -->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
