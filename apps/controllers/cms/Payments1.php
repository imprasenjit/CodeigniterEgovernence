<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Payments extends Eodbc {
    
    public $dept_code;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = "pcb";//$this->session->staff_dept;
        $this->load->model("staffs/payments_model");
        $this->load->model("staffs/offices_model");
    }//End of __construct()
            
    function index() {
        $data["title"] = "Payment Reports";
        $this->load->view("cms/payments_view",$data);
    }//End of index()
    
    function getrecords() {
        $uid = 1;//$this->session->staff_id;
        $dept = "pcb";//$this->session->staff_dept;
        $this->load->helper("unittype");
        $columns = array(
            0 => "txn_id",
            1 => "txn_time",
            2 => "uain",
            3 => "txn_amnt",
            4 => "txn_gateway"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->payments_model->tot_rows($dept, $uid);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->payments_model->all_rows($limit, $start, $order, $dir, $dept, $uid);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->payments_model->search_rows($limit, $start, $search, $order, $dir, $dept, $uid);
            $totalFiltered = $this->payments_model->tot_search_rows($search, $dept, $uid);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {                        
                $txn_id = $rows->txn_id;
                $txn_time=$rows->txn_time;
                $uain=$rows->uain;
                $txn_amnt = $rows->txn_amnt;
                $txn_gateway = $rows->txn_gateway;
                
                $nestedData["txn_id"] = $txn_id;
                $nestedData["txn_time"] = date("d-m-Y H:i", strtotime($txn_time));
                $nestedData["uain"] = $uain;
                $nestedData["txn_amnt"] = $txn_amnt;
                $nestedData["txn_gateway"] = ($txn_gateway == 1)?"Bill Desk":"Treasury";
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
    }//End of getrecords()
}//End of Payments
