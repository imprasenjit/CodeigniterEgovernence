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
		$duration = $formCertRow->duration;
		$station_names = $formCertRow->station_names;
		$call_datetime = $formCertRow->call_datetime;
		$fire_tenders_used = $formCertRow->fire_tenders_used;
		$fire_report_no = $formCertRow->fire_report_no;
		$forwarding_no = $formCertRow->forwarding_no;
		$remarks = $formCertRow->remarks;
	
	 if($formCertRow->penalty_charge == "")
	 {
		$penalty_charge="0.00";
		}
	else
	{
		$penalty_charge=$formCertRow->penalty_charge;
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
	$description = $formRow->description;


	if(!empty($formRow->place_occurrence)){
		$place_occurrence=json_decode($formRow->place_occurrence);
		if(isset($place_occurrence->vt)) 
			$place_occurrence_village= $place_occurrence->vt; 
		else $place_occurrence_village="";
		if(isset($place_occurrence->w)) 
			$place_occurrence_ward= $place_occurrence->w;
		else $place_occurrence_ward="";
		if(isset($place_occurrence->h))
			$place_occurrence_hold= $place_occurrence->h; 
		else $place_occurrence_hold="";
		if(isset($place_occurrence->p)) 
			$place_occurrence_police= $place_occurrence->p; 
		else $place_occurrence_police="";
		if(isset($place_occurrence->d)) 
			$place_occurrence_district= $place_occurrence->d; 
		else $place_occurrence_district="";
	}else{
		$place_occurrence_village="";
		$place_occurrence_ward="";
		$place_occurrence_hold="";
		$place_occurrence_police="";
		$place_occurrence_district="";
	}
	$place_of_occurrence="Village/Town : ".strtoupper($place_occurrence_village). "<br/>Ward No. : ".strtoupper($place_occurrence_ward). "<br/>Holding No : ".strtoupper($place_occurrence_hold). "<br/>Police Station : ".strtoupper($place_occurrence_police). "<br/>District : ".strtoupper($place_occurrence_district);

		if(!empty($formRow->owner_address)){
		$owner_address=json_decode($formRow->owner_address);
		$owner_address_village= $owner_address->vt;
		$owner_address_name= $owner_address->name;
		$owner_address_ward= $owner_address->w;
		$owner_address_hold= $owner_address->h;
		$owner_address_police=$owner_address->p;
		$owner_address_district=$owner_address->d;
	}else{
		$owner_address_village="";
		$owner_address_name= "";
		$owner_address_ward= "";
		$owner_address_hold= "";
		$owner_address_police="";
		$owner_address_district="";
	}
	$owner_address="Village/Town : ".strtoupper($owner_address_village). "<br/>Ward No. : ".strtoupper($owner_address_ward). "<br/>Holding No : ".strtoupper($owner_address_hold). "<br/>Police Station : ".strtoupper($owner_address_police). "<br/>District : ".strtoupper($owner_address_district);
	if(!empty($formRow->occupant_address)){
		$occupant_address=json_decode($formRow->occupant_address);
		$occupant_address_village= $occupant_address->vt;
		$occupant_address_name= $occupant_address->name;
		$occupant_address_ward= $occupant_address->w;
		$occupant_address_hold= $occupant_address->h;
		$occupant_address_police=$occupant_address->p;
		$occupant_address_district=$occupant_address->d;
	}else{
		$occupant_address_village="";
		$occupant_address_name= "";
		$occupant_address_ward= "";
		$occupant_address_hold= "";
		$occupant_address_police="";
		$occupant_address_district="";
	}
	$occupant_address="Village/Town : ".strtoupper($occupant_address_village). "<br/>Ward No. : ".strtoupper($occupant_address_ward). "<br/>Holding No : ".strtoupper($occupant_address_hold). "<br/>Police Station : ".strtoupper($occupant_address_police). "<br/>District : ".strtoupper($occupant_address_district);
	

	


if(!empty($formRow->fire_desc)){
		$fire_desc=json_decode($formRow->fire_desc);
		if(isset($fire_desc->a)) 
			$fire_desc_a=$fire_desc->a; 
		else $fire_desc_a="";
		if(isset($fire_desc->b)) 
			$fire_desc_b= $fire_desc->b; 
		else $fire_desc_b="";
		if(isset($fire_desc->c)) 
			$fire_desc_c= $fire_desc->c; 
		else $fire_desc_c="";
		if(isset($fire_desc->d)) 
			$fire_desc_d= $fire_desc->d; 
		else $fire_desc_d="";
	}else{
		$fire_desc_a="";
		$fire_desc_b="";
		$fire_desc_c="";
		$fire_desc_d="";
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
						
							<br/>
	<table  class="table table-bordered table-responsive" >
		<tr>
			<td><img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /></td>
			<td><p><h3 align="center">GOVT OF ASSAM<br/>OFFICE OF THE DIRECTOR<br/>FIRE & EMERGENCY SERVICES , GUWAHATI ASSAM<br/>************************</h3></p></td>
			<td><img src="<?=base_url('public/imgs/fire.png')?>" class="alomlogoimg" /></td>
		</tr>
	</table>
		<h4 style="text-align:center"><u>FORM - (H)</u></h4>
	<table width="90%">
		<tr>
			<td colspan="2">UBIN : <b><?php echo $ubin; ?></b><span style="float:right">UAIN : <b><?php echo $uain; ?></b></span></td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
			<td valign="top">1. Address of the place of occurrence of the fire incident :</td><td><?php echo $place_of_occurrence; ?></td>
		</tr>
		<tr>
			<td>2. The name(s) of the fire and emergency service station(s) attended :</td><td><?php echo strtoupper($station_names); ?></td>
		</tr>
		<tr>
			<td>3. Date and time of receipt of fire call in the Fire and Emergency :</td><td><?php echo strtoupper($call_datetime); ?></td>
		</tr>
		<tr>
			<td valign="top">4. Brief description of the type of property involved in the fire :</td>
			<td>a. Nature of construction of the building : <?php echo strtoupper($fire_desc_a); ?><br/>
				b. Height of the building : <?php echo strtoupper($fire_desc_b); ?><br/>
				c. Number of Floors : <?php echo strtoupper($fire_desc_c); ?><br/>
				d. Covered Floor Area : <?php echo strtoupper($fire_desc_d); ?><br/>
				e. Description of internal contents : <?php echo strtoupper($description); ?></td>
		</tr>
		<tr>
			<td valign="top">5. Owner&apos;s Details :</td>
			<td>Name : <?php echo strtoupper($owner_address_name); ?><br/>Address :<br/><?php echo $owner_address; ?></td>
		</tr>
		<tr>
			<td  valign="top">6. Occupier&apos;s Details:</td>
			<td>Name : <?php echo strtoupper($occupant_address_name); ?><br/>Address :<br/><?php echo $occupant_address; ?></td>
		</tr>
	
		<tr>
			<td>7. Duration of fire-fighting operation :</td><td><?php echo strtoupper($duration); ?></td>
		<tr>
			<td>8. Number and type of fire tenders / pumps pressed into service to extinguish the fire :</td><td><?php echo strtoupper($fire_tenders_used); ?></td>
		</tr>
		<tr>
			<td>9. Remarks :</td><td><?php echo strtoupper($remarks); ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>		
		<tr>
		  <td>Place of issue : GUWAHATI <br/>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
		  <td align="right"><div style="text-align:center;padding:10px;">
			<p>Director of Fire and Emergency Services,<br/>
			Assam, Guwahati</p></div></td>
		</tr>
		<tr>
			<td>10. Fire report no.:</td><td><?php echo strtoupper($fire_report_no); ?></td>
		</tr>
		<tr>
			<td>11. Commissioner/S.P/S.D.P.O forwarding no. :</td><td><?php echo strtoupper($forwarding_no); ?>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td align="right"><div style="text-align:center;padding:10px;"><p>Fire Prevention Officer</br>Fire and Emergency Services, Assam</p></div></td>
		</tr>

	</table> 
	<div style="clear:both"></div>
	<div style="padding-left:15px;">
		<div style="width:60%;position:relative;float:left">
			<div class="details"></div>
			<p style="margin-top:5px;font-family:sans-serif;font-size:14px;"></p>				
		</div>
		<div style="width:40%;position:relative;float:left;">
           <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
		</div>
	</div>
	<div style="clear:both"></div>

<br/>
<br/>
<br/>


</div>

                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>