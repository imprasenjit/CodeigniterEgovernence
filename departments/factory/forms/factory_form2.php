<?php
require_once "../../requires/login_session.php";
$dept = "factory";
$form = "2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name = basename(__FILE__);

include "save_form.php";

$occupier_name = $key_person;
$occupier_sn1 = $street_name1;
$occupier_sn2 = $street_name2;
$occupier_vill = $vill;
$occupier_dist = $dist;
$occupier_pin = $pincode;

$q = $formFunctions->executeQuery($dept, "select * from " . $table_name . " where user_id='$swr_id' and active='1'");
if ($q->num_rows < 1) {
    $p = $formFunctions->executeQuery($dept, "select * from " . $table_name . " where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
    if ($p->num_rows > 0) {
        $results = $p->fetch_assoc();
        $form_id = $results['form_id'];
        $managing_agents = $results['managing_agents'];
        $cah = $results['cah'];
        $risk_category = $results['risk_category'];
        if (!empty($results["communication_address"])) {
            $communication_address = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["communication_address"]));
            $communication_address_str1 = $communication_address->str1;
            $communication_address_str2 = $communication_address->str2;
            $communication_address_vill = $communication_address->vill;
            $communication_address_dist = $communication_address->dist;
            $communication_address_pin = $communication_address->pin;
            $communication_address_m_no = $communication_address->m_no;
            $communication_address_email = $communication_address->email;
        } else {
            $communication_address_str1 = "";
            $communication_address_str2 = "";
            $communication_address_vill = "";
            $communication_address_dist = "";
            $communication_address_pin = "";
            $communication_address_m_no = "";
            $communication_address_email = "";
        }
        if (!empty($results["manuf_process"])) {
            $manuf_process = json_decode($results["manuf_process"]);
            $manuf_process_carried = $manuf_process->carried;
            $manuf_process_car_fac = $manuf_process->car_fac;
            $manuf_process_nat_fac = $manuf_process->nat_fac;
        } else {
            $manuf_process_carried = "";
            $manuf_process_car_fac = "";
            $manuf_process_nat_fac = "";
        }
        //print_r($results["manuf_prod"]);
        if (!empty($results["manuf_prod"])) {
            $manuf_prod = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["manuf_prod"]));

            $manuf_prod_nv = $manuf_prod->nv;
            $manuf_prod_max_emp = $manuf_prod->max_emp;
            $manuf_prod_max_emp1 = $manuf_prod->max_emp1;
            $manuf_prod_max_emp2 = $manuf_prod->max_emp2;
        } else {
            $manuf_prod_nv = "";
            $manuf_prod_max_emp = "";
            $manuf_prod_max_emp1 = "";
            $manuf_prod_max_emp2 = "";
        }
        if (!empty($results["power"])) {
            $power_value = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["power"]));
            //$power=json_decode($results["power"]);
            $power_nature = $power_value->nature;
            $power_p = $power_value->p;
            $power_mp = $power_value->mp;
        } else {
            $power_nature = "";
            $power_p = "";
            $power_mp = "";
        }
        if (!empty($results["manager"])) {
            $manager = json_decode($results["manager"]);
            $manager_name = $manager->name;
            $manager_sn1 = $manager->sn1;
            if (isset($manager->sn2))
                $manager_sn2 = $manager->sn2;
            $manager_v = $manager->v;
            $manager_d = $manager->d;
            $manager_p = $manager->p;
        }else {
            $manager_name = "";
            $manager_sn1 = "";
            $manager_sn2 = "";
            $manager_v = "";
            $manager_d = "";
            $manager_p = "";
        }

        if (!empty($results["occupier"])) {
            $occupier = json_decode($results["occupier"]);
            $occupier_name = $occupier->name;
            $occupier_sn1 = $occupier->sn1;
            $occupier_sn2 = $occupier->sn2;
            $occupier_vill = $occupier->vill;
            $occupier_dist = $occupier->dist;
            $occupier_pin = $occupier->pin;
        }
        if (!empty($results["owner"])) {
            $owner = json_decode($results["owner"]);
            $owner_name = $owner->name;
            $owner_sn1 = $owner->sn1;
            $owner_sn2 = $owner->sn2;
            $owner_vill = $owner->vill;
            $owner_dist = $owner->dist;
            $owner_pin = $owner->pin;
        } else {
            $owner_name = "";
            $owner_sn1 = "";
            $owner_sn2 = "";
            $owner_vill = "";
            $owner_dist = "";
            $owner_pin = "";
        }
        if (!empty($results["ref_no"])) {
            $ref_no = json_decode($results["ref_no"]);
            if (isset($ref_no->approval1))
                $ref_no_approval1 = $ref_no->approval1;
            if (isset($ref_no->approval2))
                $ref_no_approval2 = $ref_no->approval2;
        }else {
            $ref_no_approval2 = "";
            $ref_no_approval1 = "";
        }
    } else {
        $cah = "";
        $form_id = "";
        $communication_address_str1 = "";
        $communication_address_str2 = "";
        $communication_address_vill = "";
        $communication_address_dist = "";
        $communication_address_pin = "";
        $communication_address_m_no = "";
        $communication_address_email = "";
        $manuf_process_carried = "";
        $manuf_process_car_fac = "";
        $manuf_prod_nv = "";
        $manuf_prod_max_emp1 = "";
        $manuf_prod_max_emp2 = "";
        $manuf_prod_max_emp = "";
        $manuf_process_nat_fac = "";
        $power_nature = "";
        $power_p = "";
        $power_mp = "";
        $manager_name = "";
        $manager_sn1 = "";
        $manager_sn2 = "";
        $manager_v = "";
        $manager_d = "";
        $manager_p = "";
        $owner_name = "";
        $owner_sn1 = "";
        $owner_sn2 = "";
        $owner_vill = "";
        $owner_dist = "";
        $owner_pin = "";
        $ref_no_approval2 = "";
        $ref_no_approval1 = "";
        $proprietors = "";
        $directors = "";
        $managing_agents = "";
        $risk_category = "";
        $file1 = "";
        $file2 = "";
        $file3 = "";
        $file4 = "";
        $file5 = "";
        $file6 = "";
        $ris_category = "";
        $ris_category_txt = "Select A Category";
    }
} else {
    $results = $q->fetch_assoc();
    $form_id = $results['form_id'];
    $managing_agents = $results['managing_agents'];
    $cah = $results['cah'];
    $risk_category = $results['risk_category'];
    if (!empty($results["communication_address"])) {
        $communication_address = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["communication_address"]));
        $communication_address_str1 = $communication_address->str1;
        $communication_address_str2 = $communication_address->str2;
        $communication_address_vill = $communication_address->vill;
        $communication_address_dist = $communication_address->dist;
        $communication_address_pin = $communication_address->pin;
        $communication_address_m_no = $communication_address->m_no;
        $communication_address_email = $communication_address->email;
    } else {
        $communication_address_str1 = "";
        $communication_address_str2 = "";
        $communication_address_vill = "";
        $communication_address_dist = "";
        $communication_address_pin = "";
        $communication_address_m_no = "";
        $communication_address_email = "";
    }
    if (!empty($results["manuf_process"])) {
        $manuf_process = json_decode($results["manuf_process"]);
        $manuf_process_carried = $manuf_process->carried;
        $manuf_process_car_fac = $manuf_process->car_fac;
        $manuf_process_nat_fac = $manuf_process->nat_fac;
    } else {
        $manuf_process_carried = "";
        $manuf_process_car_fac = "";
        $manuf_process_nat_fac = "";
    }
    //print_r($results["manuf_prod"]);
    if (!empty($results["manuf_prod"])) {
        $manuf_prod = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["manuf_prod"]));

        $manuf_prod_nv = $manuf_prod->nv;
        $manuf_prod_max_emp = $manuf_prod->max_emp;
        $manuf_prod_max_emp1 = $manuf_prod->max_emp1;
        $manuf_prod_max_emp2 = $manuf_prod->max_emp2;
    } else {
        $manuf_prod_nv = "";
        $manuf_prod_max_emp = "";
        $manuf_prod_max_emp1 = "";
        $manuf_prod_max_emp2 = "";
    }
    if (!empty($results["power"])) {
        $power_value = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $results["power"]));
        //$power=json_decode($results["power"]);
        $power_nature = $power_value->nature;
        $power_p = $power_value->p;
        $power_mp = $power_value->mp;
    } else {
        $power_nature = "";
        $power_p = "";
        $power_mp = "";
    }
    if (!empty($results["manager"])) {
        $manager = json_decode($results["manager"]);
        $manager_name = $manager->name;
        $manager_sn1 = $manager->sn1;
        if (isset($manager->sn2))
            $manager_sn2 = $manager->sn2;
        $manager_v = $manager->v;
        $manager_d = $manager->d;
        $manager_p = $manager->p;
    }else {
        $manager_name = "";
        $manager_sn1 = "";
        $manager_sn2 = "";
        $manager_v = "";
        $manager_d = "";
        $manager_p = "";
    }

    if (!empty($results["occupier"])) {
        $occupier = json_decode($results["occupier"]);
        $occupier_name = $occupier->name;
        $occupier_sn1 = $occupier->sn1;
        $occupier_sn2 = $occupier->sn2;
        $occupier_vill = $occupier->vill;
        $occupier_dist = $occupier->dist;
        $occupier_pin = $occupier->pin;
    }
    if (!empty($results["owner"])) {
        $owner = json_decode($results["owner"]);
        $owner_name = $owner->name;
        $owner_sn1 = $owner->sn1;
        $owner_sn2 = $owner->sn2;
        $owner_vill = $owner->vill;
        $owner_dist = $owner->dist;
        $owner_pin = $owner->pin;
    } else {
        $owner_name = "";
        $owner_sn1 = "";
        $owner_sn2 = "";
        $owner_vill = "";
        $owner_dist = "";
        $owner_pin = "";
    }
    if (!empty($results["ref_no"])) {
        $ref_no = json_decode($results["ref_no"]);
        if (isset($ref_no->approval1))
            $ref_no_approval1 = $ref_no->approval1;
        if (isset($ref_no->approval2))
            $ref_no_approval2 = $ref_no->approval2;
    }else {
        $ref_no_approval2 = "";
        $ref_no_approval1 = "";
    }
}
##PHP TAB management
$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

