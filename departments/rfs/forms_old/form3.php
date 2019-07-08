<?php 
require_once "../includes/login-session.php"; 
$check=$formFunctions->is_already_registered('rfs','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=rfs';
		</script>";	
}


    $sql=$rfs->query("select * from rfs_form1 where user_id='$swr_id' ");	
    $rows=$sql->fetch_array();
	$firm_name=$rows["firm_name"];$form_id=$rows["form_id"];
	$sq=$rfs->query("select * from rfs_form3 where user_id='$swr_id' ");
        $ro=$sq->fetch_array();	
       $date_alteration=$ro["date_alteration"];$present_name=$ro["present_name"];$present_address=$ro["present_address"];	
	   $partner=json_decode($ro['partner'],true);
if(mysqli_num_rows($sql)<1){
		echo "<script>
				alert('FIRST FILLUP FIRM REGISTARTION');
				window.location.href = '".$server_url."departments/rfs/index.php';
		</script>";	
	}  
include("save_form.php");	
$get_file_name=basename(__FILE__);
 $memberCount=mysqli_num_rows($sq);
 $sql1=$rfs->query("select * from t_deptt_f_reg_address where form_id='$form_id' ");
$rows1=$sql1->fetch_array();
$dist_name=$rows1["dist_name"];$mouza=$rows1["mouza"];$circle=$rows1["circle"];$patta_no=$rows1["patta_no"];
$dag_no=$rows1["dag_no"];$area=$rows1["area"];$po_name=$rows1["po_name"];$ps_name=$rows1["ps_name"];
$pincode=$rows1["pin_code"]; $address="Mouza :- ".$mouza." , Circle :- ".$circle." , Patta :- ".$patta_no." , Dag No :- ".$dag_no." , Area :- ".$area." , Post Office :- ".$po_name." , Police Station :- ".$ps_name." , Pincode :- ".$pincode;
?>
<!DOCTYPE html>
<html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Ease of doing business | Govt. of Assam</title>
<!-- Tell the browser to be responsive to screen width -->
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php require '../../../user_area/includes/css.php';?>
          <style>
			/* Over writes AdminLTE form styles */
			p{text-align: justify;}
			.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
			.form-control text-uppercase{
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
				color: #555;
				display: block;
				font-size: 14px;
				height: 34px;
				line-height: 1.42857;
				padding: 6px 12px;
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
				width: 100%;
			}
		</style>
     </head>
      <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
      <div class="wrapper">
  <?php require '../../../user_area/includes/header.php'; ?>
  <?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<section class="content-header"></section>
				<section class="content">
					<?php require '../includes/banner.php'; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 class="text-center" >
										<strong>Form No II<br>
                        Notice for alternation in the name of the Firm or in location of the Principal place of business thereof <br>
                        [(See Section 60(2) and Rules 4(3)]<br>
                        Filling Fee : Rs. 1/-
 </strong>
									</h4>	
								</div>
								<div class="panel-body">

			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							 <table class="table table-responsive">
								<tr>
								<td colspan="2">
								To,<br>
								The Registrar of Firms,Assam<br>
								Housefed Complex, Dispur, Guwahati-06
								</td>
								</tr>
								<tr>
								<td colspan="2">
								<p class="left50px">
									Notice is hereby given, pursuant to Section 60(2) and Rule 4(3) of the Indian Partnership Act,1932, of the following alteration(in the name)
									<input type="text" class="form-control" style="width:170px;" id="firmname" name="firmname" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $firm_name;?>" required/>
									of the
									<input type="text" class="form-control" style="width:170px;" id="principal_place" name="principal_place" value="<?php echo $dist_name;?>" required /> location of the principal place of business.
								</p>
								</td>
								</tr>
								<tr>
								
								</tr>
								</table>
								
								<table  class="table table-responsive">
								<tr>
								<th>Date of alteration</th>
								
								<th style="text-align:center" colspan="2">Name of the Firm</td>
								<th  style="text-align:center"  align="center" colspan="2">Principal Place of Business</td>
								</tr>
								<tr>
								<td></td>
								<td>Former name</td>
								<td>Present name</td>
								<td>Former Address</td>
								<td>Present Address</td>
								</tr>
								<tr>
								<td><input class="dob form-control"  id="alt_date" name="date_alteration" value="<?php if(isset($date_alteration))echo $date_alteration;?>"/></td>
								<td><input type="text" class="form-control"   pattern="[a-zA-Z_/.\s]+$" id="former_name" name="former_name" value="<?php echo strtoupper($firm_name);?>" required/></td>
								<td ><input type="text" class="form-control"   id="present_name" pattern="[a-zA-Z_/.\s]+$" name="present_name"  value="<?php echo strtoupper($present_name);?>" required/></td>
								<td ><textarea  id="former_address" class="form-control"  pattern="[a-zA-Z_/.\s]+$" name="former_address" maxlength="255" required="required"/><?php echo strtoupper($address);?></textarea></br><span>255</span> Characters Allowed</td>
								<td ><textarea  id="present_address"  class="form-control"  pattern="[a-zA-Z_/.\s]+$" name="present_address" maxlength="255" required="required"/><?php echo strtoupper($present_address);?></textarea></br><span>255</span> Characters Allowed</td>

								</tr>
								</table>
								<p></p>
								
								
								<h3 align="center"><u>VERIFICATION</u></h3>
								<p style="text-indent:50px">
								We, the partners of the firm <input type="text" value="<?php $q1="select * from t_deptt_f_reg_partners where form_id=$form_id";$pem=$rfs->query($q1);{while($pem_data=$pem->fetch_assoc()) echo $sunil=$pem_data['partner_name'].' ';  
                                      }?>" />
								do hereby declare that the foregoing statement is true to our knowledge and belief.
								</p>

				   <table id=""  class="table table-responsive">
				       <thead>
						<td>S.NO</td>
						<td>Witness or Witnesses Attesting the Signatures</td>
						  <td>Scanned copy of signatures of the member of  the society <br/>in full</td>
						 
					</thead>
					<tbody>
					
							<?php
				if($memberCount>0){
					$upload1="upload/";
                   
					$moreindex1=count($partner); 
					for($m=1;$m<=count($partner);$m++){					
	                    $p="p$m";
						
						?>
						
						<tr id="<?php echo ($m);?>">
						<td width="5%"><?php echo ($m);?></td>
						<td>
						<input type="hidden" name="" value="<?php  ?>"/>
						<input type="text" validate="specialChar" class="form-control text-uppercase" style="width:170px" name="partner[<?php echo $m; ?>][pname]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pname']; ?>" required/>
						</td>
						<td>
							 <span id="photo50"><div class="cropme" style="width: 70px; height: 30px; display: none;" id="<?php echo "s".$p;?>"><img src="../../../images/ajax-loader.gif" alt="loading"></div>
							 <div class="cropme" style="width: 40px; height: 0px;" id="<?php echo "e".$p;?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('<?php echo $p ?>')">Edit</span>
							</div><span id="<?php echo"v".$p; ?>" style="float: left;"><a href="<?php echo $upload1.$partner[$m]['photo'];?>" target="_blank" ><i class="fa fa-file-text" aria-hidden="true"></i> View</a></span>
						      </span>
							<input type="hidden" id="<?php echo "f".$p;?>" name="partner[<?php echo $m;?>][photo]" value="<?php echo $partner[$m]['photo'];?>">
						</td>
						
						
						
					</tr>
						
				<?php
					
					}
				}else{ 
                  $moreindex1=1;
						
				echo ""
				?>
					<tr>
						<td width="5%">1</td>
						<td>
						
						<input type="text" class="form-control text-uppercase" style="width:170px;" name="partner[1][pname]" pattern="[a-zA-Z_/.\s]+$" required/>
						</td>
						<td><span id="photo50"><div class="cropme" style="width: 70px; height: 30px;" id="sp1" >
									  <input type="button" onclick="crop_test('p1')"  name="upload1" id="test"  class="btn btn-primary"  value="upload"  />
						
									  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep1" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p1')">Edit</span>
									  
									  </div>
									  <span id="vp1" style="float: left;" ></span>
									  <input type="hidden"  id="fp1"  required="required" name="partner[1][photo]" />
						            	</span>
							
						</td>
						
						</tr>
						
				<?php  } ?>
				 <?php ?>
				         <tr id="sunil1" colspan="6">&nbsp;</tr>
					</tbody>
				</table>	
				<table>
					<tr>
						<td><a class="memberBtn" jsTag="more1">Add More</a></td>
						
						<td>
						<input id="indexval" type="hidden" name="indexval" value="<?php echo $moreindex1; ?>">
						&nbsp;&nbsp;<td style="display:none;" id="del"><a   class="memberBtn"  jsTag="last">Delete</a></td>
                    </tr>
									
					</table>
            
            
            <p style="text-align:center">
               <button type="submit" style="font-weight:bold" name="save3" class="btn btn-primary">Save </button>
                <button type="submit" class="btn btn-success" name="submit3" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
            </p>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

  <!-- /.content-wrapper -->
  
 <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>
<?php require 'rfs_js.php'; ?>

<link rel="stylesheet" type="text/css" href="../crop_image/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/style-example.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/jquery.Jcrop.css" />

    <!-- Js files-->
    <script type="text/javascript" src="../crop_image/scripts/jquery-1.10.2.11min.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.SimpleCropper.js"></script>
      </body>
	  
</html>