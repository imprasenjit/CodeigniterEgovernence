<?php 
 require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('rfs','5');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=rfs';
		</script>";	
}


 $sql=$rfs->query("select * from rfs_form1 where user_id='$swr_id' ");	
    $rows=$sql->fetch_array();
	$firm_name=$rows["firm_name"];$form_id=$rows["form_id"];
	$sq=$rfs->query("select * from rfs_form5 where user_id='$swr_id' ");
        $ro=$sq->fetch_array();	
       $reg_no=$ro["reg_no"];
	   $partner=json_decode($ro['partner'],true);
	    $partner_address=json_decode($ro['partner_address'],true);
if(mysqli_num_rows($sql)<0){
		echo "<script>
				alert('FIRST FILLUP FIRM REGISTARTION');
				window.location.href = '".$server_url."departments/rfs/index.php';
		</script>";	
	}  
include("save_form1.php");	
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
                        <strong> Form No IV<br>
                        NOTICE OF CHANGES IN THE NAMES AND ADDRESS OF THE PARTNERS OF THE FIRM<br>
                        [See Section 62 and Rules 4(5)]<br>
                        Filling Fee Rs. 1/-</strong>
                    </h4>	
								</div>
								<div class="panel-body">

			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							 <table class="table table-responsive">
								<tr>
								<td colspan="2">
                        To,<br>
                        The Registrar of Firms,Assam<br>
                        Housefed Complex, Dispur, Guwahati-6
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>
                            Notice is hereby given, pursuant to section 61 and Rule 4(5) of the Indian Partnership Act,1932 of Changes in Names and Address of the partners of the firm M/S
                            <input type="text" style="width:150px;" class="form-control" id="firm_name" name="firm_name" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $firm_name?>" required />
                            Regn. No.
                            <input type="text" style="width:150px;" class="form-control text-uppercase" id="reg_no" name="reg_no" pattern="[a-zA-Z0-9]{1,}" value="<?php echo $reg_no;?>" required/>
                        </p>
                    </td>
                </tr>
                
            </table>
			 <table   class="table table-responsive">
				       <thead>
					<th>Serial.no</th>
                    <th>Former Name and Address</th>
                    <th>Present Name and Address</th>
                    <th>Remarks</th>
						 
					</thead>
					<tbody>
					
							<?php
				if($memberCount>0){
					
                   
					$moreindexvalex=count($partner_address); 
					for($m=1;$m<=count($partner_address);$m++){					
	                    $p="p$m";
						
						?>
						
						<tr id="<?php echo "a".($m);?>">
						<td><?php echo ($m); ?></td>
						<td>
						<input type="text" validate="specialChar" class="form-control text-uppercase"name="partner_address[<?php echo $m; ?>][former_name]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner_address[$m]['former_name']; ?>" required/>
						</td>
                       <td>
						<input type="text" validate="specialChar" class="form-control text-uppercase" name="partner_address[<?php echo $m; ?>][present_name]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner_address[$m]['present_name']; ?>" required/>
						</td>	
                         <td>
						<input type="text" validate="specialChar" class="form-control text-uppercase"name="partner_address[<?php echo $m; ?>][remark]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner_address[$m]['remark']; ?>" required/>
						</td>							
					</tr>
						
				<?php
					
					}
				}else{ 
                  $moreindexvalex=1;
						
				echo ""
				?>
					<tr><td>1</td>
                    <td><input type="text"  pattern="[a-zA-Z_/.\s]+$" name="partner_address[1][former_name]" class="form-control text-uppercase" required/></td>
                    <td><input type="text" pattern="[a-zA-Z_/.\s]+$" name="partner_address[1][present_name]" class="form-control text-uppercase" required/></td>
                    <td><input type="text"  class="form-control text-uppercase" name="partner_address[1][remark]" required/></td>
                </tr>
              
                  
  
                   
						
				<?php  } ?>
								         <tr id="ravi1" colspan="6">&nbsp;</tr>
					</tbody>
				</table>
				 <table><tr>
						<td><a class="memberBtn" jsTag="addmore">ADD MORE</a>&nbsp;&nbsp;
						<input id="index" type="hidden" name="hidden" value="<?php echo $moreindexvalex; ?>"/>
						&nbsp;&nbsp;<td style="display:none;" id="delete"><a   class="memberBtn"  jsTag="deletelast">DELETE</a></td>
                    </tr>
					</table>
					
          
            <table id=""  class="table table-responsive">
				       <thead>
						<th>S.NO</th>
						<th>Witness or Witnesses Attesting the Signatures</th>
						  <th>Scanned copy of signatures of the member of  the society <br/>in full</th>
						 
					</thead>
					<tbody>
					
							<?php
				if($memberCount>0){
					$upload1="upload/";
                   
					$moreindexvalex1=count($partner); 
					for($m=1;$m<=count($partner);$m++){					
	                    $p="p$m";
						
						?>
						
						<tr id="<?php echo ($m);?>">
						<td width="5%"><?php echo ($m); ?></td>
						<td>
						<input type="hidden" name="" value="<?php  ?>"/>
						<input type="text" validate="specialChar" style="width:170px;" class="form-control text-uppercase"name="partner[<?php echo $m; ?>][pname]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pname']; ?>" required/>
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
                  $moreindexvalex1=1;
						
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
						<td><a class="memberBtn" jsTag="more1">ADD MORE</a></td>
						
						<td>
						<input id="indexval" type="hidden" name="indexval" value="<?php echo $moreindexvalex1; ?>"/>
						&nbsp;&nbsp;<td style="display:none;" id="del"><a   class="memberBtn"  jsTag="last">DELETE</a></td>
                    </tr>
									
					</table>
            <p style="text-align:center">
                   <button type="submit" style="font-weight:bold" name="save5" class="btn btn-primary">Save </button>
               <button type="submit" class="btn btn-success" name="submit5" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
                </p>
        </form>
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