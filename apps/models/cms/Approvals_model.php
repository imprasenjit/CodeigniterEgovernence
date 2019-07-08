<?php

/**
 * Description of Caf_model
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Approvals_model extends CI_Model {

    function getApprovals() {
        $caregory = array(
            1 => "Pre-Establishment",
            2 => "Pre-Operation",
            3 => "Post Commencement",
            4 => "Returns & Renewals",
            5 => "Other Approvals",
            6 => "Registers",
        );

        $columns = array(
            0 => 'id',
            1 => 'sub_dept',
            2 => 'application_type',
            3 => 'service_name',
            4 => 'action'
        );
        $dept = $this->input->post("dept");
        $subdept = $this->input->post("sub_dept");
        $cat = $this->input->post("cat");
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->tot_rows($dept, $subdept, $cat);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, $dept, $subdept, $cat);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->tot_search_rows($search);
        }
        $data = array();
        if (!empty($records)) {
            foreach ($records as $post) {
                $id = $post->id;
                $sub_dept = $post->sub_dept;
                $application_type = $post->application_type;
                $service_name = $post->service_name;
                $action = '<a href="' . base_url("cms/approvals/approvalview/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/approvals/editapproval/$id/") . '" class="btn btn-primary">Edit</a>';

                $nestedData["id"] = $id;
                $nestedData["sub_dept"] = $this->getSubDepartment_model->get_deptbyid($sub_dept)->name;
                $nestedData["application_type"] = $caregory[$application_type];
                $nestedData["service_name"] = $service_name;
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

    //End of getApprovals()

    function tot_rows($dept, $subdept, $cat) {
        $this->load->database();
        $this->db->select("id");
        $this->db->from("list_of_approvals");
        $this->db->where("status", "1");
        if($dept!="" && $subdept!=""){
        $this->db->where("dept_code", $dept);
        $this->db->where("sub_dept", $subdept);
        }
        if (!empty($cat)) {
            $this->db->where("application_type", $cat);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

//End of tot_rows()



    function all_rows($limit, $start, $col, $dir, $dept, $subdept, $cat) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        if($dept!="" && $subdept!=""){
        $this->db->where("dept_code", $dept);
        $this->db->where("sub_dept", $subdept);
        }
        if (!empty($cat)) {
            $this->db->where("application_type", $cat);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("list_of_approvals");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        $this->db->like("service_name", $search);
        $this->db->or_like("sample_name", $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("list_of_approvals");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $dept_db->close();
            return $query->result();
        }
    }

//End of search_rows()

    function tot_search_rows($search) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        $this->db->like("service_name", $search);
        $this->db->or_like("sample_name", $search);
        $this->db->from("list_of_approvals");
        $query = $this->db->get();
        $this->db->close();
        return $query->num_rows();
    }

//End of tot_search_rows()

    function getApproval($id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        $this->db->where("id", $id);
        $this->db->from("list_of_approvals");
        $query = $this->db->get();
        return $query->row();
    }

    //End of getApproval()

    function saveapproval() {
        $this->load->helper("fileupload");
        $files = $this->input->post("uplodedfile");
        $uploades = moveFile(1, $files);
        $uploadprocedure = $uploades["procedure_file"];
        $form_file = $uploades["form_file"];
        $today = date("Y-m-d H:i:s");
        $documentslist = json_encode(array("obj" => $this->input->post("documentslist")));
        $data = array(
            "paycode" => $this->input->post("paycode"),
            "dept_code" => $this->input->post("dept"),
            "sub_dept" => $this->input->post("sub_dept"),
            "form_no" => $this->input->post("form_no"),
            "service_name" => $this->input->post("service_name"),
            "application_type" => $this->input->post("app_cat"),
            "is_inspection" => $this->input->post("is_inspection"),
            "who_should_apply" => $this->input->post("who_apply"),
            "how_to_apply" => $this->input->post("how_apply"),
            "documents_list" => $this->input->post("doc_list"),
            "documentslist" => $documentslist,
            "payment_required" => $this->input->post("payment_required"),
            "approval_time" => $this->input->post("approval_timeline"),
            "timeline" => $this->input->post("timeline"),
            "fees_payment" => $this->input->post("fee"),
            "sample_form" => $this->input->post(""),
            "apply_online" => $this->input->post("apply_link"),
            "sample_name" => $this->input->post("short_service_name"),
            "approval_procedure" => $this->input->post("approval_procedure"),
            "procedure_attachment" => $uploadprocedure
        );
        $this->load->database();
        $this->db->insert("list_of_approvals", $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array("x" => 1, "info" => "Data Saved successfully"));
        } else {
            echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
        }
    }

    //End of saveapproval()


    function updateapproval() {
        $id = $this->uri->segment(4);
        $this->load->helper("fileupload");
        $files = $this->input->post("uplodedfile");
        $uploades = moveFile(1, $files);
        $uploadprocedure = $uploades["procedure_file"];
        $form_file = $uploades["form_file"];
        $today = date("Y-m-d H:i:s");
        $documentslist = json_encode(array("obj" => $this->input->post("documentslist")));
        $data = array(
            "paycode" => $this->input->post("paycode"),
            "dept_code" => $this->input->post("dept"),
            "sub_dept" => $this->input->post("sub_dept"),
            "form_no" => $this->input->post("form_no"),
            "service_name" => $this->input->post("service_name"),
            "application_type" => $this->input->post("app_cat"),
            "is_inspection" => $this->input->post("is_inspection"),
            "who_should_apply" => $this->input->post("who_apply"),
            "how_to_apply" => $this->input->post("how_apply"),
            "documents_list" => $this->input->post("doc_list"),
            "documentslist" => $documentslist,
            "payment_required" => $this->input->post("payment_required"),
            "approval_time" => $this->input->post("approval_timeline"),
            "timeline" => $this->input->post("timeline"),
            "fees_payment" => $this->input->post("fee"),
            "sample_form" => $this->input->post(""),
            "apply_online" => $this->input->post("apply_link"),
            "sample_name" => $this->input->post("short_service_name"),
            "approval_procedure" => $this->input->post("approval_procedure"),
            "procedure_attachment" => $uploadprocedure
        );
        $this->load->database();
        $this->db->where("id", $id);
        $this->db->update("list_of_approvals", $data);
        if ($this->db->affected_rows() >= 0) {
            echo json_encode(array("x" => 1, "info" => "Data Saved successfully"));
        } else {
            echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
        }
    }

    //End of updateapproval()
}