$tabbtn1 = "";
$tabbtn2 = "";
$tabbtn3 = "";
if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
    $tabbtn1 = "active";
    $tabbtn2 = "";
    $tabbtn3 = "";
}
if ($showtab == 2) {
    $tabbtn1 = "";
    $tabbtn2 = "active";
    $tabbtn3 = "";
}
if ($showtab == 3) {
    $tabbtn1 = "";
    $tabbtn2 = "";
    $tabbtn3 = "active";
}
##PHP TAB management ends
if (isset($_GET["application_type"]))
    $application_type = $_GET["application_type"];
else
    $application_type = "";
?>
                                                <?php require_once "../../requires/header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
                                                   <?php require '../../requires/banner.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center" >
                            <strong><?php echo $form_name = $formFunctions->get_formName($dept, $form); ?></strong>
                        </h4>	
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills">
                            <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
                            <li  class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>

                        </ul>
                        <br>
                        <div class="tab-content">
                            <div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
                                <form name="myform2" class="myform1 submit1" id="myform2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                    <table id="tab1" class="table table-responsive">
                                        <tr>
                                            <td colspan="4">1. Full name of the Factory (with factory licence number if already registered before) :</td>

                                        </tr>
                                        <tr>
                                            <td width="25%">Name of the Factory :</td>
                                            <td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $unit_name; ?>"></td>
                                            <td width="25%">&nbsp;</td>
                                            <td width="25%">&nbsp;</td>										
                                        </tr>
                                        <tr>
                                            <td width="25%">Legal Entity :</td>
                                            <td width="25%"><input type="text" class="form-control text-uppercase" name="legal_entity" value="<?php echo $legal_entity; ?>" disabled="disabled" /></td>
                                            <td width="25%"></td>
                                            <td width="25%"></td>

                                        </tr>
                                        <tr>
                                            <td colspan="4"> 2. (a) Full postal address and situation of the factory:</td>

                                        </tr>
                                        <tr>
                                            <td>Street Name1 :</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_street_name1; ?>"></td>
                                            <td>Street Name2:</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_street_name2; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Village/Town :</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_vill; ?>"></td>
                                            <td>District :</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_dist; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Pin Code :</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_pincode; ?>"></td>
                                            <td>Mobile No:</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-" . $b_mobile_no; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Phone No:</td>
                                            <td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_landline_std . " - " . $b_landline_no; ?>"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>

                                            <td colspan="4">(b) Full address to which communication relating to the factory should be made:</td>
                                        </tr>
                                        <tr>
                                            <td>Street Name1 :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="communication_address[str1]"  value="<?php if ($communication_address_str1 == NULL) {
                                                        echo $street_name1;
                                                    } else {
                                                        echo $communication_address_str1;
                                                    } ?>"></td>
                                            <td>Street Name2:</td>
                                            <td><input type="text" class="form-control text-uppercase" name="communication_address[str2]" value="<?php if ($communication_address_str2 == NULL) {
                                                        echo $street_name2;
                                                    } else {
                                                        echo $communication_address_str2;
                                                    } ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td>Village/Town :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="communication_address[vill]" value="<?php if ($communication_address_vill == NULL) {
                                            echo $vill;
                                        } else {
                                            echo $communication_address_vill;
                                        } ?>"></td>
                                            <td>District :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="communication_address[dist]" value="<?php                                        if ($communication_address_dist == NULL) {
                                            echo $dist;
                                        } else {
                                            echo $communication_address_dist;
                                        } ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Pin Code :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="communication_address[pin]" validate="pincode" maxlength="6" value="<?php if ($communication_address_pin == NULL) {
                                            echo $pincode;
                                        } else {
                                            echo $communication_address_pin;
                                        } ?>"></td>
                                            <td>Mobile No:</td>
                                            <td><input type="text" class="form-control text-uppercase" name="communication_address[m_no]" validate="mobileNumber" maxlength="10" value="<?php if ($communication_address_m_no == NULL) {
                                            echo $mobile_no;
                                        } else {
                                            echo $communication_address_m_no;
                                        } ?>"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>Email Id:</td>
                                            <td><input type="email" class="form-control" name="communication_address[email]" value="<?php if ($communication_address_email == NULL) {
                                            echo $email;
                                        } else {
                                            echo $communication_address_email;
                                        } ?>"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>								
                                        <tr>
                                            <td colspan="4">3. Nature of manufacturing process or processes :</td>

                                        </tr>
                                        <tr>
                                            <td >(a) Carried on in the factory during the last 12 months <br/>(in the factories already in existence) :<span class="mandatory_field">*</span> </td>
                                            <td><textarea class="form-control text-uppercase" required="required"  name="manuf_process[carried]" ><?php echo $manuf_process_carried; ?></textarea></td>
                                            <td>(b) To be carried on in the factory during the next <br/>12 months (in the case of all factories) :<span class="mandatory_field">*</span></td>
                                            <td><textarea class="form-control text-uppercase" required="required" name="manuf_process[car_fac]" ><?php echo $manuf_process_car_fac; ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>(C) Nature of the factory :<span class="mandatory_field">*</span></td>
                                            <td>
                                                <select class="form-control text-uppercase" required="required" name="manuf_process[nat_fac]" id="nature_fac" value="<?php echo $manuf_process_nat_fac; ?>">
                                                    <option disabled="disabled">Select Option</option>
                                                    <option <?php if ($manuf_process_nat_fac == "PGS" || $manuf_process_nat_fac == "") echo "selected"; ?> value="PGS">Power Generating Station</option>
                                                    <option <?php if ($manuf_process_nat_fac == "ES") echo "selected"; ?> value="ES">Electrical Substation</option>
                                                    <option <?php if ($manuf_process_nat_fac == "OT") echo "selected"; ?> value="OT">Other</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4. Names and values or principal products <br/>manufactured during the last 12 months :<span class="mandatory_field">*</span></td>
                                            <td><textarea type="text" class="form-control text-uppercase" required="required" validate="textarea" name="manuf_prod[nv]"><?php echo $manuf_prod_nv; ?></textarea></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >5.(i) Maximum number of workers proposed to be <br/>employed on any day during the year :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase" required="required" value="<?php echo $manuf_prod_max_emp; ?>" validate="onlyNumbers" name="manuf_prod[max_emp]"></td>
                                            <td >(ii) Maximum number of workers employed on any<br/> one day during the last 12 months :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" class="form-control text-uppercase" required="required" name="manuf_prod[max_emp1]" validate="onlyNumbers" value="<?php echo $manuf_prod_max_emp1; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td>(iii) Number of workers to be ordinarily employed <br/>in the factory :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" class="form-control text-uppercase" required="required" name="manuf_prod[max_emp2]" validate="onlyNumbers" value="<?php echo $manuf_prod_max_emp2; ?>"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">6. (i) Nature and total amount of power <span class="kw">(in K.W.)</span><span class="hp">(in H.P.)</span> installed or proposed to be installed:</td>

                                        </tr>
                                        <tr>
                                            <td>Nature :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" class="form-control text-uppercase" required="required" name="power[nature]" id="hp1" value="<?php echo $power_nature; ?>"/></td>
                                            <td >Power :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" name="power[p]" validate="decimal" required="required" id="hp2" <input type="text" class="form-control text-uppercase" value="<?php echo $power_p; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td >(ii) Maximum amount of power <span class="kw">(in K.W.)</span><span class="hp">(in H.P.)</span> <br/>proposed to be used. :<span class="mandatory_field">*</span> </td>
                                            <td ><input type="text" name="power[mp]" id="hp3" class="form-control text-uppercase" required="required" validate="decimal" value="<?php echo $power_mp; ?>"/></td>
                                            <td>Risk Category <span class="mandatory_field">*</span></td>
                                            <td>										
