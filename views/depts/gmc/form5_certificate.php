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
    $gmc_zone=$b_block=$cafRow->block;
	$business_type = $cafRow->pan_name;
	$status_applicant=$cafRow->status_applicant;
	//$trade_name=$unit_name=$cafRow->unit_name;
	$l_o_business = $cafRow->Type_of_ownership;
	
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params);
}
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$lic_exp_year = $formCertRow->lic_exp_year;
	$sub_date = $formCertRow->sub_date;
	$reg_no = $formCertRow->reg_no;
	$file_auth_num = $formCertRow->file_auth_num;
	$total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
    $licence_type = $formCertRow->licence_type;
    
   
    if($formCertRow->penalty_charge == ""){
		$penalty_charge="0.00";
	}else{
		$penalty_charge=$formCertRow->penalty_charge;
	}
    
	if($arrear_fees_details!=""){
		$arrear_fees_details=json_decode($arrear_fees_details);
		$arrear_fees_details_y1=$arrear_fees_details->y1; 
		$arrear_fees_details_y2=$arrear_fees_details->y2;
		if(isset($arrear_fees_details->fees) && !empty($arrear_fees_details->fees))  $arrear_fees_details_fees=$arrear_fees_details->fees; else $arrear_fees_details_fees=0;
	}else{
		$arrear_fees_details=0;
		$arrear_fees_details_y1=0;
		$arrear_fees_details_y2=0;
		$arrear_fees_details_fees=0;
	}
    
} else {
	 $sub_date= $reg_no= $file_auth_num= $licence_type= $total_fees= $lic_exp_year= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if ($formCertRow) {
    $issue_date = $formCertRow->p_date;
} else {
    $issue_date = "Not Found!";
}
$formCertRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	
				if(!empty($formCertRow->old_trade_details)){
					$old_trade_details=json_decode($formCertRow->old_trade_details);
					
					$old_trade_details_a=$old_trade_details->a;$old_trade_details_b=$old_trade_details->b;$old_trade_details_c=$old_trade_details->c;
				}else{
					$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
				}
	}

