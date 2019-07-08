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
$cafRow1 = $this->cafs_model->get_joinrow($swr_id);

if($cafRow1) {
    $dagno = $cafRow1->dagno;
    $pattano = $cafRow1->pattano;
    $mouza = $cafRow1->mouza;
}
if($cafRow1->dagno == "")
{
	$dagno="Not found";
}

else {
	    $dagno = $cafRow1->dagno;

}

if($cafRow1->pattano == "")
{
	$pattano="Not found";
}

else {
	    $pattano = $cafRow1->pattano;

}

if($cafRow1->mouza == "")
{
	$mouza="Not found";
}

else {
	    $mouza = $cafRow1->mouza;

}

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
		$total_fees = $formCertRow->total_fees;
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		$lic_exp_year = $formCertRow->lic_exp_year;		
		$sub_date = $formCertRow->sub_date;
		$certificate_for = $formCertRow->certificate_for;
		$compl_report_no = $formCertRow->compl_report_no;
		$compl_report_date = $formCertRow->compl_report_date;
		
		$occupation_details=$formCertRow->occupation_details;
	$details=Array();
	$details=explode("&",$occupation_details);
			
	 if($formCertRow->penalty_charge == "")
	 {
		$penalty_charge="0.00";
		}
	else
	{
		$penalty_charge=$formCertRow->penalty_charge;
	}
    
	if($arrear_fees_details!="")
	{
		$arrear_fees_details=json_decode($arrear_fees_details);
		$arrear_fees_details_y1=$arrear_fees_details->y1; 
		$arrear_fees_details_y2=$arrear_fees_details->y2;
		if(isset($arrear_fees_details->fees) && !empty($arrear_fees_details->fees))  $arrear_fees_details_fees=$arrear_fees_details->fees; else $arrear_fees_details_fees=0;
	}
	else
	{
		$arrear_fees_details=0;
		$arrear_fees_details_y1=0;
		$arrear_fees_details_y2=0;
		$arrear_fees_details_fees=0;
	}
	
	
	}
	
	
	//end of looped if
	else
	{
		$total_fees=0;
		$regular_fees=0;
		$lic_exp_year=0;
   //$lic_exp_year = ;
	}
	$formProcessRow = $this->formprocess_model->get_issue_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$issue_date = $formProcessRow->p_date;
	$issuing_officer_id = $formProcessRow->user_id;
	$user_row = $this->deptusers_model->get_row($issuing_officer_id, $this->dept_code);
	$sign = $user_row->user_name;
} else {
	$issue_date= "Not Found!";
	$issuing_officer_id= "";
}

$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);