<?php $rstresult = $formFunctions->executeQuery("dicc","SELECT * FROM inspection_category WHERE deptcode ='factory' GROUP BY businesstype ASC"); ?>
                                                <select name="risk_category" required="required" id="category1" class="form-control text-uppercase">
                                                    <option value="">Please Select</option>
<?php
while ($rstrows = $rstresult->fetch_object()) {
    $businesstype = $rstrows->businesstype;
    $risk_id = $rstrows->id;
    ?>
                                                        <option value="<?= $risk_id; ?>" <?php if ($risk_category == $risk_id) echo 'selected="selected"'; ?> ><?= $businesstype; ?></option>
<?php } ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">7. Full name and residential address of the person who shall be the manager of the factory for the purpose of the Act.</td>
                                        </tr>
                                        <tr>
                                            <td>Full Name :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="manager[name]" validate="letters" value="<?php if ($manager_name == NULL) {
    echo $key_person;
} echo $manager_name; ?>" required="required"></td>
                                            <td>Street Name 1 :</td>
                                            <td><input type="text" class="form-control text-uppercase"  name="manager[sn1]" value="<?php if ($manager_sn1 == NULL) {
    echo $street_name1;
} else {
    echo $manager_sn1;
} ?>"  required="required"></td>
                                        </tr>
                                        <tr>
                                            <td>Street Name 2 :</td>
                                            <td><input type="text" class="form-control text-uppercase"  name="manager[sn2]" value="<?php if ($manager_sn2 == NULL) {
    echo $street_name2;
} else {
    echo $manager_sn2;
} ?>"  ></td>
                                            <td>Village/Town :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="manager[v]" value="<?php if ($manager_v == NULL) {
    echo $vill;
} else {
    echo $manager_v;
} ?>"  required="required"></td>
                                        </tr>
                                        <tr>
                                            <td>District :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="manager[d]" value="<?php if ($manager_d == NULL) {
    echo $vill;
} else {
    echo $manager_d;
} ?>"  required="required"></td>
                                            <td>Pin Code :</td>
                                            <td><input type="text" class="form-control text-uppercase"  validate="pincode" maxlength="6" name="manager[p]" value="<?php if ($manager_p == NULL) {
    echo $pincode;
} else {
    echo $manager_p;
} ?>"  required="required"></td>
                                        </tr>

                                        <tr>										
                                            <td class="text-center" colspan="4">
                                                <button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
                                            </td>									
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
                                <form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                    <table id="" class="table table-responsive">
                                        <tr>
                                            <td colspan="4">8. Full name and residential address of occupier:<span class="mandatory_field">*</span> </td>
                                        </tr>	
                                        <tr>
                                            <td width="25%">Full Name :<span class="mandatory_field">*</span></td>
                                            <td width="25%"><input type="text" class="form-control text-uppercase" validate="letters" required="required" id="occupier_name" name="occupier[name]" value="<?php echo $occupier_name; ?>"></td>
                                            <td width="25%">Street Name 1 :<span class="mandatory_field">*</span></td>
                                            <td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="occupier[sn1]" value="<?php echo $occupier_sn1; ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td>Street Name 2 :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="occupier[sn2]" value="<?php echo $occupier_sn2; ?>"></td>
                                            <td>Village/Town :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase" required="required"  name="occupier[vill]" value="<?php echo $occupier_vill; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>District :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase" required="required"  name="occupier[dist]" value="<?php echo $occupier_dist; ?>"></td>
                                            <td>Pin Code :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" class="form-control text-uppercase" required="required"  validate="pincode" maxlength="6"  name="occupier[pin]" id="occupier_pin" value="<?php echo $occupier_pin; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>(i) The proprietor of the factory in case of private  <br/>firm/proprietory concern :</td>
                                            <td><input type="text" class="form-control text-uppercase" readonly="readonly" name="proprietors" id="proprietors" value="<?php if ($owner_type == "PR") echo $owner_names; ?>" ></td>
                                            <td>(ii) Directors in case of limited company/partners <br/>in case of a firm :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="directors" readonly="readonly" id="directors" value="<?php if ($owner_type == "PBLC" || $owner_type == "PTLC" || $owner_type == "PP" || $owner_type == "LLP" || $owner_type == "SOC" || $owner_type == "CS") echo $name_of_owner; ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td >(iii) Where a managing agent has been appointed <br/>the name of Managing Agents and Directors thereof :</td>
                                            <td><input type="text" class="form-control text-uppercase" name="managing_agents" id="managing_agents" value="<?php echo $managing_agents; ?>"></td>
                                            <td>(iv) Share-holders in case of a private company whereas <br/>Managing Agents have been appointed :</td>
                                            <td>As per annexure attached.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">(v) The Chief Administrative Head in case of a Govt. or local Fund Factory :</td>

                                        </tr>
