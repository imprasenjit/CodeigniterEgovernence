<?php
$row = $q->fetch_array();
if ($q->num_rows > 0) {
    $id = $row['id'];
    $name = $row['Name'];
    $unit_type = $row['unit_type'];
    $l_o_business = $row['Type_of_ownership'];
    $owners = Array();
    $owners = explode(",", $row['Name_of_owner']);
    $b_street_name1 = $row['b_street_name1'];
    $b_street_name2 = $row['b_street_name2'];
    $b_vill = $row['b_vill'];
    $b_dist = $row['b_dist'];
    $b_block = $row['b_block'];
    $b_pincode = $row['b_pincode'];
    $b_mobile_no = $row['b_mobile_no'];
    $b_landline_std = $row['b_landline_std'];
    $b_landline_no = $row['b_landline_no'];
    $b_email = $row['b_email'];
    $b_street_name3 = $row['b_street_name3'];
    $b_street_name4 = $row['b_street_name4'];
    $b_vill2 = $row['b_vill2'];
    $b_dist2 = $row['b_dist2'];
    $b_block2 = $row['b_block2'];
    $b_pincode2 = $row['b_pincode2'];
    $key_person = $row['Key_person'];
    $status_applicant = $row['status_applicant'];
    $street_name1 = $row['Street_name1'];
    $street_name2 = $row['Street_name2'];
    $vill = $row['Vill'];
    $dist = $row['Dist'];
    $block = $row['block'];
    $pincode = $row['Pincode'];
    $mobile_no = $row['Mobile_no'];
    $landline_std = $row['Landline_std'];
    $landline_no = $row['Landline_no'];
    $pan_no = $row['pan_no'];
    $pan_name = $row['pan_name'];
    $sector_classes_a = $row['sector_classes_a'];
    $sector_classes_b = $row['sector_classes_b'];
    $sector_classes_b_value = get_sector_classes_b_value($sector_classes_b);
    $s_o_Investment = $row['Size_of_Investment'];
    $c_o_Enterprise = $row['Category_o_Enterprise'];
    $t_o_area = $row['Type_of_area'];
    $w_l = $row['w_l'];
    $t_o_land = $row['Type_of_land'];
    $dagno = $row['dagno'];
    $pattano = $row['pattano'];
    $mouza = $row['mouza'];
    $revenue = $row['revenue'];
    $e_n_employee = $row['Estimated_n_employee'];
    if (!empty($row["sale_nature"])) {
        $sale_nature = json_decode($row["sale_nature"]);
        if (isset($sale_nature->a)) {
            $sale_nature_a = $sale_nature->a;
        } else {
            $sale_nature_a = "";
        }
        if (isset($sale_nature->b)) {
            $sale_nature_b = $sale_nature->b;
        } else {
            $sale_nature_b = "";
        }
        if (isset($sale_nature->c)) {
            $sale_nature_c = $sale_nature->c;
        } else {
            $sale_nature_c = "";
        }
        if (isset($sale_nature->d)) {
            $sale_nature_d = $sale_nature->d;
        } else {
            $sale_nature_d = "";
        }
        if (isset($sale_nature->e)) {
            $sale_nature_e = $sale_nature->e;
        } else {
            $sale_nature_e = "";
        }
        if (isset($sale_nature->f)) {
            $sale_nature_f = $sale_nature->f;
        } else {
            $sale_nature_f = "";
        }
        if (isset($sale_nature->g)) {
            $sale_nature_g = $sale_nature->g;
        } else {
            $sale_nature_g = "";
        }
        if (isset($sale_nature->h)) {
            $sale_nature_h = $sale_nature->h;
        } else {
            $sale_nature_h = "";
        }
    } else {
        $sale_nature_a = "";
        $sale_nature_b = "";
        $sale_nature_c = "";
        $sale_nature_d = "";
        $sale_nature_e = "";
        $sale_nature_f = "";
        $sale_nature_g = "";
        $sale_nature_h = "";
    }
    if ($sale_nature_a == "L") {
        $sale_nature_a = "Locale Sale including deemed sales , ";
    }
    if ($sale_nature_b == "E") {
        $sale_nature_b = "Exports out of the country , ";
    }
    if ($sale_nature_c == "I") {
        $sale_nature_c = "Interstate Sales , ";
    }
    if ($sale_nature_d == "IG") {
        $sale_nature_d = "Import goods for manufacturing, packaging and not for resale , ";
    }
    if ($sale_nature_e == "S") {
        $sale_nature_e = "Sale of Service within India , ";
    }
    if ($sale_nature_f == "ES") {
        $sale_nature_f = "Export of Service Outside India , ";
    }
    if ($sale_nature_g == "O") {
        $sale_nature_g = "Others - " . $sale_nature_h;
    }
    
    $have_pan = $row['have_pan'];
    $cin_llpin = $row['cin_llpin'];
    $date_of_commencement = $row['date_of_commencement'];
    $date_of_commencement = date("d-m-Y", strtotime($date_of_commencement));
    $is_business_started = $row['is_business_started'];

    $declare_a = $row['declare_a'];
    $declare_b = $row['declare_b'];
    $declare_c = $row['declare_c'];
    $id_proof = $row['id_proof'];
    $id_proof_doc = $row['id_proof_doc'];
    $address_proof = $row['address_proof'];
    $address_proof_doc = $row['address_proof_doc'];
    $auth_letter_doc = $row['auth_letter_doc'];
    $pan_doc = $row['pan_doc'];

    $get_array_legal_entity_values = Array();
    $get_array_legal_entity_values = get_legal_entity($l_o_business);
    $get_array_legal_entity_values = explode("/", $get_array_legal_entity_values);

    $l_o_business_val = $get_array_legal_entity_values[0];
    $l_o_business_name = $get_array_legal_entity_values[1];
    if ($unit_type == "H")
        $unit_type = "Head Office";
    else if ($unit_type == "B")
        $unit_type = "Branch Office";
    else if ($unit_type == "F")
        $unit_type = "Factory";
    else if ($unit_type == "G")
        $unit_type = "Godown";
    else
        $unit_type = "Others - " . $unit_type;

    if ($s_o_Investment == 10)
        $s_o_Investment = "Below INR 10 LAKH";
    else if ($s_o_Investment == 25)
        $s_o_Investment = "INR 10 LAKH to 25 LAKH";
    else if ($s_o_Investment == 200)
        $s_o_Investment = "INR 25 LAKH to 2.00 CRORE";
    else if ($s_o_Investment == 500)
        $s_o_Investment = "INR 2.00 CRORE to 5.00 CRORE";
    else if ($s_o_Investment == 1000)
        $s_o_Investment = "INR 5.00 CRORE to 10.00 CRORE";
    else
        $s_o_Investment = "Above 10.00 CRORE";

    if ($sector_classes_a == 1)
        $sector_classes_a = "Agriculture, forestry and fishing";
    else if ($sector_classes_a == 2)
        $sector_classes_a = "Mining and quarrying";
    else if ($sector_classes_a == 3)
        $sector_classes_a = "Manufacturing";
    else if ($sector_classes_a == 4)
        $sector_classes_a = "Electricity, gas, steam and air conditioning supply";
    else if ($sector_classes_a == 5)
        $sector_classes_a = "Water supply - sewerage, waste management and remediation activities";
    else if ($sector_classes_a == 6)
        $sector_classes_a = "Construction";
    else if ($sector_classes_a == 7)
        $sector_classes_a = "Wholesale and retail trade; repair of motor vehicles and motorcycles";
    else if ($sector_classes_a == 8)
        $sector_classes_a = "Transportation and storage";
    else if ($sector_classes_a == 9)
        $sector_classes_a = "Accommodation and Food service activities";
    else if ($sector_classes_a == 10)
        $sector_classes_a = "Information and communication";
    else if ($sector_classes_a == 11)
        $sector_classes_a = "Financial and insurance activities";
    else if ($sector_classes_a == 12)
        $sector_classes_a = "Real estate activities";
    else if ($sector_classes_a == 13)
        $sector_classes_a = "Professional, scientific and technical activities";
    else if ($sector_classes_a == 14)
        $sector_classes_a = "Administrative and support service activities";
    else if ($sector_classes_a == 15)
        $sector_classes_a = "Public administration and defence; compulsory social security";
    else if ($sector_classes_a == 16)
        $sector_classes_a = "Education";
    else if ($sector_classes_a == 17)
        $sector_classes_a = "Human health and social work activities";
    else if ($sector_classes_a == 18)
        $sector_classes_a = "Arts, entertainment and recreation";
    else if ($sector_classes_a == 19)
        $sector_classes_a = "Other service activities";
    else if ($sector_classes_a == 20)
        $sector_classes_a = "Activities of households as employers - undifferentiated goods- and services producing activities of households for own use";
    else if ($sector_classes_a == 21)
        $sector_classes_a = "Activities of extraterritorial organizations and bodies";
    else
        $sector_classes_a = "";
    if ($c_o_Enterprise == "G")
        $c_o_Enterprise = "Green";
    else if ($c_o_Enterprise == "O")
        $c_o_Enterprise = "Orange";
    else if ($c_o_Enterprise == "R")
        $c_o_Enterprise = "Red";
    else if ($c_o_Enterprise == "OT")
        $c_o_Enterprise = "Others";
    else
        $c_o_Enterprise = "Others";

    if ($t_o_area == "U")
        $t_o_area = "Urban";
    else if ($t_o_area == "R")
        $t_o_area = "Rural";
    else if ($t_o_area == "O")
        $t_o_area = "Others";
    else
        $t_o_area = "Others";

    if ($w_l == "O")
        $w_l = "Own";
    else if ($w_l == "R")
        $w_l = "Rented";
    else if ($w_l == "L")
        $w_l = "Leased";
    else
        $w_l = "";

    if ($t_o_land == "G")
        $t_o_land = "Government";
    else if ($t_o_land == "P")
        $t_o_land = "Private";
    else
        $t_o_land = "";
    if ($e_n_employee == "L10")
        $e_n_employee = "5 To 10";
    else if ($e_n_employee == "L20")
        $e_n_employee = "10 To 20";
    else if ($e_n_employee == "L50")
        $e_n_employee = "20 To 50";
    else if ($e_n_employee == "G50")
        $e_n_employee = "50 or more";
    else
        $e_n_employee = "Less than 5";
    if ($have_pan == "N")
        $have_pan = "NO";
    else
        $have_pan = "YES";
    if ($declare_a == "N")
        $declare_a = "NO";
    else
        $declare_a = "YES";
    if ($is_business_started == "N")
        $is_business_started = "NEW";
    else
        $is_business_started = "EXISTING";

    if ($id_proof == "A") {
        $id_proof = "Voter ID Card";
    } else if ($id_proof == "B") {
        $id_proof = "Passport";
    } else if ($id_proof == "C") {
        $id_proof = "Driving License";
    } else if ($id_proof == "D") {
        $id_proof = "First Page of Bank account Passbook with Photo";
    } else if ($id_proof == "E") {
        $id_proof = "Letter with Photo from any recognized Public Authority/Gaon Panchayat";
    } else if ($id_proof == "F") {
        $id_proof = "Ration card";
    } else if ($id_proof == "G") {
        $id_proof = "PAN card";
    } else {
        $id_proof = "";
    }
    if ($address_proof == "A") {
        $address_proof = "Voter ID Card";
    } else if ($address_proof == "B") {
        $address_proof = "Passport";
    } else if ($address_proof == "C") {
        $address_proof = "Electric bill";
    } else if ($address_proof == "D") {
        $address_proof = "Telephone(Landline) bill";
    } else if ($address_proof == "E") {
        $address_proof = "First Page of Bank account Passbook with Photo";
    } else if ($address_proof == "F") {
        $address_proof = "Letter from any recognized Public Authority/Gaon Panchayat";
    } else if ($address_proof == "G") {
        $address_proof = "Ration card";
    } else if ($address_proof == "H") {
        $address_proof = "Copies of Sale Deed/Lease Agreement";
    } else {
        $address_proof = "";
    }



    $id_proof_doc_name_query = $mysqli->query("select name from digital_locker where file='$id_proof_doc'");
    if ($id_proof_doc_name_query->num_rows > 0) {
        $id_proof_doc_name = $id_proof_doc_name_query->fetch_object()->name;
    } else {
        $id_proof_doc_name = "";
    }
    if (!empty($address_proof_doc)) {
        $address_proof_doc_name = $mysqli->query("select name from digital_locker where file='$address_proof_doc'")->fetch_object()->name;
        $address_proof_doc_link = "<a href='" . $upload . $address_proof_doc . "' target='_blank'>" . $address_proof_doc_name . "</a>";
    } else {
        $address_proof_doc_name = "";
        $address_proof_doc_link = "";
    }

    $pan_doc_name_query = $mysqli->query("select name from digital_locker where file='$pan_doc'");
    if ($pan_doc_name_query->num_rows > 0) {
        $pan_doc_name = $pan_doc_name_query->fetch_object()->name;
    } else {
        $pan_doc_name = "";
    }
    //$pan_doc_name=$mysqli->query("select name from digital_locker where file='$pan_doc'")->fetch_object()->name;

    $auth_letter_doc_name_query = $mysqli->query("select name from digital_locker where file='$auth_letter_doc'");
    if ($auth_letter_doc_name_query->num_rows > 0) {
        $auth_letter_doc_name = $auth_letter_doc_name_query->fetch_object()->name;
    } else {
        $auth_letter_doc_name = "";
    }
    //$auth_letter_doc_name=$mysqli->query("select name from digital_locker where file='$auth_letter_doc'")->fetch_object()->name;

    $id_proof_doc_link = "<a href='" . $upload . $id_proof_doc . "' target='_blank'>" . $id_proof_doc_name . "</a>";



    $pan_doc_link = "<a href='" . $upload . $pan_doc . "' target='_blank'>" . $pan_doc_name . "</a>";

    $auth_letter_doc_link = "<a href='" . $upload . $auth_letter_doc . "' target='_blank'>" . $auth_letter_doc_name . "</a>";
}
    ?>
