 <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		    <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
	
			                             
				              <tr>
                             <td width="25%">1.  Name of the Owner of the Land :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
                              
							     <td width="25%">2. Name of the Joint Owner :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
					            <td> <span class="soc_alert"></span> </td>
				              </tr>
							    <td width="25%">2.Address of the Proposed Site:</td>
							
					            <td> <span class="soc_alert"></span> </td>
				              </tr>
							    <tr>
								 <td>House/Plotno:</td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
								 <td> Dag no(New) :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td> 
								 <td> Dag no(Old) :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td>
								 <td> Patta no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pattano; ?>" ></td>
								 <td> Mouza :</td><td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
						        <td> Ward no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td> 
								 <td width="25%">Municipality/Gaon Panchayat Name  :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
								 <td width="25%">Zone:</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
								 <td> Revenue Village :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>" ></td>
				               <td> Locality : </td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo 	$b_street_name2; ?>" ></td>
							     <tr>
								 <td width="25%">Land Use:</td> 
							     <tr>
										<td>Road/Street Name :</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2; ?>" disabled ></td>
										<td>
										<td>Width of the Road:</td>
										 <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2; ?>" disabled ></td>
									
										
									</tr>
						      				   
						      <td>(b) Name of owners of adjoining :<br/>Land</td>
									</tr>
									<tr>
										<td>North :</td>
										<td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $north; ?>"></td>
										<td>South :</td>
										<td><input type="text" class="form-control text-uppercase"  name="south" value="<?php echo $south; ?>"></td>
									</tr>
									<tr>
										<td>East :</td>
										<td><input type="text" class="form-control text-uppercase"  name="east" value="<?php echo $east; ?>" ></td>
										<td>West</td>
										<td><input type="text" class="form-control text-uppercase"  name="west" value="<?php echo $west; ?>"></td>
									</tr>
			
			</table>
			</form>
		
		
		</div>
		 <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
		    <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
	
			                             
				              <tr>
                             <td width="25%">1. Building Category:</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
                              
							     <td width="25%">2. Name of the Joint Owner :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
					            <td> <span class="soc_alert"></span> </td>
				              </tr>
							    <td width="25%">2. Proposed Use:</td>
							
					            <td> <span class="soc_alert"></span> </td>
				              </tr>
							    
							    <tr>
								  <td>Plot Area(Patta Land recorded area in Sq Mtr):</td>
								  <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_block; ?>" disabled ></td>
								   <td>Document/Building Area ( Sq Mtr):</td>
								  <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_block; ?>" disabled ></td>
								   <td>Type of Construction:</td>
								   <td>No. of Floors:</td>
								   <td>Margin Set back:</td>
									</tr>
									<tr>
										<td>North :</td>
										<td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $north; ?>"></td>
										<td>South :</td>
										<td><input type="text" class="form-control text-uppercase"  name="south" value="<?php echo $south; ?>"></td>
									</tr>
									<tr>
										<td>East :</td>
										<td><input type="text" class="form-control text-uppercase"  name="east" value="<?php echo $east; ?>" ></td>
										<td>West</td>
										<td><input type="text" class="form-control text-uppercase"  name="west" value="<?php echo $west; ?>"></td>
									</tr>
								  <td>Cantilever:</td>
								  <tr>
										<td>North :</td>
										<td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $north; ?>"></td>
										<td>South :</td>
										<td><input type="text" class="form-control text-uppercase"  name="south" value="<?php echo $south; ?>"></td>
									</tr>
									<tr>
										<td>East :</td>
										<td><input type="text" class="form-control text-uppercase"  name="east" value="<?php echo $east; ?>" ></td>
										<td>West</td>
										<td><input type="text" class="form-control text-uppercase"  name="west" value="<?php echo $west; ?>"></td>
									</tr>
								  <tr>
								  <td>
								  Parking Details:</td>
								  </tr>
								  <tr>
								  <td>Total Area in Sq Mtr:</td>
								  <td>Boundary Wall Details(in mtrs):</td>
								  <td>Length:</td>
								  <td>Height:</td>
								  	<tr>
									  <td colspan="4"> (c) Is there any future provision for :</td>
									     
									</tr>
									<tr>
								
										<td>(i) Vertical extension :</td>
										<td><label class="radio-inline"><input <?php if($is_v_ext=="" || $is_v_ext=="Y") echo "checked"; ?> type="radio" value="Y" id="" name="is_v_ext"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($is_v_ext=="N") echo "checked"; ?> value="N" id="" name="is_v_ext"> No </label></td>
										<td>(ii) Horizontal extension :</td>
										<td><label class="radio-inline"><input <?php if($is_h_ext=="" || $is_h_ext=="Y") echo "checked"; ?> type="radio" value="Y" id="" name="is_h_ext"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($is_h_ext=="N") echo "checked"; ?> value="N" id="" name="is_h_ext"> No </label></td>			  
										
									
									</tr>
									<tr>
									    <td>(iii) If yes No. of floors :</td>
									    <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_floor" value="<?php echo $no_of_floor; ?>"></td>
									    <td></td>
									    <td></td>
									</tr>
									
								  
			</table>
			</form>
		
		
		</div>
		 <div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
		    <form name="myform" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
	
			                             
				              <tr>
                              <td width="25%">1. Registration No.:</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
                              
							     <td width="25%">2. Name of RTP :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
					           </tr>
							   <tr>
					          <td>Mobile No. :</td>
					          <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
			                 <td>Email Id:</td>
							   <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
                            </tr>
							   <tr>
							   <td>Fees to be paid:</td>
							   <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
							   </tr>
							   <tr>
							   <td>Declaration:</td>
							   <td>I/We hereby give notice that I intend to erect/re-erect or to make alteration in the House the details as given above which is in accordance with the Building Byelaws of Assamand I/We forward herewith,the following plans and specifications duly signed by me and Registered Technical person duly appointed by us, who have prepared the plans, statements/documents(as applicable).I/We request that the construction may be approved and permission accorded to me to execute the work.I hereby also declare that the contents of the above application and the enclosures are true and correct to my /our knowledge.No part of it is false and nothing has been concealed there form.
							   <td>
							   <td>I agree</td>
							   <td>Name of the applicant</td>
							   <td>Date:</td>
							   </tr>
							   
							  </table>
							  </form>
							  </div>
			<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
		    <form name="myform" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
           		          <tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
                  <tr>
					<td width="50%"> 1. A copy of site plan and building plan as required by building bye laws,ASSAM,and drawn by Technical Personal registered in MB/TC:</td>
					<td width="10%">
					<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
					</td>
					<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
				</tr>
			     <tr>
					<td>2.Photostat Copy of land document (Such as land deed,Mutation order or Patta).The photocopy is to be self- attested :</td>
					<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
					<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="B1"  class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>3.Structural Certificate(as per building bye laws of 2006 )issued by Technical/Personal/Group Agency Registered in MB/TC.: </td>
					<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
					<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="C1" class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>4. Service Plan for building when it is above 12:00 m high .:</td>
					<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
					<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>5. For boundary wall permission; an undertaking through affidavit shall be required particularly for road side wall.</td>
					<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
					<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>6. Key Plan of the Location:</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>
					
					
				</tr>
				<td>7. Soil Test report(Geo-Technical Report)in case of building above 12.00m high.: </td>
					<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" readonly="readonly"/></td>
					<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="G1" class="file7" name="G1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='G1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="G2" class="file7 cd" name="G2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='G2' onClick="checkData(this)">S/C</input></td>
					
				    <td>8. Trace Map.: </td>
					<td><select trigger="FileModal" class="file8" id="file8" <?php if($file8!="" || $file8=="SC" || $file8=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile8" value="<?php if($file8!="") echo $file8; ?>" id="mfile8" readonly="readonly"/></td>
					<td width="20%" id="mfile8-chiranjit"><?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file8" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="H1" class="file8" name="H1" <?php if($file8=="NA") echo "checked"; ?> <?php if($file8!="" && $file8!="NA") echo "disabled='disabled'"; ?> value='H1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="H2" class="file8 cd" name="H2" <?php if($file8=="SC") echo "checked"; ?> <?php if($file8!="" && $file8!="SC") echo "disabled='disabled'"; ?> value='H2' onClick="checkData(this)">S/C</input></td>
					<td>9.Receipt copy of up to date property tax.: </td>
					<td><select trigger="FileModal" class="file9" id="file9" <?php if($file9!="" || $file9=="SC" || $file9=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile9" value="<?php if($file9!="") echo $file9; ?>" id="mfile9" readonly="readonly"/></td>
					<td width="20%" id="mfile9-chiranjit"><?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file9" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="I1" class="file9" name="I1" <?php if($file9=="NA") echo "checked"; ?> <?php if($file9!="" && $file9!="NA") echo "disabled='disabled'"; ?> value='I1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="I2" class="file9 cd" name="I2" <?php if($file9=="SC") echo "checked"; ?> <?php if($file9!="" && $file9!="SC") echo "disabled='disabled'"; ?> value='I2' onClick="checkData(this)">S/C</input></td>
		
				<tr>
				
					<td class="text-center" colspan="4">
						<a href="form2.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
					</td>
					</tr>