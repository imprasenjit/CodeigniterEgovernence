<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Cafs extends Eodbs {
    function index() {         
        $this->load->view("staffs/cafs_view");
    }//End of index()
    
    function getDatatableRecords() {
        $this->load->model("staffs/cafs_model");
        $this->load->helper("unittype");
        $columns = array(
            0 => "id",
            1 => "ubin",
            2 => "Name",
            3 => "unit_type",
            4 => "b_street_name1"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->cafs_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->cafs_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->cafs_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->cafs_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $post) {
                $unit_id = $post->id;
                $ubin=$post->ubin;
                $Name=$post->Name;
                $unit_type = get_unittype($post->unit_type);
                $b_block = $post->b_block;
                $b_street_name1 = $post->b_street_name1;
                $b_street_name2 = $post->b_street_name2;
                $b_dist = $post->b_dist;
                $b_pincode = $post->b_pincode;
                $address = $b_street_name1 ." - ".$b_street_name2 ." , ".$b_dist;;
                
                $nestedData["id"] = $unit_id;
                $nestedData["ubin"] = "<a href='".base_url('staffs/cafs/details/').$unit_id."'>$ubin</a>";
                $nestedData["Name"] = $Name;
                $nestedData["unit_type"] = $unit_type;
                $nestedData["b_street_name1"] = $address;
                $data[] = $nestedData;
            }//End of foreachS
        }//End of if
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }//End of getDatatableRecords()
    
    function details($unit_id = NULL) {
        $data = array();
        $this->load->model("users/unit_model");
        if($this->unit_model->get_row($unit_id)) {
            $data["unit"] = $this->unit_model->get_row($unit_id);
        }//End of if
        $this->load->view("staffs/cafdetails_view", $data);
    }//End of details()
}//End of Cafs