<?php
if ($owner_type == "HUF" || $owner_type == "PSU") {
    $name_of_owner_values = Array();
    $name_of_owner_values = explode(",", $name_of_owner);
    $cah_name = $name_of_owner_values[0];
    ?>
                                            <tr>
                                                <td>Full Name :</td>
                                                <td><input type="text" class="form-control text-uppercase" readonly="readonly" value="<?php echo $cah_name; ?>"></td>
                                                <td>Designation :</td>
                                                <td><input type="text" class="form-control text-uppercase" name="cah" id="cah" value="<?php echo $cah; ?>"></td>
                                            </tr>
<?php } else { ?>
                                            <tr>
                                                <td>Full Name :</td>
                                                <td><input type="text" class="form-control text-uppercase" readonly="readonly" value=""></td>
                                                <td>Designation :</td>
                                                <td><input type="text" class="form-control text-uppercase" name="cah" readonly="readonly"  value=""></td>
                                            </tr>
<?php } ?>
                                        <tr>
                                            <td colspan="4">9. Full name and address of the owner of the premises of building (including precincts thereof) referred to section 93. :</td>

                                        </tr>
                                        <tr>
                                            <td>Full Name :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" required validate="letters" class="form-control text-uppercase" name="owner[name]"  value="<?php echo $owner_name; ?>"></td>
                                            <td>Street Name 1 :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" required class="form-control text-uppercase" name="owner[sn1]"  value="<?php echo $owner_sn1; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Street Name 2 :</td>
                                            <td><input type="text" class="form-control text-uppercase"  name="owner[sn2]"  value="<?php echo $owner_sn2; ?>"></td>
                                            <td>Village/Town :<span class="mandatory_field">*</span> </td>
                                            <td><input type="text" required class="form-control text-uppercase"  name="owner[vill]"  value="<?php echo $owner_vill; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>District :</td>
                                            <td><input type="text" required class="form-control text-uppercase"  name="owner[dist]"  value="<?php echo $owner_dist; ?>"></td>
                                            <td>Pin Code :<span class="mandatory_field">*</span></td>
                                            <td><input type="text" required class="form-control text-uppercase" validate="pincode" maxlength="6" name="owner[pin]"  value="<?php echo $owner_pin; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">10. In the case of a factory constructed or extended after the date of the commencement of the rules. :</td>
                                        </tr>
                                        <tr>
                                            <td>(a) Reference number and date of approval of the <br/>plans for site where for old or new building and for<br/> construction or extension of factory by the State <br/>Govt. Chief Inspector. :</td>
                                            <td><input type="text" class="form-control text-uppercase"  name="ref_no[approval1]"   value="<?php echo $ref_no_approval1; ?>"></td>
                                            <td>(b) Reference number and date of approval of the <br/>arrangement if any, made or the disposal of trade <br/>waste and effluent and the name of the authority <br/>granting such approval. :</td>
                                            <td><input type="text" class="form-control text-uppercase"  name="ref_no[approval2]"  value="<?php echo $ref_no_approval2; ?>"></td>
                                        </tr>


                                        <tr>										
                                            <td class="text-center" colspan="4">
                                                <button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
                                            </td>									
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php require_once "../../../views/users/requires/footer.php"; ?>
<?php require '../../requires/js.php' ?>
<script>
    $('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
    $('a[href="#tab1"]').on('click', function () {

        $('#tab1').css('display', 'table');
        $('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
    });
    $('a[href="#tab2"]').on('click', function () {

        $('#tab2').css('display', 'table');
        $('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
    });
    $('a[href="#tab3"]').on('click', function () {
        $('#tab3').css('display', 'table');
        $('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
    });
    $('a[href="#tab4"]').on('click', function () {
        $('#tab4').css('display', 'table');
        $('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
    });
    $('a[href="#tab5"]').on('click', function () {
        $('#tab5').css('display', 'table');
        $('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
    });
    /* ----------------------------------------------------- */
    $('#resid').hide();
    $('input[name="premises"]').on('change', function () {
        if ($(this).val() == 'O') {
            $('#resid').show();
        } else {
            $('#resid').hide();
        }
    });
    /* ------------------------------------------------------ */
    $('input[name="godown"]').on('change', function () {
        if ($(this).val() == 'Y') {
            $('.GodownExists').css('display', 'table-row');
        } else {
            $('.GodownExists').css('display', 'none');
        }
    });
<?php if ($manuf_process_nat_fac != "OT") { ?>
        $('.kw').show();
        $('.hp').hide();
<?php } else { ?>
        $('.kw').hide();
        $('.hp').show();
<?php } ?>
    $('#nature_fac').on('click', function () {
        if ($(this).val() == 'OT') {
            $('.hp').show();
            $('.kw').hide();
        } else {
            $('.kw').show();
            $('.hp').hide();
        }
    });
    /* ---------------------upload S/C click operation-------------------- */
<?php if ($check != 0 && $check != 4) { ?>
        $("#myform2 :input,select").prop("disabled", true);
<?php } ?>
    /* ------------------------------------------------------ */
    $('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-100:+0"});
    $('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-100:+0"});
</script>