//End of if ?>
<!DOCTYPE html>
<html lang="bn">
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
                            <div class="holder">
                                <div id="water_mark">
                                    <div class="border">
                                        <center>
                                        <img style="height:100px; width:100px;" src="<?=base_url('public/imgs/assam.png')?>"/> <br/>
                                    </center>
                                        <center>    
                                            <br/>
                                            <table class="table table-responsive table-bordered">
                                                <tr>							
                                                    <td width="25%"><span class="font1" style="padding-left:60px">পঞ্জীয়ন নং  : <br/>&nbsp;&nbsp;Registration No :</span></td>
                                                    <td width="25%" valign="bottom" align="left"><span class="font1"><?=$reg_no?></span></td>
                                                    <td width="20%"><span class="font1" style="padding-left:30px">মাচুল : :<br/>Fees :</span></td>
                                                    <td valign="bottom" style="text-align:left"><span class="font1">Rs. <?php echo strtoupper($total_fees); ?>.00</span></td>							
                                                </tr>
                                                <tr>
                                                    <td width="25%"><span class="font1" style="padding-left:80px">UAIN :</span></td>
                                                    <td valign="bottom" style="text-align:left"><span class="font1"><?=$uain?></span></td>
                                                    <td width="20%"><span class="font1">Ward No :</span></td>
                                                    <td valign="bottom" align="left"><span class="font1"><?php  echo strtoupper($gmc_zone);?></span></span></td>		
                                                </tr>
                                                <tr>							
                                                    <td><span class="font1" style="padding-left:80px"> UBIN :</span></td>
                                                    <td style="text-align:left"><span class="font1"><?=$ubin?></span></td>
                                                   <td width="20%"><span class="font1">Old Trade License No :</span></td>
													 <td valign="bottom" align="left"><span class="font1"><?php  echo strtoupper($old_trade_details_a);?></span></td>
                                                </tr>
                                            </table>                  
                                            <p style="margin-top:30px; line-height:180%;text-align:center;"><span style="font-size:2em;font-weight:700;padding-bottom:50px">অনুজ্ঞাপত্ৰ  <br/></span><span style="font-size:2em;font-weight:700;"><?=$companyOwner?></span><br/>
                                                <b style="font-family:sans-serif;font-size:1.2em;">(<?php echo strtoupper($licence_type); ?>)</b>
                                            </p> 
                                            <p style="padding-left:3%;padding-right:3%;margin-top:30px;text-align:center;font-size:1em;"><span style="font-size:1.2em;"> গুৱাহাটী পৌৰ নিগমৰ অধীনৰ </span><?php echo strtoupper($address); ?><span style="font-size:1.2em;">  ত অৱস্থিত </span><?= $business_type; ?><span style="font-size:1.2em;"> প্ৰতিষ্ঠান &nbsp;</span><?php echo strtoupper($companyName);?>&nbsp;<span style="font-size:1.2em;">  ৰ স্বত্তাধীকাৰ / পৰিচালক </span><?php echo strtoupper($companyOwner); ?><span style="font-size:1.2em;">ক এই কোম্পানী / ফাৰ্ম ব্যবসায় চলাবলৈ এই অনুজ্ঞাপত্ৰ প্রদান কৰা হ'ল।</span>
                                                <br/><span style="font-size:1.2em;">অনুজ্ঞাপত্ৰ  ৩১ মাৰ্চ , <?php echo $lic_exp_year; ?></span> <span style="font-size:1.2em;">  ইং তাৰিখলৈকে  বাহাল থাকিব।    </span>
                                            </p>  


                                            <p style="margin-top:20px;text-align:center;padding-left:3%;padding-right:3%;font-family:sans-serif;font-size:13pt;">
                                                 This license is being issued to <?= $key_person; ?> of <?= $l_o_business; ?> for carrying out the business of <?= $business_type; ?> , situated at <?php echo strtoupper($address); ?><br/>
                                                This license will be valid till 31st March of <?php echo strtoupper($lic_exp_year); ?>
                                            </p>
                                        </center>
                                        <table align="center" style="margin-top:60px;width:99%;font-family:sanserif;">
                                             <tr>
                                                <td style="width:50%;padding-left:40px;">গুৱাহাটী <br/> Guwahati<br/>তাৰিখ  :&nbsp;<br/> Date : <?= date("d-m-Y", strtotime($issue_date)) ?></td>
                                                <td style="width:50%;padding-right:40px;text-align:right;"><?php echo strtoupper($companyOwner) ?><br/><br/>অনুমোদিত স্বাক্ষৰকাৰী<br/>Authorized Signatory</td>
                                            </tr>                     
                                        </table>
                                        <br/>
                                        <div class="row" style="padding-left:15px;">
                                            <div style="width:70%;position:relative;float:left">
                                                <div class="details">Details of Fees Paid</div>
                                                <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
                                                <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?= $arrear_fees_details_y1; ?> to <?= $arrear_fees_details_y2; ?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>
                                                <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
                                            </div>
                                            <div style="width:30%;position:relative;float:left;">
                                                <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                            </div>
                                        </div>
                                        <br/><br/>


                                    </div>
                                </div>
                            </div>
                            <div class="holder">
                                <div class="border">
                                    <!--<img src="<?=base_url('departments/gmc/images/header.jpg')?>" style="width:100%"/> -->  
                                    <br/>
                                    <br/>
                                   <div class="h3" style="text-align:center">অনুজ্ঞাপত্ৰৰ চৰ্তাৱলী আৰু বাধ্যবাধকতা</div>

                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <td width="5%">১ |</td>
                                            <td>ব্যক্তি আৰু স্থানৰ  ক্ষে্ত্ৰ্ত এই অনুজ্ঞাপত্ৰ  স্থানান্তৰ নহ'ব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top"> ২ |</td>
                                            <td>অনুজ্ঞাপত্ৰখন ব্যৱসায় কৰা চৌহদৰ ভিতৰত সহজে চকুত পৰা ঠাইত আৰি ৰখাটো  বাধ্যতামুলক , অন্যথাই জৰিমনা ভৰিব লাগিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">৩ |</td>
                                            <td>অনুজ্ঞাপত্ৰৰ ম্যাদ এবছৰীয়া আৰু বিত্ত বছৰ বাহাল থাকিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">৪ |</td>
                                            <td> প্ৰ্তি বছৰৰ ৩১ মাৰ্চৰ ভিতৰত নবীকৰণ লাগিব, অন্যথা  জৰিমনাসহ   নবীকৰণ কৰিব লাগিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" >৫ |</td>
                                            <td>ব্যৱয়াসিক প্ৰতিষ্ঠানৰ নামফলক অসমীয়া  ভাষাত লিখাটো বাধ্যতামুলক । লগতে প্ৰয়োজন সাপেক্ষে  অন্যান্য ভাষাও ব্যৱহাৰ কৰিব পাৰিব |

                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">৬ |</td>
                                            <td>ব্যৱসায় কৰা চৌহদৰ  সন্মুখৰ ৰাস্তা / পদপথত কোনো ধৰণৰ সামগ্ৰী বিত্ৰূীৰ  বাবে  ৰাখিব নোৱাৰিব । তেনে কাৰ্য্য দৃষ্টিগোচৰ হ'লে জৰিমনা ভৰিব  লাগিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">৭ |</td>
                                            <td>ব্যৱসায় কৰা চৌহদৰ সন্মুখৰ পদপথত বা পথত কোনো ব্যৱসায়ীকে সামগ্ৰী জমা কৰি ব্যৱসায় কৰিবলৈ দিব নোৱাৰিব তেনে কাৰ্য্য দৃষ্টিগোচৰ হ 'লে মূল  দোকানৰ ব্যৱসায়ী তখা পদপথৰ ব্যৱসায়ী উভয়ে সমানে দায়ী হ 'ব । উক্ত কাৰ্য্যত লিপ্ত দুয়োজনক জৰিমনা বিহা হ 'ব আৰু  মূল ব্যৱসায়ীৰ অনুজ্ঞাপত্ৰ বাতিল কৰা হ 'ব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">৮ |</td>
                                            <td>ব্যৱসায় কৰা চৌহদ  আৰু সন্মুখৰ  পদপথত জাৱৰ-জোথৰ জমা কৰি ৰাখিব নোৱাৰিব আৰু সকলো পৰিস্কাৰ কৰিব লাগিব | অন্যথা  জৰিমনা ভৰিব লাগিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">৯ |</td>
                                            <td>ব্যৱসায় কৰা  চৌহদৰ উপযুক্ত স্থানত একোটাকৈ " ডাষ্টবিন" ৰখাটো বাধ্যতামুলক | উক্ত " ডাষ্টবিন" সকলো গ্ৰাহকক ব্যৱহাৰ কৰিবৰ বাবে আহবান জনাই চকুত লগাকৈ জাননী এখন লগাই ৰাখিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">১০ |</td>
                                            <td>ব্যৱসায়  কৰা চৌহদৰ উপযুক্ত স্থানত " অগ্নি নিৰ্বাপক "   সৰঞ্জাম ৰখাটো বাঞ্চনীয় |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">১১ |</td>
                                            <td>ব্যৱসায়  কৰা চৌহদৰ জাৱৰ-জোথৰসমুহ সন্ধ্যা ৭.০০ বজাৰ পিচত নতুবা ৰাতিপুৱা  ৭.০০ বজাৰ আগতে পৌৰ নিগমে স্থাপন কৰা ডাষ্টবিনত পেলোৱাতো বাধ্যতামুলক নাইবা পৌৰ নিগমৰ দ্বাৰা নিযুক্ত এন. জি . অৰ. যোগোদি  মূল্যৰ বিনিময়ত  জাৱৰ-নিষ্কাষণ ব্যৱস্থা কৰিব লাগিব অন্যথা  জৰিমনা ভৰিব লাগিব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">১২ |</td>
                                            <td>ব্যৱসায়   চৌহদৰ অনুমতিবিহীন / সংগতিবিহীন কোনো  
                                                বিজ্ঞাপন আদি আঁৰিব নোৱাৰিব । তেনে  কাৰ্য্য দৃষ্টি গোচৰ হ'লে জৰিমনা বিহা হ 'ব আৰু অনুজ্ঞাপত্ৰ বাতিল কৰা হ 'ব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">১৩ |</td>
                                            <td>পদপথত নাইবা  ৰাস্তাত পুৱা ৬.০০ বজাৰ পৰা  সন্ধ্যা ৬.০০ বজালৈ কোনো ধৰণৰ " লোডিং" বা " আনলোডিং" নিষেধ,অন্যথা জৰিমনা ভৰিব লাগিব |</td>
                                        </tr><tr>
                                            <td valign="top">১৪ |</td>
                                            <td>বিশেযধৰণৰ ব্যৱসায়ৰ ক্ষেএত বিভিন্ন বিভাগৰ নিয়মসমুহ মানিব লাগিব |</td>
                                        </tr><tr>
                                            <td valign="top">১৫ |</td>
                                            <td> সময়ে সময়ে পৌৰ নিগমে  বান্ধি দিয়া বিধিসমূহ পালন কৰিবলৈ বাধ্য থাকিব |</td>
                                        </tr><tr>
                                            <td valign="top">১৬ |</td>
                                            <td>অনুজ্ঞাপত্ৰত উল্লেখ কৰা  ব্যৱসায়ৰ বাহিৰে অন্য কোনো ব্যৱসায় কৰিব  নোৱাৰিব | এনে কাৰ্য্য দৃষ্টিগোচৰ হ 'লে অনুজ্ঞাপত্ৰ বাতিল কৰা  হ 'ব আৰু ব্যৱসায় বন্ধ কৰি দিয়া হ 'ব |</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">১৭ |</td>
                                            <td> পৌৰ নিগমে উপৰত উল্লেখ কৰা নিয়মসমুহ  বা  চৰ্তাৱলী ভঙ্গ কৰিলে গুৱাহাটী পৌৰ নিগম আইন ১৯৭১ চনৰ অধীনত যিকোনো সময়ত যিকোনো কাৰণত এই অনুজ্ঞাপত্ৰ ৰদ , নাকচ বা প্ৰ্ত্যাহাৰ কৰা হ 'ব | </td>
                                        </tr>

                                    </table> 
                                </div>
                            </div>                            
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>