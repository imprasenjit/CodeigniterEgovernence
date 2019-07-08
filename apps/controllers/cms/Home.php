<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Home extends Eodbc {

    public function index() {
        $this->load->model("cms/home_model");
        //USER MANAGEMENT
        $totalusers = $this->home_model->getTotalUsers();
        $total_verified_users = $this->home_model->getVerifiedUsers();
        $total_unverified_users = $totalusers - $total_verified_users;
        //USER MANAGEMENT
        //  CAF MANAGEMENT
        $totalcaf = $this->home_model->getTotalCaf();
        $total_unapproved_cafs = $this->home_model->getUnapprovedCaf();
        $total_underquery_cafs = $this->home_model->getQueridCaf();
        $total_approved_cafs = $this->home_model->getApprovedCaf();
        $total_rejected_cafs = $this->home_model->getRejectedcafs();
        // END OF CAF MANAGEMENT
        // UNIT MANAGEMENT
        $totalunit = $this->home_model->getTotalUnit();
        $total_unapproved_units = $this->home_model->getUnapprovedUnit();
        $total_underquery_units = $this->home_model->getQueridUnit();
        $total_approved_units = $this->home_model->getApprovedUnit();
        $total_rejected_units = $this->home_model->getRejectedUnit();
        $total_modified_units = $this->home_model->getModifiedUnit();
        //END OF UNIT MANAGEMENT

        $total_list_of_approvals = $this->home_model->getTotalListOfApprovals();
        $totalnotifications = $this->home_model->getNotifications();
        $totaldraftnotifications = $this->home_model->getDraftNotifications();
        $data = array(
            "total_users" => $totalusers,
            "total_unverified_users" => $total_unverified_users,
            "total_verified_users" => $total_verified_users,
            "total_cafs" => $totalcaf,
            "total_unapproved_cafs" => $total_unapproved_cafs,
            "total_underquery_cafs" => $total_underquery_cafs,
            "total_approved_cafs" => $total_approved_cafs,
            "total_rejected_cafs" => $total_rejected_cafs,
            //End of caf management
            "totalunit" => $totalunit,
            "total_unapproved_units" => $total_unapproved_units,
            "total_underquery_units" => $total_underquery_units,
            "total_approved_units" => $total_approved_units,
            "total_rejected_units" => $total_rejected_units,
            "total_modified_units" => $total_modified_units,
            //End of Unit management
            "total_list_of_approvsls" => $total_list_of_approvals,
            "totalnotifications" => $totalnotifications,
            "totaldraftnotifications" => $totaldraftnotifications,
        );
        $this->load->view("cms/requires/header", array("title" => "Dashboard"));
        $this->load->view("cms/home_view", $data);
        $this->load->view("cms/requires/footer");
    }

//End of index()
}

//End of Welcome
