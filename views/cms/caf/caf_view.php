<?php
$cafid = $this->uri->segment(4);
$caf = $this->caf_model->getCaf($cafid);
$this->load->helper("address");
$address = get_address($caf->address);
$user_address = get_address($caf->app_address);
$this->load->helper("entity");
$entity = getAllEntity($caf->entity_id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Common Application Form</title>
    </head>
    <body>
        <style type="test/css">
            table, thead, td {
                border: 1px solid #000;
                border-collapse: collapse;
            }
        </style>

        <h2 align="center">Common Application Form </h2>
        <table width="99%" class="table table-responsive table-bordered" align="center" border="1" style="margin:0px auto;">
            <tbody>
                <tr>
                    <td colspan="2"><h4><u><b>ENTERPRISE DETAILS</b></u></h4></td>
                </tr>
                <tr>
                    <td valign="top" width="45%">1. Name of the Enterprise           </td>
                    <td width="50%"><?= $caf->entp_name; ?></td>
                </tr>
                <tr>
                    <td>2. Date of commencement of business :</td>
                    <td><?= date("d-m-Y", strtotime($caf->date_of_commencement)) ?></td>
                </tr>
                <tr>
                    <td valign="top">3. Legal Entity of the Business or Constitution of Business             </td>
                    <td width="50%"><?php
                        $entity = getAllEntity($caf->entity_id);
                        echo $entity ? $entity->entity_name : "";
                        ?></td>
                </tr>
                <tr>
                    <td width="50%"></td>
                    <td width="50%">
                        <?php
                        $this->caf_model->getEntityData($caf->entity_id, $caf->owner_names, $caf->cin_llpin);
                        ?>
                    </td>
                </tr>


                <tr>
                    <td valign="top">4. Income Tax Permanent Account Number(PAN) of the Enterprise : </td>
                    <td width="50%"><?= $caf->pan; ?></td>
                </tr>
                <tr>
                    <td valign="top">5. Name as on PAN Card of the Enterprise : </td>
                    <td width="50%"><?= $caf->pan_name; ?></td>
                </tr>
                <tr>
                    <td valign="top">6. Registered office address</td>
                    <td >
                        <table width="100%" style="border:none">
                            <tbody>
                                <tr>
                                    <td width="30%">Address:</td>
                                    <td><?= $address->address; ?></td>
                                </tr>

                                <tr>
                                    <td>District :</td>

                                    <td><?= $address->dist; ?></td>
                                </tr>
                                <tr>
                                    <td>State :</td>

                                    <td><?= $address->state; ?></td>
                                </tr>
                                <tr>
                                    <td>Pin Code :</td>

                                    <td><?= $address->pin; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">7.Pan Card</td>
                    <td width="50%"><a href="<?= $caf->pan_card; ?>" target="_blank">View</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><h4><u><b>APPLICANT DETAILS</b></u></h4></td>
                </tr>
                <tr>
                    <td valign="top">8. Name of the Applicant/Authorised Person :       </td>
                    <td width="50%"><?= $caf->app_name; ?></td>
                </tr>
                <tr>
                    <td valign="top">9. Designation :       </td>
                    <td width="50%"><?= $caf->app_designation; ?></td>
                </tr>
                <tr>
                    <td valign="top">10. Applicant Address :       </td>

                    <td >
                        <table width="100%" style="border:none">
                            <tbody>
                                <tr>
                                    <td width="30%">Address:</td>
                                    <td><?= $user_address->address; ?></td>
                                </tr>

                                <tr>
                                    <td>District :</td>

                                    <td><?= $user_address->dist; ?></td>
                                </tr>
                                <tr>
                                    <td>State :</td>

                                    <td><?= $user_address->state; ?></td>
                                </tr>
                                <tr>
                                    <td>Pin Code :</td>

                                    <td><?= $user_address->pin; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td valign="top">11. Mobile No. of the Applicant  :      </td>
                    <td width="50%">+91 <?= $caf->app_mobile; ?></td>

                </tr>
                <tr>
                    <td valign="top">12. Email-ID of the Applicant :       </td>
                    <td width="50%"> <?= $caf->app_email; ?></td>

                </tr>
                <tr>
                    <td valign="top">14.ID proof</td>
                    <?php if (!empty($caf->app_id_proof)) { ?>
                        <td width="50%"><a href="<?= $caf->app_id_proof; ?>" target="_blank">View</a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">15. Authorisation Letter </td>
                    <?php if (!empty($caf->app_authorisation_letter)) { ?>
                        <td width="50%">
                            <a href="<?= $caf->app_authorisation_letter; ?>" target="_blank">View</a>
                        <?php } ?>
                    </td>

                </tr>

                <tr>
                    <td style="border:none">Submission Date</td>
                    <td style="border:none"><strong><?= date("d-m-Y   h:i A", strtotime($caf->entrytime)); ?></strong></td>

                </tr>
        </table>
    </body>
</html>
