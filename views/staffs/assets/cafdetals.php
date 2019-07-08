<div class="box box-primary box-alm" style="margin-top: 10px;">
    <h3 class="boxalm-head">
        Common application form
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <div class="box-body">
        <?php if(isset($unit)) {
            /*
            echo "<pre>";
            print_r($unit);  
            echo "</pre>";
            */
            $id = $unit->id;// 983
            $user_id = $unit->user_id;// 1
            $ubin = $unit->ubin;// AA00995/NPDPR00995/08/2017
            $save_mode = $unit->save_mode;// C
            $Name = $unit->Name;// asd(A unit of MY BUSINESS)
            $unit_type = $unit->unit_type;// B
            $Type_of_ownership = $unit->Type_of_ownership;// SOC
            $Name_of_owner = $unit->Name_of_owner;// Chiranjit Das,Rishiraj Adhikari
            $b_street_name1 = $unit->b_street_name1;// asd
            $b_street_name2 = $unit->b_street_name2;// as
            $b_vill = $unit->b_vill;// asd
            $b_dist = $unit->b_dist;// BAKSA
            $b_block = $unit->b_block;// BASKA
            $b_pincode = $unit->b_pincode;// 781364
            $subdivision = $unit->subdivision;// sub div 1
            $b_landline_std = $unit->b_landline_std;// 
            $b_landline_no = $unit->b_landline_no;// 
            $b_mobile_no = $unit->b_mobile_no;// 
            $b_email = $unit->b_email;// 
            $Street_name1 = $unit->Street_name1;// House No3
            $Street_name2 = $unit->Street_name2;// Street3
            $Vill = $unit->Vill;// Village3
            $block = $unit->block;// ASSAM
            $Dist = $unit->Dist;// KAMRUP (RURAL)
            $Pincode = $unit->Pincode;// 888888
            $Landline_std = $unit->Landline_std;// 01234
            $Landline_no = $unit->Landline_no;// 56789012
            $Mobile_no = $unit->Mobile_no;// 8664567888
            $Key_person = $unit->Key_person;// Proprietor
            $status_applicant = $unit->status_applicant;// Proprietor
            $pan_no = $unit->pan_no;// 
            $pan_name = $unit->pan_name;// 
            $Time_of_registration = $unit->Time_of_registration;// 2017-08-24 14:47:16
            $id_proof = $unit->id_proof;// G
            $id_proof_doc = $unit->id_proof_doc;// 16360143845892b49f3101f.pdf
            $address_proof = $unit->address_proof;// A
            $address_proof_doc = $unit->address_proof_doc;// 4250355505892b2b63637d.pdf
            $auth_letter_doc = $unit->auth_letter_doc;// 119342275158b568d56ecf8.jpg
            $pan_doc = $unit->pan_doc;// 16365550835847a881e6b9b.jpeg
            $active = $unit->active;// 1
            $approved_by = $unit->approved_by;// 
            $approved_date = $unit->approved_date;//
            
            if($this->unit_model->get_applicant($user_id)) {
                $applicant = $this->unit_model->get_applicant($user_id);
                $applicant_name = $applicant->name;
                $applicant_email = $applicant->email;
                $applicant_phone = $applicant->phone;
            } else {
                $applicant_name=$applicant_email=$applicant_phone="Not found!";
            }//End of if else
            /*
            $name = $unit->name;//CHIRANJIT DAS
            $email = $unit->email;//bhanita@avantikain.com
            $phone = $unit->phone;//8876201614
            $registered_on = $unit->registered_on;//2016-12-07 00:00:00
            */
            $unit_id = $unit->unit_id;// 995
            $sector_classes_a = $unit->sector_classes_a;// 1
            $sector_classes_b = $unit->sector_classes_b;// 3
            $b_street_name3 = $unit->b_street_name3;// Gmail
            $b_street_name4 = $unit->b_street_name4;// GMAIL
            $b_vill2 = $unit->b_vill2;// GMAIL
            $b_dist2 = $unit->b_dist2;// Kupwara
            $b_block2 = $unit->b_block2;// Jammu and Kashmir (JK)
            $b_pincode2 = $unit->b_pincode2;// 781003
            $Size_of_Investment = $unit->Size_of_Investment;// 200
            $Category_o_Enterprise = $unit->Category_o_Enterprise;// G
            $Type_of_area = $unit->Type_of_area;// U
            $Type_of_land = $unit->Type_of_land;// G
            $w_l = $unit->w_l;// O
            $Estimated_n_employee = $unit->Estimated_n_employee;// G50
            $dagno = $unit->dagno;// Dag No
            $pattano = $unit->pattano;// Patta No
            $mouza = $unit->mouza;// Mouza
            $revenue = $unit->revenue;// BARAMA 
            $sale_nature = $unit->sale_nature;// {"a":"L","h":""}
            $have_pan = $unit->have_pan;// 
            $cin_llpin = $unit->cin_llpin;// 
            $declare_a = $unit->declare_a;// Y
            $declare_b = $unit->declare_b;// 
            $declare_c = $unit->declare_c;// 
            $date_of_commencement = $unit->date_of_commencement;// 2017-05-27
            $is_business_started = $unit->is_business_started;// N
        ?>
        <table class="table table-responsive table-bordered">
            <tbody>
                <tr>
                    <td colspan="2">
                        <h4>
                            <u><b>ENTERPRISE DETAILS</b></u>
                        </h4>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%">1. Name of the Enterprise</td>
                    <td><?=$Name?></td>
                </tr>
                <tr>
                    <td>2. (a) Whether the business is new (not started) or existing (already started) :</td>
                    <td><?=$is_business_started?></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp; (b) Date of commencement of business :</td>
                    <td><?=$date_of_commencement?></td>
                </tr>
                <tr>
                    <td>3. Legal Entity of the Business or Constitution of Business</td>
                    <td><?=""?></td>
                </tr>
                <tr>
                    <td>4.(a) Name of the MEMBERS  : </td>
                    <td><?=""?></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp; (b) Income Tax Permanent Account Number(PAN) of the Enterprise : </td>
                    <td><?=$pan_no?></td>			
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp; (c) Name as on PAN Card of the Enterprise : </td>
                    <td><?=$pan_name?></td>			
                </tr>
                <tr>
                    <td>5. (a) Type of unit for which CAF is being filled : </td>
                    <td><?=$unit_type?></td>
                </tr>

                <tr>
                    <td>(b) Address of the unit for which CAF is being filled :</td>
                    <td>
                        <table style="border:none" width="100%">
                            <tbody>
                                <tr>
                                    <td>Street name 1 :</td>
                                    <td><?=$b_street_name1?></td>
                                </tr>
                                <tr>
                                    <td>Street name 2 :</td>
                                    <td><?=$b_street_name2?></td>
                                </tr>
                                <tr>
                                    <td>Town/Vill :</td>
                                    <td><?=$b_vill?></td>
                                </tr>
                                <tr>
                                    <td>District :</td>
                                    <td><?=$b_dist?></td>
                                </tr>
                                <tr>
                                    <td>Block/Word No. :</td>
                                    <td><?=$b_block?></td>
                                </tr>
                                <tr>
                                    <td>Pin Code :</td>
                                    <td><?=$b_pincode?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>6. Location of the Enterprise/Registered Office :</td>
                    <td>
                        <table style="border:none" width="100%">
                            <tbody>
                                <tr>
                                    <td>Street name 1 :</td>
                                    <td><?=$b_street_name3?></td>
                                </tr>
                                <tr>
                                    <td>Street name 2 :</td>
                                    <td><?=$b_street_name4?></td>
                                </tr>
                                <tr>
                                    <td>Town/Vill :</td>
                                    <td><?=$b_vill2?></td>
                                </tr>
                                <tr>
                                    <td>District :</td>
                                    <td><?=$b_dist2?></td>
                                </tr>
                                <tr>
                                    <td>State :</td>
                                    <td><?=$b_block2?></td>
                                </tr>
                                <tr>
                                    <td>Pin Code :</td>
                                    <td><?=$b_pincode2?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>7.(a) Landline No.</td>
                    <td><?=$b_landline_std."-".$b_landline_no?></td>
                </tr>
                <tr>
                    <td>(b) Mobile No.</td>
                    <td>+91 <?=$b_mobile_no?></td>
                </tr>

                <tr>
                    <td>(c) Email-ID.      </td>
                    <td><?=$b_email?></td>
                </tr>
                <tr>
                    <td colspan="2"><h4><u><b>APPLICANT DETAILS</b></u></h4></td>
                </tr>
                <tr>
                    <td> 8. (a) Name of the Applicant/Authorised Person :       </td>
                    <td><?=$Key_person?></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;(b) Designation of the Applicant :  </td>
                    <td><?=$status_applicant?></td>
                </tr>
                <tr>
                    <td> (c) Address of the Applicant</td>
                    <td>
                        <table style="border:none" width="100%">
                            <tbody>
                                <tr>
                                    <td>Street name 1 :</td>
                                    <td><?=$Street_name1?></td>
                                </tr>
                                <tr>
                                    <td>Street name 2 :</td>

                                    <td><?=$Street_name1?></td>
                                </tr>
                                <tr>
                                    <td>Town/Vill :</td>
                                    <td><?=$Vill?></td>
                                </tr>
                                <tr>
                                    <td>District :</td>
                                    <td><?=$Dist?></td>
                                </tr>
                                <tr>
                                    <td>State :</td>
                                    <td><?=$block?></td>
                                </tr>
                                <tr>
                                    <td>Pin Code :</td>
                                    <td><?=$Pincode?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>(d) Landline No. of the Applicant : </td>
                    <td><?=$Landline_std."-".$Landline_no?></td>
                </tr>
                <tr>
                    <td>(e) Mobile No. of the Applicant  : </td>
                    <td>+91 <?=$applicant_phone?></td>

                </tr>
                <tr>
                    <td>(f) Email-ID of the Applicant : </td>
                    <td><?=$applicant_email?></td>
                </tr>
                <tr>
                    <td colspan="2"><h4><u><b>OTHER DETAILS</b></u></h4></td>
                </tr>
                <tr>
                    <td>9. Size of Current Investment :</td>
                    <td><?=$Size_of_Investment?></td>
                </tr>
                <tr>
                    <td>10. (a) Select Your Sector of Operation :  </td>
                    <td><?=$sector_classes_a?></td>
                </tr>
                <tr>
                    <td>(b) Select your business type :  </td>
                    <td><?=$sector_classes_b?></td>			
                </tr>
                <tr>
                    <td> 11. Category of Enterprise based on pollution :   </td>
                    <td><?=$Category_o_Enterprise?></td>
                </tr>
                <tr>
                    <td>12. Type of Area     </td>
                    <td><?=$Type_of_area?></td>			
                </tr>
                <tr>
                    <td>  13. Status of Land/Building/Premises :     </td>
                    <td><?=$w_l?></td>
                </tr>
                <tr>
                    <td>  14 (a).Type of Land   </td>
                    <td><?=$Type_of_land?></td>			
                </tr>
                <tr>
                    <td>  &nbsp;&nbsp;&nbsp; (b) Dag No : </td>
                    <td><?=$dagno?></td>
                </tr>
                <tr>
                    <td>   &nbsp;&nbsp;&nbsp; (c) Patta No :  </td>
                    <td><?=$pattano?></td>
                </tr>
                <tr>
                    <td>  &nbsp;&nbsp;&nbsp; (d) Mouza :   </td>
                    <td><?=$mouza?></td>
                </tr>
                <tr>
                    <td>  &nbsp;&nbsp;&nbsp; (e) Revenue Circle     </td>
                    <td><?=$revenue?></td>			
                </tr>
                <tr>
                    <td> 15. Estimated number of employees currently being employed :   </td>
                    <td><?=$Estimated_n_employee?></td>
                </tr>
                <tr>
                    <td>16. Please select appropriate nature of sales/turnover : </td>
                    <td>
                        <?=$sale_nature?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><h4><u><b>LIST OF DOCUMENTS SUBMITTED</b></u></h4></td>
                </tr>
                <tr>
                    <td>1. Board Resolution / Authorisation Letter from the other Directors/Members/Partners </td>
                    <td><a href="http://192.168.88.229/eodb/Document_locker/119342275158b568d56ecf8.jpg" target="_blank"></a></td>
                </tr>
                <tr>
                    <td>2. Proof of identity of person applying <br>( The name of the person should be same as given in Sl No. 8.(a) of the application form) - PAN card </td>
                    <td><a href="http://192.168.88.229/eodb/Document_locker/16360143845892b49f3101f.pdf" target="_blank"></a></td>
                </tr>
                <tr>
                    <td>3. Proof of Address of person applying <br>( The address in the submitted document should be same as given in Sl No. 8.(c) of the application form) - Voter ID Card </td>
                    <td><a href="http://192.168.88.229/eodb/Document_locker/4250355505892b2b63637d.pdf" target="_blank"></a></td>
                </tr>
                <tr>
                    <td>4. PAN CARD of the Enterprise </td>
                    <td><a href="http://192.168.88.229/eodb/Document_locker/16365550835847a881e6b9b.jpeg" target="_blank"></a></td>
                </tr>
                <tr>
                    <td>Signature and Date:</td>
                    <td>
                        <table style="border:none" width="100%">
                            <tbody>
                                <tr>
                                    <td style="border:none"> Signature of Authorized Person </td>
                                    <td style="border:none"><strong>:</strong></td>
                                    <td style="border:none">PROPRIETOR</td>
                                </tr>
                                <tr>
                                    <td style="border:none">Submission Date</td>
                                    <td style="border:none"><strong>:</strong></td>
                                    <td style="border:none">2016-12-07 11:44:10</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php } else { ?>
            <h2 class="text-center">No records found!</h2>
        <?php } ?>
    </div>
</div><!--End of .box-->