if(!empty($formRow->address)){
		$address=json_decode($formRow->address);
		$address_s1=$address->s1;
		$address_s2=$address->s2;
		$address_d=$address->d;
		$address_p=$address->p;
	}else{				
		$address_s1="";
		$address_s2="";
		$address_d="";
		$address_p="";
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
                        <a href="<?=base_url('staffs/certificates/getpdf/'.encodeme($uain))?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
							<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">

                           
                            <table  class="table table-bordered table-responsive" >
		<tr>
			<td>		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /></td>
			<td><p><h3 align="center">GOVT OF ASSAM<br/>OFFICE OF THE DIRECTOR<br/>FIRE & EMERGENCY SERVICES , GUWAHATI ASSAM<br/>************************</h3></p></td>
			<td><img src="<?=base_url('public/imgs/fire.png')?>" class="alomlogoimg" /></td>
		</tr>
	</table>
	<br/><br/>

	<p><u>F O R M - (G)</u></p>
	<table width="100%"  >
	<tr>
	<td>UBIN : <b><?php echo $ubin; ?></b><span style="float:right">UAIN : <b><?php echo $uain; ?></b></span></td>

	</tr>
	</table>

	<br/><br/>
	<div  style=" width:90%; ">
	<p align="justify">NO OBJECTION CERTIFICATE OF INBUILT FIRE FIGHTING/ FIRE PREVENTION AND MEANS OF ESCAPE MEASURES IN <?php echo strtoupper($certificate_for); ?>
	</p>
	<br/>

	<p align="justify">This NOC is issued to <?php echo strtoupper($companyName); ?> on <?php echo date("d-m-Y",strtotime($issue_date)); ?> with reference to Compliance Report No. <?php echo $compl_report_no; ?> dated <?php if($compl_report_date=="" || $compl_report_date=="0000-00-00") echo "NIL"; else echo date("d-m-Y",strtotime($compl_report_date)); ?> .<br/><br/>
	I here by certify that the building as per description below at Dag No. <?php echo strtoupper($dagno); ?> Patta No. <?php echo strtoupper($pattano); ?>  Mouza <?php echo strtoupper($mouza); ?> Place <?php echo strtoupper($address); ?> has been inspected in respect of implementation of inbuilt Fire Fighting,Fire Prevention and Means of escape measures and is declared fit in respect of fire safety. The Fire & Emergency Services, Assam has no objection in its occupation/ utilization for the purpose of:</p>
	<br/><br/> 
	</div>
	<p><u><b><h4>DETAILS OF APPROVED OCCUPATION</h4></b></u></p>

	<table width="100%" class="table table-bordered table responsive">
	<tr>
	<td> <u>GROUND FLOOR</u></td>
	<td><u> MEZANINE/BASEMENT  </u></td>
	</tr>
	<tr>
	<td>1. Floor Area : <?php echo $details[0]; ?></td>
	<td>1. Floor Area : <?php echo $details[1]; ?></td>
	</tr>
	<tr>
	<td>2. Purpose of utilization : <?php echo $details[2]; ?></td>
	<td>2. Purpose of utilization : <?php echo $details[3]; ?></td>
	</tr> 

	<tr>
	<td><u>FIRST FLOOR </u></td>
	<td><u>SECOND FLOOR  </u></td>
	</tr>
	<tr>
	<td>1. Floor Area : <?php echo $details[4]; ?></td>
	<td>1. Floor Area : <?php echo $details[5]; ?></td>
	</tr>
	<tr>
	<td>2. Purpose of utilization : <?php echo $details[6]; ?></td>
	<td>2. Purpose of utilization : <?php echo $details[7]; ?></td>
	</tr> 

	<tr>
	<td> <u>THIRD FLOOR   </u></td>
	<td><u> FOURTH FLOOR  </u></td>
	</tr>
	<tr>
	<td>1. Floor Area : <?php echo $details[8]; ?></td>
	<td>1. Floor Area : <?php echo $details[9]; ?></td>
	</tr>
	<tr>
	<td>2. Purpose of utilization : <?php echo $details[10]; ?></td>
	<td>2. Purpose of utilization : <?php echo $details[11]; ?></td>
	</tr> 

	<tr>
	<td> <u>FIFTH FLOOR   </u></td>
	<td><u>SIXTH FLOOR   </u></td>
	</tr>
	<tr>
	<td>1. Floor Area : <?php echo $details[12]; ?></td>
	<td>1. Floor Area : <?php echo $details[13]; ?></td>
	</tr>
	<tr>
	<td>2. Purpose of utilization : <?php echo $details[14]; ?></td>
	<td>2. Purpose of utilization : <?php echo $details[15]; ?></td>
	</tr> 
	<tr>
	<td> <u>SEVENTH FLOOR</u></td>
	<td><u> EIGHTH FLOOR  </u></td>
	</tr>
	<tr>
	<td>1. Floor Area : <?php echo $details[16]; ?></td>
	<td>1. Floor Area : <?php echo $details[17]; ?></td>
	</tr>
	<tr>
	<td>2. Purpose of utilization : <?php echo $details[18]; ?></td>
	<td>2. Purpose of utilization : <?php echo $details[19]; ?></td>
	</tr> 
	<tr>
	<td><u>NINETH FLOOR</u></td>
	<td><u> TENTH FLOOR  </u></td>
	</tr>
	<tr>
	<td>1. Floor Area : <?php echo $details[20]; ?></td>
	<td>1. Floor Area : <?php echo $details[21]; ?></td>
	</tr>
	<tr>
	<td>2. Purpose of utilization : <?php echo $details[22]; ?></td>
	<td>2. Purpose of utilization : <?php echo $details[23]; ?></td>
	</tr> 
	</table>
	<br/>
	<h4><b>THIS NOC IS VALID UP TO 31<sup>st</sup> OF MARCH, <?php echo date("Y",strtotime($lic_exp_year))+1;?></b></h4>
	<br/>
<table  class="table table bordered table-responsive">
	<tr>
	  <td>Place of issue : GUWAHATI <br/>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
	  <td style="width:40%" align="right"><div style="text-align:center;padding:10px;">
	  
		<p>Director of Fire and Emergency Services,<br/>
		Assam, Guwahati</p>
		<div style="width:30%;position:relative;float:left;">
           <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
			</div></div></td>
	</tr>
</table>
<h4>(Subject to Conditions mentioned here under)</h4>
<br/>
 

<p style="text-align:left">CONDITIONS :</p>
  <table   class="table table bordered table-responsive">
    <tr>
    
    <td> 1 . There should not be any change of Trade for which this License has been issued. </td>
    </tr>
    <tr>
    
    <td> 2 . There should not be any structural change in the building either horizontally or vertically. There should not also be any change in the existing arrangements.  </td>
    </tr>
    <tr>
    
    <td>3 . The fire fighting equipments should be in serviceable condition at all time </td>
    </tr>
    <tr>
   
    <td>4 . Water reservoir should always be kept full up to brim </td>
    </tr>
    <tr>
    
    <td> 5 . The entrance and exit and the water reservoir should always be free from any obstruction/ projection.</td>
    </tr>
    <tr>
    
    <td> 6 . The NOC is liable to be cancelled if the premises (for which the NOC is granted) when inspected are not found conforming to the description and condition under which this NOC is granted and its violation also punishable under Rule 17 & 19 of the Assam Fire Service Rules’ 1989. </td>
    </tr>
  </table>
<br/>
                    <div style="clear:both"></div>
                            

                           
</div>

                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>