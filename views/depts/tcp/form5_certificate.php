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

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$total_fees = $formCertRow->total_fees;
	
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		
		$lic_exp_year = $formCertRow->lic_exp_year;
		
        $sub_date = $formCertRow->sub_date;
		//$receive_dt = $formCertRow->receive_dt;
		
	   
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
						<!--copied from tcp_form5_certificate.php-->
						 <div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">		
			
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok">
                            <br/>
		 <h2 class="text-uppercase" align="center"><?=$this->dept_name?></h2>
		<h4><b>See rule 19(2)</b></h4>
		<h4><b>Building Permit</b></h4>
		<br/>
		<h4><b></b></h4>
		<br/>
		<table width="100%">
			<tr>
				<td>NO:</td>
			</tr>	
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
				
			</tr>
			<tr>
				<td></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
			</tr>
		</table>
		<br/>
		
		<table width="100%">
				<tr>
					<td>To, </br>
					<?php echo $companyName;?>
					</td>
				</tr>
				
				<tr>
				<td>
					SUB: <strong>NO OBJECTION CERTIFICATE FOR CONSTRUCTION </strong>
				</td>
				</tr>
				
				<tr>
				<td>
					REF : Your application dated <?php echo date("d-m-Y",strtotime($sub_date)); ?>
				</td>
				</tr>
			
		</table>
	</br>
		
		<p align="justify">Sir/Madam, </br>
		With reference to your above application for PROGRESS CERTIFICATE - LAST STOREY at <?=strtoupper($address);?> is hereby accorded and you are required  to comply with the conditions mentioned overleaf in accordance with plan submitted with / without modification.</p>
		<br/>
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($sub_date)); ?></td>
				<td align="right">Your’s faithfully, </br>Chairman </br> MB/TC</td>
			</tr> 
			
		</table>
		<br/><br/>
		
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<?php if($total_fees!=""){?>
			<div style="width:70%;position:relative;float:left;text-align:left">
				<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details_y1." - ".substr( $arrear_fees_details_y2, -2 );?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
			</div>
			<?php }else{?>	
			<div style="width:70%;position:relative;float:left;text-align:left">
				<p>&nbsp;</p>
			</div>
			<?php }?>
			<div style="width:30%;position:relative;float:left;">
				<img src="<?=base_url('storage/temps/qrcode.png')?>?d=<?php echo $uain; ?>" style="width: 120px; height: 120px"/>
			</div>
		</div>
		
	<div class="row">
		
		<h4><b>NOTICE </b></h4>
		<p align="justify">
		1. This Permit shall remain valid up to two years only from the date of issue of the permit.
		</p>
		
		<p align="justify">
		2. The Permit is not transferable.
		</p>
		
		<p align="justify">
		3. The owner upon commencement of his work under a no-objection certificate shall give
		Notice to MB/TC that he has started his work and Authority shall cause inspection of the 
		work to be made within 14 days following receipt of notice to verify that the building has   
		been erected in accordance with the sanctioned plans.
		</p>
		
		<p align="justify">
		4. Shall the MB/TC determine at any stage that the layout or the construction is not proceeding according to the sanctioned plan or is in violation of any provision of the Act, it shall serve a notice on the applicant requiring him to stay further execution until correction has been made in accordance with the approved plan.
		</p>
		
		<p align="justify">

		5. If the Permit holder fails to comply with the requirements at any stage of construction the MB/TC is empowered to cancel the building permit issued.
		</p>

		<p align="justify">
		6. Every person who erects or re-erects any building shall within one month of the completion of the work deliver to the MB/TC a notice in writing of such completion and shall give him all necessary facilities for the inspection of such works as provided in the Building Bye-laws.
		</p>
		
		<p align="justify">
		7. Whenever asked by the MB/TC or his subordinates, the Permit holder shall produce the Permit along with the copy of the approved plan of verification.
		</p>
		
		<p align="justify">
		8. In the event of reclamation of the plot for construction of building/boundary wall the reclamation level shall not exceed the level of the nearest P.W.D. or MB/TC Road. For preparation of hilly land for construction, retaining wall has to be constructed on the excavated earth and spoils shall be adequately guarded to prevent erosion.
		</p>
		</div>
		
		<div class="row">
		
		<h4><b>Conditions </b></h4>
		<p align="justify">
		1. "M/S ......" along with the builder shall be held responsible for any kind of structural failure of the building.
		</p>
		
		<p align="justify">
		2. N.O.C. from Director of FIRE Service is to be obtained for the building.
		</p>
		
		<p align="justify">
		3. Necessary fire fighting facilities are to be provided in and around the building.
		</p>
		
		<p align="justify">
		4. The Road side drain along with the Road is to be constructed at the cost of the builder connecting main outlet of the area.
		</p>
		
		<p align="justify">

		5. Before installation of Deep Tube Well, N.O.C. from Central Ground Water Board is to be obtained.
		</p>

		<p align="justify">
		6. "CHUTES" are to be provided inside the building for garbage disposal.
		</p>
		
		<p align="justify">
		7. At leat 2 nos. of DUST BIN are to be placed near the plot at the cost of the builder.
		</p>
		
		<p align="justify">
		8. Planning of minimum 10 nos. of evergreen trees inside the plot on the date of commencement of construction and be maintained.
		</p>
		
		<p align="justify">
		9. The owner through the licensed architect, engineer, as the case may be (RTP) who has supervised the construction, shall give notice to the Authority regarding completion of work and obtain &ldquo;Occupancy Certificate&rdquo; before occupying the building. </br>
		For building above seven storeyed, Party shall submit detail structural design for proof checking by SDRP at least one month prior to commencement of construction.
		</p>
		</div>
	</div>
	</center>
</div>
	<!--copied-->
                         
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
