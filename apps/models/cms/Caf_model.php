<?php

/**
 * Description of Caf_model
 *
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Caf_model extends CI_Model {

    function getCaf($id = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("caf");
        if ($id != NULL) {
            $this->db->where("caf_id", $id);
            $query = $this->db->get();
            $this->db->close();
            return $query->row();
        } else {
            $this->db->where("caf.status", "0");
            $query = $this->db->get();
            $this->db->close();
            return $query->result();
        }
    }

//Function Not in use
    function getunverified() {
        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'entpname',
            3 => 'entpaddress',
            4 => 'entpaddress',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "unverified");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "unverified");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->caf_id;
                $action = '<a href="' . base_url("cms/caf/viewcaf/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/caf/editcaf/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["id"] = $id;
                $nestedData["username"] = $post->name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["entpaddress"] = $fulladdress->house_no . " , " . $fulladdress->street . " , " . $fulladdress->village . " , " . $fulladdress->state . " , " . $fulladdress->dist . " , " . $fulladdress->pin;
                $nestedData["mobile"] = $post->phone;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    // End  of unverifiedcaf

    function getUnApprovedCaf($id = NULL) {

        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'entpname',
            3 => 'entpaddress',
            4 => 'mobile',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "unapproved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "unapproved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->caf_id;
                $action = '<a href="' . base_url("cms/caf/viewcaf/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/caf/editcaf/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["id"] = $id;
                $nestedData["username"] = $post->app_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["entpaddress"] = $fulladdress->address . " , " . $fulladdress->pin . " , " . $fulladdress->dist . " , " . $fulladdress->state . "";
                $nestedData["mobile"] = $post->app_mobile;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function getUnderQueryCaf($id = NULL) {

        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'entpname',
            3 => 'entpaddress',
            4 => 'entpaddress',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "underquery");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "underquery");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->caf_id;
                $action = '<a href="' . base_url("cms/caf/viewcaf/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/caf/editcaf/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["id"] = $id;
                $nestedData["username"] = $post->app_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["entpaddress"] = $fulladdress->address . " , " . $fulladdress->pin . " , " . $fulladdress->dist . " , " . $fulladdress->state . "";
                $nestedData["mobile"] = $post->app_mobile;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);

        /*  */
        $this->load->database();
        $this->db->select("*");
        $this->db->from("caf");
        $this->db->join("users", "caf.user_id=users.id");
        $this->db->where("caf.query_status", "1");
        $this->db->where("caf.status", "0");
        $query = $this->db->get();
        $this->db->close();
        return $query->result();
    }

    //Enf of getUnderQueryCaf()

    function getApprovedCaf($id = NULL) {
        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'entpname',
            3 => 'entpaddress',
            4 => 'entpaddress',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "approved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "approved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            $this->load->helper("address");
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->caf_id;
                $action = '<a href="' . base_url("cms/caf/viewcaf/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/caf/editcaf/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = get_address($post->address);
                $nestedData["id"] = $id;
                $nestedData["username"] = $post->app_name;
                $nestedData["entpname"] = $post->entp_name;
                if ($fulladdress) {
                    $nestedData["entpaddress"] = $fulladdress->address . " ,  " . $fulladdress->state . " , " . $fulladdress->dist . " , " . $fulladdress->pin;
                } else {
                    $nestedData["entpaddress"] = "";
                }
                $nestedData["mobile"] = $post->app_mobile;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function getRejectedCaf($id = NULL) {
        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'entpname',
            3 => 'entpaddress',
            4 => 'entpaddress',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "rejected");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "rejected");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->caf_id;
                $action = '<a href="' . base_url("cms/caf/viewcaf/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/caf/editcaf/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["id"] = $id;
                $nestedData["username"] = $post->app_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["entpaddress"] = $fulladdress->address . " , " . $fulladdress->pin . " , " . $fulladdress->dist . " , " . $fulladdress->state . "";
                $nestedData["mobile"] = $post->app_mobile;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    //Enf of getRejectedCaf()

    function all_rows($limit, $start, $col, $dir, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by('caf_id', $dir);
        $this->db->from("caf");
        if ($type == "approved") {
            $this->db->where("caf.status", "1");
        } else if ($type == "underquery") {
            $this->db->where("query_status", "1");
            $this->db->where("status", "0");
        } else if ($type == "unapproved") {
            $this->db->where("status", "0");
            $this->db->where("query_status", "0");
        } else if ($type == "rejected") {
            $this->db->where("caf.status", "2");
        }

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            $tmp = array(
                "totalrows" => $query->num_rows(),
                "result" => $query->result()
            );
            return $tmp;
        }//End of if else
    }

//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("caf");
        $this->db->like("entp_name", $search);
        $this->db->like("app_name", $search);
        $this->db->like("app_mobile", $search);
        $this->db->from("caf");
        if ($type == "approved") {
            $this->db->where("status", "1");
        } else if ($type == "underquery") {
            $this->db->where("query_status", "1");
            $this->db->where("status", "0");
        } else if ($type == "unapproved") {
            $this->db->where("status", "0");
            $this->db->where("query_status", "0");
        } else if ($type == "rejected") {
            $this->db->where("status", "2");
        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            $tmp = array(
                "totalrows" => $query->num_rows(),
                "result" => $query->result()
            );
            return $tmp;
        }
    }

    //End of searchrows

    function getEntityData($entity, $names, $other = NULL) {
        $owner_names = json_decode($names, true);
        switch ($entity) {
            case 1:
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Proprietor:</div><div class="col-sm-6">' . $owner_names[0] . '</div></div>';
                break;
            case 2:
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Partner(s) : ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 3:
                echo '<div class="col-md-12"><div class="col-sm-6">LLpin: </div><div class="col-sm-6">' . $other . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Partner(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 4:
                echo '<div class="col-md-12"><div class="col-sm-6">CIN: </div><div class="col-sm-6">' . $other . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Directors(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 5:
                echo '<div class="col-md-12"><div class="col-sm-6">LLpin: </div><div class="col-sm-6">' . $other . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Partner(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 6: echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 7: echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 8:
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Trusties(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 9: echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 10:
                echo '<div class="col-md-12"><div class="col-sm-6">name of Karta: </div><div class="col-sm-6">' . $owner_names[0] . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 11:echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            default:
                echo "Not found!";
        }
    }

//End of getEntityData()


    function getEntityWithFields($entity, $names, $other = NULL) {
        $owner_names = json_decode($names, true);
        switch ($entity) {
            case 1:
                echo '<div class="form-group has-feedback">     '
                . '<label for="names" class="col-sm-3 control-label">Name of the Proprietor</label>     '
                . '<div class="col-sm-7">       '
                . '<input type="text" name="names[]" value="' . $owner_names[0] . '" class="form-control" data-error="Please enter Name of the Proprietor" />  '
                . '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>'
                . '<span id="inputSuccess3Status" class="sr-only">(success)</span>'
                . '<span class="help-block"></span>    </div>   '
                . '</div>';
                break;
            case 2:
                foreach ($owner_names as $name) {
                    echo '<div class="form-group has-feedback">       '
                    . '<label for="names" class="col-sm-3 control-label">Name of the Partner(s)</label>     '
                    . '<div class="col-sm-7"> '
                    . '<div class="input-group">    '
                    . '<input type="text" name="names[]" value= "' . $name . '" class="form-control" data-error="Please enter name of the Partner(s)">    '
                    . '<span class="input-group-btn">    <button type="button" class="add_btn btn btn-info">'
                    . '<span class="glyphicon glyphicon-plus"></span></button></span></div> '
                    . '<span class="help-block"></span>   </div> '
                    . '</div>';
                }

                break;
            case 3:
                echo '<div class="form-group"><label for="llpin" class="col-sm-3 control-label">LLPIN</label> '
                . '<div class="col-sm-7">'
                . '<input type="text" class="form-control" id="llpin" value="' . $other . '" name="cin_lpin" data-error="Please enter LLPIN" placeholder=""></div></div>'
                ;
                foreach ($owner_names as $name) {
                    echo '<div class="form-group has-feedback">       '
                    . '<label for="names" class="col-sm-3 control-label">Name of the Partner(s)</label>     '
                    . '<div class="col-sm-7"> '
                    . '<div class="input-group">    '
                    . '<input type="text" name="names[]" value= "' . $name . '" class="form-control" data-error="Please enter name of the Partner(s)">    '
                    . '<span class="input-group-btn">    <button type="button" class="add_btn btn btn-info">'
                    . '<span class="glyphicon glyphicon-plus"></span></button></span></div> '
                    . '<span class="help-block"></span>   </div> '
                    . '</div>';
                }
                break;
            case 4:
                echo '<div class="form-group">'
                . '<label for="cin" class="col-sm-3 control-label">CIN of the Company</label> '
                . '<div class="col-sm-7">'
                . '<input type="text" class="form-control" value="' . $other . '" id="cin" name="cin_lpin" placeholder="" data-error="Please enter CIN">'
                . '</div></div>';
                foreach ($owner_names as $name) {
                    echo '<div class="form-group has-feedback">       '
                    . '<label for="names" class="col-sm-3 control-label">Name of the Directors(s)</label>     '
                    . '<div class="col-sm-7"> '
                    . '<div class="input-group">    '
                    . '<input type="text" name="names[]" value= "' . $name . '" class="form-control" data-error="Please enter name of the Partner(s)">    '
                    . '<span class="input-group-btn">    <button type="button" class="add_btn btn btn-info">'
                    . '<span class="glyphicon glyphicon-plus"></span></button></span></div> '
                    . '<span class="help-block"></span>   </div> '
                    . '</div>';
                }
                break;
            case 5:
                echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">CIN of the Company</label> <div class="col-sm-7"><input type="text" class="form-control" id="cin" name="cin_lpin" placeholder=""></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Director(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Directors(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 6:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 7:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 8:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Trusties(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Trusties(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 9:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 10:
                echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">Name of Karta</label> <div class="col-sm-7"><input type="text" class="form-control" id="namess" name="names[]" placeholder="" data-error="Name of Karta" ></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 11:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            default:
                echo "Please select Entity!";
        }
    }

    function checkpancard($value) {
        $this->load->database();
        $this->db->select("user_id");
        $this->db->from("caf");
        $this->db->where("pan", $value);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return $userid->user_id;
        } else {
            $this->db->close();
            return FALSE;
        }
    }

    // End of getEntityWithFields()

    function storeeditcaf() {
        $error = 1;
        //Registration Informations
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $mobile = $this->input->post("phone");
        $password = $this->input->post("password");
        $captcha = $this->input->post("captcha");
        $designation = $this->input->post("designation");
        $is_pancard_available = $this->input->post("ispancardavailable");

        // End of Registration informations
        //Enterprise informations
        $nameofentp = $this->input->post("nameofenterprise");
        $typeofentp = $this->input->post("typeofenterprise");
        $namesofmembers = $this->input->post("names");
        $pancard = $this->input->post("pancard");
        $panname = $this->input->post("pan_name");
        $dateofcommencement = $this->input->post("dateofcommencement");
        $cin_lpin = $this->input->post("cin_lpin");
        $entp_address = $this->input->post("entp_address");
        $entp_state = $this->input->post("entp_state");
        $entp_dist = $this->input->post("entp_dist");
        $entp_pin = $this->input->post("entp_pin");
        $app_address = $this->input->post("app_address");
        $app_state = $this->input->post("app_state");
        $app_dist = $this->input->post("app_dist");
        $app_pin = $this->input->post("app_pin");

        if ($this->input->post("entp_pin") != NULL) {
            $cin_liipn = $this->input->post("cin_lpiin");
        } else {
            $cin_liipn = "";
        }
        //End of Enterprise informations

        $array_of_entity_id = array(3, 4, 5, 10, 11); // This array will help us to determine which entity will require pan card
        $this->load->helper("email");
        if (empty($name)) {
            $error = "Please enter name";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error = "Only letters and white space allowed";
        } elseif (empty($email)) {
            $error = "Please Enter Your Email ID";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "$email is not a valid email address";
        } elseif (empty($mobile)) {
            $error = "Please Enter Your Email ID";
        } elseif (!preg_match("/^\d{10}$/", $mobile)) {
            $error = "Please Enter a valid 10 digits mobile number.";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $nameofentp)) {
            $error = "Only letters and white space allowed";
        } elseif (empty($typeofentp)) {
            $error = "Please select type of enterprise.";
        } elseif (count($namesofmembers) < 0) {
            $error = "Please enter names of partners/members/trusties.";
        } elseif (empty($is_pancard_available)) {
            $error = "Do u have a pan Card?";
        } elseif (empty($entp_address)) {
            $error = "Please Enter Registered office address.";
        } elseif (empty($entp_state)) {
            $error = "Please select state.";
        } elseif (empty($entp_dist)) {
            $error = "Please select district.";
        } elseif (empty($entp_pin)) {
            $error = "Please Enter PIN number.";
        } elseif (empty($app_address)) {
            $error = "Please Enter Applicant address.";
        } elseif (empty($app_state)) {
            $error = "Please select Applicant state.";
        } elseif (empty($app_dist)) {
            $error = "Please select Applicant district.";
        } elseif (empty($designation)) {
            $error = "Please enter designation of the applicant.";
        } elseif (empty($app_pin)) {
            $error = "Please Enter Applicant PIN .";
        } elseif (!is_numeric($app_pin) || !is_numeric($entp_pin)) {
            $error = "Please Enter a numeric PIN Code.";
        } elseif ($is_pancard_available === "Yes") {
            if (empty($pancard)) {
                $error = "Please Enter pancard number.";
            } elseif (strlen($pancard) < 10) {
                $error = "Please Enter Valid Pan card.";
            } elseif (empty($panname)) {
                $error = "Please Enter pan name.";
            }
        } elseif ($is_pancard_available === "No") {
            if (in_array($typeofentp, $array_of_entity_id)) {
                $error = "Pan card is mandatory for your entity type.";
            }
        } else {

            $error = 1;
        }

        $today = date("Y-m-d H:i:s");
        if ($error == 1) {
            //Pancard Upload

            $this->load->helper("fileupload");
            if (!empty($this->input->post("upload_pancard_doc"))) {
                $pancard_doc = moveFile(0, $this->input->post("upload_pancard_doc"), "pancard_doc");
            } else {
                $pancard_doc = array(0 => $this->input->post("pancard_document"));
            }
            //Authorisation letter Upload
            if (!empty($this->input->post("upload_authorisation_letter"))) {
                $authorisation_letter = moveFile(0, $this->input->post("upload_authorisation_letter"), "authorisation_letter");
            } else {
                $authorisation_letter = array(0 => $this->input->post("authorisation_document"));
            }

            //ID proof
            if (!empty($this->input->post("upload_id_proof"))) {
                $id_proof = moveFile(0, $this->input->post("upload_id_proof"), "id_proof");
            } else {
                $id_proof = array(0 => $this->input->post("idproof_document"));
            }
            //Enterpriseid to update
            $entpid = $this->input->post("entpid");
            //Addressid to update
            $addressid = $this->input->post("addressid");
            $app_addressid = $this->input->post("app_addressid");
            $today = date("Y-m-d H:i:s");
            if ($this->input->post("entp_pin") != NULL) {
                $cin_liipn = $this->input->post("cin_lpiin");
            } else {
                $cin_liipn = "";
            }
            $app_addressdata = array(
                "type_of_address" => "applicant_address",
                "address" => $app_address,
                "state" => $app_state,
                "dist" => $app_dist,
                "pin" => $app_pin,
                "entrydate" => $today
            );
            $this->address_model->update($app_addressdata, $app_addressid);
            $addressdata = array(
                "type_of_address" => "registered_address",
                "address" => $entp_address,
                "state" => $entp_state,
                "dist" => $entp_dist,
                "pin" => $entp_pin
            );
            $this->address_model->update($addressdata, $addressid);
            $this->load->database();
            //Updating enterprise data
            $entpdata = array(
                "entp_name" => $nameofentp,
                "entity_id" => $typeofentp,
                "owner_names" => json_encode($namesofmembers),
                "cin_llpin" => $cin_lpin,
                "date_of_commencement" => $dateofcommencement,
                "pan" => $pancard,
                "pan_name" => $panname,
                "address" => $addressid,
                'app_name' => $name,
                'app_email' => $email,
                'app_mobile' => $mobile,
                'app_address' => $app_addressid,
                'app_designation' => $designation,
                "pan_card" => $pancard_doc[0],
                "app_authorisation_letter" => $authorisation_letter[0],
                "app_id_proof" => $id_proof[0],
                "entrytime" => $today,
            );
            $this->db->where('caf_id', $entpid);
            $this->db->update('caf', $entpdata);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("x" => 1, "info" => "Caf editted successfully"));
            } else {
                echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
            }
        } else {
            echo json_encode(array("x" => 0, "error" => $error));
        }
    }

    //End of storeeditcaf()

    function approvecaf() {
        $caf_id = $this->input->post("cafid");
        $cms_user_id = $this->session->userdata('cms_user_id');
        $today = date("Y-m-d H:i:s");
        $entpdata = array(
            "approve_time" => $today,
            "who_approved" => $cms_user_id,
            "status" => "1"
        );
        $this->load->database();
        $this->db->where('caf_id', $caf_id);
        $this->db->update('caf', $entpdata);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array("x" => 1, "info" => "Caf Approved successfully"));
        } else {
            echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
        }
    }

    //Enf of Approvecaf()

    function querycaf() {
        $caf_id = $this->input->post("cafid");
        $query = $this->input->post("query");
        $cms_user_id = $this->session->userdata('cms_user_id');
        $today = date("Y-m-d H:i:s");
        $cafstatus = array(
            "query_status" => "1",
            "status" => "0"
        );
        $this->load->database();
        $this->db->where("caf_id", $caf_id);
        $this->db->update("caf", $cafstatus);
        $querydata = array(
            "query" => $query,
            "caf_id" => $caf_id,
            "cms_user_id" => $cms_user_id,
            "querytime" => $today
        );
        $this->load->database();
        $this->db->insert("caf_query", $querydata);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array("x" => 1, "info" => "Query sent successfully"));
        } else {
            echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
        }
    }

    //End of querycaf()
}
