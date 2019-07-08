<?php
$per_page=10;
$page = (int)(isset($_GET["page"]) ? $_GET["page"] : 1);
$start_from = ($page-1) * $per_page;

require_once "includes/login_session.php";   
if(isset($sid) && isset($swr_id)) {
    $user_id=$sid;
    $applications_results=$mysqli->query("SELECT * FROM incomplete_forms WHERE swr_id='$swr_id' ORDER BY date DESC LIMIT $start_from, $per_page") or die("Error : ".$mysqli->query);
    $paginationQuery = $mysqli->query("SELECT * FROM incomplete_forms WHERE swr_id='$swr_id' ORDER BY date DESC") or die("Error :".$mysqli->error);
    if($applications_results->num_rows==0) $msg="<b style='color:red'>"."No Records Found !!!"."</b>";
}	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ease of doing business | Govt. of Assam</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php require 'includes/css.php';?>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">

	  <?php require 'includes/header.php'; ?>
	  <?php require 'includes/aside.php'; ?>

	  
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
				Incomplete Applications
					<small><?php echo $paginationQuery->num_rows;?> New Applications</small>
				</h1>
			</section>
			<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<table class="table table-bordered table-responsive">
							<thead>
							<tr>
								<th>#</th>
								<th>UAIN</th>
								<th>Department Name</th>
								<th>Form Name</th>
								<th style="width:145px">Operation</th>
							</tr>
							</thead>
							 <tbody><?php
                    if(isset($msg)) { ?>
                    <tr>
                        <td colspan="6"  style="text-align: center"><?php echo $msg ?></td>
                    </tr>
                    <?php } else { 
                    $sl=$page*$per_page-$per_page+1;						
                    while($rows=$applications_results->fetch_object()){ 
						$dept=$rows->dept_name;$form_no=$rows->form_no;
						$dept_name=$formFunctions->get_deptName($dept);
						$form_name=$formFunctions->get_formName($dept,$form_no);												
												
						$table=$formFunctions->getTableName($dept,$form_no);
						$query="select uain from ".$table." where user_id='$swr_id' and save_mode!='C'" or die("Error : ".$mysqli->error);
						$results=$formFunctions->executeQuery($dept,$query);
                                                if($results->num_rows == 0) $uain="UAIN not generated yet";
                                                else $uain=$results->fetch_object()->uain;
						if($dept=="pcb"){
							if($form_no<3){
								$link_redirect="../departments/".$dept."/forms/form".$form_no;
							}else{
								$link_redirect="../departments/".$dept."/forms/".$table;
							}							
						}else{
							$link_redirect="../departments/".$dept."/forms/".$table;
						}
						
						
					?>
                    <tr>
                        <td style="width:3%;text-align: center"><?php echo sprintf("%02d",$sl); ?></td>
                        <td style="width:15%"><?php echo $uain; ?></td>
                        <td style="width:15%"><?php echo $dept_name; ?></td>                        
                        <td style="width:57%"><?php echo $form_name; ?></td>
                        <td style="width:10%"><a href="<?php echo $link_redirect; ?>.php" id="viewBtn" class="btn btn-success btn-md btn-inline">Fill and Complete</a></td>
                    </tr>
						<?php 	$sl++; 
						}
					}	//End of else Statement ?>
        <tr> <!-- Star of Pagination -->
            <td colspan="5" style="text-align: center;">
                <?php require_once "../admin/includes/pagination.php"; ?>
            </td>
        </tr> <!-- End of Pagination -->
                </tbody>
				</table>
				</div>
				</div>
			</div>
			</section>
		</div>
	  
	  <?php require 'includes/footer.php'; ?>
	</div>
<?php require 'includes/js.php' ?>
	<script>
	function inputOnModalTrigger(){
		$('#query_id').val($('#token1').val());
	}
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover({html:true})
	});
</script>
</body>
</html>

