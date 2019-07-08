<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Payments extends Eodbc {
    
    public $dept_code;
    
    function __construct() {
        parent::__construct();
        $this->load->model("cms/paymentresponses_model");
        $this->load->helper("encode");
    }//End of __construct()
    
    function index($dept=NULL) {
        $this->dept_code = $dept;
        $this->session->set_userdata("session_deptcode", $this->dept_code);
        $this->load->view("cm/paymentreports_view");
    }//End of index()
            
    function getrecords() {
        $deptcode = $this->session->session_deptcode;
        $this->load->helper("unittype");
        $columns = array(
            0 => "challan_no",
            1 => "txn_time",
            2 => "txn_refno",
            3 => "txn_amnt",
            4 => "bank_refno"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->paymentresponses_model->tot_deptrows($deptcode);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->paymentresponses_model->all_deptrows($deptcode, $limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->paymentresponses_model->search_deptrows($deptcode, $limit, $start, $search, $order, $dir);
            $totalFiltered = $this->paymentresponses_model->tot_search_deptrows($deptcode, $search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $challan_no = $rows->challan_no;
                $txn_time=$rows->txn_time;
                $txn_refno=$rows->txn_refno;
                $txn_amnt = $rows->txn_amnt;
                $bank_refno = $rows->bank_refno;
                
                $nestedData["challan_no"] = $challan_no;
                $nestedData["txn_time"] = date("d-m-Y H:i", strtotime($txn_time));
                $nestedData["txn_refno"] = $txn_refno;
                $nestedData["txn_amnt"] = $txn_amnt;
                $nestedData["bank_refno"] = $bank_refno;
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
    
    function getfilteredrecords() {
        $deptcode = $this->session->session_deptcode;
        $this->load->helper("unittype");
        $frmdt = date("Y-m-d", strtotime($this->input->post('frmdt')));
        $todt = date("Y-m-d", strtotime($this->input->post('todt')));        
        $results = $this->paymentresponses_model->get_deptdaterows($deptcode, $frmdt, $todt); ?>
        <table class="table table-bordered table-responsive" id="dtbl">
            <thead>
                <tr>
                    <th>Challen No.</th>
                    <th>Date &amp; Time</th>
                    <th>Ref. No.</th>
                    <th>Amount</th>
                    <th>Bank Ref.</th>
                </tr>
            </thead>
        <?php if ($results) { ?>
            <tbody>
            <?php foreach ($results as $rows) {
                $challan_no = $rows->challan_no;
                $txn_time= date("d-m-Y H:i", strtotime($rows->txn_time));
                $txn_refno = $rows->txn_refno;
                $txn_amnt = $rows->txn_amnt;
                $bank_refno = $rows->bank_refno; ?>
                <tr>
                    <td><?=$challan_no?></td>
                    <td><?=$txn_time?></td>
                    <td><?=$txn_refno?></td>
                    <td><?=$txn_amnt?></td>
                    <td><?=$bank_refno?></td>
                </tr>
            <?php }//End of foreach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Date &amp; Time</th>
                    <th>Amount</th>
                    <th>Bank Ref.</th>
                </tr>
            </tfoot>
        </table>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dtbl").DataTable({
                    dom: "Bfrtip",
                    buttons: ["excel", "pdf", "print"],
                    "order": [[1, 'desc']],
                    "lengthMenu": [[10, 20, 50, 100, 200], [10, 20, 50, 100, 200]],
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;
                        var intVal = function (i) {
                            return typeof i === 'string' ?i.replace(/[\$,]/g, '') * 1 :typeof i === 'number' ? i : 0;
                        };
                        pageTotal = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        AllTotal = api.column(3).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        $(api.column(0).footer()).html('Total : ');
                        $(api.column(3).footer()).html('<i class="fa fa-inr"></i> '+pageTotal.toFixed(3)+" ("+AllTotal.toFixed(3)+")");
                        $(api.column(4).footer()).html('');
                    }
                });                    
            });
        </script>
        <?php } else {
            echo "No records found";
        }//End of if else
    }//End of getfilteredrecords()
}//End of Payments
