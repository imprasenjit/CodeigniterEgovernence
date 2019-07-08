<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Logreports extends Eodbs {
    function index() {
        /*
        $this->load->model("staffs/logreports_model");
        $uid = $this->session->staff_id;
        $dept = $this->session->staff_dept;
        $tot = $this->logreports_model->tot_rows($dept, $uid);
        die($dept.", ".$uid." : ".$tot);
        */
        $this->load->view("staffs/logreports_view");
    }//End of index()
    
    function getDatatableRecords() {
        $uid = $this->session->staff_id;
        $dept = $this->session->staff_dept;
        $this->load->model("staffs/logreports_model");
        $this->load->helper("unittype");
        $columns = array(
            0 => "log_id",
            1 => "log_date",
            2 => "login_time",
            3 => "logout_time",
            4 => "system_info"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->logreports_model->tot_rows($dept, $uid);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->logreports_model->all_rows($limit, $start, $order, $dir, $dept, $uid);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->logreports_model->search_rows($limit, $start, $search, $order, $dir, $dept, $uid);
            $totalFiltered = $this->logreports_model->tot_search_rows($search, $dept, $uid);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $post) {
                $log_id = $post->log_id;
                $log_date=$post->log_date;
                $login_time=$post->login_time;
                $logout_time = $post->logout_time;
                $system_info = $post->system_info;
                
                $nestedData["log_id"] = $log_id;
                $nestedData["log_date"] = $log_date;
                $nestedData["login_time"] = $login_time;
                $nestedData["logout_time"] = $logout_time;
                $nestedData["system_info"] = $system_info;
                $data[] = $nestedData;
            }//End of foreach
        }//End of if statement
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );//End of json_data
        echo json_encode($json_data);
    }//End of getDatatableRecords()
}//End of Logreports