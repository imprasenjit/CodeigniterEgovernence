<?php
$unitid = $this->session->userdata("unit_id");
$row = $this->unit_model->getapplicantdetails($unitid);
if(!$row){redirect(base_url());}
?>	
<div class="container user-bodysection">
    
    <div class="row">
        <h2 align="center">My Profile </h2>
        <table width="99%" class="table table-responsive table-bordered" align="center" border="1" style="margin:0px auto;">
            <tbody>	
                <tr>
                    <td valign="top" width="45%">1. Name </td>
                    <td width="50%"><?= $row->app_name ?></td>
                </tr>
                <tr>
                    <td>2. Designation:</td>
                    <td><?= $row->app_designation; ?></td>
                </tr>

                              <tr>
                    <td valign="top">6. Address</td>
                    <td >
 <?php
                        $this->load->helper("address");
                        view_address($row->address);
                        ?>
        
                    </td>
                </tr>
                <tr>
                    <td valign="top">8. Mobile No :      </td>
                    <td width="50%">+91 <?= $row->app_mobile_no; ?> </td>

                </tr>
                <tr>
                    <td valign="top">9. Email-ID :       </td>
                    <td width="50%"> <?= $row->app_email; ?></td>

                </tr>
        </table>
</div>
    <h3> If you want to make any edit please ask your company manager</h3>
</div>