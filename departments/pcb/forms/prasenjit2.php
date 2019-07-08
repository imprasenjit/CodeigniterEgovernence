<form name="myForm" id="myForm"
		action='https://www.sbiepay.com/secure/GOA/AggGovtOfAssamRequestListener' method="post">

		<div align="center">
			<table width="100%">
				<tr>
					<td align="left" valign="top"><table width="100%" border="0"
							cellspacing="7" cellpadding="0">
							<tr>
								<td height="300" align="center" valign="middle">
									<table width="80%" border="0" align="center" cellpadding="5"
										cellspacing="2" bgcolor="#5797c9">
										<tr>
											<td align="center" valign="middle" class="header">Re
												Direct TO Bank Portal</td>
										</tr>
										<tr>
											<td align="left" valign="top" bgcolor="#FFFFFF"><table
													width="100%" border="0" cellspacing="5" cellpadding="0">
													<!--  <tr>
                <td></td>
                <td height="40" align="left" valign="middle" class="whitebig">Please wait while You are redirecting to Bank Portal.</td>
              </tr>-->
													<tr>
														<td align="center"><input type="hidden"
															name="bankTransactionId" id="bankTransactionId"
															value="bank123456" /></td>

													</tr>
													<tr>
														<td align="center"><input type="hidden"
															name="processFlag" id="processFlag"
															value="S" /></td>

													</tr>
													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Merchant Code</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="merchantCode"
															type="text" id="merchantCode" size="50" readonly="true"
															value="1000262" /><input name="MerchantCode"
															type="hidden" id="MerchantCode" size="50" readonly="true"
															value="1000262" /></td>

													</tr>
													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Government
																		Transaction Number</font></b></span><span class="style2"><b>:</b></span></td>
														<td width="50%"><input name="challanId" type="text"
															id="challanId" size="50" readonly="true"
															value="2269" /></td>

													</tr>
													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Government Receive
																		Date</font></b></span><span class="style2"><b>:</b></span></td>
														<td width="50%"><input name="receivedDate"
															type="text" id="receivedDate" size="50" readonly="true"
															value="26/05/2017 01:37:15 PM" /></td>

													</tr>
													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Act Name/Tax Type</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="taxType" type="text"
															id="taxType" size="50" readonly="true"
															value="TEST" /></td>

													</tr>

													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Tax Prayer Type/Department Name</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="taxPayerType"
															type="text" id="taxPayerType" size="50" readonly="true"
															value="Labour Department" /></td>

													</tr>
													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Registration Number/(Licence No./File No.) and Name</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="regNo" type="text"
															id="regNo" size="50" readonly="true" value="kkk/sss/sss/sss/lop" /></td>

													</tr>

													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Dealer Name/Name of the Person for whom amount deposited</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="dealerName" type="text"
															id="dealerName" size="50" readonly="true"
															value="pcb" /></td>

													</tr>

													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">From Date</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="fromDate" type="text"
															id="fromDate" size="50" readonly="true"
															value="" /></td>

													</tr>

													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">To Date</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="toDate" type="text"
															id="toDate" size="50" readonly="true" value="" /></td>

													</tr>


													<tr>
														<td width="30%"><span class="style1"><b><font
																	face="Book Antiqua" size="2">Total Amount</font></b></span><span
															class="style2"><b>:</b></span></td>
														<td width="50%"><input name="totalAmnt" type="text"
															id="totalAmnt" size="50" readonly="true"
															value="20" /></td>

													</tr>
													<tr>
													<td>&nbsp;</td>
													</tr>
													
													<tr>
													<td colspan="2" align="center">
													<table style="border-left:solid red 3px;border-bottom:solid red 3px;border-right:solid red 3px;border-top:solid red 3px;">
													<tr>
													<td align="center"><font color="red" size="2px"><b>NOTICE:</b></font></td>
													</tr>
													<tr>
													<td align="center"><b>The request for refunds. If found eligible, will be entertained only offline and no online refunds will be done. The transaction once done cannot be cancelled.</b></td>
													</tr>
													<tr>
													<td align="center"><b></b><input type="radio" id="agr" name="rad">&nbsp;&nbsp;Agreed<input type="radio" name="rad" id="nagr">&nbsp;&nbsp;Not Agreed</b></td>
													</tr>
													</table>
													</td>
													</tr>
													
													<tr>
														<input type="hidden" name="chksm" value="cfeba1f58cc2af0204982b5f753ce30e"></input>
														<input type="hidden" name="bankName" id="bankName" value="SBI"></input>
													</tr>

													<table width="100%">
														<tr>
															<!-- <td align="center" valign="top"><input name="btnSubmit" id="btnSubmit" type="button" class="bot" value="Pay" onClick="openChild('tdschallan1.jsp?challan=','tdschallan1','800','700');return false;"/>      <input type="button" name="btnCancel" id="btnCancel"  class="bot"  value="Close" onClick="window.location='Home'"/>
                </td>
                 
                 <td align="center" valign="top"><input name="btnSubmit" id="btnSubmit" type="button" class="bot" value="Submit"  onClick="openChild('tdsTaxSite.jsp?challanId=','tdsTaxSite','800','700');return false;"/>      <input type="button" name="btnCancel" id="btnCancel"  class="bot"  value="Close" onClick="window.close();"/>
                </td>-->

															<td align="center" valign="top"><input
																name="btnSubmit" id="btnSubmit" type="button"
																class="bot" value="Submit" onclick="return submitBut();" />
																<input type="button" name="btnCancel" id="btnCancel"
																class="bot" value="Close" onClick="window.close();" /></td>
														</tr>
													</table>

												</table></td>
										</tr>
									</table>
								</td>
							</tr>

						</table></td>
				</tr>


			</table>
		</div>
	</form>
<?php
print_r($_POST);
?>