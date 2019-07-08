<?php	
$dept="society";
$form="2";
$table_name=getTableName($dept,$form);	
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");		
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
}

	
if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$operation_area=$results['operation_area'];$s_obj=$results['s_obj'];$language=$results['language'];$admn_fee=$results['admn_fee'];$share_value=$results['share_value'];
}
	
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
	<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
		<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
    <div style="text-align:center">
       '.$assamSarkarLogo.' <h4>'.$form_name.'</h4>
    </div><br/> 
    <table class="table table-bordered table-responsive">
		<tr>
			<td width="60%">1. Name of the proposed society :</td>
			<td width="40%">'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td colspan="2"> 2. The registered address of the proposed society : </td>

		</tr>
		<tr>
			<td>a) House No./ Bye lane :</td>
			<td>'.strtoupper($b_street_name1).'</td>
		</tr>
		<tr>
			<td>b) Locality :</td>
			<td>'.strtoupper($b_street_name2).'</td>
		</tr>
		<tr>
			<td>c) Post office :</td>
			<td>'.strtoupper($s_po).'</td>
		</tr>
		<tr>
			<td>d)P.S :</td>
			<td>'.strtoupper($s_ps).'</td>
		</tr>
		<tr>
			<td>e) Vill/ Town :</td>
			<td>'.strtoupper($b_vill).'</td>
		</tr>
		<tr>
			<td>f) Mouza :</td>
			<td>'.strtoupper($mouza).'</td>
		</tr>
		<tr>
			<td>g) Circle :</td>
			<td>'.strtoupper($circle).'</td>
		</tr>
		<tr>
			<td>h) Contituency :</td>
			<td>'.strtoupper($s_con).'</td>
		</tr>
		<tr>
			<td>i) Sub-division :</td>
			<td>'.strtoupper($block).'</td>
		</tr>
		<tr>
			<td>j) District :</td>
			<td>'.strtoupper($b_dist).'</td>
		</tr>
		<tr>
			<td>3. Area of operation of the society :</td>
			<td>'.strtoupper($operation_area).'</td>
		</tr>
		<tr>
			<td>4. Objective of the society :</td>
			<td>'.strtoupper($s_obj).'</td>
		</tr>
		<tr>
			<td>5. Language in which the books & records will be maintained :</td>
			<td>'.strtoupper($language).'</td>
		</tr>
		<tr>
			<td>6.(i) Each member shall pay an admission fee of Rs.:</td>
			<td>'.strtoupper($admn_fee).'</td>
		</tr>
		<tr>
			<td>(ii) Authorised Share Capital (in Rs.) :</td>
			<td>'.strtoupper($share_value).'</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
				<tr>
					<td>Sl No.</td>
					<td>Name</td>
					<td>Father&#39;s/Husband&#39;s name</td>
					<td >Age</td>
					<td>Postal address</td>
					<td>Occupation</td>
					<td>Equity partipation</td>
					<td>Signature</td>
				</tr>
				</thead>
				<tbody>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){						
						if($rows->upload_signature !="") $upload_signature='<img style="padding:5px" width="200" height="60" src="'.$server_url.'departments/society/forms/upload/'.$rows->upload_signature .'"/>';
						else $upload_signature="";
						
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->member_name).'</td>
							<td>'.strtoupper($rows->member_fname).'</td>
							<td>'.strtoupper($rows->member_age).'</td>
							<td>'.strtoupper($rows->member_address).'</td>
							<td>'.strtoupper($rows->member_occupation).'</td>
							<td>'.strtoupper($rows->member_partition).'</td>
							<td>'.$upload_signature .'</td>
						</tr>';
						$sl++;
					}				
					$printContents=$printContents.'
				</tbody>
			</table>
			</td>
		</tr>
		';
		
	    $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
		<tr>
			<td colspan="2">
				<h3 style="text-align:center">
					<u>SCHEDULE-A <br/>ASSAM COOPERATIVE SOCIETIES ACT, 2007 (ACT-IV OF 2012)</u>
				</h3>
				<br/>
				<br/>
				<h5 align="center"><u>COOPERATIVE PRINCIPLES</u></h5>
				<p>The cooperative principles are guidelines by which cooperative societies put their values into practice.</p>
				<p>1<sup>st</sup> Principle: <u>Voluntary and open membership:</u><br/>
					Cooperative societies are voluntary organization, open to all person able to use their service and willing to accept the responsibilitys of membership, without gender, social, racial, political or religious discrimination.</p>
				<p>2<sup>nd</sup> Principle: <u>Democratic member control:</u><br/>	
					Cooperative societies are democratic organization controlled by their members, to actively participate in setting their policies and making decisions. Men and women serving as elected representative are accountable to the members. In primary cooperative, members have equal voting rights. (one member, one vote) and cooperative society at other levels are also organized in a democratic manner.

				<p>3<sup>rd</sup> Principle: <u>Members&#39; economic participation:</u><br/>

					Members contribute equitably to and democratically control, the capital of their cooperative societies. At least part of that capital is usually the common property of the cooperative. Members usually receive limited compensation, if any, on capital subcribed as a condition of membership. Members allocate surpluses for any or all of the following purposes: developing their cooperative societies, possibly by setting up reserves, part of which at least would be invisible, benefitting members in proportion to their transaction with the cooperative society, and supporting other activities approved by the members.

				<p>4<sup>th</sup>Principle:<u> Autonomy and independence:</u><br/>

					Cooperative societies are autonomus, self help organization controlled by their members, If they enter into agreements with other organizations, including goverments, or raise capital from external sources, they do so on terms that ensure democratic control by their members and maintain their cooperative autonomy.

				<<p>5<sup>th</sup>Principle: <u>Education, Training and Information:</u><br/>

					Cooperative societies provide education and training for their members, elected representatives, managers, and employees so that they can contribute effectively to the developments of their cooperative societies. They inform the general public particularly young people and opinion leaders-about the nature and benefits of cooperation.

				<p>6<sup>th</sup> Principle:<u> Cooperation among cooperative societies:</u><br/>

					Cooperative societies provide education and training for their members, elected representatives, managers, and employees so they can contribute effectively to the development of their cooperative societies. They inform the general public particularly young people and opinion leaders- about the nature and benefits of cooperation.

				<p>7<sup>th</sup> Principle: <u>Cooperation among cooperative societies:</u><br/>

					Cooperative societies serve their members most effectively and strenthen the cooperative movement by working together through local, national, regional and international structures.

				<p>8<sup>th</sup> Principle:<u> Professional Management:</u><br/>

					Cooperative societies are managed in a professional manner in running their affairs.
			<td>
		</tr>
		<tr>
			<td colspan="2" align="center"><u><b>Undertaking</b></u></td>
		</tr>
		<tr>
			<td colspan="2"> I/We hereby  declare and undertake to abide by the eight principles of cooperation in case of default at our end,we shall be liable for legal action as stipulated under relevant law.<br/><br/>
			
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<h3 style="text-align:center">
				<u>SCHEDULE-B <br/>Matters to be incorporated in  Bye-Laws</u>
			</h3>
			<br/>
			<br/>
				<ol type="1">
					<li> Name and address</li>
					<li>Area of operation</li>
					<li> Objectives and function</li>
					<li> Membership</li>
					<li> Authorized share capital</li>
					<li> Capital and Fund</li>
					<li> Annual General meeting</li>
					<li> Special general meeting</li>
					<li>Amendment</li>
					<li> Board of Directors</li>
					<li> Chief Executive officer</li>
					<li> Appointment of net profit</li>
					<li> Investment of fund</li>
					<li> Reserve fund</li>
					<li> Dividend</li>
					<li> Books and Accounts</li>
					<li> Audit</li>
					<li> Liability of Members in case of winding up</li>
				</ol>
			<td>
		</tr>
		<tr>
			<td colspan="2" align="center"><u><b>Undertaking</b></u></td>
		</tr>
		<tr>
			<td colspan="2">We, the members of the proposed  &nbsp;<b>'.strtoupper($unit_name).'</b> &nbsp; do hereby agree to incorporate all the matters as stated in Schedule B (Guidelines) in our bye-laws under the provisions of the Assam Cooperative Societies Act, 2007 and rules framed thereunder. We understand and agree, that any omission or misstatement in the same, shall attract legal action as stipulated under the relevant law.<br/><br/></td>
		</tr> 
		<tr>
			<td></td>
			<td align="right">
				 <b>'.strtoupper($key_person).'</b><br/>
				 Signature of the Applicant</td>				
		</tr>        	
	</table>';
?>
